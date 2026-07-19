<?php
$this->layout = 'dashboard';
?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <!-- LEFT -->

    <div>

        <h4 class="fw-bold mb-1">

            Welcome back, <?= h($user['name']) ?>.

        </h4>

        <p class="text-muted mb-0">
        
            Stay connected with the latest lost and found reports and track your submissions.

        </p>

    </div>

    <!-- RIGHT -->

    <div class="d-flex align-items-center gap-3">

        <!-- Notification -->

<div class="d-flex align-items-center gap-3">

    <!-- Notification -->

    <div class="notification-btn position-relative">

        <button
            class="btn btn-light shadow-sm rounded-circle"
            id="notificationToggle">

            <i class="bi bi-bell-fill"></i>

        </button>

        <?php if($notificationCount > 0): ?>

        <span class="notification-count">

            <?= $notificationCount ?>

        </span>

        <?php endif; ?>

        <!-- Notification Dropdown -->

        <div
        class="notification-dropdown shadow"
        id="notificationDropdown">

            <div class="notification-header">

                <div class="d-flex justify-content-between align-items-start">

                    <div>

                        <h5 class="fw-bold mb-1">

                            Notifications

                        </h5>

                        <small class="notification-subtitle">

                            <?= $notificationCount ?> unread notifications

                        </small>

                    </div>

                </div>

            </div>

            <div class="notification-body">

                <?php if(count($notifications)): ?>

                    <?php foreach($notifications as $notification): ?>

                    <div
                    class="notification-item <?= $notification->is_read == 0 ? 'notification-unread' : '' ?>"
                    data-id="<?= $notification->id ?>">

                        <div class="notification-icon notification-user">

                            <i class="bi bi-bell-fill"></i>

                        </div>

                        <div class="flex-grow-1">

                            <div class="d-flex justify-content-between align-items-start">

                                <div>

                                    <div class="fw-semibold">

                                        <?= h($notification->title) ?>

                                    </div>

                                    <small class="text-muted d-block">

                                        <?= h($notification->message) ?>

                                    </small>

                                </div>

                                <?php if($notification->is_read == 0): ?>

                                <span class="unread-dot"></span>

                                <?php endif; ?>

                            </div>

                            <small class="text-secondary">

                                <?= $notification->created->timeAgoInWords() ?>

                            </small>

                        </div>

                    </div>

                    <?php endforeach; ?>

                <?php else: ?>

                <div class="notification-empty">

                    <div class="empty-icon">

                        <i class="bi bi-bell"></i>

                    </div>

                    <h5>

                        You're all caught up

                    </h5>

                    <p>

                        No new notifications at the moment.

                    </p>

                </div>

                <?php endif; ?>

            </div>

        </div>

    </div>

    <!-- Profile -->

    <div class="admin-profile">

        <div class="admin-avatar">

            <?= strtoupper(substr($user['name'],0,1)) ?>

        </div>

        <div>

            <div class="fw-semibold">

                <?= h($user['name']) ?>

            </div>

            <small class="text-muted">

                Student

            </small>

        </div>

    </div>

    </div>

</div>

</div>

<!-- ===========================================
SUMMARY CARDS
=========================================== -->

<div class="row g-4 mb-3">

    <div class="col-lg-3 col-md-6">

        <div class="card summary-card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <h3 class="text-muted">
                            Found Items
                        </h3>

                        <h2 class="fw-bold">
                            <?= $totalFound ?>
                        </h2>

                        <small class="text-success">
                            Available to claim
                        </small>

                    </div>

                    <div class="summary-icon found-icon">

                        <i class="bi bi-search-heart-fill"></i>

                    </div>

                 </div>
                    
            </div>

        </div>

    </div>

    <div class="col-lg-3 cold-md-6">

        <div class="card summary-card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                <div>

                    <h3 class="text-muted">
                        Lost Reports
                    </h3>

                    <h2 class="fw-bold">
                        <?= $totalLost ?>
                    </h2>

                    <small class="text-danger">
                        Looking for items
                    </small>

                </div>

                <div class="summary-icon lost-icon">

                    <i class="bi bi-exclamation-diamond-fill"></i>

                </div>

                </div>   

            </div>

        </div>

    </div>

    <div class="col-lg-3 col-md-6">

        <div class="card summary-card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                <div>

                    <h3 class="text-muted">
                        Pending Reports
                    </h3>

                    <h2 class="fw-bold">
                        <?= $pendingReports ?>
                    </h2>

                    <small class="text-warning">
                        Waiting for admin approval
                    </small>

                </div>

                <div class="summary-icon pending-icon">

                    <i class="bi bi-hourglass-split"></i>

                </div>

                </div>

            </div>

        </div>

    </div>

    <div class="col-lg-3 col-md-6">

        <div class="card summary-card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                <div>

                    <h3 class="text-muted">
                        Approved Reports
                    </h3>

                    <h2 class="fw-bold">
                        <?= $approvedReports ?>
                    </h2>

                    <small class="text-primary">
                        Approved by administrator
                    </small>

                </div>

                <div class="summary-icon return-icon">

                    <i class="bi bi-patch-check-fill"></i>

                </div>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="card table-card mt-4">

    <div class="card-body">

        <div class="row">

            <!-- ================= LEFT ================= -->

            <div class="col-lg-8">

                <div class="d-flex justify-content-between align-items-center mb-3">

                    <div>

                        <h5 class="fw-bold mb-1">
                            Latest Reports
                        </h5>

                        <small class="text-muted">
                            Recently submitted reports
                        </small>

                    </div>

                </div>

                <div class="report-box">

                    <div class="swiper reportSwiper">

                        <div class="swiper-wrapper">

                            <?php foreach ($latestReports as $report): ?>

                                <div class="swiper-slide">

                                    <div class="report-item">

<?php if (!empty($report->image)): ?>

<img
    src="<?= $this->Url->image('reports/'.$report->image) ?>"
    class="report-img">

<?php else: ?>

<img
    src="<?= $this->Url->image('dashboard/no-image.jpg') ?>"
    class="report-img">

<?php endif; ?>

                                        <div class="report-info">

                                            <span class="badge rounded-pill <?= strtolower($report->type) == 'found' ? 'bg-success' : 'bg-danger' ?>">

                                                <?= strtoupper($report->type) ?> ITEM

                                            </span>

                                            <h2>

                                                <?= h($report->item_name) ?>

                                            </h2>

                                            <p>

                                                <i class="bi bi-clock-history me-2"></i>

                                                <?= $report->created->timeAgoInWords() ?>

                                            </p>

                                            <p>

                                                <i class="bi bi-person-circle me-2"></i>

                                                Reported by
                                                <strong><?= h($report->user->name) ?></strong>

                                                </p>

                                            <div class="mt-3 d-flex gap-2">

                                                <?= $this->Html->link(
                                                    'Browse Reports',
                                                    [
                                                        'controller' => 'Reports',
                                                        'action' => 'index'
                                                    ],
                                                    [
                                                        'class' => 'btn btn-primary rounded-pill'
                                                    ]
                                                ) ?>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            <?php endforeach; ?>

                        </div>

                        <div class="slider-bottom">

                            <div class="swiper-pagination"></div>

                                <div class="slider-count">

                                    <span class="current-slide">01</span>

                                        /

                                    <span class="total-slide">

                                        <?= count($latestReports) ?>

                                    </span>

                                </div>

                            </div>

                        

                    </div>

                </div>

            </div>

<!-- ================= RIGHT ================= -->

<div class="col-lg-4">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <div>

            <h5 class="fw-bold mb-1">
                Recent Activity
            </h5>

            <small class="text-muted">
                Your latest activities
            </small>

        </div>

    </div>

    <div class="activity-box">

        <?php if (empty($recentActivities)): ?>

            <div class="empty-activity">

                <i class="bi bi-clock-history"></i>

                <h6>No recent activity</h6>

                <p>
                    Your reports and claims will appear here.
                </p>

            </div>

        <?php else: ?>

            <?php foreach ($recentActivities as $activity): ?>

                <div class="activity-item">

                    <div class="activity-icon <?= $activity['status'] ?>">

                        <?php

                        switch ($activity['status']) {

                            case 'approved':
                                echo '<i class="bi bi-check2-circle"></i>';
                                break;

                            case 'rejected':
                                echo '<i class="bi bi-x-circle"></i>';
                                break;

                            case 'pending':
                                echo '<i class="bi bi-hourglass-split"></i>';
                                break;

                            case 'claimed':
                                echo '<i class="bi bi-patch-check"></i>';
                                break;

                            default:
                                echo '<i class="bi bi-upload"></i>';

                        }

                        ?>

                    </div>

                    <div class="activity-content">

                        <h6>
                            <?= h($activity['title']) ?>
                        </h6>

                        <p>
                            <?= h($activity['item']) ?>
                        </p>

                        <small>
                            <?= $activity['created']->timeAgoInWords() ?>
                        </small>

                    </div>

                </div>

            <?php endforeach; ?>

        <?php endif; ?>

    </div>

</div>

<?php $this->start('script'); ?>

<script>

new Swiper(".reportSwiper",{

loop:true,

speed:900,

autoplay:{

delay:4500,

disableOnInteraction:false

},

pagination:{

el:".reportSwiper .swiper-pagination",

clickable:true

},

on:{

init:function(){

document.querySelector(".current-slide").textContent="01";

},

slideChange:function(){

let index=this.realIndex+1;

document.querySelector(".current-slide").textContent=
String(index).padStart(2,"0");

}

}

});

const notificationToggle=document.getElementById("notificationToggle");

const notificationDropdown=document.getElementById("notificationDropdown");

notificationToggle.addEventListener("click",function(e){

e.stopPropagation();

if(notificationDropdown.style.display==="block"){

notificationDropdown.style.display="none";

}else{

notificationDropdown.style.display="block";

}

});

document.addEventListener("click",function(){

notificationDropdown.style.display="none";

});

notificationDropdown.addEventListener("click",function(e){

e.stopPropagation();

});

</script>

<?php $this->end(); ?>