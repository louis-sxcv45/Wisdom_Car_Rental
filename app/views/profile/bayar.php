<div class="container d-flex justify-content-between align-items-center" style="margin-top:45px;">
    <div class="container mt-4"  style="min-height: 100vh;">
        <div class="row">
            <div class="col-md-8 p-4 border shadow-sm ms-1 mt-5" style="max-width: 90em; width: 100%;">
                <div class="container">
                    <h1>Pembayaran</h1>
                    <div class="detail-section">
                        <h3>Rental Details</h3>
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
                    <div class="qr-code">
                        <h3>Scan QR Code to Pay</h3>
                        catatan karena blum ada api untuk pembayaran melakukan sekenarion pembayaran manual
                        <form action="<?= BASEURL; ?>/Profile/gantistatus" method="post" id="orderForm">
                            <input type="hidden" name="rental_id" value="<?= $rental['rental_id'] ?>">
                        <button type="submit" class="btn btn-primary">Bayar</button>
                        </form>
                            <img src="<?= BASEURL ?>/image/qr.jpg" alt="QR Code Bank Transfer">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
