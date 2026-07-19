<?php
$this->layout = 'dashboard';
?>

<div class="container-fluid py-4">

    <div class="card report-card">

        <div class="card-body p-5">

            <!-- HEADER -->

            <div class="mb-3">

                <h4 class="report-title">

                    <i class="bi bi-file-earmark-plus"></i>

                    Report Item

                </h4>

                <small class="text-muted">

                    Complete the form below to submit a lost or found item report. Our team will review your submission before publishing it.

                </small>

            </div>

            <?= $this->Form->create($report,[
                'type'=>'file'
            ]) ?>

            <!-- ITEM INFORMATION -->

            <h5 class="form-section-title">

                Item Information

            </h5>

            <div class="row">

                <div class="col-md-6 mb-4">

                    <?= $this->Form->control('category_id',[

                        'label'=>'Category',

                        'options'=>$categories,

                        'empty'=>'Select Category',

                        'class'=>'form-select'

                    ]) ?>

                </div>

                <div class="col-md-6 mb-4">

                    <?= $this->Form->control('type',[

                        'label'=>'Report Type',

                        'options'=>[

                            'lost'=>'Lost Item',

                            'found'=>'Found Item'

                        ],

                        'empty'=>'Select Type',

                        'class'=>'form-select'

                    ]) ?>

                </div>

            </div>

            <div class="row">

                <div class="col-md-6 mb-4">

                    <?= $this->Form->control('item_name',[

                        'label'=>'Item Name',

                        'class'=>'form-control'

                    ]) ?>

                </div>

                <div class="col-md-6 mb-4">

                    <?= $this->Form->control('contact_number',[

                        'label'=>'Contact Number',

                        'class'=>'form-control'

                    ]) ?>

                </div>

            </div>

            <!-- DETAILS -->

            <h5 class="form-section-title mt-2">

                Additional Details

            </h5>

            <div class="mb-4">

                <?= $this->Form->control('description',[

                    'type'=>'textarea',

                    'rows'=>6,

                    'label'=>'Description',

                    'class'=>'form-control',

                    'placeholder'=>'Provide a detailed description of the item...'

                ]) ?>

            </div>

            <div class="row">

                <div class="col-md-6 mb-4">

                    <?= $this->Form->control('location',[

                        'label'=>'Location',

                        'class'=>'form-control'

                    ]) ?>

                </div>

                <div class="col-md-6 mb-4">

                    <?= $this->Form->control('report_date',[

                        'label'=>'Report Date',

                        'type'=>'date',

                        'class'=>'form-control'

                    ]) ?>

                </div>

            </div>

            <div class="mb-4">

                <?= $this->Form->control('image',[

                    'label'=>'Upload Image',

                    'type'=>'file',

                    'accept'=>'image/*',

                    'class'=>'form-control'

                ]) ?>

            </div>

            <div class="text-end mt-5">

                <?= $this->Form->button(

                    '<i class="bi bi-check-circle-fill me-2"></i> Submit Report',

                    [

                        'class'=>'btn submit-report-btn',

                        'escapeTitle'=>false

                    ]

                ) ?>

            </div>

            <?= $this->Form->end() ?>

        </div>

    </div>

</div>