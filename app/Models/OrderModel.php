<?php
namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\BaseBuilder;

class OrderModel extends Model
{
    protected $table            = 'orders';
    protected $primaryKey       = 'id';
    
    // Pastikan 'user_id' terdaftar di sini
    protected $allowedFields    = ['user_id', 'customer_name', 'customer_whatsapp', 'total_price', 'status'];
    
    // Aktifkan timestamps untuk kolom 'created_at' secara otomatis
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = ''; // Tidak ada kolom 'updated_at'

    /**
     * Mengambil data pesanan lengkap dengan detail item-itemnya.
     * Fungsi ini sekarang menerima objek Query Builder yang sudah difilter
     * dari controller, membuatnya sangat fleksibel untuk pencarian dan filter.
     *
     * @param BaseBuilder|null $builder Instance Query Builder yang sudah disiapkan.
     * @param array|string|null $status Filter status tambahan.
     * @return array
     */
    public function getOrdersWithItems(BaseBuilder $builder = null, $status = null): array
    {
        // Jika tidak ada builder yang diberikan, mulai dari awal
        if ($builder === null) {
            $builder = $this;
        }

        // Terapkan filter status jika ada
        if ($status) {
            $builder->whereIn('status', is_array($status) ? $status : [$status]);
        }
        
        // Eksekusi query utama untuk mendapatkan data pesanan
        $orders = $builder->orderBy('created_at', 'DESC')->get()->getResultArray();

        // Jika tidak ada pesanan yang cocok, kembalikan array kosong
        if (empty($orders)) {
            return [];
        }

        // --- Proses Eager Loading untuk mengambil detail item ---

        // 1. Kumpulkan semua ID pesanan dari hasil query di atas
        $orderIds = array_column($orders, 'id');

        // 2. Ambil SEMUA item untuk SEMUA pesanan dalam SATU query saja
        $orderItemModel = new OrderItemModel();
        $items = $orderItemModel->whereIn('order_id', $orderIds)->findAll();

        // 3. Kelompokkan item-item tersebut ke dalam sebuah array berdasarkan 'order_id'
        $groupedItems = [];
        foreach ($items as $item) {
            $groupedItems[$item['order_id']][] = $item;
        }

        // 4. Gabungkan pesanan dengan item-itemnya yang sudah dikelompokkan
        foreach ($orders as &$order) {
            // Jika ada item untuk order ini, masukkan ke array. Jika tidak, masukkan array kosong.
            $order['items'] = $groupedItems[$order['id']] ?? [];
        }

        return $orders;
    }
}