<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h3 class="fw-bold mb-1">
            Claim Details
        </h3>

        <small class="text-muted">
            Review submitted ownership claim information.
        </small>

    </div>

    <?= $this->Html->link(
        '<i class="bi bi-arrow-left"></i> Back',
        ['action'=>'adminIndex'],
        [
            'class'=>'btn action-view2',
            'escape'=>false
        ]
    ) ?>

</div>


<div class="card table-card2 detail-card">

<div class="card-body">

<div class="row">

    <!-- LEFT IMAGE -->

    <div class="col-lg-4">

        <div class="image-wrapper">

            <img
                src="<?= $this->Url->image('reports/'.$claim->report->image) ?>"
                class="claim-image">

            <?php

            $type = strtolower($claim->report->type);

            if($type=="found"){

                echo '<span class="status-badge type-found image-badge">Found</span>';

            }else{

                echo '<span class="status-badge type-lost image-badge">Lost</span>';

            }

            ?>

        </div>

        <div class="evidence-box mt-4">

            <h6 class="section-title-sm">

                Ownership Evidence

            </h6>

            <p class="mb-0">

                <?= nl2br(h($claim->reason)) ?>

            </p>

        </div>

    </div>


    <!-- RIGHT CONTENT -->

    <div class="col-lg-8">

        <div class="info-section">

            <h5 class="section-title">
                Claim Information
            </h5>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="detail-label">
                        Claim ID
                    </label>

                    <div class="detail-value">
                        #<?= $claim->id ?>
                    </div>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="detail-label">
                        Status
                    </label>

                    <div>

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

                </div>

                <div class="col-md-6 mb-3">

                    <label class="detail-label">
                        Claimed By
                    </label>

                    <div class="detail-value">
                        <?= h($claim->user->name) ?>
                    </div>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="detail-label">
                        Student ID
                    </label>

                    <div class="detail-value">
                        <?= h($claim->user->student_id) ?>
                    </div>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="detail-label">
                        Email
                    </label>

                    <div class="detail-value">
                        <?= h($claim->user->email) ?>
                    </div>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="detail-label">
                        Contact Number
                    </label>

                    <div class="detail-value">
                        <?= h($claim->contact_number) ?>
                    </div>

                </div>

            </div>

        </div>


        <hr>


        <div class="info-section">

            <h5 class="section-title">
                Report Information
            </h5>

            <div class="row">

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
                        Submitted
                    </label>

                    <div class="detail-value">
                        <?= $claim->created->format('d M Y') ?>
                    </div>

                </div>

            </div>

            <div class="action-section">

<?php if(strtolower($claim->status)=="pending"): ?>

<hr>

<h5 class="section-title">

    Claim Action

</h5>

<div class="claim-actions mt-4">

    <?= $this->Html->link(
        'Approve',
        ['action'=>'approve',$claim->id],
        [
            'class'=>'claim-approve-btn',
            'escape'=>false
        ]
    ) ?>

    <?= $this->Html->link(
        'Reject',
        ['action'=>'reject',$claim->id],
        [
            'class'=>'claim-reject-btn',
            'escape'=>false
        ]
    ) ?>

</div>

<?php elseif(strtolower($claim->status)=="approved"): ?>

<hr>

<div class="status-card-success">

✅ Claim Approved

</div>

<?php elseif(strtolower($claim->status)=="rejected"): ?>

<hr>

<div class="status-card-danger">

❌ Claim Rejected

</div>

<?php endif; ?>

</div>

        </div>

    </div>

</div>

</div>

</div>

