<?= $this->extend('layout/user') ?>

<?= $this->section('konten') ?>

<div class="app-content content">
    <div class="row">
        <div class="col-md-8">
            <div class="content-wrapper">
                <div class="content-header row">
                    <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                        <h3 class="content-header-title mb-0 d-inline-block">Profil Pengguna</h3>
                    </div>
                </div>
                <div class="content-body">
                    <div class="card">
                        <div class="card-body">
                            <h4>Profil Pengguna</h4>

                            <?php if (session()->getFlashdata('success')): ?>
                                <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
                            <?php endif; ?>

                            <?php if (session()->getFlashdata('errors')): ?>
                                <div class="alert alert-danger">
                                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                        <p><?= $error ?></p>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>

                            <!-- Tampilkan data profil -->
                            <div id="profil-view">
                                <p><strong>Nama:</strong> <?= esc($user->nama_pelanggan) ?></p>
                                <p><strong>Username:</strong> <?= esc($user->username) ?></p>
                                <p><strong>Email:</strong> <?= esc($user->email) ?></p>
                                <p><strong>Handphone:</strong> <?= esc($user->handphone) ?></p>
                                <p><strong>Alamat:</strong> <?= esc($user->alamat) ?></p>
                                <button id="edit-button" class="btn btn-primary">Edit</button>
                            </div>

                            <!-- Form update profil (disembunyikan secara default) -->
                            <form id="edit-form" action="<?= site_url('/user/updateProfil'); ?>" method="POST" style="display: none;">
                                <?= csrf_field(); ?>
                                <div class="form-group">
                                    <label for="nama_pelanggan">Nama:</label>
                                    <input type="text" id="nama_pelanggan" name="nama_pelanggan" class="form-control"
                                           value="<?= old('nama_pelanggan', $user->nama_pelanggan); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="username">Username:</label>
                                    <input type="text" id="username" name="username" class="form-control"
                                           value="<?= old('username', $user->username); ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" id="email" name="email" class="form-control"
                                           value="<?= old('email', $user->email); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="handphone">Handphone:</label>
                                    <input type="text" id="handphone" name="handphone" class="form-control"
                                           value="<?= old('handphone', $user->handphone); ?>" required>
                                    <small id="handphone-error" class="form-text text-danger" style="display: none;">Nomor handphone harus diisi dengan angka saja!</small>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat:</label>
                                    <textarea id="alamat" name="alamat" class="form-control" required><?= old('alamat', $user->alamat); ?></textarea>
                                </div>
                                <button type="submit" class="btn btn-success">Simpan</button>
                                <button type="button" id="cancel-button" class="btn btn-secondary">Batal</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // JavaScript untuk toggle antara view dan edit mode
    document.getElementById('edit-button').addEventListener('click', function () {
        document.getElementById('profil-view').style.display = 'none';
        document.getElementById('edit-form').style.display = 'block';
    });

    document.getElementById('cancel-button').addEventListener('click', function () {
        document.getElementById('edit-form').style.display = 'none';
        document.getElementById('profil-view').style.display = 'block';
    });

    // Validasi handphone saat input berubah atau disubmit
    document.getElementById('handphone').addEventListener('input', function () {
        var handphone = this.value;
        var errorMessage = document.getElementById('handphone-error');

        // Periksa apakah input hanya berisi angka
        if (!/^\d+$/.test(handphone)) {
            errorMessage.style.display = 'block'; // Tampilkan pesan kesalahan
        } else {
            errorMessage.style.display = 'none'; // Sembunyikan pesan kesalahan jika valid
        }
    });

    // Validasi form sebelum disubmit
    document.getElementById('edit-form').addEventListener('submit', function (event) {
        var handphone = document.getElementById('handphone').value;
        var errorMessage = document.getElementById('handphone-error');

        // Jika handphone tidak hanya berisi angka, tampilkan peringatan dan cegah form submit
        if (!/^\d+$/.test(handphone)) {
            errorMessage.style.display = 'block';
            event.preventDefault(); // Cegah form untuk disubmit
        }
    });
</script>

<?= $this->endSection() ?>
