<?php
namespace App\Controllers;

// Pastikan use statement ini ada dan benar
use App\Models\OrderModel;
use App\Models\OrderItemModel;

class OrderController extends BaseController
{
    // Method untuk menerima pesanan dari pengguna
    public function create()
    {
        if ($this->request->isAJAX()) {
            $json = $this->request->getJSON();
            if (empty($json->items) || !session()->get('isLoggedIn') || session()->get('role') !== 'user') {
                 return $this->response->setJSON(['success' => false, 'message' => 'Akses ditolak atau data tidak lengkap.']);
            }
            
            $orderModel = new OrderModel();
            $orderItemModel = new OrderItemModel();

            $totalPrice = 0;
            foreach ($json->items as $item) {
                $totalPrice += $item->price * $item->quantity;
            }

            $orderData = [
                'user_id'           => session()->get('user_id'),
                'customer_name'     => session()->get('fullname'),
                'customer_whatsapp' => session()->get('username'),
                'total_price'       => $totalPrice,
                'status'            => 'Baru'
            ];
            $orderModel->insert($orderData);
            $orderId = $orderModel->getInsertID();

            foreach ($json->items as $item) {
                $itemData = [
                    'order_id'  => $orderId,
                    'menu_name' => esc($item->name),
                    'quantity'  => $item->quantity,
                    'price'     => $item->price
                ];
                $orderItemModel->insert($itemData);
            }
            
            return $this->response->setJSON(['success' => true, 'order_id' => $orderId]);
        }
        return $this->response->setStatusCode(403, 'Akses Ditolak');
    }
    
    // Method untuk menampilkan halaman Kelola Pesanan
    
    
    public function manage()
{
    $orderModel = new OrderModel();
    // Panggil method dengan argumen yang benar
    // Argumen pertama ($builder) kita kosongkan (null), argumen kedua ($status) kita isi
    $data['orders'] = $orderModel->getOrdersWithItems(null, ['Baru', 'Diproses']);

    // Logika pencarian tidak lagi di sini, karena sudah pindah ke Dashboard
    $data['keyword'] = ''; 

    return view('admin/orders/manage', $data);
}

    // Method untuk menampilkan halaman Riwayat Pesanan
    public function history()
{
    $orderModel = new OrderModel();
    // Panggil method dengan argumen yang benar
    // Argumen pertama ($builder) kita kosongkan (null), argumen kedua ($status) kita isi
    $data['orders'] = $orderModel->getOrdersWithItems(null, ['Selesai', 'Dibatalkan']);
    return view('admin/orders/history', $data);
}

    // Method untuk mengubah status pesanan
    public function updateStatus($id, $status)
    {
        $allowedStatus = ['Diproses', 'Selesai', 'Dibatalkan'];
        if (!in_array($status, $allowedStatus)) {
            return redirect()->back()->with('error', 'Status tidak valid!');
        }

        $orderModel = new OrderModel();
        $orderModel->update($id, ['status' => $status]);
        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui.');
    }
}