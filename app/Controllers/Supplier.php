<?php

namespace App\Controllers;

use App\Models\SupplierModel;
use App\Models\BarangMasukModel;
use CodeIgniter\Controller;

class Supplier extends Controller
{
    protected $supplierModel;
    protected $barangMasukModel;


    public function __construct()
    {
        $this->supplierModel = new SupplierModel();
        $this->barangMasukModel = new BarangMasukModel();

    }

    // Display all suppliers
   public function index()
{
    $data = [
        'suppliers' => $this->supplierModel->findAll(),  // Ambil data list supplier dari model
    ];
    
    return view('admin/supplier/index', $data);
}

    public function create()
    {
        $data['barangMasukList'] = $this->barangMasukModel->findAll(); // Fetch all barang_masuk entries
        return view('admin/supplier/index', $data);
    }

    // Store new supplier in the database
    public function store()
    {
        $this->supplierModel->save([
            'nama_supp' => $this->request->getPost('nama_supp'),
            'kode_brgmasuk' => $this->request->getPost('kode_brgmasuk'),
            'handphone' => $this->request->getPost('handphone')
        ]);

        session()->setFlashdata('success', 'Data supplier berhasil ditambahkan.');
        return redirect()->to('/supplier');  // Redirect to the same page to refresh the supplier list
    }


 
    // Update an existing supplier in the database
    public function update($id)
    {
        $this->supplierModel->update($id, [
            'nama_supp' => $this->request->getPost('nama_supp'),
            'kode_brgmasuk' => $this->request->getPost('kode_brgmasuk'),
            'handphone' => $this->request->getPost('handphone')
        ]);
        session()->setFlashdata('success', 'Data supplier berhasil diperbarui.');
        return redirect()->to('/supplier');
    }

    // Delete a supplier from the database
    public function delete($id)
    {
        $this->supplierModel->delete($id);
        session()->setFlashdata('success', 'Data supplier berhasil dihapus.');
        return redirect()->to('/supplier');
    }
}
