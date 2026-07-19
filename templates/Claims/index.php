<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Claim> $claims
 */
?>
<div class="claims index content">
    <?= $this->Html->link(__('New Claim'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Claims') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('report_id') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('reason') ?></th>
                    <th><?= $this->Paginator->sort('contact_number') ?></th>
                    <th><?= $this->Paginator->sort('evidence') ?></th>
                    <th><?= $this->Paginator->sort('status') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($claims as $claim): ?>
                <tr>
                    <td><?= $this->Number->format($claim->id) ?></td>
                    <td><?= $claim->hasValue('report') ? $this->Html->link($claim->report->report_code, ['controller' => 'Reports', 'action' => 'view', $claim->report->id]) : '' ?></td>
                    <td><?= $claim->hasValue('user') ? $this->Html->link($claim->user->name, ['controller' => 'Users', 'action' => 'view', $claim->user->id]) : '' ?></td>
                    <td><?= h($claim->reason) ?></td>
                    <td><?= h($claim->contact_number) ?></td>
                    <td><?= h($claim->evidence) ?></td>
                    <td><?= h($claim->status) ?></td>
                    <td><?= h($claim->created) ?></td>
                    <td><?= h($claim->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $claim->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $claim->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $claim->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $claim->id),
                            ]
                        ) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>