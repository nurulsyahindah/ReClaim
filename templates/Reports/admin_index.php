<div class="card table-card">

    <div class="card-body">

        <!-- ==========================
             HEADER
        ========================== -->

        <div class="d-flex justify-content-between align-items-center mb-3">

            <div>

                <h4 class="fw-bold mb-1">

                    Manage Reports

                </h4>

                <small class="text-muted">

                    Review and manage all submitted reports.

                </small>

            </div>

            <form method="get">

                <div class="search-toolbar">

                    <input

                        type="text"

                        name="search"

                        class="form-control search-input"

                        placeholder="Search report..."

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

                        <option value="Claimed"
                        <?= $this->request->getQuery('status')=="Claimed" ? 'selected' : '' ?>>

                            Claimed

                        </option>

                        <option value="Lost"
                        <?= $this->request->getQuery('status')=="Lost" ? 'selected' : '' ?>>

                            Lost Items

                        </option>

                        <option value="Found"
                        <?= $this->request->getQuery('status')=="Found" ? 'selected' : '' ?>>

                            Found Items

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

                        <th>Code</th>

                        <th>Item</th>

                        <th>Reporter</th>

                        <th>Type</th>

                        <th>Status</th>

                        <th>Date</th>

                        <th width="220">Action</th>

                    </tr>

                </thead>

                <tbody>

                <?php foreach($reports as $report): ?>

                <tr>

                    <td>

                        <?= h($report->report_code) ?>

                    </td>

                    <td>

                        <div class="d-flex align-items-center gap-3">

                            <img
                                src="<?= $this->Url->image('reports/'.$report->image) ?>"
                                class="report-image">

                            <div>

                        <div class="fw-semibold">

                            <?= h($report->item_name) ?>

                        </div>

                        <small class="text-muted">

                            <?= h($report->category->category_name) ?>

                        </small>

                    </div>

            </div>

        </td>

                    <td>

                        <?= h($report->user->name) ?>

                    </td>

                    <td>

                        <?php

                        $type=strtolower(trim($report->type));

                        if($type=="found"){

                            echo '<span class="status-badge type-found">Found</span>';

                            }else{

                            echo '<span class="status-badge type-lost">Lost</span>';

                            }

                        ?>

                    </td>

                    <td>

                    <?php

                    $status=strtolower($report->status);

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

                    </td>

                    <td>

                        <?= $report->report_date->format('d M Y') ?>

                    </td>

                    <td>

                        <div class="d-flex gap-2">

                            <?= $this->Html->link(

                                '<i class="bi bi-eye"></i>',

                                ['action'=>'adminView',$report->id],

                                [   

                                'class'=>'btn action-view',

                                'escape'=>false

                                ]

                            ) ?>

                            <?= $this->Html->link(

                                '<i class="bi bi-check-lg"></i>',

                                ['action'=>'approve',$report->id],

                                [

                                'class'=>'btn action-approve',

                                'escape'=>false

                                ]

                            ) ?>

                            <?= $this->Html->link(

                                '<i class="bi bi-x-lg"></i>',

                                ['action'=>'reject',$report->id],

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

            <div class="d-flex justify-content-between align-items-center mt-4">

                <small class="text-muted">

                    <?= $this->Paginator->counter(
                        'Showing {{current}} of {{count}} reports'
                    ) ?>

                </small>

                <nav>

                    <ul class="pagination modern-pagination mb-0">

                        <?= $this->Paginator->prev('‹',[
                        'escape'=>false
                        ]) ?>

                        <?= $this->Paginator->numbers() ?>

                        <?= $this->Paginator->next('›',[
                        'escape'=>false
                        ]) ?>

                    </ul>

                </nav>

            </div>

    </div>

</div>

</div>

</div>

</div>