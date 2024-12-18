<?php

namespace App\Controllers;

use App\Models\ModelPenjualan;
use App\Models\ModelDetailPenjualan;
use App\Models\ModelKeranjang;
use App\Models\ModelPelanggan;
use App\Models\ModelBarang;
use CodeIgniter\Exceptions\PageNotFoundException;

class Checkout extends BaseController
{
    protected $session;
    protected $penjualanModel;
    protected $detailPenjualanModel;
    protected $keranjangModel;
    protected $barangModel;
    protected $pelangganModel; // Menambahkan model pelanggan

    public function __construct()
    {
        $this->penjualanModel = new ModelPenjualan();
        $this->detailPenjualanModel = new ModelDetailPenjualan();
        $this->keranjangModel = new ModelKeranjang();
        $this->pelangganModel = new ModelPelanggan();
        $this->barangModel = new ModelBarang(); // Inisialisasi model pelanggan
        $this->session = session();
    }

    public function pesanan()
{
    $username = $this->session->get('username');

    if (!$username) {
        return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
    }

    // Ambil data pelanggan untuk mendapatkan kode_pelanggan
    $pelanggan = $this->pelangganModel->where('username', $username)->first();

    if (!$pelanggan) {
        return redirect()->to('/login')->with('error', 'Pelanggan tidak ditemukan.');
    }

    $kode_pelanggan = $pelanggan['kode_pelanggan'];

    // Ambil data penjualan berdasarkan kode_pelanggan
    $penjualan = $this->penjualanModel->where('kode_pelanggan', $kode_pelanggan)->findAll();

    if (empty($penjualan)) {
        return redirect()->to('/keranjang')->with('error', 'Tidak ada pesanan ditemukan.');
    }

    // Ambil detail pesanan untuk setiap penjualan dan relasikan dengan tabel barang
    $dataPenjualan = [];
    foreach ($penjualan as $p) {
        // Ambil detail penjualan
        $detailPenjualan = $this->detailPenjualanModel
            ->select('detail_penjualan.*, barang.nama_brg, barang.ukuran')
            ->join('barang', 'barang.kode_brg = detail_penjualan.kode_brg')
            ->where('detail_penjualan.id_penjualan', $p['id_penjualan'])
            ->findAll();

        $dataPenjualan[] = [
            'penjualan' => $p,
            'detailPenjualan' => $detailPenjualan
        ];
    }

    // Cek apakah ada parameter showModal, jika ada maka tampilkan modal untuk pesanan tersebut
    $showModal = $this->request->getGet('showModal');
    $data = [
        'dataPenjualan' => $dataPenjualan,
        'showModal' => $showModal,  // Tambahkan flag untuk menampilkan modal
    ];

    return view('user/pesanan/index', $data);
}

    public function process()
{
    $username = $this->session->get('username');

    if (!$username) {
        return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
    }

    // Ambil kode_pelanggan berdasarkan username
    $pelanggan = $this->pelangganModel->where('username', $username)->first();

    if (!$pelanggan) {
        return redirect()->to('/login')->with('error', 'Pelanggan tidak ditemukan.');
    }

    $kode_pelanggan = $pelanggan['kode_pelanggan'];

    // Ambil data keranjang dari form POST (produk yang dipilih)
    $selectedItems = $this->request->getPost('selectedItems');
    if (!$selectedItems) {
        return redirect()->to('/keranjang')->with('error', 'Tidak ada produk yang dipilih.');
    }

    $selectedItems = json_decode($selectedItems, true);

    // Hitung total harga
    $totalHarga = array_sum(array_column($selectedItems, 'total_harga'));

    // Simpan ke tabel penjualan
    $idPenjualan = $this->penjualanModel->insert([
        'kode_pelanggan' => $kode_pelanggan,
        'total_harga' => $totalHarga,
        'status' => 'Belum Lunas',
        'tanggal_pembelian' => date('Y-m-d H:i:s'),
    ], true);

    if (!$idPenjualan) {
        return redirect()->to('/checkout')->with('error', 'Gagal memproses checkout.');
    }

    // Simpan detail penjualan dan kurangi stok barang
foreach ($selectedItems as $item) {
    $kode_brg = $this->keranjangModel->where('id', $item['id'])->first()['kode_brg'];

    // Simpan detail penjualan
    $this->detailPenjualanModel->insert([
        'id_penjualan' => $idPenjualan,
        'kode_brg' => $kode_brg,
        'jumlah' => $item['jumlah'],
        'harga_brg' => $item['harga_brg'],
        'total_harga' => $item['total_harga'],
    ]);

    // Kurangi stok barang
    $barang = $this->barangModel->where('kode_brg', $kode_brg)->first();
        if ($barang) {
            $stokBaru = $barang['stok'] - $item['jumlah'];
            $this->barangModel->update($barang['kode_brg'], ['stok' => $stokBaru]); // Gunakan kode_brg sebagai identifier
        }
}

// Hapus produk yang dipilih dari keranjang
foreach ($selectedItems as $item) {
    $this->keranjangModel->where('id', $item['id'])->delete();
}


    // Redirect ke halaman /pesanan dan berikan parameter untuk menampilkan modal
    return redirect()->to('/pesanan?idPenjualan=' . $idPenjualan)
    ->with('success', 'Checkout berhasil. Silakan upload bukti pembayaran.');
}

public function getBuktiBayar($id_penjualan)
{
    $penjualan = $this->penjualanModel->find($id_penjualan);

    if ($penjualan && !empty($penjualan['bukti_bayar'])) {
        return $this->response->setJSON([
            'status' => 'success',
            'bukti_bayar' => $penjualan['bukti_bayar']
        ]);
    }

    return $this->response->setJSON([
        'status' => 'error',
        'message' => 'Bukti bayar tidak ditemukan.'
    ]);
}



    public function uploadBukti()
{
    $idPenjualan = $this->request->getPost('id_penjualan');

    if (!$idPenjualan) {
        return redirect()->to('/pesanan')->with('error', 'Data penjualan tidak ditemukan.');
    }

    $penjualan = $this->penjualanModel->find($idPenjualan);

    if (!$penjualan) {
        return redirect()->to('/pesanan')->with('error', 'Pesanan tidak valid.');
    }

    // Mengambil file bukti bayar yang diupload
    $buktiBayar = $this->request->getFile('bukti_bayar');

    // Pastikan file bukti bayar valid dan belum dipindahkan
    if ($buktiBayar->isValid() && !$buktiBayar->hasMoved()) {
        // Ambil nama file asli
        $buktiBayarName = $buktiBayar->getName(); // Menggunakan nama file asli

        // Pindahkan file bukti bayar ke direktori 'assets/dist/img/bukti'
        $buktiBayar->move('assets/dist/img/bukti', $buktiBayarName);
    } else {
        $buktiBayarName = null;
        return redirect()->to('/pesanan')->with('error', 'Gagal mengupload bukti pembayaran. Pastikan file valid dan dipilih.');
    }

    // Update data penjualan dengan nama file bukti bayar
    $this->penjualanModel->update($idPenjualan, [
        'bukti_bayar' => $buktiBayarName,  // Simpan nama file ke database
        'status' => 'Menunggu Konfirmasi', // Update status pesanan
    ]);

    return redirect()->to('/pesanan')->with('success', 'Bukti pembayaran berhasil diupload. Tunggu konfirmasi admin.');
}

    
}
