<?php namespace App\Controllers;

use App\Models\ModelPelanggan;

class Pelanggan extends BaseController
{

    protected $pelangganModel;


    public function __construct()
    {
        $this->pelangganModel = new ModelPelanggan();
        

    }
    public function index()
    {
        $data = [
            'pelanggan' => $this->pelangganModel->findAll(),  // Ambil data list supplier dari model
        ];
        
        return view('admin/pelanggan/index', $data);
    }


    public function update($id)
    {
        $this->pelangganModel->update($id, [
            'nama_pelanggan' => $this->request->getPost('nama_pelanggan'),
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password'),
            'email' => $this->request->getPost('email'),
            'alamat' => $this->request->getPost('alamat'),
            'handphone' => $this->request->getPost('handphone')
        ]);
        session()->setFlashdata('success', 'Data pelanggan berhasil diperbarui.');
        return redirect()->to('/datapelanggan');
    }


    public function delete($id)
{
    $model = new ModelPelanggan(); 
    $model->delete($id);  
    session()->setFlashdata('success', 'Pelanggan berhasil dihapus.');
    return redirect()->to('/datapelanggan');
}

}
