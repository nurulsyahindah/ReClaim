<?php
$this->layout = 'dashboard';
?>

<div class="container-fluid">

    <!-- PAGE TITLE -->

    <div class="d-flex justify-content-between align-items-center mb-1">

        <div>

            <h4 class="fw-bold mb-1">
                My Claims
            </h4>

            <p class="text-muted">
                Track all ownership claims you have submitted.
            </p>

        </div>

    </div>

    <!-- SEARCH -->

    <div class="card shadow-sm border-0 rounded-4 mb-4">

        <div class="card-body">

            <?= $this->Form->create(null,[
                'type'=>'get'
            ]) ?>

            <div class="row g-3 align-items-center">

                <!-- Search -->

                <div class="col-lg-6">

                    <div class="input-group">

                        <span class="input-group-text bg-white border-end-0">

                            <i class="bi bi-search"></i>

                        </span>

                        <input
                            type="text"
                            name="search"
                            class="form-control border-start-0"
                            placeholder="Search by item name..."
                            value="<?= h($this->request->getQuery('search')) ?>">

                    </div>

                </div>

                <!-- Status -->

                <div class="col-lg-3">

                    <select
                        name="status"
                        class="form-select">

                        <option value="">All Status</option>

                        <option value="Pending"
                            <?= $this->request->getQuery('status')=='Pending'?'selected':'' ?>>
                            Pending
                        </option>

                        <option value="Approved"
                            <?= $this->request->getQuery('status')=='Approved'?'selected':'' ?>>
                            Approved
                        </option>

                        <option value="Rejected"
                            <?= $this->request->getQuery('status')=='Rejected'?'selected':'' ?>>
                            Rejected
                        </option>

                    </select>

                </div>

                <!-- Button -->

                <div class="col-lg-3">

                    <button
                        type="submit"
                        class="btn purple-btn2 w-100">

                        <i class="bi bi-search me-2"></i>

                        Search

                    </button>

                </div>

            </div>

            <?= $this->Form->end() ?>

        </div>

    </div>

    <!-- CLAIM LIST -->

    <div class="claims-scroll">

        <?php if($claims->count()==0): ?>

            <div class="empty-state text-center py-5">

                <i class="bi bi-folder2-open fs-1 text-muted"></i>

                <h5 class="mt-3">

                    No Claims Found

                </h5>

                <p class="text-muted">

                    You haven't submitted any ownership claims yet.

                </p>

            </div>

        <?php else: ?>

            <?php foreach($claims as $claim): ?>

            <div class="claim-card mb-4">

                <div class="row align-items-center">

                    <!-- IMAGE -->

                    <div class="col-lg-2">

                        <?php

                        $image = !empty($claim->report->image)
                            ? $this->Url->image('reports/'.$claim->report->image)
                            : $this->Url->image('no-image.png');

                        ?>

                        <img
                            src="<?= $image ?>"
                            class="claim-image">

                    </div>

                    <!-- DETAILS -->

                    <div class="col-lg-7">

                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label class="detail-label">

                                    Claim ID

                                </label>

                                <div class="detail-value">

                                    #<?= h($claim->id) ?>

                                </div>

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="detail-label">

                                    Report Code

                                </label>

                                <div class="detail-value">

                                    <?= h($claim->report->report_code) ?>

                                </div>

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="detail-label">

                                    Item Name

                                </label>

                                <div class="detail-value">

                                    <?= h($claim->report->item_name) ?>

                                </div>

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="detail-label">

                                    Category

                                </label>

                                <div class="detail-value">

                                    <?= h($claim->report->category->category_name) ?>

                                </div>

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="detail-label">

                                    Claim Status

                                </label>

                                <?php

                                switch(strtolower($claim->status)){

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

                            <div class="col-md-6 mb-3">

                                <label class="detail-label">

                                    Report Status

                                </label>

                                <?php

                                switch(strtolower($claim->report->status)){

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

                            <div class="col-md-6">

                                <label class="detail-label">

                                    Submitted On

                                </label>

                                <div class="detail-value">

                                    <?= $claim->created->format('d M Y') ?>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- BUTTON -->

                    <div class="col-lg-3 text-end">

                        <?= $this->Html->link(

                            '<i class="bi bi-eye-fill me-2"></i> View Details',

                            ['action'=>'view',$claim->id],

                            [

                                'class'=>'btn submit-report-btn',

                                'escape'=>false

                            ]

                        ) ?>

                    </div>

                </div>

            </div>

            <?php endforeach; ?>

        <?php endif; ?>

    </div>

</div>