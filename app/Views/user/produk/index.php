
<?= $this->extend('layout/user') ?>

<?= $this->section('konten') ?>

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block">Daftar Produk</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Produk</a></li>
                            <li class="breadcrumb-item active">Sepatu</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="sidebar-detached sidebar-left">
            <div class="sidebar">
                <div class="sidebar-content d-none d-lg-block sidebar-shop">
                    <div class="card">
                        <div class="card-body">
                            <div class="search">
                                <input id="basic-search" type="text" placeholder="Cari Disini...." class="basic-search">
                                <i class="ficon ft-search"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
							<div class="categories-list">
								<div class="category-title pb-1 d-flex justify-content-between align-items-center">
									<h4 class="card-title mb-0">Kategori</h4>
									<a href="<?= base_url('produk') ?>" class="btn btn-link p-0">See All</a>
								</div>
								<hr>
								<div class="product-cat" id="categories">
									<ul class="treeview">
										<?php foreach ($kategori as $kat): ?>
											<li>
												<a href="?kategori=<?= esc($kat['kode_kategori']) ?>" 
												class="<?= $kategoriDipilih == $kat['kode_kategori'] ? 'active' : '' ?>">
													<?= esc($kat['nama_kategori']) ?>
												</a>
											</li>
										<?php endforeach; ?>
									</ul>
								</div>
							</div>

							<div class="size">
								<div class="category-title mt-3 pb-1 d-flex justify-content-between align-items-center">
									<h4 class="card-title mb-0">Ukuran</h4>
									<a href="?<?= http_build_query(array_merge($_GET, ['ukuran' => null])) ?>" 
									class="btn btn-link p-0">See All</a>
								</div>
								<hr>
								<div class="size-filter">
									<div class="d-flex flex-wrap gap-2">
										<?php foreach ($ukuranUnik as $ukuran): ?>
											<a href="?<?= http_build_query(array_merge($_GET, ['ukuran' => $ukuran['ukuran']])) ?>" 
											class="btn <?= $ukuranDipilih == $ukuran['ukuran'] ? 'btn-primary' : 'btn-outline-secondary' ?> btn-sm">
												<?= esc($ukuran['ukuran']) ?>
											</a>
										<?php endforeach; ?>
									</div>
								</div>
							</div>


                        </div>
                    </div>
                </div>
            </div>
        </div>

		<div class="content-detached content-right">
    <div class="content-body">
        <div class="row match-height">
            <?php if (empty($produkGrouped)): ?>
                <p class="text-center">Produk tidak ditemukan untuk kategori ini.</p>
            <?php else: ?>
                <?php foreach ($produkGrouped as $namaBrg => $produk): ?>
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="product-img d-flex align-items-center justify-content-center">
                                        <?php if ($produk[0]['foto_brg']): ?>
                                            <img src="<?= base_url('assets/dist/img/fotosepatu/' . $produk[0]['foto_brg']) ?>" 
                                                 alt="<?= esc($produk[0]['nama_brg']) ?>" 
                                                 class="img-fluid" style="max-width: 100%; height: auto;">
                                        <?php else: ?>
                                            <span>No Photo</span>
                                        <?php endif; ?>
                                    </div>

                                    <h4 class="product-title"><?= esc($produk[0]['nama_brg']) ?></h4>
                                    <div class="price-reviews">
                                        <span class="price">Rp<?= number_format($produk[0]['harga_brg'], 0, ',', '.') ?></span>
                                    </div>
                                    <div class="product-action d-flex justify-content-around">
                                        <a href="#" 
                                           data-toggle="modal" 
                                           data-target="#productDetailModal" 
                                           class="btn-view-detail"
                                           data-id="<?= esc($produk[0]['kode_brg']) ?>" 
                                           data-nama="<?= esc($produk[0]['nama_brg']) ?>"
                                           data-harga="<?= number_format(esc($produk[0]['harga_brg']), 0, ',', '.') ?>"
                                           data-deskripsi="<?= esc($produk[0]['deskripsi_brg'] ?? 'Tidak ada deskripsi') ?>"
                                           data-foto="<?= base_url('assets/dist/img/fotosepatu/' . $produk[0]['foto_brg']) ?>"
                                           data-kategori="<?= esc($produk[0]['nama_kategori']) ?>">
                                            Lihat Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="productDetailModal" tabindex="-1" role="dialog" aria-labelledby="productDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="product-detail">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-content">
                                <div class="row">
                                    <!-- Product Image -->
                                    <div class="col-4">
                                        <div class="product-img d-flex align-items-center">
                                            <img id="product-image" class="img-fluid mb-1" src="#" alt="Product Image">
                                        </div>
                                    </div>
                                    <!-- Product Details -->
                                    <div class="col-8">
                                        <!-- Title and Ratings -->
										<div class="title-area clearfix">
                                            <h2 id="product-name" class="product-title float-left">Product Name</h2>
                                            <div class="badge badge-success round">-50%</div>
                                            <div class="badge badge-primary round" id="product-category">Kategori</div> <!-- Kategori di sini -->
                                            <span class="ratings float-right"></span>
                                        </div>
                                        <!-- Price and Reviews -->
                                        <div class="price-reviews clearfix">
                                            <span class="price-box">
                                                <span id="product-price" class="price h4">$250</span>
                                                <span class="old-price h4">$500</span>
                                            </span>
                                            <span class="float-right">(201 ratings)</span>
                                        </div>
                                        <!-- Product Description -->
                                        <div class="product-info">
                                            <p id="product-description">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                            </p>
                                        </div>
                                        <!-- Size Options -->
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="product-options size-filter mb-3">
                                                    <span class="option-title">Ukuran:</span>
                                                    <ul id="ukuran-list" class="list-inline">
                                                        <!-- Ukuran akan dirender secara dinamis -->
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Input Jumlah (Sekarang di bawah deskripsi) -->
                                        <div class="form-group">
                                            <label for="product-quantity">Jumlah:</label>
                                            <input type="number" id="product-quantity" class="form-control" value="1" min="1">
                                        </div>
                                        <!-- Action Buttons -->
										<form id="add-to-cart-form" action="/keranjang/add" method="post">
											<input type="hidden" name="kode_brg" id="input-kode-brg" value="">
											<input type="hidden" name="ukuran" id="input-ukuran" value="">
											<input type="hidden" name="jumlah" id="input-jumlah" value="1">
											<input type="hidden" name="username" id="input-username" value=""> <!-- Input untuk username -->
											<input type="hidden" name="harga_brg" id="input-harga-brg" value=""> <!-- Input untuk harga barang -->
											<input type="hidden" name="total_harga" id="input-total-harga" value=""> <!-- Input untuk total harga -->
											<button type="submit" class="btn btn-danger btn-sm">
												<i class="la la-shopping-cart"></i> Masukkan Ke Keranjang
											</button>
											<a href="ecommerce-checkout.html" class="btn btn-info btn-sm">
												<i class="la la-flash"></i> Beli Sekarang
											</a>
										</form>
                                    </div>
                                    <!-- End of Product Details -->
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
	document.getElementById('add-to-cart-form').addEventListener('submit', function (e) {
    e.preventDefault(); // Cegah pengiriman form default

    const formData = new FormData(this);

    // Mulai request fetch
    fetch(this.action, {
        method: 'POST',
        body: formData,
    })
        .then(response => response.json()) // Pastikan respons berupa JSON
        .then(data => {
            // Cek status dari server
            if (data.status === 'success') {
                // Tampilkan alert biasa jika sukses
                alert('Produk telah masuk ke keranjang Anda.');

                // Reset form jika perlu
                this.reset();
            } else {
                // Jika gagal, tampilkan pesan error
                alert(data.message || 'Terjadi kesalahan saat menambahkan ke keranjang.');
            }
        })
        .catch(error => {
            console.error('Error:', error); // Tampilkan error di console jika fetch gagal
            alert('Terjadi kesalahan jaringan. Coba lagi nanti.');
        });
});

document.querySelectorAll('.btn-view-detail').forEach(btn => {
    btn.addEventListener('click', function () {
        // Mengisi data dasar ke modal
        document.getElementById('product-name').textContent = this.dataset.nama;
        document.getElementById('product-price').textContent = `IDR ${this.dataset.harga}`;
        document.getElementById('product-description').textContent = this.dataset.deskripsi;
        document.getElementById('product-image').src = this.dataset.foto;

        // Menambahkan kategori produk
        document.getElementById('product-category').textContent = this.dataset.kategori;

        // Isi kode barang ke input form (menggunakan data-id)
        document.getElementById('input-kode-brg').value = this.dataset.id;

        // Ambil username dari sesi
        const username = <?= json_encode(session()->get('username')) ?>; // Ambil username dari session
        document.getElementById('input-username').value = username;

        // Ambil nama_brg yang dipilih
        const nama_brg = this.dataset.nama;

        // Ambil harga_brg yang dipilih
        const harga_brg = parseInt(this.dataset.harga.replace(/\D/g, '')); // Mengonversi harga menjadi angka tanpa simbol IDR
        document.getElementById('input-harga-brg').value = harga_brg;

        // Fetch ukuran berdasarkan nama_brg
        fetch(`/produk/getUkuran/${nama_brg}`)
            .then(response => response.json())
            .then(data => {
                let ukuranList = '';
                data.forEach(item => {
                    if (item.status === 'Aktif') {
                        ukuranList += `<li><a href="#" class="active size-option" data-ukuran="${item.ukuran}" data-id="${item.kode_brg}" data-harga="${item.harga_brg}">${item.ukuran}</a></li>`;
                    } else {
                        ukuranList += `<li><a href="#" class="disabled" style="color: grey; cursor: not-allowed;">${item.ukuran}</a></li>`;
                    }
                });
                document.getElementById('ukuran-list').innerHTML = ukuranList;
            })
            .catch(error => console.error('Error:', error));

        // Menampilkan modal
        $('#productDetailModal').modal('show');
    });
});


// Menangani klik ukuran
document.addEventListener('click', function (e) {
    if (e.target && e.target.classList.contains('size-option')) {
        e.preventDefault();

        // Hapus kelas 'selected' dari semua ukuran
        document.querySelectorAll('.size-option').forEach(option => {
            option.classList.remove('selected');
        });

        // Tandai ukuran yang dipilih
        e.target.classList.add('selected');

        // Ambil ukuran yang dipilih
        const selectedSize = e.target.getAttribute('data-ukuran');
        document.getElementById('input-ukuran').value = selectedSize;

        // Ambil kode_brg berdasarkan ukuran yang dipilih
        const selectedKodeBrg = e.target.getAttribute('data-id');
        document.getElementById('input-kode-brg').value = selectedKodeBrg;

        // Ambil harga_brg berdasarkan ukuran yang dipilih
        const harga_brg = parseInt(e.target.getAttribute('data-harga').replace(/\D/g, '')); // Mengonversi harga menjadi angka tanpa simbol IDR
        document.getElementById('input-harga-brg').value = harga_brg;

        // Update harga total berdasarkan jumlah
        updateTotalPrice();
    }
});

// Menangani perubahan jumlah
document.getElementById('product-quantity').addEventListener('input', function () {
    document.getElementById('input-jumlah').value = this.value;

    // Update harga total berdasarkan jumlah
    updateTotalPrice();
});

function updateTotalPrice() {
    const harga_brg = parseInt(document.getElementById('input-harga-brg').value);
    const jumlah = parseInt(document.getElementById('product-quantity').value);
    
    if (harga_brg && jumlah) {
        const totalHarga = harga_brg * jumlah;
        document.getElementById('product-price').textContent = `IDR ${totalHarga.toLocaleString()}`;
        document.getElementById('input-total-harga').value = totalHarga; // Kirimkan total harga ke input form
    }
}

</script>

				<style>
					.product-options {
						display: flex;
						justify-content: flex-start;
						align-items: center;
					}

					.option-title {
						margin-right: 10px; /* Menambahkan jarak antara teks dan elemen ukuran */
						font-weight: bold;
						white-space: nowrap; /* Menghindari teks terpotong */
					}


					/* CSS untuk menandai ukuran yang dipilih */
					.size-option.selected {
						color: #007bff; /* Ubah warna teks ketika ukuran dipilih */
						font-weight: bold;
						border: 2px solid #007bff; /* Tambahkan border */
						padding: 0; /* Hilangkan padding */
						background-color: #f8f9fa; /* Menambahkan latar belakang saat dipilih */
					}

					.size-option.active {
						cursor: pointer;
						color: #28a745; /* Warna aktif */
					}

					.size-option.disabled {
						cursor: not-allowed;
						color: grey;
					}
				</style>

        </div>
    </div>
</div>

<?= $this->endSection() ?>


          