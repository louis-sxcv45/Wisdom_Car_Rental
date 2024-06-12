<div class="container d-flex justify-content-between align-items-center" style="margin-top:45px;">
    <div class="container mt-4 vh-auto">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3" style="margin-top:25px;">
                <h4 class="mb-1">Kelola Akun</h4>
                <ul class="list-group border-0">
                    <li class="list-group-item border-0">
                        <a href="#" class="text-decoration-none fs-5 fw-medium active-profile">Profil</a>
                    </li>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="col-md-8 p-4 border shadow-sm ms-1 mt-5" style="max-width: 50em; width: 97.6%;">
                <h3>Profile</h3>
                <!-- KTP Image -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <div class="container position-relative">
                                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#profileModal">
                                    <?php
                                    if (!empty($data['profile']['image'])) { // If the profile image data is not empty
                                        echo '<img src="data:image/jpeg;base64,' . base64_encode($data['profile']['image']) . '" class="utama-profile-image" alt="Profile Image" />'; // Display the profile image
                                    } else { // If the profile image data is empty
                                    ?>
                                        <span id="user-section">
                                            <span class="me-3" id="user-avatar"><i class="bi bi-person-circle text-black" style="font-size: 120px;"></i></span> <!-- Display a default icon for profile image -->
                                        </span>
                                    <?php
                                    };
                                    ?>

                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <form action="<?= BASEURL ?>/admin/prosesedit">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label for="firstName">Nama Depan</label>
                                <input type="text" class="form-control mt-2" name="nama_depan" value="<?= $data['profile']['nama_depan'] ?>" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label for="lastName">Nama Belakang</label>
                                <input type="text" class="form-control mt-2" name="nama_belakang" value="<?= $data['profile']['nama_belakang'] ?>" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="email">Email</label>
                        <input type="email" class="form-control mt-2" name="email" value="<?= $data['profile']['email'] ?>" />
                    </div>

                    <div class="form-group mb-4">
                        <label for="phoneNumber">Phone Number</label>
                        <input type="text" class="form-control mt-2" name="phone_number" value="<?= $data['profile']['phone_number'] ?>" />
                    </div>
                    <button type="submit" class="btn btn-primary" name="save" style="width: 10em; height: 3em;">
                        Kirim
                    </button>
                </form>

                <form action="<?= BASEURL ?>/admin/newpw" method="post" onsubmit="return validatePassword()">
                    <?php Flasher::flashapus(); ?>
                    <h5>Perubahan Kata Sandi</h5>
                    <div class="form-group mb-4">
                        <input type="password" class="form-control mt-2" id="currentPassword" name="password" placeholder="Kata Sandi Saat Ini" required />
                    </div>
                    <div class="form-group mb-4">
                        <input type="password" class="form-control mt-2" id="newPassword" name="newPassword" placeholder="Kata Sandi Baru" required />
                    </div>
                    <div class="form-group mb-4">
                        <input type="password" class="form-control mt-2" id="confirmPassword" name="confirmPassword" placeholder="Konfirmasi Kata Sandi Baru" required />
                    </div>
                    <div id="passwordError" class="text-danger mt-2" style="display: none;">Kata sandi baru tidak cocok.</div>
                    <div class="button-action mt-3 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary" style="width: 10em; height: 3em;">
                            Ganti Password
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<!-- Profile Modal -->
<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profileModalLabel">Tambah/Ubah Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="profileForm" action="<?= BASEURL ?>/admin/updateimagebaru" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="profile-image">Pilih Gambar</label>
                        <input type="file" class="form-control-file" id="profile-image" name="image" accept="image/*">
                    </div>
                    <div class="form-group">
                        <img id="profile-image-preview" src="#" alt="Preview Gambar" style="display: none;">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>