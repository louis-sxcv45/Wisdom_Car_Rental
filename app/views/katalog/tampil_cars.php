<div class="container-fluid" id="bottom-section">
    <div class="container">
        <div class="row">
            <h3 class="text-center my-3 underline underline-card">Kendaraan Unggulan Kami</h3>
            <div class="container">
                <form class="d-flex justify-content-center" role="search" action="<?= BASEURL; ?>/katalog/index#bottom-section" method="POST">
                    <input class="form-control me-2 text-center shadow" type="search" placeholder="Cari Mobil" aria-label="Search" name="keyword" style="outline-color: blue; width: 300px; padding: 10px;">
                    <button class="btn btn-primary" type="submit">Cari</button>
                </form>
            </div>
            <?php foreach ($data['cars'] as $produk) : ?>
                <div class="col-lg-4 col-md-6 my-4">
                    <div class="card shadow-sm">
                        <div class="card-head p-3">
                            <img src="data:image/jpeg;base64,<?= base64_encode($produk['image']) ?>" class="card-img-top" alt="Product Image" height="250" />
                            <h5 class="mt-2"><?= $produk['merek'] ?></h5>
                            <div>
                                <i class="fa-regular fa-user"></i>
                                <span class="me-3">5</span>
                                <i class="fa-solid fa-gas-pump"></i>
                                <span class="me-3">Gasoline</span>
                                <i class="fa-solid fa-car"></i>
                                <span><?= $produk['category_names'] ?></span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <span>Tarif Harian</span>
                                    <p class="font-weight-bold">Rp <?= number_format($produk['price_per_day'], 2) ?></p>
                                </div>
                                <div>
                                    <form action="<?= BASEURL; ?>/order" method="post" id="orderForm">
                                        <input type="hidden" name="car_id" value="<?= $produk['car_id'] ?>">
                                        <button type="submit" class="btn btn-primary" <?= $produk['isRented'] ? 'disabled' : '' ?>>Pesan Sekarang</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
