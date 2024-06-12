<div class="container d-flex justify-content-between align-items-center" style="margin-top:45px;">
    <div class="container mt-4 vh-auto">
        <div class="row">
            <form id="addressForm" method="POST" action="<?= BASEURL; ?>/payment/intodb" enctype="multipart/form-data">
                <h2>Format Pemesanan</h2>
                <div class="container-flex">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label for="firstName">Nama Depan</label>
                                        <input type="text" class="form-control mt-2" name="nama_depan" value="<?= $data['profile']['nama_depan'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label for="lastName">Nama Belakang</label>
                                        <input type="text" class="form-control mt-2" name="nama_belakang" value="<?= $data['profile']['nama_belakang'] ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control mt-2" name="email" value="<?= $data['profile']['email'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label for="phoneNumber">Phone Number</label>
                                        <input type="text" class="form-control mt-2" name="phone_number" value="<?= $data['profile']['phone_number'] ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="nik">NIK</label>
                                <input type="text" class="form-control mt-2" name="nik" value="<?= $data['profile']['nik'] ?>" readonly>
                            </div>
                            <div class="form-group mb-4">
                                <label for="address">Alamat</label>
                                <input type="text" class="form-control" id="address" name="address" value="<?= $data['post']['address']; ?>" readonly>
                            </div>
                            <div class="form-group mb-4">
                                <label for="pickup-location">Lokasi Pengambilan</label>
                                <input type="text" class="form-control" id="pickup-location" name="pickup-location" value="<?= $data['post']['pickup-location']; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <center>
                                    <div class="form-group">
                                        <label for="image">Gambar KTP :</label>
                                        <img src="data:image/jpeg;base64,<?= base64_encode($data['profile']['ktp']) ?>" class="utama-profile-image" style="width: 600px;" alt="Profile Image" />
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
                    <hr>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label for="pickup-date">Tanggal Pengambilan</label>
                                <input type="date" class="form-control" id="pickup-date" name="pickup-date" value="<?= $data['post']['pickup-date']; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label for="return-time">Waktu Pengembalian</label>
                                <input type="time" class="form-control" id="return-time" name="return-time" value="<?= $data['post']['return-time']; ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label for="return-date">Tanggal Pengembalian</label>
                                <input type="date" class="form-control" id="return-date" name="return-date" value="<?= $data['post']['return-date']; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label for="pickup-time">Waktu Pengambilan</label>
                                <input type="time" class="form-control" id="pickup-time" name="pickup-time" value="<?= $data['post']['pickup-time']; ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label for="subtotal">Subtotal</label>
                                <input type="text" class="form-control" id="subtotal" name="subtotal" value="<?= number_format($data['totalsub'], 2) ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <span>Asuransi</span>
                                <input type="text" class="form-control" id="Asuransi" name="Asuransi" value="<?= number_format($data['asuransi'], 2) ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <span>Pajak</span>
                                <input type="text" class="form-control" id="pajak" name="pajak" value="<?= number_format($data['pajak'], 2) ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <span>Total</span>
                                <input type="text" class="form-control" id="total" name="total" value="<?= number_format($data['total'], 2) ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-2" id="bank-selection">
                        <label for="bank-list">Pilih Bank</label>
                        <select class="form-control" id="bank-list" name="bank-list" required>
                            <option value="">pilih bank</option>
                            <option value="BCA">BCA</option>
                            <option value="Mandiri">Mandiri</option>
                            <option value="BNI">BNI</option>
                            <option value="BRI">BRI</option>
                        </select>
                        <div class="invalid-feedback" style="display: none;">Pilih salah satu bank.</div>
                    </div>
                </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
</div>