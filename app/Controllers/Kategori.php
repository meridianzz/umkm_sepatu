<?php
namespace App\Controllers;

use App\Models\ModelKategori;
use CodeIgniter\Controller;

class Kategori extends Controller
{
    protected $modelKategori;

    public function __construct()
    {
        $this->modelKategori = new ModelKategori();
    }

    public function index()
    {
        // Ambil data kategori dari database
        $data['kategori'] = $this->modelKategori->findAll();
        return view('admin/kategori/index', $data);
    }

    public function store()
    {
        // Menyimpan kategori baru
        $this->modelKategori->save([
            'nama_kategori' => $this->request->getPost('nama_kategori')
        ]);

        session()->setFlashdata('success', 'Kategori berhasil ditambahkan.');
        return redirect()->to('/kategori');
    }



    public function update()
    {
        // Update kategori berdasarkan kode_kategori
        $kode_kategori = $this->request->getPost('kode_kategori');
        $nama_kategori = $this->request->getPost('nama_kategori');

        $this->modelKategori->update($kode_kategori, [
            'nama_kategori' => $nama_kategori
        ]);

        session()->setFlashdata('success', 'Kategori berhasil diperbarui.');
        return redirect()->to('/kategori');
    }

    public function delete($kode_kategori)
    {
        // Hapus kategori berdasarkan kode
        $this->modelKategori->delete($kode_kategori);

        session()->setFlashdata('success', 'Kategori berhasil dihapus.');
        return redirect()->to('/kategori');
    }
}
