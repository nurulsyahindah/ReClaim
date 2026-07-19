<?php
$this->layout = 'dashboard';
?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h3 class="fw-bold mb-1">

            Claim Details

        </h3>

        <small class="text-muted">

            Review the complete information about your ownership claim.

        </small>

    </div>

    <?= $this->Html->link(

        '<i class="bi bi-arrow-left"></i> Back',

        ['action' => 'myClaims'],

        [

            'class' => 'back-btn',

            'escape' => false

        ]

    ) ?>

</div>


<div class="report-detail-card">

<div class="row">

<!-- IMAGE -->

<div class="col-lg-4">

<div class="position-relative">

<img

src="<?= $this->Url->image('reports/'.$claim->report->image) ?>"

class="report-detail-image">

</div>

        <div class="evidence-box mt-4">

            <h5 class="section-title-sm">

                Reason for Claim

            </h5>

            <p class="mb-0">

                <<?= h($claim->reason) ?>

            </p>

        </div>

</div>


<!-- CLAIM INFORMATION -->

<div class="col-lg-8">

<h5 class="section-title">

Claim Information

</h5>

<div class="row">

    <!-- ROW 1 -->

    <div class="col-md-6 mb-4">

        <label class="detail-label">
            Claim ID
        </label>

        <div class="detail-value">
            #<?= h($claim->id) ?>
        </div>

    </div>

    <div class="col-md-6 mb-4">

        <label class="detail-label">
            Report Type
        </label>

        <?php

        $type = strtolower($claim->report->type);

        if ($type == "found") {

            echo '<span class="status-badge type-found">Found</span>';

        } else {

            echo '<span class="status-badge type-lost">Lost</span>';

        }

        ?>

    </div>


    <!-- ROW 2 -->

    <div class="col-md-6 mb-4">

        <label class="detail-label">
            Report Code
        </label>

        <div class="detail-value">
            <?= h($claim->report->report_code) ?>
        </div>

    </div>

    <div class="col-md-6 mb-4">

        <label class="detail-label">
            Report Status
        </label>

        <?php

        $rstatus = strtolower($claim->report->status);

        switch ($rstatus) {

            case "pending":
                echo '<span class="status-badge status-pending">Pending</span>';
            break;

            case "approved":
                echo '<span class="status-badge status-approved">Approved</span>';
            break;

            case "claimed":
                echo '<span class="status-badge status-claimed">Claimed</span>';
            break;

            case "rejected":
                echo '<span class="status-badge status-rejected">Rejected</span>';
            break;

        }

        ?>

    </div>


    <!-- ROW 3 -->

    <div class="col-md-6 mb-4">

        <label class="detail-label">
            Item Name
        </label>

        <div class="detail-value">
            <?= h($claim->report->item_name) ?>
        </div>

    </div>

    <div class="col-md-6 mb-4">

        <label class="detail-label">
            Claim Status
        </label>

        <?php

        $status = strtolower($claim->status);

        switch ($status) {

            case "pending":
                echo '<span class="status-badge status-pending">Pending</span>';
            break;

            case "approved":
                echo '<span class="status-badge status-approved">Approved</span>';
            break;

            case "rejected":
                echo '<span class="status-badge status-rejected">Rejected</span>';
            break;

        }

        ?>

    </div>


    <!-- ROW 4 -->

    <div class="col-md-6 mb-4">

        <label class="detail-label">
            Category
        </label>

        <div class="detail-value">
            <?= h($claim->report->category->category_name) ?>
        </div>

    </div>

    <div class="col-md-6 mb-4">

        <label class="detail-label">
            Contact Number
        </label>

        <div class="detail-value">
            <?= h($claim->contact_number) ?>
        </div>

    </div>


    <!-- ROW 5 -->

    <div class="col-md-6 mb-4">

        <label class="detail-label">
            Submitted On
        </label>

        <div class="detail-value">
            <?= $claim->created->format('d M Y') ?>
        </div>

    </div>

</div>


<h5 class="section-title">

Evidence Submitted

</h5>

<?php if(!empty($claim->evidence)): ?>

<div class="text-center">

<img

src="<?= $this->Url->image('evidence/'.$claim->evidence) ?>"

class="img-fluid rounded shadow"

style="max-height:350px;">

</div>

<?php else: ?>

<div class="alert alert-light border">

No supporting evidence uploaded.

</div>

<?php endif; ?>



<div class="report-divider"></div>


<h5 class="section-title">

Administrator Decision

</h5>

<?php

$status=strtolower($claim->status);

if($status=="pending"):

?>

<div class="alert alert-warning">

<i class="bi bi-hourglass-split me-2"></i>

Your ownership claim is currently under review. Please wait while the administrator verifies your submission.

</div>

<?php elseif($status=="approved"): ?>

<div class="alert alert-success">

<i class="bi bi-patch-check-fill me-2"></i>

Congratulations! Your ownership claim has been approved. Please collect your item according to the administrator's instructions.

</div>

<?php else: ?>

<div class="alert alert-danger">

<i class="bi bi-x-circle-fill me-2"></i>

Unfortunately, your ownership claim was not approved because the submitted information could not be verified.

</div>

<?php endif; ?>

</div>

</div>
