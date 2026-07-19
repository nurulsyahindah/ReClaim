<?php
$this->layout = 'dashboard';
?>

<div class="container-fluid">

    <div class="card shadow border-0">

        <div class="card-header bg-white">

            <h3 class="mb-0">
                <i class="bi bi-check-circle-fill text-success"></i>
                Claim Item
            </h3>

        </div>

        <div class="card-body p-4">

            <?= $this->Form->create($claim, [
                'type' => 'file'
            ]) ?>

            <div class="mb-4">

                <?= $this->Form->control('reason', [

                    'label' => 'Reason for Claim',

                    'type' => 'textarea',

                    'rows' => 5,

                    'class' => 'form-control',

                    'placeholder' => 'Explain why this item belongs to you...'

                ]) ?>

            </div>

            <div class="mb-4">

                <?= $this->Form->control('contact_number', [

                    'label' => 'Contact Number',

                    'class' => 'form-control',

                    'placeholder' => '01X-XXXXXXXX'

                ]) ?>

            </div>

            <div class="mb-4">

                <?= $this->Form->control('evidence', [

                    'label' => 'Upload Supporting Evidence',

                    'type' => 'file',

                    'class' => 'form-control'

                ]) ?>

                <small class="text-muted">

                    Upload student card, receipt, photo or any proof of ownership.

                </small>

            </div>

            <div class="d-flex justify-content-between">

                <?= $this->Html->link(

                    '<i class="bi bi-arrow-left"></i> Cancel',

                    [

                        'controller'=>'Reports',

                        'action'=>'index'

                    ],

                    [

                        'class'=>'btn btn-secondary',

                        'escape'=>false

                    ]

                ) ?>

                <?= $this->Form->button(

                    '<i class="bi bi-send-fill"></i> Submit Claim',

                    [

                        'class'=>'btn btn-success',

                        'escapeTitle'=>false

                    ]

                ) ?>

            </div>

            <?= $this->Form->end() ?>

        </div>

    </div>

</div>