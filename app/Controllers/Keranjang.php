<?php

namespace App\Controllers;

use App\Models\ModelKeranjang;
use App\Models\ModelBarang;

class Keranjang extends BaseController
{
    protected $keranjangModel;
    protected $barangModel;

    public function __construct()
    {
        $this->keranjangModel = new ModelKeranjang();
        $this->barangModel = new ModelBarang();
    }

    public function getKodeBarang()
    {
        $nama_brg = $this->request->getGet('nama_brg');
        $ukuran = $this->request->getGet('ukuran');
    
        $barang = $this->barangModel
            ->where('nama_brg', $nama_brg)
            ->where('ukuran', $ukuran)
            ->first();
    
        if ($barang) {
            return $this->response->setJSON(['kode_brg' => $barang['kode_brg']]);
        }
    
        return $this->response->setJSON(['kode_brg' => null]);
    }

    public function getUkuran($nama_brg)
{
    // Ambil data ukuran berdasarkan nama_brg
    $data = $this->barangModel->where('nama_brg', $nama_brg)->findAll();

    // Kirimkan data ukuran dalam format JSON
    return $this->response->setJSON($data);
}


    // Tambahkan barang ke keranjang
    public function addToCart()
    {
        $data = $this->request->getPost();
        // Ambil data dari AJAX request
        $username = $this->request->getPost('username'); // Username pengguna
        $kode_brg = $this->request->getPost('kode_brg'); // Kode barang
        $jumlah = $this->request->getPost('jumlah');     // Jumlah barang
        $harga_brg = $this->request->getPost('harga_brg'); // Harga barang
        $total_harga = $this->request->getPost('total_harga'); // Harga total
    
        log_message('debug', 'Data diterima: ' . json_encode($data));
    
        // Validasi input
        if (empty($username) || empty($kode_brg) || empty($jumlah) || empty($harga_brg) || empty($total_harga)) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Cek Ukuran anda.']);
        }
    
        // Periksa apakah barang sudah ada di keranjang
        $existingItem = $this->keranjangModel->where([
            'username' => $username,
            'kode_brg' => $kode_brg,
        ])->first();
    
        if ($existingItem) {
            // Jika sudah ada, update jumlah dan total harga berdasarkan harga_brg dan jumlah baru
            $newJumlah = $existingItem['jumlah'] + $jumlah;
            $newTotalHarga = $harga_brg * $newJumlah;
    
            $this->keranjangModel->update($existingItem['id'], [
                'jumlah' => $newJumlah,
                'total_harga' => $newTotalHarga,  // Update total harga berdasarkan jumlah baru
            ]);
        } else {
            // Jika belum ada, tambahkan sebagai item baru
            $this->keranjangModel->insert([
                'username' => $username,
                'kode_brg' => $kode_brg,
                'jumlah' => $jumlah,
                'harga_brg' => $harga_brg,  // Simpan harga barang
                'total_harga' => $total_harga, // Simpan total harga
            ]);
        }
    
        return $this->response->setJSON(['status' => 'success', 'message' => 'Barang berhasil ditambahkan ke keranjang.']);
    }
    


    // Tampilkan keranjang pengguna
    public function viewCart()
{
    $username = session('username'); // Ambil username dari sesi login

    if (!$username) {
        return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
    }

    // Ambil data keranjang dengan informasi produk terkait
    $keranjang = $this->keranjangModel
        ->select('keranjang.*, barang.nama_brg, barang.foto_brg, barang.ukuran, barang.harga_brg') // Menambahkan foto, ukuran, harga
        ->join('barang', 'barang.kode_brg = keranjang.kode_brg') // Join dengan tabel barang
        ->where('keranjang.username', $username)
        ->findAll();

    // Hitung total keseluruhan harga dari semua item
    $totalHargaKeseluruhan = array_sum(array_column($keranjang, 'total_harga'));

    $data = [
        'keranjang' => $keranjang,
        'totalHargaKeseluruhan' => $totalHargaKeseluruhan, // Kirim total harga ke view
    ];

    return view('user/keranjang/index', $data);
}

    public function editCart($id)
{
    $data = $this->request->getJSON(true);

    $jumlah = $data['jumlah'];
    $ukuran = $data['ukuran'];

    // Validasi jumlah dan ukuran
    if ($jumlah <= 0 || empty($ukuran)) {
        return $this->response->setJSON(['status' => 'error', 'message' => 'Data tidak valid.']);
    }

    // Ambil data keranjang berdasarkan id
    $keranjangItem = $this->keranjangModel->find($id);
    if (!$keranjangItem) {
        return $this->response->setJSON(['status' => 'error', 'message' => 'Item keranjang tidak ditemukan.']);
    }

    // Ambil kode_brg dari keranjang untuk mendapatkan nama_brg
    $kodeBrg = $keranjangItem['kode_brg'];

    // Cari barang berdasarkan kode_brg untuk mendapatkan nama_brg
    $barang = $this->barangModel->find($kodeBrg);
    if (!$barang) {
        return $this->response->setJSON(['status' => 'error', 'message' => 'Barang tidak ditemukan.']);
    }

    // Ambil nama_brg dari barang
    $namaBrg = $barang['nama_brg'];

    // Cari barang berdasarkan nama_brg dan ukuran baru
    $barangBaru = $this->barangModel
        ->where('nama_brg', $namaBrg)  // Cari berdasarkan nama_brg
        ->where('ukuran', $ukuran)      // Cari berdasarkan ukuran baru yang dipilih
        ->first();

    if (!$barangBaru) {
        return $this->response->setJSON(['status' => 'error', 'message' => 'Barang tidak ditemukan untuk ukuran tersebut.']);
    }

    // Ambil harga barang sesuai ukuran yang dipilih
    $harga = $barangBaru['harga_brg'];
    $totalHarga = $harga * $jumlah;

    // Update keranjang hanya dengan kode_brg baru dan total_harga
    $this->keranjangModel->update($id, [
        'kode_brg' => $barangBaru['kode_brg'],  // Perbarui kode_brg di keranjang
        'jumlah' => $jumlah,                    // Jumlah yang dipilih
        'total_harga' => $totalHarga           // Total harga setelah dihitung
    ]);

    return $this->response->setJSON(['status' => 'success', 'message' => 'Keranjang berhasil diperbarui.']);
}

    
    // Hapus barang dari keranjang
    public function removeFromCart($id)
    {
        $this->keranjangModel->delete($id);

        return $this->response->setJSON(['status' => 'success', 'message' => 'Barang berhasil dihapus dari keranjang.']);
    }
}
