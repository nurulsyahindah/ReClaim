<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Claim $claim
 * @var string[]|\Cake\Collection\CollectionInterface $reports
 * @var string[]|\Cake\Collection\CollectionInterface $users
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $claim->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $claim->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Claims'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="claims form content">
            <?= $this->Form->create($claim) ?>
            <fieldset>
                <legend><?= __('Edit Claim') ?></legend>
                <?php
                    echo $this->Form->control('report_id', ['options' => $reports]);
                    echo $this->Form->control('user_id', ['options' => $users]);
                    echo $this->Form->control('reason');
                    echo $this->Form->control('contact_number');
                    echo $this->Form->control('evidence');
                    echo $this->Form->control('status');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
