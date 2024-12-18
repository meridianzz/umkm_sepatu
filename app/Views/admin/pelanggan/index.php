<?= $this->extend('layout/admin') ?>

<?= $this->section('konten') ?>

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title mb-0 d-inline-block">Pelanggan</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a>Admin</a></li>
                            <li class="breadcrumb-item active">Data Pelanggan</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Data Pelanggan -->
        <div class="content-body">
        <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success'); ?>
        </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error'); ?>
            </div>
        <?php endif; ?>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pelanggan</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Nomor HP</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pelanggan as $p): ?>
                        <tr>
                            <td><?= $p['kode_pelanggan'] ?></td>
                            <td><?= $p['nama_pelanggan'] ?></td>
                            <td><?= $p['username'] ?></td>
                            <td><?= $p['email'] ?></td>
                            <td><?= $p['handphone'] ?></td>
                            <td><?= $p['alamat'] ?></td>
                            <td>
                                <button class="btn btn-warning btn-sm"
                                    onclick="openEditModal(
                                        '<?= $p['kode_pelanggan'] ?>',
                                        '<?= $p['nama_pelanggan'] ?>',
                                        '<?= $p['username'] ?>',
                                        '<?= $p['password'] ?>',
                                        '<?= $p['email'] ?>',
                                        '<?= $p['handphone'] ?>',
                                        '<?= $p['alamat'] ?>'
                                    )">
                                    Edit
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Pelanggan -->
<div class="modal fade" id="editDataModal" tabindex="-1" aria-labelledby="editDataModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDataModalLabel">Edit Pelanggan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEditPelanggan" method="post" enctype="multipart/form-data">
                    <!-- Hidden field for kode pelanggan -->
                    <input type="hidden" name="kode_pelanggan" id="edit_kode_pelanggan">
                    <div class="form-group">
                        <label for="edit_nama_pelanggan">Nama Pelanggan</label>
                        <input type="text" name="nama_pelanggan" id="edit_nama_pelanggan" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_username">Username</label>
                        <input type="text" class="form-control" id="edit_username" name="username" readonly>
                    </div>
                    <input type="hidden" name="password" id="edit_password">
                    <div class="form-group">
                        <label for="edit_email">Email</label>
                        <input type="email" class="form-control" id="edit_email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_handphone">Nomor HP</label>
                        <input type="text" class="form-control" id="edit_handphone" name="handphone" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_alamat">Alamat</label>
                        <textarea class="form-control" id="edit_alamat" name="alamat" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Function to open edit modal and populate the form with existing data
    function openEditModal(kode, nama, username, password, email, handphone, alamat) {
        $('#formEditPelanggan').attr('action', '/datapelanggan/update/' + kode);
        $('#edit_kode_pelanggan').val(kode);
        $('#edit_nama_pelanggan').val(nama);
        $('#edit_username').val(username);
        $('#edit_password').val(password);
        $('#edit_email').val(email);
        $('#edit_handphone').val(handphone);
        $('#edit_alamat').val(alamat);

        // Show the modal
        $('#editDataModal').modal('show');
    }
</script>

<?= $this->endSection() ?>
