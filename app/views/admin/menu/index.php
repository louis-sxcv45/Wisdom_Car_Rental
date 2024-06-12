<div class="container d-flex justify-content-between align-items-center" style="margin-top:45px;">
    <div class="container mt-4" style="min-height: 100vh;">
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <br>
                    <h1 class="mt-4">Dashboard</h1>
                    <br><br>
                    <div class="row">
                        <div class="col-xl-4 col-md-6">
                            <div class="card mb-4">
                                <div class="card-body">Total Barang</div>
                                <div class="card-footer">
                                    <span><?=$data['bariscars']['total_cars']?></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6">
                            <div class="card mb-4">
                                <div class="card-body">User</div>
                                <div class="card-footer">
                                    <span><?= $data["barisusers"]['total_users']?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="card mb-4">
                                <div class="card-body">Total Orderan</div>
                                <div class="card-footer">
                                    <span><?=$data['barisrentals']['total_rentals']?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>
