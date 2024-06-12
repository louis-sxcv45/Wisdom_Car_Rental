<div class="container p-0 mb-4 mt-4 rounded-5 ">
    <div class="container">
        <div class="product-container"style="margin-top: 150px;">
            <div class="product-card">
                <img src="data:image/jpeg;base64,<?= base64_encode($data['cars']['image']) ?>" class="product-image" />
            </div>
            <div class="product-detail-pemesanan">
                <h2><?= $data['cars']['merek'] ?></h2><br>
                Stok Tersedia : <?= $data['cars']['stock'] ?><br><br>
                <div class="harga">Rp.<?= number_format($data['cars']['price'], 2) ?></div>
                <div class="category">Kategori : <?= $data['cars']['category_names'] ?></div>
                <form action="<?= BASEURL ?>/order/index" method="post">
                    <label for="quantity">Jumlah:</label>
                    <div class="input-group">
                        <input type="number" id="quantity" name="quantity" value="1" required>
                    </div>
                    <input type="hidden" name="product_id" value="<?= $data['cars']['car_id'] ?>">
                    <input type="hidden" name="price" value="<?= $data['cars']['price_per_day'] ?>">
                    <button type="submit" class="btn-beli">pesan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="description">
    <p><?= $data['cars']['description'] ?></p>
</div>