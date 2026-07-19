<?php
$this->layout = 'dashboard';
?>

<div class="row">

    <!-- PROFILE CARD -->
    <div class="col-lg-4 mb-4">

        <div class="card shadow border-0 rounded-4 h-100">

            <div class="card-body text-center">

                <div class="rounded-circle bg-primary d-inline-flex justify-content-center align-items-center mb-3"
                    style="width:110px;height:110px;">

                    <i class="bi bi-person-fill text-white" style="font-size:55px;"></i>

                </div>

                <h3 class="fw-bold mb-1">
                    <?= h($user->name) ?>
                </h3>

                <p class="text-muted text-capitalize">
                    <?= h($user->role) ?>
                </p>

                <hr>

                <div class="text-start">

                    <p class="mb-4">
                        <strong>Student ID</strong><br>
                        <?= h($user->student_id) ?>
                    </p>

                    <p class="mb-4">
                        <strong>Email</strong><br>
                        <?= h($user->email) ?>
                    </p>

                    <p class="mb-4">
                        <strong>Member Since</strong><br>
                        <?= $user->created->format('d M Y') ?>
                    </p>

                </div>

                <?= $this->Html->link(
                    '<i class="bi bi-pencil-square"></i> Edit Profile',
                    ['action' => 'edit', $user->id],
                    [
                        'class' => 'btn btn-primary w-100',
                        'escape' => false
                    ]
                ) ?>

            </div>

        </div>

    </div>

    <!-- STATISTICS -->
    <div class="col-lg-8">

        <div class="row">

            <!-- Reports -->
            <div class="col-md-6 mb-4">

                <div class="card shadow border-0 rounded-4 h-100">

                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <h6 class="text-muted">
                                    Reports Submitted
                                </h6>

                                <h2 class="fw-bold">
                                    <?= $totalReports ?>
                                </h2>

                            </div>

                            <i class="bi bi-file-earmark-text fs-1 text-primary"></i>

                        </div>

                    </div>

                </div>

            </div>

            <!-- Claims -->
            <div class="col-md-6 mb-4">

                <div class="card shadow border-0 rounded-4 h-100">

                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <h6 class="text-muted">
                                    Claims Submitted
                                </h6>

                                <h2 class="fw-bold">
                                    <?= $totalClaims ?>
                                </h2>

                            </div>

                            <i class="bi bi-check-circle fs-1 text-success"></i>

                        </div>

                    </div>

                </div>

            </div>

            <!-- Pending -->
            <div class="col-md-6 mb-4">

                <div class="card shadow border-0 rounded-4 h-100">

                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <h6 class="text-muted">
                                    Pending Reports
                                </h6>

                                <h2 class="fw-bold text-warning">
                                    <?= $pendingReports ?>
                                </h2>

                            </div>

                            <i class="bi bi-hourglass-split fs-1 text-warning"></i>

                        </div>

                    </div>

                </div>

            </div>

            <!-- Returned -->
            <div class="col-md-6 mb-4">

                <div class="card shadow border-0 rounded-4 h-100">

                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <h6 class="text-muted">
                                    Returned Items
                                </h6>

                                <h2 class="fw-bold text-success">
                                    <?= $returnedItems ?>
                                </h2>

                            </div>

                            <i class="bi bi-box-seam fs-1 text-info"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>