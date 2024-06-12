<div class="container d-flex justify-content-between align-items-center" style="margin-top:45px;">
    <div class="container mt-4" style="min-height: 100vh;">
        <div class="row">
    
            <div class="col-md-3">
                <h4 class="mb-1">Kelola Akun</h4>
                <ul class="list-group border-0">
                    <li class="list-group-item border-0">
                        <a href="<?= BASEURL ?>/Profile" class="text-secondary text-decoration-none fs-5 fw-medium">Profil</a>
                    </li>
                    <h4>Pesanan</h4>
                    <li class="list-group-item border-0">
                        <a href="<?= BASEURL ?>/Profile/Tagihan" class="text-secondary text-decoration-none fs-5 fw-medium">Tagihan</a>
                    </li>
                    <li class="list-group-item border-0">
                        <a href="<?= BASEURL ?>/Profile/Sedangberlangsung" class="text-decoration-none fs-5 fw-medium active-profile">Sedang Berlangsung</a>
                    </li>
                    <li class="list-group-item border-0">
                        <a href="<?= BASEURL ?>/Profile/Dibatalkan" class="text-secondary text-decoration-none fs-5 fw-medium">Pembatalan</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-8 p-4 border shadow-sm ms-1 mt-5" style="max-width: 50em; width: 97.6%;">
                <div class="header">
                </div>
                <div class="container">
                    <h1>Tagihan</h1>
                    <?php if (!empty($data['tagihan'])) : ?>
                        <table>
                            <thead>
                                <tr>
                                    <th>Tempat Pengambilan</th>
                                    <th>Alamat Rumah</th>
                                    <th>Total Cost</th>
                                    <th>Status Rental</th>
                                    <th>Nama Penerima</th>
                                    <th>Pembayaran</th>
                                </tr>
                            </thead>
                            <tbody>
                    <?php foreach ($data['tagihan'] as $rental) : ?>
                        <tr>
                            <td><?= htmlspecialchars($rental['tempat_pengambilan']); ?></td>
                            <td><?= htmlspecialchars($rental['alamat_rumah']); ?></td>
                            <td><?= htmlspecialchars(number_format($rental['total_cost'], 2)); ?></td>
                            <td><?= htmlspecialchars($rental['statusrental']); ?></td>
                            <td><?= htmlspecialchars($rental['nama_penerima']); ?></td>
                            <td>
                            <form action="<?= BASEURL; ?>/Profile/detail" method="post" id="orderForm">
                                    <input type="hidden" name="rental_id" value="<?= $rental['rental_id'] ?>">
                            <button type="submit" class="btn btn-primary">Detail</button>
                            </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>Tidak ada tagihan.</p>
        <?php endif; ?>
    </div>
            </div>
        </div>
    </div>
</div>