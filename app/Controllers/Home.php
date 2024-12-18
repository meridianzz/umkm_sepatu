<?php

namespace App\Controllers;
use App\Models\ModelBarang;
use App\Models\ModelKategori;

class Home extends BaseController
{
    protected $session;
    protected $barangModel;
    protected $kategoriModel;
    

    public function __construct()
    {
        $this->barangModel = new ModelBarang();
        $this->kategoriModel = new ModelKategori();
    }

    public function getUkuran($nama_brg)
{
    // Ambil data berdasarkan nama barang
    $data = $this->barangModel->where('nama_brg', $nama_brg)->findAll();

    // Kirimkan data dalam format JSON
    return $this->response->setJSON($data);
}

public function produk(): string
{
    // Ambil kategori dan ukuran yang dipilih dari parameter GET
    $kategoriDipilih = $this->request->getGet('kategori');
    $ukuranDipilih = $this->request->getGet('ukuran');

    // Query untuk mendapatkan produk berdasarkan kategori (jika ada)
    $barangQuery = $this->barangModel->select('barang.*, kategori.nama_kategori')
        ->join('kategori', 'kategori.kode_kategori = barang.kode_kategori')
        ->where('barang.status', 'aktif'); // Hanya produk dengan status aktif

    if ($kategoriDipilih) {
        $barangQuery->where('barang.kode_kategori', $kategoriDipilih);
    }

    if ($ukuranDipilih) {
        $barangQuery->where('barang.ukuran', $ukuranDipilih);
    }

    $barang = $barangQuery->findAll();

    // Mengelompokkan produk berdasarkan nama_brg
    $produkGrouped = [];
    foreach ($barang as $item) {
        $produkGrouped[$item['nama_brg']][] = $item; // Kelompokkan berdasarkan nama_brg
    }

    // Ambil ukuran unik dengan status aktif untuk filter
    $ukuranUnik = $this->barangModel->select('ukuran')
        ->where('status', 'aktif')
        ->groupBy('ukuran')
        ->findAll();

    // Kirim data ke view
    $data = [
        'produkGrouped' => $produkGrouped,
        'kategori' => $this->kategoriModel->findAll(),
        'kategoriDipilih' => $kategoriDipilih, // Untuk menandai kategori yang aktif
        'ukuranUnik' => $ukuranUnik,          // Untuk filter ukuran
        'ukuranDipilih' => $ukuranDipilih,    // Ukuran yang dipilih
    ];

    return view('user/produk/index', $data);
}



    public function login(): string
    {
        return view('login');
    }

    public function register(): string
    {
        return view('register');
    }

    public function admin(): string
    {
        return view('login/admin');
    }

    public function barang(): string
    {
        return view('admin/barang/barang');
    }


    // public function keranjang(): string
    // {
    //     return view('user/keranjang/index');
    // }

    // public function kategori(): string
    // {
    //     return view('admin/kategori/index');
    // }


    public function dashboardadmin(): string
    {
        return view('admin/halamanAdmin');
    }

}