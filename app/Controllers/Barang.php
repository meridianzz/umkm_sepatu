<?php

namespace App\Controllers;

use App\Models\ModelBarang;
use App\Models\ModelKategori;
use App\Models\ModelPelanggan;
use App\Models\ModelPenjualan;
use App\Models\ModelDetailPenjualan;


class Barang extends BaseController
{
    protected $barangModel;
    protected $kategoriModel;
    protected $pelangganModel;
    protected $penjualanModel;
    protected $detailPenjualanModel;
    
    public function __construct()
    {
        $this->barangModel = new ModelBarang();
        $this->kategoriModel = new ModelKategori();
        $this->pelangganModel = new ModelPelanggan();
        $this->penjualanModel = new ModelPenjualan();
        $this->detailPenjualanModel = new ModelDetailPenjualan();
    }

    // Menampilkan daftar barang
    public function index()
    {
        $data['barang'] = $this->barangModel
            ->select('barang.*, kategori.nama_kategori')
            ->join('kategori', 'kategori.kode_kategori = barang.kode_kategori')
            ->findAll();

        $data['kategori'] = $this->kategoriModel->findAll(); // Mengambil semua kategori
        return view('admin/barang/index', $data);
    }

    public function store()
    {
        // Mengambil file foto yang diupload
        $foto = $this->request->getFile('foto_brg');
    
        // Pastikan file foto valid dan ada
        if ($foto->isValid() && !$foto->hasMoved()) {
            // Ambil ekstensi file
            $ext = $foto->getExtension();
    
            // Buat nama file baru yang unik (misalnya dengan timestamp dan nama asli)
            $fotoName = time() . rand(1000, 9999) . '.' . $ext; // Menggunakan timestamp dan random number untuk nama file unik
    
            // Pindahkan file foto ke direktori 'assets/dist/img/fotosepatu'
            $foto->move('assets/dist/img/fotosepatu', $fotoName);
        } else {
            // Jika tidak ada foto, tetapkan nama kosong
            $fotoName = null;
        }
    
        // Simpan data barang termasuk nama foto
        $this->barangModel->save([
            'nama_brg' => $this->request->getPost('nama_brg'),
            'kode_kategori' => $this->request->getPost('kode_kategori'),
            'harga_brg' => $this->request->getPost('harga_brg'),
            'stok' => $this->request->getPost('stok'),
            'ukuran' => $this->request->getPost('ukuran'),
            'status' => $this->request->getPost('status'),
            'deskripsi_brg' => $this->request->getPost('deskripsi_brg'),
            'foto_brg' => $fotoName,  // Menyimpan nama foto ke database
        ]);
    
        return redirect()->to('/barang');
    }

    public function update()
    {
        $kode_brg = $this->request->getPost('kode_brg');

        $data = [
            'nama_brg' => $this->request->getPost('nama_brg'),
            'kode_kategori' => $this->request->getPost('kode_kategori'),
            'harga_brg' => $this->request->getPost('harga_brg'),
            'stok' => $this->request->getPost('stok'),
            'ukuran' => $this->request->getPost('ukuran'),
            'status' => $this->request->getPost('status'),
            'deskripsi_brg' => $this->request->getPost('deskripsi_brg'),
        ];

        // Handle file upload
        $foto = $this->request->getFile('foto_brg');
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $newName = $foto->getRandomName();
            $foto->move('assets/dist/img/fotosepatu', $newName);
            $data['foto_brg'] = $newName; // Tambahkan ke data
        }

        $this->barangModel->update($kode_brg, $data);

        return redirect()->to('/barang')->with('message', 'Data berhasil diupdate!');
    }


    // Menghapus data barang
    public function delete($kode_brg)
    {
        $this->barangModel->delete($kode_brg);
        return redirect()->to('/barang');
    }
}
