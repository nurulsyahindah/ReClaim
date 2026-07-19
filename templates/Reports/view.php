<?php
$this->layout = 'dashboard';
?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h3 class="fw-bold mb-1">
            Report Details
        </h3>

        <small class="text-muted">
            View your submitted report information.
        </small>

    </div>

    <?= $this->Html->link(

        '<i class="bi bi-arrow-left"></i> Back',

        ['action' => 'myReports'],

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
                src="<?= $this->Url->image('reports/'.$report->image) ?>"
                class="report-detail-image">

        </div>

    </div>

    <!-- REPORT INFORMATION -->

    <div class="col-lg-8">

        <h5 class="section-title">
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
                    Type
                </label>

                <?php

                if(strtolower($report->type)=="lost"){

                    echo '<span class="status-badge type-lost">Lost</span>';

                }else{

                    echo '<span class="status-badge type-found">Found</span>';

                }

                ?>

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
                    Report Date
                </label>

                <div class="detail-value">
                    <?= $report->report_date->format('d M Y') ?>
                </div>

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
                    Contact Number
                </label>

                <div class="detail-value">
                    <?= h($report->contact_number) ?>
                </div>

            </div>

            <div class="col-md-6 mb-4">

                <label class="detail-label">
                    Status
                </label>

                <?php

                switch(strtolower($report->status)){

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

</div>