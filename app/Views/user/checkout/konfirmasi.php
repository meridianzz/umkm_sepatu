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
        <div class="container mt-5">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h2 class="mb-3">Keranjang Belanja</h2>
                        <form id="keranjangForm">
                            <table class="table table-borderless mb-0">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="selectAll"></th>
                                        <th>Produk</th>
                                        <th>Detail</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Total Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($keranjang)): ?>
                                        <tr>
                                            <td colspan="6" class="text-center">Keranjang kosong.</td>
                                        </tr>
                                    <?php else: ?>
                                        <?php foreach ($keranjang as $item): ?>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" class="selectItem" data-id="<?= $item['id'] ?>" data-total="<?= $item['total_harga'] ?>">
                                                </td>
                                                <td>
                                                    <img class="img-fluid" 
                                                         src="<?= base_url('assets/dist/img/fotosepatu/' . esc($item['foto_brg'])) ?>" 
                                                         alt="Foto Barang" 
                                                         style="width: 150px; height: auto; border-radius: 8px;">
                                                </td>
                                                <td>
                                                    <div><?= esc($item['nama_brg']) ?></div>
                                                    <div>
                                                        <strong>Size: </strong>
                                                        <select class="form-control size-select" data-id="<?= $item['id'] ?>">
                                                            <?php foreach ($item['available_sizes'] as $size): ?>
                                                                <option value="<?= $size ?>" <?= $size == $item['ukuran'] ? 'selected' : '' ?>><?= $size ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>Rp <?= number_format($item['harga_brg'], 0, ',', '.') ?></td>
                                                <td>
                                                    <div class="input-group">
                                                        <button type="button" class="btn btn-outline-secondary btn-sm btn-decrease" data-id="<?= $item['id'] ?>">-</button>
                                                        <input type="number" class="form-control text-center jumlah-barang" data-id="<?= $item['id'] ?>" 
                                                               value="<?= esc($item['jumlah']) ?>" min="1" style="width: 60px;">
                                                        <button type="button" class="btn btn-outline-secondary btn-sm btn-increase" data-id="<?= $item['id'] ?>">+</button>
                                                    </div>
                                                </td>
                                                <td class="total-price" data-id="<?= $item['id'] ?>">Rp <?= number_format($item['total_harga'], 0, ',', '.') ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="row mt-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div class="total-harga">
                                    <h5>Total Belanja: Rp <span id="totalHargaKeseluruhan">0</span></h5>
                                </div>
                                <div>
                                    <a href="/produk" class="btn btn-info mr-2">Lanjut Belanja</a>
                                    <button type="button" class="btn btn-warning" id="checkoutBtn">Order Sekarang</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Update total harga berdasarkan checkbox
function updateTotalHarga() {
    let total = 0;
    document.querySelectorAll('.selectItem:checked').forEach(checkbox => {
        total += parseInt(checkbox.dataset.total);
    });
    document.getElementById('totalHargaKeseluruhan').innerText = total.toLocaleString();
}

// Event listener untuk checkbox
document.querySelectorAll('.selectItem').forEach(checkbox => {
    checkbox.addEventListener('change', updateTotalHarga);
});

// Select all functionality
document.getElementById('selectAll').addEventListener('change', function () {
    const isChecked = this.checked;
    document.querySelectorAll('.selectItem').forEach(checkbox => {
        checkbox.checked = isChecked;
    });
    updateTotalHarga();
});

// Fungsi update jumlah barang
function updateJumlah(id, jumlah) {
    fetch(`/keranjang/updateJumlah/${id}`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ jumlah })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            const totalElement = document.querySelector(`.total-price[data-id='${id}']`);
            totalElement.textContent = `Rp ${data.total_harga.toLocaleString()}`;
            document.querySelector(`.selectItem[data-id='${id}']`).dataset.total = data.total_harga;
            updateTotalHarga();
        }
    });
}

// Mengurangi jumlah
document.querySelectorAll('.btn-decrease').forEach(btn => {
    btn.addEventListener('click', function () {
        const id = this.dataset.id;
        const input = document.querySelector(`.jumlah-barang[data-id='${id}']`);
        if (parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
            updateJumlah(id, input.value);
        }
    });
});

// Menambahkan jumlah
document.querySelectorAll('.btn-increase').forEach(btn => {
    btn.addEventListener('click', function () {
        const id = this.dataset.id;
        const input = document.querySelector(`.jumlah-barang[data-id='${id}']`);
        input.value = parseInt(input.value) + 1;
        updateJumlah(id, input.value);
    });
});

// Mengubah ukuran produk
document.querySelectorAll('.size-select').forEach(select => {
    select.addEventListener('change', function () {
        const id = this.dataset.id;
        const size = this.value;
        fetch(`/keranjang/updateUkuran/${id}`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ukuran: size })
        }).then(response => response.json()).then(data => {
            if (data.status === 'success') {
                console.log('Ukuran berhasil diubah.');
            }
        });
    });
});
</script>

<?= $this->endSection() ?>
