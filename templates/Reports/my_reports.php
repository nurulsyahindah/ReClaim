<div class="card table-card">

    <div class="card-body">

        <!-- ==========================
             HEADER
        ========================== -->

        <div class="d-flex justify-content-between align-items-center mb-3">

            <div>

                <h4 class="fw-bold mb-1">
                    My Reports
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
                        placeholder="Search item..."
                        value="<?= h($this->request->getQuery('search')) ?>">

                    <select
                        name="type"
                        class="form-select search-select">

                        <option value="">All Reports</option>

                        <option value="Found"
                            <?= $this->request->getQuery('type') == "Found" ? 'selected' : '' ?>>
                            Found Items
                        </option>

                        <option value="Lost"
                            <?= $this->request->getQuery('type') == "Lost" ? 'selected' : '' ?>>
                            Lost Items
                        </option>

                    </select>

                    <button type="submit" class="btn search-btn">

                        <i class="bi bi-search"></i>

                    </button>

                    <?= $this->Html->link(

                        '<i class="bi bi-plus-circle"></i> New Report',

                        ['action' => 'add'],

                        [
                            'class' => 'action-view2',
                            'escape' => false
                        ]

                    ) ?>

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
                        <th>Category</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th width="220">Action</th>

                    </tr>

                </thead>

                <tbody>

                    <?php if (!$reports->isEmpty()): ?>

                        <?php foreach ($reports as $report): ?>

                            <tr>

                                <td>

                                    <?= h($report->report_code) ?>

                                </td>

                                <td>

                                    <div class="d-flex align-items-center gap-3">

                                        <?php if (!empty($report->image)): ?>

                                            <img
                                                src="<?= $this->Url->image('reports/' . $report->image) ?>"
                                                class="report-image">

                                        <?php endif; ?>

                                        <div>

                                            <div class="fw-semibold">

                                                <?= h($report->item_name) ?>

                                            </div>

                                        </div>

                                    </div>

                                </td>

                                <td>

                                    <?= h($report->category->category_name) ?>

                                </td>

                                <td>

                                    <?php

                                    $type = strtolower(trim($report->type));

                                    if ($type == "found") {

                                        echo '<span class="status-badge type-found">Found</span>';

                                    } else {

                                        echo '<span class="status-badge type-lost">Lost</span>';

                                    }

                                    ?>

                                </td>

                                <td>

                                    <?php

                                    $status = strtolower($report->status);

                                    switch ($status) {

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

                                        default:

                                            echo '<span class="status-badge">' . h($report->status) . '</span>';

                                    }

                                    ?>

                                </td>

                                <td>

                                    <?= $report->report_date ? $report->report_date->format('d M Y') : '-' ?>

                                </td>

                                <td>

                                    <div class="d-flex gap-2">

                                        <?= $this->Html->link(

                                            '<i class="bi bi-eye"></i>',

                                            ['action' => 'view', $report->id],

                                            [
                                                'class' => 'btn action-view',
                                                'escape' => false
                                            ]

                                        ) ?>

                                        <?= $this->Html->link(

                                            '<i class="bi bi-pencil"></i>',

                                            ['action' => 'edit', $report->id],

                                            [
                                                'class' => 'btn action-approve',
                                                'escape' => false
                                            ]

                                        ) ?>

                                        <?= $this->Form->postLink(

                                            '<i class="bi bi-trash"></i>',

                                            ['action' => 'delete', $report->id],

                                            [
                                                'class' => 'btn action-reject',
                                                'escape' => false,
                                                'confirm' => 'Delete this report?'
                                            ]

                                        ) ?>

                                    </div>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>

                            <td colspan="7" class="text-center py-5">

                                No reports found.

                            </td>

                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>

        <!-- ==========================
             PAGINATION
        ========================== -->

        <div class="d-flex justify-content-between align-items-center mt-4">

            <small class="text-muted">

                <?= $this->Paginator->counter(
                    'Showing {{current}} of {{count}} reports'
                ) ?>

            </small>

            <nav>

                <ul class="pagination modern-pagination mb-0">

                    <?= $this->Paginator->prev('‹', [
                        'escape' => false
                    ]) ?>

                    <?= $this->Paginator->numbers() ?>

                    <?= $this->Paginator->next('›', [
                        'escape' => false
                    ]) ?>

                </ul>

            </nav>

        </div>

    </div>

</div>