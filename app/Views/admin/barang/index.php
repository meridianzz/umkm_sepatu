<?= $this->extend('layout/admin') ?>

<?= $this->section('konten') ?>

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title mb-0 d-inline-block">Data Barang</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Admin</li>
                            <li class="breadcrumb-item active">Data Barang</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-body">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>Daftar Barang</h4>
                        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalTambahBarang">Tambah Barang</button>
                        
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Kategori</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Ukuran</th>
                                    <th>Status</th>
                                    <th>Deskripsi</th>
                                    <th>Foto</th>                                
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($barang as $b) : ?>
                                <tr>
                                    <td><?= $b['nama_brg'] ?></td>
                                    <td><?= $b['nama_kategori'] ?></td> <!-- Menampilkan nama_kategori -->
                                    <td><?= $b['harga_brg'] ?></td>
                                    <td><?= $b['stok'] ?></td>
                                    <td><?= $b['ukuran'] ?></td>
                                    <td><?= $b['status'] ?></td>
                                    <td><?= $b['deskripsi_brg'] ?></td>
                                    <td>
                                        <?php if ($b['foto_brg']) : ?>
                                            <a href="<?= base_url('assets/dist/img/fotosepatu/' . $b['foto_brg']) ?>" target="_blank">
                                                <img src="<?= base_url('assets/dist/img/fotosepatu/' . $b['foto_brg']) ?>" alt="Foto Barang" width="100">
                                            </a>
                                        <?php else : ?>
                                            <span>No Photo</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <!-- Tombol Edit memicu modal -->
                                        <button class="btn btn-warning btn-sm" 
                                            onclick="openEditModal(
                                                '<?= $b['kode_brg'] ?>', 
                                                '<?= $b['nama_brg'] ?>', 
                                                '<?= $b['kode_kategori'] ?>', 
                                                '<?= $b['harga_brg'] ?>',
                                                '<?= $b['stok'] ?>',
                                                '<?= $b['ukuran'] ?>',
                                                '<?= $b['status'] ?>',
                                                 '<?= $b['deskripsi_brg'] ?>',
                                                '<?= $b['foto_brg'] ?>'
                                            )">
                                            Edit
                                        </button>
                                        <a href="<?= base_url('barang/delete/' . $b['kode_brg']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin?')">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Tambah Barang -->
<div class="modal fade" id="modalTambahBarang" tabindex="-1" role="dialog" aria-labelledby="modalTambahBarangLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Ubah method dan tambah enctype untuk upload file -->
            <form action="<?= base_url('barang/store') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahBarangLabel">Tambah Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_brg">Nama Barang</label>
                        <input type="text" class="form-control" id="nama_brg" name="nama_brg" required>
                    </div>
                    <div class="form-group">
                        <label for="kode_kategori">Kategori</label>
                        <select class="form-control" id="kode_kategori" name="kode_kategori" required>
                            <option value="" disabled selected>Pilih Kategori</option>
                            <?php foreach ($kategori as $k) : ?>
                                <option value="<?= $k['kode_kategori'] ?>"><?= $k['nama_kategori'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="harga_brg">Harga Barang</label>
                        <input type="number" class="form-control" id="harga_brg" name="harga_brg" required>
                    </div>
                    <div class="form-group">
                        <label for="stok">Stok</label>
                        <input type="number" class="form-control" id="stok" name="stok" required>
                    </div>
                    <div class="form-group">
                        <label for="ukuran">Ukuran</label>
                        <input type="text" class="form-control" id="ukuran" name="ukuran" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="Aktif">Aktif</option>
                            <option value="Nonaktif">Nonaktif</option>
                        </select>
                    </div>
                     <div class="form-group">
                        <label for="deskripsi_brg">Deskripsi</label>
                        <input type="text" class="form-control" id="deskripsi_brg" name="deskripsi_brg" required>
                    </div>
                    <!-- Input foto barang -->
                    <div class="form-group">
                        <label for="foto_brg">Foto Barang</label>
                        <input type="file" class="form-control-file" id="foto_brg" name="foto_brg">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Barang -->
<div class="modal fade" id="editDataModal" tabindex="-1" aria-labelledby="editDataModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDataModalLabel">Edit Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEditBarang" method="post" enctype="multipart/form-data">
                    <!-- Hidden field for kode barang -->
                    <input type="hidden" name="kode_brg" id="edit_kode_brg">
                    <div class="form-group">
                        <label for="edit_nama_brg">Nama Barang</label>
                        <input type="text" name="nama_brg" id="edit_nama_brg" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_kode_kategori">Kategori</label>
                        <select class="form-control" id="edit_kode_kategori" name="kode_kategori" required>
                            <option value="" disabled selected>Pilih Kategori</option>
                            <?php foreach ($kategori as $k) : ?>
                                <option value="<?= $k['kode_kategori'] ?>"><?= $k['nama_kategori'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_harga_brg">Harga Barang</label>
                        <input type="number" class="form-control" id="edit_harga_brg" name="harga_brg" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_stok">Stok</label>
                        <input type="number" class="form-control" id="edit_stok" name="stok" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_ukuran">Ukuran</label>
                        <input type="number" class="form-control" id="edit_ukuran" name="ukuran" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_status">Status</label>
                        <select class="form-control" id="edit_status" name="status" required>
                            <option value="Aktif">Aktif</option>
                            <option value="Nonaktif">Nonaktif</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_deskripsi_brg">Deskripsi</label>
                        <input type="text" class="form-control" id="edit_deskripsi_brg" name="deskripsi_brg" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_foto_brg">Foto Barang</label>
                        <input type="file" class="form-control-file" id="edit_foto_brg" name="foto_brg">
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
    function openEditModal(kode, nama, kategori, harga, stok, ukuran, status,deskripsi_brg, foto) {
        $('#formEditBarang').attr('action', '/barang/update/' + kode);
        $('#edit_kode_brg').val(kode);
        $('#edit_nama_brg').val(nama);
        $('#edit_kode_kategori').val(kategori);
        $('#edit_harga_brg').val(harga);
        $('#edit_stok').val(stok);
        $('#edit_ukuran').val(ukuran);
        $('#edit_status').val(status);
        $('#edit_deskripsi_brg').val(deskripsi_brg);

        // Show the modal
        $('#editDataModal').modal('show');
    }
</script>

<?= $this->endSection() ?>