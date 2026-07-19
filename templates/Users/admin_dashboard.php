<div class="d-flex justify-content-between align-items-center mb-4">

    <!-- Left -->
    <div>

        <h2 class="fw-bold mb-1">
            Welcome back, <?= h($user['name']) ?>.

        </h2>

        <p class="text-muted mb-0">
            Manage lost and found reports, track claim requests, and monitor item recovery activities in one place.
        </p>

    </div>

    <!-- Right -->
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

        </div>

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

            <div class="notification-actions mt-3">

        <button
            class="notification-action-btn"
            id="markAllRead">

            <i class="bi bi-check2-all me-1"></i>

            Mark all

        </button>

        <button
            class="notification-action-btn danger"
            id="clearAllNotifications">

            <i class="bi bi-trash me-1"></i>

            Clear

        </button>

            </div>

    </div>

</div>

<div class="notification-tabs">

    <button class="tab-btn active" data-filter="all">

        All

    </button>

    <button class="tab-btn" data-filter="user">

        Users

    </button>

    <button class="tab-btn" data-filter="found_report">

        Found

    </button>

    <button class="tab-btn" data-filter="lost_report">

        Lost

    </button>

    <button class="tab-btn" data-filter="claim">

        Claims

    </button>

</div>

<div class="notification-body">

<?php if(count($notifications)): ?>

    <?php foreach($notifications as $notification): ?>

<div
class="notification-item <?= $notification->is_read=='No' ? 'notification-unread' : '' ?>"
data-id="<?= $notification->id ?>"
data-category="<?= $notification->category ?>"
style="cursor:pointer;">

        <div class="notification-icon notification-<?= $notification->category ?>">

            <?php

            switch($notification->category){

                case 'user':
                    echo '<i class="bi bi-person-fill"></i>';
                    break;

                case 'lost_report':
                    echo '<i class="bi bi-search"></i>';
                    break;

                case 'found_report':
                    echo '<i class="bi bi-box-seam"></i>';
                    break;

                case 'claim':
                    echo '<i class="bi bi-patch-check-fill"></i>';
                    break;

            }

            ?>

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

        <?php if($notification->is_read == 'No'): ?>

        <span class="unread-dot"></span>

        <?php endif; ?>

    </div>

    <small class="text-secondary">

        <?php

        $time = $notification->created;

        $now = new DateTime();

        $diff = $now->diff($time);

        if($diff->d == 0){

            if($diff->h == 0){

                echo $diff->i == 0 ? 'Just now' : $diff->i.' mins ago';

            }else{

                echo $diff->h.' hours ago';

            }

        }elseif($diff->d == 1){

            echo 'Yesterday';

        }else{

            echo $diff->d.' days ago';

        }

        ?>

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

        No new activity at the moment.

        <br>

        New reports, claims and user registrations

        <br>

        will appear here automatically.

    </p>

</div>

<?php endif; ?>

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

                    Administrator

                </small>

            </div>

        </div>

    </div>

</div>

<div class="row g-4 mb-3">

    <!-- TOTAL REPORTS -->

    <div class="col-lg-3 col-md-6">

        <div class="card summary-card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-muted">
                            Total Reports
                        </small>

                        <h2 class="fw-bold mt-2">

                            <?= $totalReports ?>

                        </h2>

                    </div>

                    <div class="summary-icon reports-icon">

                        <i class="bi bi-file-earmark-text"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- PENDING REPORTS -->

    <div class="col-lg-3 col-md-6">

        <div class="card summary-card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-muted">

                            Pending Reports

                        </small>

                        <h2 class="fw-bold mt-2 text-warning">

                            <?= $pendingReports ?>

                        </h2>

                    </div>

                    <div class="summary-icon pending-icon">

                        <i class="bi bi-hourglass-split"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- PENDING CLAIMS -->

    <div class="col-lg-3 col-md-6">

        <div class="card summary-card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-muted">

                            Pending Claims

                        </small>

                        <h2 class="fw-bold mt-2 text-success">

                            <?= $pendingClaims ?>

                        </h2>

                    </div>

                    <div class="summary-icon claim-icon">

                        <i class="bi bi-check-circle"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- USERS -->

    <div class="col-lg-3 col-md-6">

        <div class="card summary-card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-muted">

                            Registered Users

                        </small>

                        <h2 class="fw-bold mt-2 text-info">

                            <?= $totalUsers ?>

                        </h2>

                    </div>

                    <div class="summary-icon user-icon">

                        <i class="bi bi-people-fill"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="card table-card mt-3">

<div class="card-header d-flex align-items-center fw-bold">

    <i class="bi bi-pie-chart-fill me-2" style="color:#6D4AFF;"></i>

    Report Status Overview

</div>

    <div class="card-body">

        <div class="row">

            <!-- LEFT : CHART -->
            <div class="col-lg-5">

                <div id="reportChart"></div>

            </div>

            <!-- RIGHT : PENDING -->
            <div class="col-lg-7">

    <!-- =========================
         Pending Reports
    ========================== -->

    <div class="d-flex justify-content-between align-items-center mb-2">

        <h6 class="fw-bold mb-0">

            Latest Pending Reports

        </h6>

        <a href="<?= $this->Url->build([
            'controller'=>'Reports',
            'action'=>'adminIndex'
        ]) ?>"
        class="btn btn-sm view-btn">

            View All

        </a>

    </div>

    <?php foreach($latestPendingReports as $report): ?>

    <div class="pending-item">

        <img
        src="<?= $this->Url->image('reports/'.$report->image) ?>"
        class="pending-image">

        <div class="flex-grow-1">

            <div class="pending-title">

                <?= h($report->item_name) ?>

            </div>

            <div class="pending-user">

                Reported by

                <strong><?= h($report->user->name) ?></strong>

            </div>

            <div class="pending-date">

                <?= $report->created->format('d M Y') ?>

            </div>

        </div>
        
        <span class="status-badge status-pending">

            Pending

        </span>

    </div>

    <?php endforeach; ?>

    <hr class="my-3">

    <!-- =========================
         Pending Claims
    ========================== -->

    <div class="d-flex justify-content-between align-items-center mb-2">

        <h6 class="fw-bold mb-0">

            Latest Pending Claims

        </h6>

        <a href="<?= $this->Url->build([
            'controller'=>'Claims',
            'action'=>'adminIndex'
        ]) ?>"
        class="btn btn-sm view-btn">

            View All

        </a>

    </div>

    <?php foreach($latestPendingClaims as $claim): ?>

    <div class="pending-item">

        <img
        src="<?= $this->Url->image('reports/'.$claim->report->image) ?>"
        class="pending-image">

        <div class="flex-grow-1">

            <div class="pending-title">

                <?= h($claim->report->item_name) ?>

            </div>

            <div class="pending-user">

                Claimed by

                <strong><?= h($claim->user->name) ?></strong>

            </div>

            <div class="pending-date">

                <?= $claim->created->format('d M Y') ?>

            </div>

        </div>

    <span class="status-badge status-pending">

        Pending

    </span>

    </div>

<?php endforeach; ?>

</div> <!-- col-lg-7 -->

</div> <!-- row -->

</div> <!-- card-body -->

</div> <!-- table-card -->


<?php $this->start('script'); ?>

<script>

var options = {

    series: [<?= $approvedReports ?>,<?= $rejectedReports ?>,<?= $pendingReports ?>,<?= $claimedReports ?>],

    chart:{type:'donut',height:350},

    labels:['Approved','Rejected','Pending','Claimed'],

    colors:['#7C5CFA','#FF5E78','#FDBA2D','#5B8CFF'],

    legend:{position:'bottom'},

    dataLabels:{enabled:true},

    responsive:[{breakpoint:480,options:{chart:{width:300}}}]

};

var chart=new ApexCharts(document.querySelector("#reportChart"),options

);

chart.render();

const overlay=document.createElement("div");

overlay.id="notificationBackground";

document.body.appendChild(overlay);

const bell=document.getElementById("notificationToggle");

const dropdown=document.getElementById("notificationDropdown");

dropdown.onclick=function(e){

e.stopPropagation();

};

bell.onclick=function(e){

e.stopPropagation();

if(dropdown.style.display==="block"){

dropdown.style.display="none";

overlay.classList.remove("show");

}else{

dropdown.style.display="block";

overlay.classList.add("show");

}

};

document.addEventListener("click",function(e){

if(

!dropdown.contains(e.target)

&&

!bell.contains(e.target)

){

dropdown.style.display="none";

overlay.classList.remove("show");

}

});


const tabs=document.querySelectorAll(".tab-btn");

const items=document.querySelectorAll(".notification-item");

tabs.forEach(tab=>{

tab.addEventListener("click",function(){

tabs.forEach(t=>t.classList.remove("active"));

this.classList.add("active");

const filter=this.dataset.filter;

items.forEach(item=>{

if(filter==="all"){

item.style.display="flex";

}

else if(item.dataset.category===filter){

item.style.display="flex";

}

else{

item.style.display="none";

}

});

});

});

// ==========================
// MARK AS READ
// ==========================

const csrf=document.querySelector('meta[name="csrfToken"]').content;

document.querySelectorAll(".notification-item").forEach(item=>{

item.addEventListener("click",function(){

const card=this;

const id=card.dataset.id;

fetch("<?= $this->Url->build([
'controller'=>'AdminNotifications',
'action'=>'markRead'
]) ?>/"+id,{

method:"POST",

headers:{

"X-CSRF-Token":csrf,

"X-Requested-With":"XMLHttpRequest"

}

})

.then(r=>r.json())

.then(data=>{

if(data.success){

card.classList.remove("notification-unread");

const dot=card.querySelector(".unread-dot");

if(dot){

dot.remove();

}

const badge=document.querySelector(".notification-count");

if(badge){

if(data.count>0){

badge.innerHTML=data.count;

}else{

badge.remove();

}

}

}

});

});

});

// =======================
// MARK ALL AS READ
// =======================

const markAll=document.getElementById("markAllRead");

if(markAll){

markAll.onclick=function(){

fetch("<?= $this->Url->build([
'controller'=>'AdminNotifications',
'action'=>'markAllRead'
]) ?>",{

method:"POST",

headers:{
"X-Requested-With":"XMLHttpRequest"
}

})

.then(res=>res.json())

.then(data=>{

if(data.success){

document.querySelectorAll(".notification-item").forEach(function(item){

item.classList.remove("notification-unread");

});

document.querySelectorAll(".unread-dot").forEach(function(dot){

dot.remove();

});

document.querySelector(".notification-count")?.remove();

const subtitle=document.querySelector(".notification-subtitle");

if(subtitle){

subtitle.innerHTML="0 unread notifications";

}

}

});

}

}

// =======================
// CLEAR ALL
// =======================

const clearBtn=document.getElementById("clearAllNotifications");

if(clearBtn){

clearBtn.onclick=function(){

if(!confirm("Delete all notifications?")){

return;

}

fetch("<?= $this->Url->build([
'controller'=>'AdminNotifications',
'action'=>'clearAll'
]) ?>",{

method:"POST",

headers:{
"X-Requested-With":"XMLHttpRequest"
}

})

.then(res=>res.json())

.then(data=>{

if(data.success){

const body=document.querySelector(".notification-body");

body.innerHTML=`

<div class="notification-empty">

<div class="empty-icon">

<i class="bi bi-bell"></i>

</div>

<h5>You're all caught up</h5>

<p>

No new activity at the moment.<br>

New reports, claims and user registrations<br>

will appear here automatically.

</p>

</div>

`;

document.querySelector(".notification-count")?.remove();

const subtitle=document.querySelector(".notification-subtitle");

if(subtitle){

subtitle.innerHTML="0 unread notifications";

}

}

});

}

}

</script>

<?php $this->end(); ?>