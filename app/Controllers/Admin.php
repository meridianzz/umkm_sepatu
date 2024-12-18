<?php

namespace App\Controllers;

use App\Models\ModelAdmin;
use App\Models\ModelPenjualan;
use App\Models\ModelPelanggan;
use App\Models\ModelDetailPenjualan;
use App\Models\ModelBarang;
use CodeIgniter\Controller;

class Admin extends Controller
{
    protected $penjualanModel;
    protected $barangModel;
    protected $pelangganModel;
    protected $detailPenjualanModel;
    

    public function __construct()
    {
        $this->penjualanModel = new ModelPenjualan();
        $this->barangModel = new ModelBarang();
        $this->pelangganModel = new ModelPelanggan();
        $this->detailPenjualanModel= new ModelDetailPenjualan();

    }
    // Menampilkan halaman login
    public function index()
    {
        return view('loginadmin');  // Pastikan view-nya bernama loginadm
    }

    public function halamanAdmin()
    {
        $totalCustomer = $this->pelangganModel->countAll(); // Menghitung total pelanggan
        $totalPenjualan = $this->penjualanModel->countAll(); // Menghitung total penjualan
        
        // Menghitung total produk yang terjual (jumlah barang yang dibeli) dengan status selesai
        $totalPenjualanProduk = $this->detailPenjualanModel
            ->selectSum('jumlah') // Menghitung total jumlah barang yang dibeli
            ->join('penjualan', 'penjualan.id_penjualan = detail_penjualan.id_penjualan')
            ->where('penjualan.status', 'selesai') // Hanya yang statusnya selesai
            ->first(); // Mengambil hasil pertama
    
        // Menghitung total pendapatan (total harga semua produk yang telah dibeli) dengan status selesai
        $totalPendapatan = $this->detailPenjualanModel
            ->select('SUM(detail_penjualan.jumlah * barang.harga_brg) as total_pendapatan') // Menjumlahkan total pendapatan
            ->join('penjualan', 'penjualan.id_penjualan = detail_penjualan.id_penjualan')
            ->join('barang', 'barang.kode_brg = detail_penjualan.kode_brg') // Menyambungkan barang untuk harga
            ->where('penjualan.status', 'selesai') // Hanya yang statusnya selesai
            ->first(); // Mengambil hasil pertama
    
        // Menyiapkan data untuk dikirim ke view
        $data = [
            'total_customer' => $totalCustomer,
            'total_penjualan' => $totalPenjualan,
            'total_produk_terjual' => $totalPenjualanProduk['jumlah'] ?? 0, // Menampilkan jumlah produk terjual
            'total_pendapatan' => $totalPendapatan['total_pendapatan'] ?? 0, // Menampilkan total pendapatan
        ];
    
        // Memuat view dengan data yang sudah dipersiapkan
        return view('admin/halamanAdmin', $data);
    }

    public function penjualan()
{
      // Ambil data penjualan
      $penjualan = $this->penjualanModel->findAll();

      // Ambil detail penjualan untuk setiap penjualan
      foreach ($penjualan as &$p) {
          $p['detailPenjualan'] = $this->detailPenjualanModel
              ->select('detail_penjualan.*, barang.nama_brg, barang.ukuran')
              ->join('barang', 'barang.kode_brg = detail_penjualan.kode_brg')
              ->where('detail_penjualan.id_penjualan', $p['id_penjualan'])
              ->findAll();
      }

      // Kirim data ke view
      return view('admin/penjualan/index', ['penjualan' => $penjualan]);
    return view('admin/penjualan/index', $data);
}

public function update_status($id_penjualan)
{
    // Ambil data dari form
    $status = $this->request->getPost('status');

    // Validasi jika status valid
    $validStatuses = ['Menunggu Konfirmasi', 'Proses', 'Selesai', 'Dibatalkan'];
    if (!in_array($status, $validStatuses)) {
        return redirect()->back()->with('error', 'Status tidak valid.');
    }

    // Ambil data penjualan
    $penjualan = $this->penjualanModel->find($id_penjualan);
    if (!$penjualan) {
        return redirect()->to('/datapenjualan')->with('error', 'Penjualan tidak ditemukan.');
    }

    // Jika status diubah menjadi "Dibatalkan", kembalikan stok barang
    if ($status === 'Dibatalkan') {
        // Ambil detail penjualan berdasarkan id_penjualan
        $detailPenjualan = $this->detailPenjualanModel->where('id_penjualan', $id_penjualan)->findAll();

        foreach ($detailPenjualan as $detail) {
            // Ambil data barang berdasarkan kode_brg
            $barang = $this->barangModel->where('kode_brg', $detail['kode_brg'])->first();
            if ($barang) {
                // Tambahkan kembali stok barang
                $stokBaru = $barang['stok'] + $detail['jumlah'];
                $this->barangModel->update($barang['kode_brg'], ['stok' => $stokBaru]);
            }
        }
    }

    // Update status di database
    $this->penjualanModel->update($id_penjualan, ['status' => $status]);

    return redirect()->to('/datapenjualan')->with('success', 'Status penjualan berhasil diperbarui.');
}

    

    // Proses login admin
    public function login()
    {
        // Ambil data dari form
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        
        // Load model admin
        $model = new ModelAdmin();
        
        // Cari admin berdasarkan username
        $admin = $model->where('username', $username)->first();
        
        // Cek apakah username ada dan password cocok
        if ($admin && $admin['password'] === $password) {
            // Jika login berhasil, set session
            session()->set([
                'isLoggedInAdmin' => true,  // Menandakan login berhasil sebagai admin
                'admin_id'        => $admin['id'],
                'admin_name'      => $admin['nama_admin']
            ]);
            
            return redirect()->to('/dbadmin'); // Redirect ke halaman dashboard admin
        } else {
            // Jika login gagal
            session()->setFlashdata('error', 'Username atau password salah!');
            return redirect()->to('/admin'); // Kembali ke halaman login
        }
    }
    
    

    // Fungsi untuk logout
    public function logout()
    {
        // Hapus semua session
        session()->destroy();

        // Redirect kembali ke halaman login
        return redirect()->to('/admin');  // Mengarahkan ke halaman login setelah logout
    }
}
