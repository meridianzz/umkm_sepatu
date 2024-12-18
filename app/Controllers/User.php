<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ModelPelanggan;
use App\Models\ModelBarang;

class User extends Controller
{
    protected $session;
    protected $barangModel;


    public function __construct()
    {
        $this->barangModel = new ModelBarang();

        $this->session = session();
    }

    public function registerproses()
    {
        // Ambil data dari form
        $data = [
            'username'       => $this->request->getPost('username'),
            'nama_pelanggan' => $this->request->getPost('nama_pelanggan'),
            'password'       => $this->request->getPost('password'),
            'email'          => $this->request->getPost('email'),
            'handphone'      => $this->request->getPost('handphone'),
            'alamat'         => $this->request->getPost('alamat'),
            'is_verified'    => 0 // Set awal status verifikasi OTP ke 0 (belum terverifikasi)
        ];
    
        $modelPelanggan = new ModelPelanggan();
        
        // Memasukkan data pelanggan ke dalam database
        if ($modelPelanggan->insert($data)) {
            // Ambil ID pelanggan terakhir yang baru terdaftar
            $idPelanggan = $modelPelanggan->getInsertID();
    
            // Generate kode OTP dan waktu kadaluarsa
            $otpCode = rand(100000, 999999); // OTP 6 digit
            $otpExpiredAt = date('Y-m-d H:i:s', strtotime('+10 minutes')); // OTP kadaluarsa dalam 10 menit
    
            // Simpan OTP dan expired_at di database
            $modelPelanggan->update($idPelanggan, [
                'otp_code' => $otpCode,
                'otp_expired_at' => $otpExpiredAt
            ]);
    
            // Kirim OTP ke email pengguna
            $emailService = \Config\Services::email();
            $emailService->setTo($data['email']);
            $emailService->setFrom('your_email@gmail.com', 'Your App Name'); // Ganti dengan email Anda
            $emailService->setSubject('Kode OTP untuk Registrasi');
            $emailService->setMessage("Kode OTP Anda adalah: $otpCode");
    
            // Mengirim email dan menampilkan debugging jika gagal
            if ($emailService->send()) {
                // Redirect ke halaman verifikasi OTP
                return redirect()->to('/verify-otp/' . $idPelanggan)->with('success', 'Kode OTP telah dikirim ke email Anda. Silakan periksa email Anda.');
            } else {
                // Menampilkan error message jika pengiriman email gagal
                $emailError = $emailService->printDebugger(); // Mendapatkan detail error
                log_message('error', 'Gagal mengirim OTP. Debug Info: ' . $emailError);
                return redirect()->back()->with('error', 'Gagal mengirim OTP, coba lagi nanti. Debug Info: ' . $emailError);
            }
        } else {
            // Jika gagal memasukkan data pelanggan, tampilkan error
            return redirect()->back()->withInput()->with('errors', $modelPelanggan->errors());
        }
    }

    // Fungsi untuk menampilkan form verifikasi OTP
    public function verifyOtp($idPelanggan)
    {
        $modelPelanggan = new ModelPelanggan();
        $pelanggan = $modelPelanggan->find($idPelanggan);
    
        if (!$pelanggan) {
            return redirect()->to('/register')->with('error', 'Data pelanggan tidak ditemukan.');
        }
    
        // Cek apakah OTP telah kedaluwarsa
        $isOtpExpired = strtotime($pelanggan['otp_expired_at']) < time();
    
        return view('user/verify_otp', [
            'pelanggan' => $pelanggan,
            'isOtpExpired' => $isOtpExpired // Kirim status OTP kedaluwarsa ke view
        ]);
    }

    // Fungsi untuk memverifikasi OTP
    public function verifyOtpProcess()
    {
        $idPelanggan = $this->request->getPost('id_pelanggan');
        $otpEntered = $this->request->getPost('otp');
        $modelPelanggan = new ModelPelanggan();
        $pelanggan = $modelPelanggan->find($idPelanggan);

        if (!$pelanggan) {
            return redirect()->to('/register')->with('error', 'Data pelanggan tidak ditemukan.');
        }

        // Cek apakah OTP sesuai dan belum kadaluarsa
        if ($pelanggan['otp_code'] == $otpEntered && strtotime($pelanggan['otp_expired_at']) > time()) {
            // Update status verifikasi
            $modelPelanggan->update($idPelanggan, ['is_verified' => 1]);
        
            // Redirect ke halaman login
            return redirect()->to('/')->with('success', 'Registrasi berhasil, silakan login.');
        } else {
            return redirect()->back()->with('error', 'Kode OTP tidak sesuai atau telah kadaluarsa.');
        }
    }

    public function resendOtp($idPelanggan)
{
    $modelPelanggan = new ModelPelanggan();
    $pelanggan = $modelPelanggan->find($idPelanggan);

    if (!$pelanggan) {
        return redirect()->to('/register')->with('error', 'Data pelanggan tidak ditemukan.');
    }

    // Generate kode OTP baru dan waktu kadaluarsa
    $otpCode = rand(100000, 999999); // OTP 6 digit
    $otpExpiredAt = date('Y-m-d H:i:s', strtotime('+10 minutes')); // OTP kadaluarsa dalam 10 menit

    // Update OTP di database
    $modelPelanggan->update($idPelanggan, [
        'otp_code' => $otpCode,
        'otp_expired_at' => $otpExpiredAt
    ]);

    // Kirim OTP ke email pengguna
    $emailService = \Config\Services::email();
    $emailService->setTo($pelanggan['email']);
    $emailService->setFrom('your_email@gmail.com', 'Your App Name'); // Ganti dengan email Anda
    $emailService->setSubject('Kode OTP Baru');
    $emailService->setMessage("Kode OTP baru Anda adalah: $otpCode");

    if ($emailService->send()) {
        return redirect()->back()->with('success', 'Kode OTP baru telah dikirim ke email Anda.');
    } else {
        $emailError = $emailService->printDebugger();
        log_message('error', 'Gagal mengirim ulang OTP. Debug Info: ' . $emailError);
        return redirect()->back()->with('error', 'Gagal mengirim ulang OTP, coba lagi nanti.');
    }
}

    
private function checkUser()
{
    // Periksa apakah user sudah login
    if (!$this->session->get('isLoggedInUser')) {
        return redirect()->to('/login')->with('error', 'Anda harus login sebagai user.');
    }

    // Ambil data user yang sedang login
    $userModel = new ModelPelanggan();
    $user = $userModel->find($this->session->get('kode_pelanggan'));

    if ($user && $user['is_verified'] == 0) {
        // Cek apakah OTP telah kedaluwarsa
        $isOtpExpired = strtotime($user['otp_expired_at']) < time();

        if ($isOtpExpired) {
            // Berikan pesan bahwa pengguna perlu mengirim ulang OTP
            return redirect()->to('/verify-otp/' . $user['kode_pelanggan'])
                ->with('error', 'Kode OTP Anda telah kedaluwarsa. Silakan kirim ulang.');
        }

        // Arahkan ke halaman verifikasi OTP
        return redirect()->to('/verify-otp/' . $user['kode_pelanggan'])
            ->with('error', 'Anda harus memverifikasi OTP terlebih dahulu.');
    }
}


    public function index()
    {
        $this->checkUser(); // Pastikan user sudah login
        return view('user/halamanUser'); // Ganti dengan view dashboard user
    }

    public function login()
{
    $userModel = new ModelPelanggan();
    $session = session();

    // Ambil input dari form
    $username = $this->request->getPost('username');
    $password = $this->request->getPost('password');

    // Validasi input kosong
    if (empty($username) || empty($password)) {
        return redirect()->back()->with('error', 'Username dan password harus diisi.');
    }

    // Periksa apakah input tidak berupa array
    if (is_array($username) || is_array($password)) {
        return redirect()->back()->with('error', 'Input tidak valid.');
    }

    // Cari user berdasarkan username
    $user = $userModel->where('username', $username)->first();

    if ($user) {
        // Validasi password langsung (disarankan untuk menggunakan hashing di masa depan)
        if ($password === $user['password']) {
            // Cek status verifikasi
            if ($user['is_verified'] == 0) {
                // Jika status verifikasi belum 1, alihkan ke halaman verifikasi OTP
                return redirect()->to('/verify-otp/' . $user['kode_pelanggan'])->with('error', 'Anda harus verifikasi terlebih dahulu.');
            }

            // Set session untuk user jika sudah terverifikasi
            $session->set([
                'kode_pelanggan' => $user['kode_pelanggan'],
                'username'       => $user['username'],
                'isLoggedInUser' => true,
            ]);
            return redirect()->to('/beranda');
        } else {
            // Jika password salah
            return redirect()->back()->with('error', 'Password salah.');
        }
    }

    // Jika username tidak ditemukan
    return redirect()->back()->with('error', 'Username tidak ditemukan.');
}

public function profil()
{
    $this->checkUser(); // Pastikan pengguna sudah login
    $kodeUser = session()->get('kode_pelanggan');
    $userModel = new ModelPelanggan();

    // Cari data pengguna berdasarkan kode_pelanggan
    $user = $userModel->find($kodeUser);

    // Jika data tidak ditemukan, redirect dengan pesan error
    if (!$user) {
        return redirect()->to('/user')->with('error', 'Profil pengguna tidak ditemukan.');
    }

    // Konversi array ke objek
    $user = (object) $user;

    return view('user/profil', ['user' => $user]);
}

public function updateProfil()
{
    $kodeUser = session()->get('kode_pelanggan'); // Ambil kode_pelanggan dari sesi
    $userModel = new ModelPelanggan();

    // Validasi input
    $rules = [
        'nama_pelanggan' => 'required|min_length[3]',
        'username'       => "required|min_length[3]|is_unique[pelanggan.username,kode_pelanggan,{$kodeUser}]",
        'email'          => 'required|valid_email',
        'handphone'      => 'required|numeric',
        'alamat'         => 'required',
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // Data baru yang akan diupdate
    $data = [
        'nama_pelanggan' => $this->request->getPost('nama_pelanggan'),
        'username'       => $this->request->getPost('username'),
        'email'          => $this->request->getPost('email'),
        'handphone'      => $this->request->getPost('handphone'),
        'alamat'         => $this->request->getPost('alamat'),
    ];

    // Debugging untuk memastikan data yang diterima
    log_message('info', 'Data yang diterima untuk update: ' . json_encode($data));

    // Perbarui data pengguna
    if (!$userModel->update($kodeUser, $data)) {
        log_message('error', 'Update profil gagal. Error: ' . json_encode($userModel->errors()));
        return redirect()->back()->withInput()->with('errors', $userModel->errors());
    }

    session()->setFlashdata('success', 'Profil berhasil diperbarui!');
    return redirect()->to('/profil');
    
}

    public function logout()
    {
        $this->session->remove(['kode_pelanggan', 'username', 'isLoggedInUser']); // Hapus session user
        return redirect()->to('/');
    }
}
