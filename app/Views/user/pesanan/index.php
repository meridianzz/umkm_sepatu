<?= $this->extend('layout/user') ?>

<?= $this->section('konten') ?>

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title mb-0 d-inline-block">Pesanan</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a>Pelanggan</a></li>
                            <li class="breadcrumb-item active">Data Pesanan Anda</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-body">
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

    <?php if (!empty($dataPenjualan)): ?>
        <?php foreach ($dataPenjualan as $pesanan): ?>
            <div class="card mb-3" id="pesanan-<?= esc($pesanan['penjualan']['id_penjualan']) ?>">
                <div class="card-header">
                    <h5>Pesanan #<?= esc($pesanan['penjualan']['id_penjualan']) ?> - Tanggal: <?= esc($pesanan['penjualan']['tanggal_pembelian']) ?></h5>
                    <p>Status: 
                    <?php 
                    $status = esc($pesanan['penjualan']['status']);
                    if ($status == 'Menunggu Konfirmasi') {
                        echo '<span class="badge badge-warning">Menunggu Konfirmasi</span>';
                    } elseif ($status == 'Selesai') {
                        echo '<span class="badge badge-success">Selesai</span>';
                    } elseif ($status == 'Dibatalkan') {
                        echo '<span class="badge badge-danger">Dibatalkan</span>';
                    } elseif ($status == 'Belum Lunas') {
                        echo '<span class="badge badge-secondary">Belum Lunas</span>';
                    } else {
                        echo '<span class="badge badge-info">Proses</span>';
                    }
                    ?>
                    </p>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Ukuran</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Total Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pesanan['detailPenjualan'] as $item): ?>
                                <tr>
                                    <td><?= esc($item['nama_brg']) ?></td>
                                    <td><?= esc($item['ukuran']) ?></td>
                                    <td><?= esc($item['jumlah']) ?></td>
                                    <td>Rp<?= number_format($item['harga_brg'], 0, ',', '.') ?></td>
                                    <td>Rp<?= number_format($item['total_harga'], 0, ',', '.') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="text-end">
                        <strong>Total Pesanan: Rp<?= number_format($pesanan['penjualan']['total_harga'], 0, ',', '.') ?></strong>
                    </div>
                    
                    <!-- Tombol Bayar Sekarang hanya tampil jika status bukan 'Selesai' atau 'Dibatalkan' -->
                    <?php if ($status != 'Selesai' && $status != 'Dibatalkan'&& $status != 'Proses'): ?>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#bayarModal<?= $pesanan['penjualan']['id_penjualan'] ?>">Bayar Sekarang</button>
                    <?php endif; ?>
                    <button class="btn btn-success" data-toggle="modal" data-target="#buktiModal<?= $pesanan['penjualan']['id_penjualan'] ?>">
                        Lihat Bukti
                        </button>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="alert alert-warning">Tidak ada pesanan untuk ditampilkan.</div>
    <?php endif; ?>
</div>


<!-- Modal untuk upload bukti pembayaran -->
<div class="modal fade" id="bayarModal<?= esc($pesanan['penjualan']['id_penjualan']) ?>" tabindex="-1" aria-labelledby="bayarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bayarModalLabel">Upload Bukti Pembayaran</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Gambar bukti pembayaran atau ilustrasi -->
                <div class="mb-3">
                    <img src="https://i.imgflip.com/zumme.jpg?a480960" alt="Ilustrasi Pembayaran" class="img-fluid rounded mx-auto d-block">
                </div>
                <form action="/checkout/uploadBukti" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id_penjualan" value="<?= esc($pesanan['penjualan']['id_penjualan']) ?>">
                    <div class="mb-3">
                        <label for="bukti_bayar" class="form-label">Pilih Bukti Pembayaran (jpg, png, jpeg)</label>
                        <input type="file" class="form-control" id="bukti_bayar" name="bukti_bayar" accept=".jpg,.jpeg,.png" required>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-success">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="buktiModal<?= $pesanan['penjualan']['id_penjualan'] ?>" tabindex="-1" aria-labelledby="buktiModalLabel<?= $pesanan['penjualan']['id_penjualan'] ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="buktiModalLabel<?= $pesanan['penjualan']['id_penjualan'] ?>">Bukti Pembayaran - Pesanan #<?= esc($pesanan['penjualan']['id_penjualan']) ?></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Cek apakah bukti bayar tersedia -->
                    <?php if ($pesanan['penjualan']['bukti_bayar']): ?>
                        <img src="/assets/dist/img/bukti/<?= esc($pesanan['penjualan']['bukti_bayar']) ?>" 
                            alt="Bukti Pembayaran" 
                            class="img-fluid" 
                            style="max-width: 100%; height: auto;">
                    <?php else: ?>
                        <p>Bukti pembayaran belum tersedia.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>




<?php if (!empty($_GET['idPenjualan'])): ?>
    <script>

    $(document).ready(function() {
        // Pastikan halaman sepenuhnya dimuat sebelum scrolling
        setTimeout(function() {
            // Ambil idPenjualan dari query string
            var idPenjualan = '<?= esc($_GET['idPenjualan']) ?>';

            // Scroll ke pesanan yang sesuai dengan idPenjualan
            var target = $('#pesanan-' + idPenjualan);
            if (target.length) { // Pastikan elemen dengan ID tersebut ada
                // Hitung posisi tengah elemen dan tengah viewport
                var targetTop = target.offset().top;
                var targetHeight = target.outerHeight();
                var viewportHeight = $(window).height();
                var scrollTo = targetTop - (viewportHeight / 2) + (targetHeight / 2);

                $('html, body').animate({
                    scrollTop: scrollTo
                }, 1000); // Waktu scroll 1000ms (1 detik)
            }
        }, 500); // Waktu tunda 500ms
    });

    document.addEventListener('DOMContentLoaded', function () {
    const buktiBayarContent = document.getElementById('buktiBayarContent');

    // Event listener untuk tombol "Lihat Bukti"
    document.querySelectorAll('.lihat-bukti-btn').forEach(button => {
        button.addEventListener('click', function () {
            const idPenjualan = this.dataset.id;

            // Tampilkan loading sebelum data dimuat
            buktiBayarContent.innerHTML = '<p>Loading...</p>';

            // Ambil data bukti bayar menggunakan AJAX
            fetch(`/pesanan/getBuktiBayar/${idPenjualan}`)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success' && data.bukti_bayar) {
                        // Tampilkan gambar bukti bayar
                        buktiBayarContent.innerHTML = `
                            <img src="public/assets/dist/img/bukti/${data.bukti_bayar}" 
                                alt="Bukti Pembayaran" 
                                class="img-fluid" 
                                style="max-width: 100%; height: auto;">
                        `;
                    } else {
                        // Jika bukti bayar tidak ditemukan
                        buktiBayarContent.innerHTML = `<p>${data.message || 'Bukti bayar tidak ditemukan.'}</p>`;
                    }
                })
                .catch(error => {
                    console.error('Error fetching bukti bayar:', error);
                    buktiBayarContent.innerHTML = '<p>Terjadi kesalahan saat memuat data.</p>';
                });
        });
    });
});

</script>

<?php endif; ?>
<?= $this->endSection() ?>
