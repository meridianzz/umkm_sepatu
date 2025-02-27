<?= $this->extend('layout/admin') ?>

<?= $this->section('konten') ?>

<div class="app-content content">
	<div class="row">
		<div class="col-xl-3 col-lg-6 col-12">
			<div class="card pull-up">
				<div class="card-content">
					<div class="card-body">
						<div class="media d-flex">
							<div class="media-body text-left">
							<h3 class="success"><?= esc($total_produk_terjual) ?></h3>
								<h6>Produk terjual</h6>
							</div>
							<div>
								<i class="icon-basket-loaded info font-large-2 float-right"></i>
							</div>
						</div>
						<div class="progress progress-sm mt-1 mb-0 box-shadow-2">
							<div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 80%"
								aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-lg-6 col-12">
			<div class="card pull-up">
				<div class="card-content">
					<div class="card-body">
						<div class="media d-flex">
							<div class="media-body text-left">
							       <h3 class="warning"><?= esc($total_pendapatan) ?></h3>
								<h6>Pendapatan</h6>
							</div>
							<div>
								<i class="icon-pie-chart warning font-large-2 float-right"></i>
							</div>
						</div>
						<div class="progress progress-sm mt-1 mb-0 box-shadow-2">
							<div class="progress-bar bg-gradient-x-warning" role="progressbar" style="width: 65%"
								aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-lg-6 col-12">
		<div class="card pull-up">
			<div class="card-content">
				<div class="card-body">
					<div class="media d-flex">
						<div class="media-body text-left">
							<!-- Menampilkan total pelanggan -->
							<h3 class="success"><?= esc($total_customer) ?></h3>
							<h6>Customer</h6>
						</div>
						<div>
							<i class="icon-user-follow success font-large-2 float-right"></i>
						</div>
					</div>
					<div class="progress progress-sm mt-1 mb-0 box-shadow-2">
						<div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

		<div class="col-xl-3 col-lg-6 col-12">
			<div class="card pull-up">
				<div class="card-content">
					<div class="card-body">
						<div class="media d-flex">
							<div class="media-body text-left">
								<h3 class="danger">99.89 %</h3>
								<h6>Penilaian</h6>
							</div>
							<div>
								<i class="icon-heart danger font-large-2 float-right"></i>
							</div>
						</div>
						<div class="progress progress-sm mt-1 mb-0 box-shadow-2">
							<div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 85%"
								aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?= $this->endSection() ?>