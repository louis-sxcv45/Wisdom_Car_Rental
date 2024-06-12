<div class="container mt-5 dropdown margin-top: 20px;">
    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside" style="margin-top: 50px;">
        Dropdown form
    </button>
    <a class="btn btn-primary" style="margin-top: 50px;" href="<?= BASEURL; ?>/admin/insert_cars"> + Tambah Mobil</a>
    <?php echo $data['post']; ?>
    <form class="dropdown-menu p-4" method="post" action="<?= BASEURL; ?>/admin/cars#bottom-section">
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
    <div class="container">
        <form class="d-flex justify-content-center" role="search" action="<?= BASEURL; ?>/admin/cars#bottom-section" method="POST">
            <input class="form-control me-2 text-center shadow" type="search" placeholder="Cari Mobil" aria-label="Search" name="keyword" style="outline-color: blue; width: 300px; padding: 10px;">
            <button class="btn btn-primary" type="submit">Cari</button>
        </form>
    </div>
</div>