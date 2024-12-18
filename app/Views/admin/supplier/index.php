<?= $this->extend('layout/admin') ?>

<?= $this->section('konten') ?>

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title mb-0 d-inline-block">Supplier</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a>Admin</a></li>
                            <li class="breadcrumb-item active">Data Supplier</li>
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
            <!-- Button to trigger add modal -->
            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#inputDataModal">
                Tambah
            </button>
            
            <!-- Add Supplier Modal -->
            <div class="modal fade" id="inputDataModal" tabindex="-1" aria-labelledby="inputDataModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="inputDataModalLabel">Add New Supplier</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="/supplier/store" method="post" id="formAddSupplier">
                                <div class="form-group">
                                    <label for="nama_supp">Name</label>
                                    <input type="text" name="nama_supp" id="nama_supp" class="form-control" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="handphone">Phone</label>
                                    <input type="text" name="handphone" id="handphone" class="form-control" required>
                                </div>
                                
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Supplier Modal -->
            <div class="modal fade" id="editDataModal" tabindex="-1" aria-labelledby="editDataModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editDataModalLabel">Edit Supplier</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="formEditSupplier" method="post">
                                <!-- Action URL akan diisi dinamis melalui JavaScript -->
                                <div class="form-group">
                                    <label for="edit_nama_supp">Name</label>
                                    <input type="text" name="nama_supp" id="edit_nama_supp" class="form-control" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="edit_handphone">Phone</label>
                                    <input type="text" name="handphone" id="edit_handphone" class="form-control" required>
                                </div>
                                
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table for displaying supplier data -->
            <div class="card">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($suppliers as $supplier): ?>
                        <tr>
                            <td><?= $supplier['kode_supp'] ?></td>
                            <td><?= $supplier['nama_supp'] ?></td>
                            <td><?= $supplier['handphone'] ?></td>
                            <td>
                                <button class="btn btn-warning btn-sm" 
                                        onclick="openEditModal('<?= $supplier['kode_supp'] ?>', '<?= $supplier['nama_supp'] ?>', '<?= $supplier['handphone'] ?>')">
                                    Edit
                                </button>
                                <a href="/supplier/delete/<?= $supplier['kode_supp'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Function to open edit modal and populate the form with existing data
    function openEditModal(kode, name, phone) {
        $('#formEditSupplier').attr('action', '/supplier/update/' + kode); // Set action URL with ID
        $('#edit_nama_supp').val(name);
        $('#edit_handphone').val(phone);
        $('#editDataModal').modal('show');
    }
</script>

<?= $this->endSection() ?>

<script>
    // Function to open edit modal and populate the form with existing data
    function openEditModal(kode, name, phone) {
        $('#formEditSupplier').attr('action', '/supplier/update/' + kode); // Set action URL with ID
        $('#edit_nama_supp').val(name);
        $('#edit_handphone').val(phone);
        $('#editDataModal').modal('show');
    }
</script>
