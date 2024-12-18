<?= $this->extend('layout/admin') ?>

<?= $this->section('konten') ?>

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title mb-0 d-inline-block">Kategori</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a>Admin</a></li>
                            <li class="breadcrumb-item active">Data Kategori</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>  

        <div class="content-body">
        <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>
            <!-- Button to open modal -->
            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#inputKategoriModal">
                Tambah Kategori
            </button>

            <!-- Modal for input kategori -->
            <div class="modal fade" id="inputKategoriModal" tabindex="-1" aria-labelledby="inputKategoriModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="inputKategoriModalLabel">Tambah Kategori</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="/kategori/store" method="post" id="formAddKategori">
                                <div class="form-group">
                                    <label for="nama_kategori">Nama Kategori</label>
                                    <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" required>
                                </div>
                                
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal for edit kategori -->
            <div class="modal fade" id="editKategoriModal" tabindex="-1" aria-labelledby="editKategoriModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editKategoriModalLabel">Edit Kategori</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="/kategori/update" method="post" id="formEditKategori">
                                <input type="hidden" name="kode_kategori" id="edit_kode_kategori">
                                <div class="form-group">
                                    <label for="edit_nama_kategori">Nama Kategori</label>
                                    <input type="text" name="nama_kategori" id="edit_nama_kategori" class="form-control" required>
                                </div>
                                
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel untuk menampilkan data kategori -->
            <div class="card mt-4">
                <div class="card-header">
                    <h4>Data Kategori</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <!-- <th>Kode Kategori</th> -->

                                <th>Nama Kategori</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($kategori)): ?>
                            <?php foreach ($kategori as $item): ?>
                                <tr>
                                    <td><?= $item['nama_kategori'] ?></td>
                                    <td>
                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editKategoriModal" data-id="<?= $item['kode_kategori'] ?>" data-nama="<?= $item['nama_kategori'] ?>">Edit</button>
                                        <a href="/kategori/delete/<?= $item['kode_kategori'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin?')">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3" class="text-center">Tidak ada data kategori</td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS dan jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>


<script>
    // Mengisi form edit dengan data kategori yang dipilih
    $('#editKategoriModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Tombol yang memicu modal
        var kodeKategori = button.data('id'); // Ambil data-id dari tombol
        var namaKategori = button.data('nama'); // Ambil data-nama dari tombol
        
        var modal = $(this);
        modal.find('#edit_kode_kategori').val(kodeKategori);
        modal.find('#edit_nama_kategori').val(namaKategori);
    });
</script>

<?= $this->endSection() ?>
