<div class='container mt-5' id="bottom-section">
    <h2>Produk Dipesan</h2>
    <ul class="row row-cols-1 row-cols-md-4" >
        <?php foreach ($data['dipesan'] as $car) : ?>
            <div class="col-lg-4 col-md-6 my-4">
                <div class="card shadow-sm">
                    <div class="card-head p-3">
                        <img src="data:image/jpeg;base64,<?= base64_encode($car['image']) ?>" class="card-img-top" alt="Product Image" height="250" />
                        <h5 class="mt-2"><?= $car['merek'] ?></h5>
                        <div>
                            <i class="fa-regular fa-user"></i>
                            <span class="me-3">5</span>
                            <i class="fa-solid fa-gas-pump"></i>
                            <span class="me-3">Gasoline</span>
                            <i class="fa-solid fa-car"></i>
                            <span><?= $car['category_names'] ?></span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span>Tarif Harian</span>
                                <p class="font-weight-bold">Rp <?= number_format($cark['price_per_day'], 2) ?></p>
                            </div>
                            <div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </ul>

    <h2>Produk Siap Dihapus</h2>
    <form action="<?= BASEURL; ?>/admin/hapus" method="post">
    <ul class="row row-cols-1 row-cols-md-4">
        <?php foreach ($data['ready'] as $car) : ?>
            <div class="col-lg-4 col-md-6 my-4">
                <div class="card shadow-sm checkbox-container">
                    <input type="checkbox" name="id[]" value="<?= $car['car_id'] ?>" class="card-checkbox">
                    <div class="card-head p-3">
                        <img src="data:image/jpeg;base64,<?= base64_encode($car['image']) ?>" class="card-img-top" alt="Product Image" height="250" />
                        <h5 class="mt-2"><?= $car['merek'] ?></h5>
                        <div>
                            <i class="fa-regular fa-user"></i>
                            <span class="me-3">5</span>
                            <i class="fa-solid fa-gas-pump"></i>
                            <span class="me-3">Gasoline</span>
                            <i class="fa-solid fa-car"></i>
                            <span><?= $car['category_names'] ?></span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span>Tarif Harian</span>
                                <p class="font-weight-bold">Rp <?= number_format($car['price_per_day'], 2) ?></p>
                            </div>
          
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </ul>
    <button type="submit" class="btn btn-danger position-fixed bottom-0 start-0">Hapus Produk Terpilih</button>
</form>
</div>