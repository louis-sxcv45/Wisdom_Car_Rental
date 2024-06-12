<div class="container-fluid background vh-80">
    <div class="container">
        <div class="row">
            <div class="col-md-6 my-5">
                <h1 class="font-weight-bold text-justify text-white mb-4">
                    Nikmati hidup Anda <br />dengan kendaraan <br />kami yang nyaman.
                </h1>
                <p class="text-justify text-white fs-3 mb-3">
                    Rental Mobil Wisdom, siap melayani yang terbaik pengalaman terbaik dalam<br />
                    penyewaan kendaraan.
                </p>
                <button type="button" class="btn btn-light btn-lg mt-3" onclick="scrollToBottom()">
                    Pesan Sekarang
                </button>
            </div>
            <div class="col-md-6 my-5">
                <img src="<?= BASEURL ?>/image/obi-pixel8propix-aZKJEvydrNM-unsplash 1.png" class="card-img-top" alt="Product Image" />
            </div>
        </div>
    </div>
</div>

<!-- About Us -->
<div class="container-fluid" id="about">
    <div class="container">
        <div class="row">
            <h3 class="text-center mt-3 underline">Tentang Kami</h3>
            <div class="col-md-6 my-4">
                <img src="<?= BASEURL ?>/image/eroz-kP7iKeuSIv8-unsplash22.png" class="card-img-top" alt="Product Image" />
            </div>
            <div class="col-md-6 my-4 d-flex align-items-center">
                <p class="text-center text-md-start fs-4">
                    Kami adalah tim yang berdedikasi dan berkomitmen untuk menyediakan
                    layanan penyewaan kendaraan yang dapat diandalkan. Salah satu
                    keuntungan menyewa kendaraan dari kami adalah menawarkan harga
                    yang kompetitif dan transparan.
                </p>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5 dropdown margin-top: 20px;">
    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside" style="margin-top: 50px;">
        Categories
    </button>
    <?php echo $data['post']; ?>
    <form class="dropdown-menu p-4" method="post" action="<?= BASEURL; ?>/katalog/index#bottom-section">
        <?php foreach ($data['categories'] as $row) : ?>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="id[]" value="<?= $row['category_id']; ?>" id="dropdownCheck<?= $row['category_id']; ?>">
                <label class="form-check-label" for="dropdownCheck<?= $row['category_id']; ?>">
                    <?= $row['category_name']; ?>
                </label>
            </div>
        <?php endforeach; ?>
        <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Submit</button>
    </form>
</div>