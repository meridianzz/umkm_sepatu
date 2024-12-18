<?= $this->extend('layout/user') ?>

<?= $this->section('konten') ?>

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title mb-0 d-inline-block">Keranjang</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a>Pelanggan</a></li>
                            <li class="breadcrumb-item active">Daftar belanjaan anda</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-5"> 
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h2 class="mb-3">Keranjang Belanja</h2>
                        <table class="table table-borderless mb-0">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="selectAllCheckbox" /></th> <!-- Checkbox untuk memilih semua item -->
                                    <th>Produk</th>
                                    <th>Detail</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Total Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($keranjang)): ?>
                                    <tr>
                                        <td colspan="7" class="text-center">Keranjang kosong.</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($keranjang as $item): ?>
                                        <tr>
                                            <td>
                                                <input type="checkbox" class="item-checkbox" data-id="<?= $item['id'] ?>" data-harga="<?= $item['total_harga'] ?>" />
                                            </td>
                                            <td>
                                                <div class="product-img d-flex align-items-center">
                                                    <img class="img-fluid" 
                                                        src="<?= base_url('assets/dist/img/fotosepatu/' . esc($item['foto_brg'])) ?>" 
                                                        alt="Foto Barang" 
                                                        style="width: 150px; height: auto; border-radius: 8px;">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="product-title" style="font-size: 1.4rem; font-weight: 250; color: #333;"><?= esc($item['nama_brg']) ?></div>
                                                <div class="product-size" style="font-size: 1rem; color: #666;"><strong>Size: </strong> <?= esc($item['ukuran']) ?></div>
                                            </td>
                                            <td>
                                                <div class="product-price">Rp <?= number_format($item['harga_brg'], 0, ',', '.') ?></div>
                                            </td>
                                            <td>
                                                <div class="input-group"><?= esc($item['jumlah']) ?></div>
                                            </td>
                                            <td>
                                                <div class="total-price">Rp <?= number_format($item['total_harga'], 0, ',', '.') ?></div>
                                            </td>
                                            <td>
                                                <div class="product-action">
                                                    <a href="#" class="btn btn-danger btn-sm remove-cart-btn" data-id="<?= $item['id'] ?>"><i class="ft-trash-2"></i> Hapus</a>
                                                    <a href="#" 
                                                        class="btn btn-primary btn-sm edit-cart-btn" 
                                                        data-id="<?= $item['id'] ?>" 
                                                        data-ukuran="<?= $item['ukuran'] ?>" 
                                                        data-jumlah="<?= $item['jumlah'] ?>" 
                                                        data-nama-brg="<?= esc($item['nama_brg']) ?>"><i class="ft-edit"></i> Edit</a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Action Buttons -->
            <div class="row mt-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <!-- Tambahkan total harga keseluruhan di sini -->
                                <div class="total-harga">
                                    <h5>Total Keranjang: Rp<?= number_format($totalHargaKeseluruhan, 0, ',', '.') ?></h5>
                                </div>
                                <!-- Tombol-tombol -->
                                <div>
                                    <a href="/produk" class="btn btn-info mr-2">Lanjut Belanja</a>
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#checkoutModal">Order Sekarang</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Keranjang -->
<div class="modal fade" id="editKeranjangModal" tabindex="-1" aria-labelledby="editKeranjangModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editCartForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="editKeranjangModalLabel">Edit Keranjang</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <input type="hidden" id="editKodeBrg" name="kode_brg">
                    <input type="hidden" id="editCartId" name="id">
                    <div class="mb-3">
                        <label for="editUkuran" class="form-label">Ukuran</label>
                        <select class="form-select" id="editUkuran" name="ukuran">
                            <!-- Data ukuran akan diisi melalui JavaScript -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editJumlah" class="form-label">Jumlah</label>
                        <input type="number" class="form-control" id="editJumlah" name="jumlah" min="1">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Checkout Modal -->
<div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="checkoutModalLabel">Checkout</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Tabel Keranjang -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Barang</th>
                            <th>Ukuran</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody id="checkoutItems">
                        <!-- Data keranjang akan dimasukkan di sini -->
                    </tbody>
                </table>

                <!-- Total Belanja -->
                <div class="text-end">
                    <strong>Total Belanja: Rp <span id="totalHarga"></span></strong>
                </div>
            </div>
            <div class="modal-footer">
                <form action="/checkout/process" method="post">
                <input type="hidden" name="selectedItems" id="selectedItems" value="">
                    <button type="submit" class="btn btn-primary">Lanjutkan</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    document.querySelectorAll('.remove-cart-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;
            fetch(`/keranjang/removeFromCart/${id}`, { method: 'DELETE' })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        location.reload();
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    });

    document.querySelectorAll('.edit-cart-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        const id = this.dataset.id;
        const ukuran = this.dataset.ukuran;
        const jumlah = this.dataset.jumlah;
        const kodeBrg = this.dataset.kodeBrg; // Ambil kode_brg dari dataset
        const namaBrg = this.dataset.namaBrg; // Ambil nama_brg dari dataset

        // Set nilai pada form modal
        document.getElementById('editCartId').value = id;
        document.getElementById('editJumlah').value = jumlah;

        // Set nama_brg sebagai data attribute di editCartId (untuk diakses nanti)
        document.getElementById('editCartId').dataset.namaBrg = namaBrg;

        // Ambil ukuran berdasarkan nama_brg
        fetch(`/keranjang/getUkuran/${namaBrg}`)
            .then(response => response.json())
            .then(data => {
                const ukuranSelect = document.getElementById('editUkuran');
                ukuranSelect.innerHTML = '';
                data.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.ukuran;
                    option.text = item.ukuran;
                    if (item.ukuran === ukuran) option.selected = true;
                    ukuranSelect.appendChild(option);
                });
            });

        // Tampilkan modal
        new bootstrap.Modal(document.getElementById('editKeranjangModal')).show();
    });
});

document.getElementById('editUkuran').addEventListener('change', function () {
    const ukuranBaru = this.value; // Ukuran yang dipilih
    const namaBrg = document.getElementById('editCartId').dataset.namaBrg; // Ambil nama_brg dari data attribute

    // Ambil kode_brg baru berdasarkan ukuran dan nama barang
    fetch(`/keranjang/getKodeBarang?nama_brg=${namaBrg}&ukuran=${ukuranBaru}`)
        .then(response => response.json())
        .then(data => {
            if (data.kode_brg) {
                document.getElementById('editKodeBrg').value = data.kode_brg;
            } else {
                
            }
        })
        .catch(error => console.error('Error:', error));
});

document.getElementById('editCartForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const id = document.getElementById('editCartId').value;
    const ukuran = document.getElementById('editUkuran').value;
    const jumlah = document.getElementById('editJumlah').value;

    fetch(`/keranjang/editCart/${id}`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ ukuran, jumlah })
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                location.reload();
            } else {
                alert(data.message);
            }
        })
        .catch(error => console.error('Error:', error));
});

document.addEventListener("DOMContentLoaded", function () {
    const checkoutButton = document.querySelector('.btn-warning');
    const itemCheckboxes = document.querySelectorAll('.item-checkbox');

    checkoutButton.addEventListener('click', function () {
        let selectedItems = [];
        let totalHarga = 0;

        // Loop melalui semua checkbox
        itemCheckboxes.forEach(function (checkbox) {
            if (checkbox.checked) {
                // Ambil data produk dari checkbox
                const id = checkbox.dataset.id;
                const harga = parseInt(checkbox.dataset.harga);
                const item = <?= json_encode($keranjang) ?>.find(i => i.id === id);

                if (item) {
                    selectedItems.push({
                        id: item.id,
                        nama_brg: item.nama_brg,
                        ukuran: item.ukuran,
                        jumlah: item.jumlah,
                        harga_brg: item.harga_brg,
                        total_harga: item.total_harga
                    });

                    totalHarga += parseInt(item.total_harga);
                }
            }
        });

        // Update modal dengan data produk yang dipilih
        const checkoutItems = selectedItems.map(item => `
            <tr>
                <td>${item.nama_brg}</td>
                <td>${item.ukuran}</td>
                <td>${item.jumlah}</td>
                <td>Rp${item.harga_brg.toLocaleString()}</td>
                <td>Rp${item.total_harga.toLocaleString()}</td>
            </tr>
        `).join('');
        
        document.getElementById('checkoutItems').innerHTML = checkoutItems || '<tr><td colspan="5" class="text-center">Tidak ada produk yang dipilih.</td></tr>';
        document.getElementById('totalHarga').innerText = totalHarga.toLocaleString();

        // Simpan data produk yang dipilih dalam input hidden
        document.getElementById('selectedItems').value = JSON.stringify(selectedItems);
    });
});


    document.addEventListener('DOMContentLoaded', function () {
    const selectAllCheckbox = document.getElementById('selectAllCheckbox');
    const itemCheckboxes = document.querySelectorAll('.item-checkbox');

    // Event listener untuk checkbox "Pilih Semua"
    selectAllCheckbox.addEventListener('change', function () {
        const isChecked = selectAllCheckbox.checked;
        itemCheckboxes.forEach(checkbox => {
            checkbox.checked = isChecked; // Sesuaikan semua checkbox dengan status checkbox "Pilih Semua"
        });
    });

    // Event listener untuk mengubah status "Pilih Semua" jika semua checkbox lain diubah
    itemCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            const allChecked = Array.from(itemCheckboxes).every(item => item.checked);
            const someChecked = Array.from(itemCheckboxes).some(item => item.checked);
            selectAllCheckbox.checked = allChecked; // Checkbox "Pilih Semua" hanya aktif jika semua checkbox aktif
            selectAllCheckbox.indeterminate = !allChecked && someChecked; // Tampilkan status indeterminate jika sebagian dipilih
        });
    });
});
    
</script>

<?= $this->endSection() ?>
