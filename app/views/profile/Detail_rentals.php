<div class="container d-flex justify-content-between align-items-center" style="margin-top:45px;">
    <div class="container mt-4"  style="min-height: 100vh;">
        <div class="row">
            <div class="col-md-8 p-4 border shadow-sm ms-1 mt-5" style="max-width: 70em; width: 97.6%;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <div class="detail-section">
                                    <h1>Detail Rental</h1>
                                    <table>
                                        <tr>
                                            <th>Rental ID</th>
                                            <td>:</td>
                                            <td><?= htmlspecialchars($data['rental']['rental_id']); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Rental Start Date</th>
                                            <td>:</td>
                                            <td><?= htmlspecialchars($data['rental']['rental_start_date']); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Rental End Date</th>
                                            <td>:</td>
                                            <td><?= htmlspecialchars($data['rental']['rental_end_date']); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Tempat Pengambilan</th>
                                            <td>:</td>
                                            <td><?= htmlspecialchars($data['rental']['tempat_pengambilan']); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Alamat Rumah</th>
                                            <td>:</td>
                                            <td><?= htmlspecialchars($data['rental']['alamat_rumah']); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Total Cost</th>
                                            <td>:</td>
                                            <td><?= htmlspecialchars(number_format($data['rental']['total_cost'], 2)); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Status Rental</th>
                                            <td>:</td>
                                            <td><?= htmlspecialchars($data['rental']['statusrental']); ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <div class="detail-section">
                                    <h3>Customer Details</h3>
                                    <?php if ($data['profile']) : ?>
                                        <table>
                                            <tr>
                                                <th>Name</th>
                                                <td>:</td>
                                                <td><?= htmlspecialchars($data['profile']['nama_depan'] . '' . $data['profile']['nama_belakang']); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Email</th>
                                                <td>:</td>
                                                <td><?= htmlspecialchars($data['profile']['email']); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Usernameame</th>
                                                <td>:</td>
                                                <td><?= htmlspecialchars($data['profile']['username']); ?></td>
                                            </tr>
                                            <tr>
                                                <th>NIK</th>
                                                <td>:</td>
                                                <td><?= htmlspecialchars($data['profile']['nik']); ?></td>
                                            </tr>
                                            <tr>
                                                <th>KTP</th>
                                                <td>:</td>
                                                <td><img src="data:image/jpeg;base64,<?= base64_encode($data['profile']['ktp']) ?>" class="<?= htmlspecialchars($data['profile']['nama_depan'] . '' . $data['profile']['nama_belakang']); ?>" style="width: 280px;" alt="Profile Image" /></td>
                                            </tr>
                                        </table>
                                    <?php else : ?>
                                        <p>No customer details available.</p>
                                    <?php endif; ?>
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
                                <?php $car = $data['car']  ?>
                                <tr>
                                    <td><img src="data:image/jpeg;base64,<?= base64_encode($car['image']) ?>" alt="<?= $data['car']['merek'] ?>" width="50"></td>
                                    <td><?= $car['merek'] ?></td>
                                    <td><?= $car['color'] ?></td>
                                    <td><?= $car['year'] ?></td>
                                    <td><?= number_format($car['price_per_day'], 2) ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>