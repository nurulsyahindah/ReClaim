<?php
$this->layout = 'dashboard';
?>

<div class="card shadow border-0">

    <div class="card-header bg-white">

        <h3 class="mb-1">
            Notifications
        </h3>

        <small class="text-muted">
            Stay updated with your latest activities.
        </small>

    </div>

    <div class="card-body p-0">

        <?php if(!$notifications->isEmpty()): ?>

            <?php foreach($notifications as $notification): ?>

                <div class="border-bottom p-4">

                    <div class="d-flex justify-content-between">

                        <div>

                            <h6 class="fw-bold">

                                <?= h($notification->title) ?>

                            </h6>

                            <p class="text-muted mb-0">

                                <?= h($notification->message) ?>

                            </p>

                        </div>

                        <small class="text-muted">

                            <?= $notification->created->format('d M Y') ?>

                        </small>

                    </div>

                </div>

            <?php endforeach; ?>

        <?php else: ?>

            <div class="text-center p-5">

                <i class="bi bi-bell fs-1 text-muted"></i>

                <h5 class="mt-3">
                    No Notifications
                </h5>

                <p class="text-muted">
                    You don't have any notifications yet.
                </p>

            </div>

        <?php endif; ?>

    </div>

</div>