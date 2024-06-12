<div class="container d-flex justify-content-between align-items-center" style="margin-top:45px;">
    <div class="container mt-4"  style="min-height: 100vh;">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3">
                <h4 class="mb-1">Kelola Akun</h4>
                <ul class="list-group border-0">
                    <li class="list-group-item border-0">
                        <a href="<?= BASEURL ?>/Profile" class="text-decoration-none fs-5 fw-medium active-profile">Profil</a>
                    </li>
                    <h4>Pesanan</h4>
                    <li class="list-group-item border-0">
                        <a href="<?= BASEURL ?>/Profile/Tagihan" class="text-secondary text-decoration-none fs-5 fw-medium">Tagihan</a>
                    </li>
                    <li class="list-group-item border-0">
                        <a href="<?= BASEURL ?>/Profile/Sedangberlangsung" class="text-secondary text-decoration-none fs-5 fw-medium">Sedang Berlangsung</a>
                    </li>
                    <li class="list-group-item border-0">
                        <a href="<?= BASEURL ?>/Profile/Dibatalkan" class="text-secondary text-decoration-none fs-5 fw-medium">Pembatalan</a>
                    </li>
                </ul>
            </div>

            <div class="col-md-8 p-4 border shadow-sm ms-1 mt-5 vh-auto" style="max-width: 50em; width: 97.6%;">
            <?php Flasher::flashProfileIncomplete(); ?>   
            <?php Flasher::flashapus(); ?>   
            <h3>Edit Your Profile</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <div class="form-row d-flex mb-4">
                                <div class="container position-relative">
                                    <h1>KTP</h1>
                                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#KTPModal">
                                        <?php
                                        if (!empty($data['profile']['ktp'])) {
                                            echo '<img src="data:image/jpeg;base64,' . base64_encode($data['profile']['ktp']) . '" style="width: 280px; hight: 1300px;" />';
                                        } else {
                                            echo '<img src="' . BASEURL . '/image/Id Card Designs Vector Art PNG, Vector Of Ktp Indonesian Id Card, Id Card, Vector, Indonesia PNG Image For Free Download.jpg"  />';
                                        }
                                        ?>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <div class="container position-relative">
                                <h1>Profile</h1>
                                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#profileModal">
                                    <?php
                                    if (!empty($data['profile']['image'])) { 
                                        echo '<img src="data:image/jpeg;base64,' . base64_encode($data['profile']['image']) . '" class="utama-profile-image" style="margin-left:6.5em;" alt="Profile Image" />'; // Display the profile image
                                    } else { 
                                    ?>
                                        <span id="user-section">
                                            <span id="user-avatar"><i class="bi bi-person-circle text-black" style="font-size: 120px; margin-left:0.8em;"></i></span> <!-- Display a default icon for profile image -->
                                        </span>
                                    <?php
                                    };
                                    ?>

                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <form action="<?= BASEURL ?>/Profile/editprofile" method="post">
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
                    <div class="form-group mb-4">
                        <label for="nik">NIK</label>
                        <input type="text" class="form-control mt-2" name="nik" value="<?= $data['profile']['nik'] ?>" />
                    </div>
                    <button type="submit" class="btn btn-primary" style="width: 10em; height: 3em;">
                        Kirim
                    </button>
                </form>

                <form action="<?= BASEURL ?>/Profile/newpw" method="post" class="mt-5" onsubmit="return validatePassword()">
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


<div class="modal fade" id="KTPModal" tabindex="-1" aria-labelledby="KTPModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="KTPModalLabel">Tambah/Ubah KTP</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="KTPForm" action="<?= BASEURL ?>/Profile/ktpimagebaru" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="KTP-image">Pilih Gambar</label>
                        <input type="file" class="form-control-file" id="KTP-image" name="image" accept="image/*">
                    </div>
                    <div class="form-group">
                        <img id="KTP-image-preview" src="#" alt="Preview Gambar" style="display: none;">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
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
                <form id="profileForm" action="<?= BASEURL ?>/Profile/profileimagebaru" method="post" enctype="multipart/form-data">
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