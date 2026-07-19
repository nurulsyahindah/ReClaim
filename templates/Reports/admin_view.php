<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h3 class="fw-bold mb-1">
            Report Details
        </h3>

        <small class="text-muted">
            Review submitted lost and found report information.
        </small>

    </div>

    <?= $this->Html->link(

        '<i class="bi bi-arrow-left"></i> Back',

        ['action'=>'adminIndex'],

        [

            'class'=>'back-btn',

            'escape'=>false

        ]

    ) ?>

</div>


<div class="report-detail-card">

<div class="row">

    <!-- IMAGE -->

    <div class="col-lg-4">

        <div class="position-relative">

            <img
                src="<?= $this->Url->image('reports/'.$report->image) ?>"
                class="report-detail-image">

            <?php if(strtolower($report->type)=="lost"): ?>

                <span class="status-badge type-lost image-badge2">
                    Lost
                </span>

            <?php else: ?>

                <span class="status-badge type-found image-badge2">
                    Found
                </span>

            <?php endif; ?>

        </div>

    </div>

    <!-- REPORT INFORMATION -->

    <div class="col-lg-8">

        <h5 class=section-title>
            Report Information
        </h5>

        <div class="row">

            <div class="col-md-6 mb-4">

                <label class="detail-label">
                    Report Code
                </label>

                <div class="detail-value">
                    <?= h($report->report_code) ?>
                </div>

            </div>

            <div class="col-md-6 mb-4">

                <label class="detail-label">
                    Item Name
                </label>

                <div class="detail-value">
                    <?= h($report->item_name) ?>
                </div>

            </div>

            <div class="col-md-6 mb-4">

                <label class="detail-label">
                    Category
                </label>

                <div class="detail-value">
                    <?= h($report->category->category_name) ?>
                </div>

            </div>

            <div class="col-md-6 mb-4">

                <label class="detail-label">
                    Status
                </label>

                <?php

                $status = strtolower($report->status);

                switch($status){

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

            <div class="col-md-6 mb-4">

                <label class="detail-label">
                    Location
                </label>

                <div class="detail-value">
                    <?= h($report->location) ?>
                </div>

            </div>

            <div class="col-md-6 mb-4">

                <label class="detail-label">
                    Report Date
                </label>

                <div class="detail-value">
                    <?= $report->report_date->format('d M Y') ?>
                </div>

            </div>

        </div>

    </div>

</div>


<div class="report-divider"></div>

<!-- DESCRIPTION -->

<h5 class="section-title">
    Description
</h5>

<p class="description-text">

    <?= h($report->description) ?>

</p>


<div class="report-divider"></div>

<!-- REPORTER INFORMATION -->

<h5 class="section-title">
    Reporter Information
</h5>

<div class="row">

    <div class="col-md-3 mb-4">

        <label class="detail-label">
            Name
        </label>

        <div class="detail-value">
            <?= h($report->user->name) ?>
        </div>

    </div>

    <div class="col-md-3 mb-4">

        <label class="detail-label">
            Student ID
        </label>

        <div class="detail-value">
            <?= h($report->user->student_id) ?>
        </div>

    </div>

    <div class="col-md-3 mb-4">

        <label class="detail-label">
            Email
        </label>

        <div class="detail-value">
            <?= h($report->user->email) ?>
        </div>

    </div>

    <div class="col-md-3 mb-4">

        <label class="detail-label">
            Contact Number
        </label>

        <div class="detail-value">
            <?= h($report->contact_number) ?>
        </div>

    </div>

</div>


<div class="report-divider"></div>

<!-- ACTION -->

<?php if(strtolower($report->status)=="pending"): ?>

<div class="claim-actions">

    <?= $this->Html->link(

        'Approve',

        ['action'=>'approve',$report->id],

        [

            'class'=>'claim-approve-btn2'

        ]

    ) ?>

    <?= $this->Html->link(

        'Reject',

        ['action'=>'reject',$report->id],

        [

            'class'=>'claim-reject-btn2'

        ]

    ) ?>

</div>

<?php else: ?>

<div class="review-completed">

    Review Completed

</div>

<?php endif; ?>

</div>