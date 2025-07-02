<?php
// Sesuaikan namespace dengan lokasi file Anda
namespace App\Controllers; 

use App\Controllers\BaseController;
use App\Models\OrderModel;
use Dompdf\Dompdf; 

class DashboardController extends BaseController
{
    public function index()
    {
        $orderModel = new OrderModel();
        
        // 1. Ambil semua filter dari URL
        $filterTime = $this->request->getGet('filter') ?? 'today';
        $keyword = $this->request->getGet('keyword') ?? '';

        // 2. Tentukan rentang tanggal
        $dateRange = $this->getDateRange($filterTime);

        // --- INI BAGIAN UTAMA YANG DIPERBAIKI ---
        // 3. Dapatkan instance Query Builder murni dari model
        $builder = $orderModel->builder();

        // Terapkan filter ke builder
        $builder->where('created_at >=', $dateRange['start'])
                ->where('created_at <=', $dateRange['end']);

        if (!empty($keyword)) {
            $builder->groupStart()
                    ->like('customer_name', $keyword)
                    ->orLike('id', $keyword)
                    ->groupEnd();
        }
        
        // 4. Ambil statistik dari builder yang sudah lengkap
        $data['orders_count'] = (clone $builder)->countAllResults();
        $data['new_orders'] = (clone $builder)->whereIn('status', ['Baru', 'Diproses'])->countAllResults();
        $data['total_revenue'] = (clone $builder)->selectSum('total_price')->where('status', 'Selesai')->get()->getRow()->total_price ?? 0;

        // 5. Kirim builder yang sudah difilter ke dalam method getOrdersWithItems
        $data['recent_orders'] = $orderModel->getOrdersWithItems($builder);
        
        // 6. Kirim semua filter aktif ke view
        $data['active_filter'] = $filterTime;
        $data['keyword'] = $keyword;
        
        return view('admin/dashboard', $data);
    }

    // Fungsi getDateRange() tetap sama
    private function getDateRange(string $filter): array
    {
        $today = date('Y-m-d');
        switch ($filter) {
            case 'this_week':
                return ['start' => date('Y-m-d 00:00:00', strtotime('monday this week')), 'end' => date('Y-m-d 23:59:59', strtotime('sunday this week'))];
            case 'this_month':
                return ['start' => date('Y-m-01 00:00:00'), 'end' => date('Y-m-t 23:59:59')];
            case 'this_year':
                return ['start' => date('Y-01-01 00:00:00'), 'end' => date('Y-12-31 23:59:59')];
            case 'today':
            default:
                return ['start' => $today . ' 00:00:00', 'end' => $today . ' 23:59:59'];
        }
    }

    public function downloadReport()
    {
        // 1. Ambil filter dari URL (sama seperti di dashboard)
        $filterTime = $this->request->getGet('filter') ?? 'today';
        $keyword = $this->request->getGet('keyword') ?? '';

        // 2. Ambil data yang sudah difilter (logika sama seperti di index())
        $orderModel = new OrderModel();
        $dateRange = $this->getDateRange($filterTime);
        $builder = $orderModel->builder();
        $builder->where('created_at >=', $dateRange['start'])->where('created_at <=', $dateRange['end']);
        if (!empty($keyword)) {
            $builder->groupStart()->like('customer_name', $keyword)->orLike('id', $keyword)->groupEnd();
        }
        $orders = $orderModel->getOrdersWithItems($builder);

        // 3. Siapkan data untuk dikirim ke view PDF
        $data['orders'] = $orders;
        $data['filterTime'] = $filterTime;
        $data['keyword'] = $keyword;
        $data['dateRange'] = $dateRange;

        // 4. Render HTML dari sebuah file view khusus untuk PDF
        $html = view('admin/reports/order_report_pdf', $data);

        // 5. Konfigurasi dan Generate PDF dengan DomPDF
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait'); // Ukuran kertas
        $dompdf->render();

        // 6. Download file PDF di browser
        $filename = 'laporan-pesanan-' . date('Y-m-d') . '.pdf';
        $dompdf->stream($filename, ['Attachment' => true]); // true = download, false = tampilkan di browser
    }
}