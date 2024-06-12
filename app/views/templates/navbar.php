<nav class="navbar navbar-expand-lg" style="background-color: #1083e0;">
	<div class="container d-flex justify-content-between align-items-center">
		<a class="navbar-brand order-1 text-white text-decoration-none" href="<?= BASEURL; ?>/katalog">Rental Mobil Wisdom</a>
		<div class="d-flex order-lg-4 order-2">
			<?php if (!empty($data['profile'])) : ?>
				<div class="nav-item d-flex align-items-center">
					<li class="nav-item dropdown mb-2" style="list-style: none;">

						<a class="nav-link" href="#user-dropdown" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<?php if (!empty($data['profile']['image'])) : ?>
								<img src='data:image/jpeg;base64,<?= base64_encode($data['profile']['image']) ?>' class="utama-profile-image rounded-circle ml-2 " alt="Profile Image" style="width: 40px; height: 40px;" />

							<?php else : ?>
								<div class='nav-item'>
									<span id="user-section">
										<span class="me-3" id="user-avatar"><i class="bi bi-person-circle text-white" style="font-size: 35px;"></i></span>
									</span>
								</div>
							<?php endif; ?>
						</a>
						<ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start">
							<li><a class="dropdown-item text-decoration-none" href='<?= BASEURL; ?>/profile'>Profile</a></li>
							<li>
								<hr class="dropdown-divider">
							</li>
							<li><a class="dropdown-item text-decoration-none" href='<?= BASEURL; ?>/logout'>Logout</a></li>
						</ul>
					</li>
				</div>
			<?php else : ?>
				<div class='nav-item'>
					<a href='<?= BASEURL; ?>/login' class='nav-link text-white'>Login/Sign Up</a>
				</div>
			<?php endif; ?>
			<button class="navbar-toggler order-2 my-2 h-25" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
		</div>

		<div class="collapse navbar-collapse justify-content-center order-lg-2 order-4" id="navbarResponsive">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link text-white text-decoration-none" href="<?= BASEURL; ?>/katalog#about">About Us</a>
				</li>
				<li class="nav-item">
					<a class="nav-link text-white text-decoration-none" href="<?= BASEURL; ?>/katalog">Katalog</a>
				</li>
				<li class="nav-item">
					<a class="nav-link text-white text-decoration-none" href="https://wa.me/6281262462719">Contact</a>
				</li>
			</ul>
		</div>
	</div>
</nav>