<?= $this->extend('layout/user') ?>

<?= $this->section('konten') ?>

<!-- Checkout Modal -->
<div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="checkoutModalLabel">Checkout</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Barang</th>
                            <th>Ukuran</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($keranjang as $item): ?>
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
                    <strong>Total Belanja: Rp<?= number_format($totalHarga, 0, ',', '.') ?></strong>
                </div>
            </div>
            <div class="modal-footer">
                <form action="/checkout" method="post">
                    <button type="submit" class="btn btn-primary">Bayar Sekarang</button>
                </form>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>