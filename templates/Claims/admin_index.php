<div class="card table-card">

    <div class="card-body">

        <!-- ==========================
             HEADER
        ========================== -->

        <div class="d-flex justify-content-between align-items-center mb-3">

            <div>

                <h4 class="fw-bold mb-1">
                    Manage Claims
                </h4>

                <small class="text-muted">
                    Review and manage all submitted claims.
                </small>

            </div>

            <form method="get">

                <div class="search-toolbar">

                    <input
                        type="text"
                        name="search"
                        class="form-control search-input"
                        placeholder="Search claim..."
                        value="<?= h($this->request->getQuery('search')) ?>">

                    <select
                        name="status"
                        class="form-select search-select">

                        <option value="">All Status</option>

                        <option value="Pending"
                        <?= $this->request->getQuery('status')=="Pending" ? 'selected' : '' ?>>
                            Pending
                        </option>

                        <option value="Approved"
                        <?= $this->request->getQuery('status')=="Approved" ? 'selected' : '' ?>>
                            Approved
                        </option>

                        <option value="Rejected"
                        <?= $this->request->getQuery('status')=="Rejected" ? 'selected' : '' ?>>
                            Rejected
                        </option>

                    </select>

                    <button class="btn search-btn">
                        <i class="bi bi-search"></i>
                    </button>

                </div>

            </form>

        </div>

        <!-- ==========================
             TABLE
        ========================== -->

        <div class="table-responsive">

            <table class="table table-modern align-middle">

                <thead>

                    <tr>

                        <th style="width:90px;">Claim</th>

                        <th style="width:360px;">Item</th>

                        <th style="width:260px;">Claim By</th>

                        <th style="width:170px;">Category</th>

                        <th style="width:170px;">Status</th>

                        <th style="width:170px;">Date</th>

                        <th style="width:170px;">Action</th>

                    </tr>

                </thead>

                <tbody>

                <?php foreach($claims as $claim): ?>

                <tr>

                    <td>

                        <strong>#<?= h($claim->id) ?></strong>

                    </td>

                    <td>

                        <div class="d-flex align-items-center gap-3">

                            <img
                                src="<?= $this->Url->image('reports/'.$claim->report->image) ?>"
                                class="report-image">

                            <div>

                                <div class="fw-semibold">

                                    <?= h($claim->report->item_name) ?>

                                </div>

                                <small class="text-muted">

                                    <?= h($claim->report->report_code) ?>

                                </small>

                            </div>

                        </div>

                    </td>

                    <td>

                        <?= h($claim->user->name) ?>

                    </td>

                    <td>

                        <?= h($claim->report->category->category_name) ?>

                    </td>

                    <td>

                        <?php

                        switch(strtolower($claim->status)){

                            case 'pending':

                                echo '<span class="status-badge status-pending">Pending</span>';

                            break;

                            case 'approved':

                                echo '<span class="status-badge status-approved">Approved</span>';

                            break;

                            case 'rejected':

                                echo '<span class="status-badge status-rejected">Rejected</span>';

                            break;

                            default:

                                echo '<span class="status-badge">'.$claim->status.'</span>';

                        }

                        ?>

                    </td>

                    <td>
                        <?= $claim->created->format('d M Y') ?>
                    </td>

                    <td>

                        <div class="d-flex gap-2">

                            <?= $this->Html->link(

                                '<i class="bi bi-eye"></i>',

                                ['action'=>'adminView',$claim->id],

                                [

                                'class'=>'btn action-view',

                                'escape'=>false

                                ]
                            ) ?>

                            <?= $this->Html->link(

                                '<i class="bi bi-check-lg"></i>',

                                ['action'=>'approve',$claim->id],

                                [

                                    'class'=>'btn action-approve',

                                    'escape'=>false

                                ]

                            ) ?>

                            <?= $this->Html->link(

                                '<i class="bi bi-x-lg"></i>',

                                ['action'=>'reject',$claim->id],

                                [

                                    'class'=>'btn action-reject',

                                    'escape'=>false

                                ]

                            ) ?>

                        </div>

                    </td>

                </tr>

                <?php endforeach; ?>

                </tbody>

            </table>

        </div>

        <!-- ==========================
             PAGINATION
        ========================== -->

        <div class="d-flex justify-content-between align-items-center mt-4">

            <small class="text-muted">

                <?= $this->Paginator->counter(
                    'Showing {{current}} of {{count}} claims'
                ) ?>

            </small>

            <nav>

                <ul class="pagination modern-pagination mb-0">

                    <?= $this->Paginator->prev('‹',['escape'=>false]) ?>

                    <?= $this->Paginator->numbers() ?>

                    <?= $this->Paginator->next('›',['escape'=>false]) ?>

                </ul>

            </nav>

        </div>

    </div>

</div>