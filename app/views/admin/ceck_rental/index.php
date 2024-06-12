<div class="container d-flex justify-content-between align-items-center" style="margin-top:60px;">
    <div class="container mt-4" style="min-height: 100vh;">
        <div class="row">
            <br>

            <div class="status-section">
                <h3>Pending Rentals</h3>
                <?php
                $pendingRentals = array_filter($data['rentals'], function ($rental) {
                    return $rental['statusrental'] === 'pending';
                });
                ?>
                <?php if (!empty($pendingRentals)) : ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Rental ID</th>
                                <th>Rental Start Date</th>
                                <th>Rental End Date</th>
                                <th>Total Cost</th>
                                <th>Status Rental</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pendingRentals as $rental) : ?>
                                <tr>
                                    <td><?= htmlspecialchars($rental['rental_id']); ?></td>
                                    <td><?= htmlspecialchars($rental['rental_start_date']); ?></td>
                                    <td><?= htmlspecialchars($rental['rental_end_date']); ?></td>
                                    <td><?= htmlspecialchars(number_format($rental['total_cost'], 2)); ?></td>
                                    <td><?= htmlspecialchars($rental['statusrental']); ?></td>
                                    <td>                                            
                                        <form action="<?= BASEURL ?>/admin/cancelRental/<?= $rental['rental_id']; ?>" method="POST">
                                            <button type="submit" class="btn btn-danger">Cancel</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else : ?>
                    <p>No pending rentals available.</p>
                <?php endif; ?>
            </div>

            <div class="status-section">
                <h3>Rentals Dibayar</h3>
                <?php
                $dibayarRentals = array_filter($data['rentals'], function ($rental) {
                    return $rental['statusrental'] === 'dibayar';
                });
                ?>
                <?php if (!empty($dibayarRentals)) : ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Rental ID</th>
                                <th>Rental Start Date</th>
                                <th>Rental End Date</th>
                                <th>Total Cost</th>
                                <th>Status Rental</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dibayarRentals as $rental) : ?>
                                <tr>
                                    <td><?= htmlspecialchars($rental['rental_id']); ?></td>
                                    <td><?= htmlspecialchars($rental['rental_start_date']); ?></td>
                                    <td><?= htmlspecialchars($rental['rental_end_date']); ?></td>
                                    <td><?= htmlspecialchars(number_format($rental['total_cost'], 2)); ?></td>
                                    <td><?= htmlspecialchars($rental['statusrental']); ?></td>
                                    <td>                                            
                                        <form action="<?= BASEURL ?>/admin/submitRental/<?= $rental['rental_id']; ?>" method="POST">
                                            <button type="submit" class="btn btn-danger">Approve</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else : ?>
                    <p>No rentals with status dibayar available.</p>
                <?php endif; ?>
            </div>

            <div class="status-section">
                <h3>Rentals Dirental</h3>
                <?php
                $direntalRentals = array_filter($data['rentals'], function ($rental) {
                    return $rental['statusrental'] === 'Sedang Dirental';
                });
                ?>
                <?php if (!empty($direntalRentals)) : ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Rental ID</th>
                                <th>Rental Start Date</th>
                                <th>Rental End Date</th>
                                <th>Total Cost</th>
                                <th>Status Rental</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($direntalRentals as $rental) : ?>
                                <tr>
                                    <td><?= htmlspecialchars($rental['rental_id']); ?></td>
                                    <td><?= htmlspecialchars($rental['rental_start_date']); ?></td>
                                    <td><?= htmlspecialchars($rental['rental_end_date']); ?></td>
                                    <td><?= htmlspecialchars(number_format($rental['total_cost'], 2)); ?></td>
                                    <td><?= htmlspecialchars($rental['statusrental']); ?></td>
                                    <td>
                                        <form action="<?= BASEURL ?>/admin/returnRental/<?= $rental['rental_id']; ?>" method="POST">
                                            <button type="submit" class="btn btn-danger">Return</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="<?= BASEURL ?>/admin/cancelRental/<?= $rental['rental_id']; ?>" method="POST">
                                            <button type="submit" class="btn btn-danger">Cancel</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else : ?>
                    <p>No rentals with status dirental available.</p>
                <?php endif; ?>
            </div>

            <div class="status-section">
                <h3>Rentals Cancelled</h3>
                <?php
                $cancelRentals = array_filter($data['rentals'], function ($rental) {
                    return $rental['statusrental'] === 'cancel';
                });
                ?>
                <?php if (!empty($cancelRentals)) : ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Rental ID</th>
                                <th>Rental Start Date</th>
                                <th>Rental End Date</th>
                                <th>Total Cost</th>
                                <th>Status Rental</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cancelRentals as $rental) : ?>
                                <tr>
                                    <td><?= htmlspecialchars($rental['rental_id']); ?></td>
                                    <td><?= htmlspecialchars($rental['rental_start_date']); ?></td>
                                    <td><?= htmlspecialchars($rental['rental_end_date']); ?></td>
                                    <td><?= htmlspecialchars(number_format($rental['total_cost'], 2)); ?></td>
                                    <td><?= htmlspecialchars($rental['statusrental']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else : ?>
                    <p>No rentals with status cancelled available.</p>
                <?php endif; ?>
            </div>

            <div class="status-section">
                <h3>Rentals Sudah Dikembalikan</h3>
                <?php
                $direntalRentals = array_filter($data['rentals'], function ($rental) {
                    return $rental['statusrental'] === 'Sudah Dikembalikan';
                });
                ?>
                <?php if (!empty($direntalRentals)) : ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Rental ID</th>
                                <th>Rental Start Date</th>
                                <th>Rental End Date</th>
                                <th>Total Cost</th>
                                <th>Status Rental</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($direntalRentals as $rental) : ?>
                                <tr>
                                    <td><?= htmlspecialchars($rental['rental_id']); ?></td>
                                    <td><?= htmlspecialchars($rental['rental_start_date']); ?></td>
                                    <td><?= htmlspecialchars($rental['rental_end_date']); ?></td>
                                    <td><?= htmlspecialchars(number_format($rental['total_cost'], 2)); ?></td>
                                    <td><?= htmlspecialchars($rental['statusrental']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else : ?>
                    <p>No rentals with status dirental available.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
