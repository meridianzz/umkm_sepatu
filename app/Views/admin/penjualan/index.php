<?= $this->extend('layout/admin') ?>

<?= $this->section('konten') ?>

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title mb-0 d-inline-block">Penjualan</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a>Data Penjualan</a></li>
                            <li class="breadcrumb-item active">Data Penjualan Produk</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-body">
            <?php if (!empty($penjualan)): ?>
                <div class="card">
                    <div class="card-header">
                        <h5>Daftar Penjualan</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Tanggal Pembelian</th>
                                    <th>Status</th>
                                    <th>Total Harga</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($penjualan as $p): ?>
                                    <tr>
                                        <td><?= esc($p['tanggal_pembelian']) ?></td>
                                        <td>
                                            <!-- Form untuk mengubah status -->
                                            <form action="/admin/penjualan/update_status/<?= esc($p['id_penjualan']) ?>" method="post">
                                                <select name="status" class="form-control">
                                                    <option value="Menunggu Konfirmasi" <?= $p['status'] == 'Menunggu Konfirmasi' ? 'selected' : '' ?>>Menunggu Konfirmasi</option>
                                                    <option value="Proses" <?= $p['status'] == 'Proses' ? 'selected' : '' ?>>Proses</option>
                                                    <option value="Selesai" <?= $p['status'] == 'Selesai' ? 'selected' : '' ?>>Selesai</option>
                                                    <option value="Dibatalkan" <?= $p['status'] == 'Dibatalkan' ? 'selected' : '' ?>>Dibatalkan</option>
                                                </select>
                                                <button type="submit" class="btn btn-primary btn-sm mt-2">Update</button>
                                            </form>
                                        </td>
                                        <td>Rp<?= number_format($p['total_harga'], 0, ',', '.') ?></td>
                                        <td>
                                            <!-- Tombol untuk membuka modal -->
                                            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#detailModal<?= $p['id_penjualan'] ?>">Lihat Detail</button>
                                        </td>
                                    </tr>

                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php else: ?>
                <div class="alert alert-warning">Tidak ada data penjualan untuk ditampilkan.</div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php foreach ($penjualan as $p): ?>
    <!-- Modal untuk detail penjualan -->
    <div class="modal fade" id="detailModal<?= $p['id_penjualan'] ?>" tabindex="-1" aria-labelledby="detailModalLabel<?= $p['id_penjualan'] ?>" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel<?= $p['id_penjualan'] ?>">Detail Pesanan #<?= esc($p['id_penjualan']) ?></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
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
                            <?php foreach ($p['detailPenjualan'] as $item): ?>
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
                        <strong>Total Pesanan: Rp<?= number_format($p['total_harga'], 0, ',', '.') ?></strong>
                    </div>

                    <!-- Tampilkan bukti bayar jika ada -->
                    <?php if ($p['bukti_bayar']): ?>
                        <div class="mt-3">
                            <h6>Bukti Pembayaran:</h6>
                            <!-- Menampilkan gambar bukti bayar -->
                            <img src="/assets/dist/img/bukti/<?= esc($p['bukti_bayar']) ?>" alt="Bukti Pembayaran" class="img-fluid" style="max-width: 100%; height: auto;">
                        </div>
                    <?php else: ?>
                        <div class="mt-3">
                            <h6>Bukti Pembayaran Belum Dikirim</h6>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?= $this->endSection() ?>
