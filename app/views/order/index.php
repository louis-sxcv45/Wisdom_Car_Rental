<div class="container d-flex justify-content-between align-items-center" style="margin-top:45px;">
    <div class="container mt-4 vh-auto">
    <h2>Format Pemesanan</h2>
        <div class="row">
            <div class="container-flex">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label for="firstName">Nama Depan</label>
                            <input type="text" class="form-control mt-2" name="nama_depan" value="<?= $data['profile']['nama_depan'] ?>" readonly>
                        </div>
                        <div class="form-group mb-4">
                            <label for="lastName">Nama Belakang</label>
                            <input type="text" class="form-control mt-2" name="nama_belakang" value="<?= $data['profile']['nama_belakang'] ?>" readonly>
                        </div>
                        <div class="form-group mb-4">
                            <label for="email">Email</label>
                            <input type="email" class="form-control mt-2" name="email" value="<?= $data['profile']['email'] ?>" readonly>
                        </div>
                        <div class="form-group mb-4">
                            <label for="phoneNumber">Phone Number</label>
                            <input type="text" class="form-control mt-2" name="phone_number" value="<?= $data['profile']['phone_number'] ?>" readonly>
                        </div>
                        <div class="form-group mb-4">
                            <label for="nik">NIK</label>
                            <input type="text" class="form-control mt-2" name="nik" value="<?= $data['profile']['nik'] ?>" readonly>
                        </div>
                        <form id="addressForm" method="POST" action="<?= BASEURL; ?>/payment" enctype="multipart/form-data">
                            <div class="form-group mb-4">
                                <label for="address">Alamat</label>
                                <input type="text" class="form-control" id="address" name="address" required>
                            </div>
                            <div class="form-group mb-4">
                                <label for="pickup-location">Lokasi Pengambilan</label>
                                <input type="text" class="form-control" id="pickup-location" name="pickup-location" required>
                            </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <center>
                                <div class="form-group">
                                    <label for="image">Gambar KTP :</label>
                                    <img src="data:image/jpeg;base64,<?= base64_encode($data['profile']['ktp']) ?>" class="ktp" style="width: 600px;" alt="Profile Image" />
                                </div>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Warna</th>
                            <th>Tahun</th>
                            <th>Harga/day</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['cars'] as $car) : ?>
                            <tr>
                                <td><img src="data:image/jpeg;base64,<?= base64_encode($car['image']) ?>" alt="<?= $data['cars']['merek'] ?>" width="50"></td>
                                <td><?= $car['merek'] ?></td>
                                <td><?= $car['color'] ?></td>
                                <td><?= $car['year'] ?></td>
                                <td><?= number_format($car['price_per_day'], 2) ?></td>
                            </tr>
                            <input type="hidden" name="car_id" value="<?= $car['car_id'] ?>">
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <hr>
            <div class="container">
                <div class="form-group">
                    <label for="pickup-date">Tanggal Pengambilan</label>
                    <input type="date" class="form-control" id="pickup-date" name="pickup-date" required>
                </div>
                <div class="form-group">
                    <label for="return-time">Waktu Pengembalian</label>
                    <input type="time" class="form-control" id="return-time" name="return-time" required>
                </div>
                <div class="form-group">
                    <label for="return-date">Tanggal Pengembalian</label>
                    <input type="date" class="form-control" id="return-date" name="return-date" required>
                </div>
                <div class="form-group">
                    <label for="pickup-time">Waktu Pengambilan</label>
                    <input type="time" class="form-control" id="pickup-time" name="pickup-time" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>