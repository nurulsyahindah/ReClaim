<?php
$this->layout = 'dashboard';
?>

<div class="container-fluid">

    <!-- PAGE TITLE -->

    <div class="d-flex justify-content-between align-items-center mb-1">

        <div>

            <h4 class="fw-bold mb-1">
                Browse Reports
            </h4>

            <p class="text-muted">
                Browse all Lost and Found reports submitted by students.
            </p>

        </div>

    </div>

    <!-- SEARCH BAR -->

    <div class="card shadow-sm border-0 rounded-4 mb-4">

        <div class="card-body">

            <form method="get">

                <div class="row g-3">

                    <!-- Search -->

                    <div class="col-md-4">

                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Search item..."
                            value="<?= h($this->request->getQuery('search')) ?>">

                    </div>

                    <!-- Category -->

                    <div class="col-md-3">

                        <select
                            name="category"
                            class="form-select">

                            <option value="">All Categories</option>

                            <?php foreach($categories as $id => $category): ?>

                                <option
                                    value="<?= $id ?>"
                                    <?= $this->request->getQuery('category') == $id ? 'selected' : '' ?>>

                                    <?= h($category) ?>

                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>

                    <!-- Type -->

                    <div class="col-md-3">

                        <select
                            name="type"
                            class="form-select">

                            <option value="">All Reports</option>

                            <option
                                value="Found"
                                <?= $this->request->getQuery('type') == 'Found' ? 'selected' : '' ?>>

                                Found

                            </option>

                            <option
                                value="Lost"
                                <?= $this->request->getQuery('type') == 'Lost' ? 'selected' : '' ?>>

                                Lost

                            </option>

                        </select>

                    </div>

                    <!-- Button -->

                    <div class="col-md-2">

                        <button
                            type="submit"
                            class="btn purple-btn2 w-100">

                            Search

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

    <!-- REPORTS -->

    <div class="row">

        <?php if ($reports->count() > 0): ?>

            <?php foreach($reports as $report): ?>

                <div class="col-lg-3 col-md-4 mb-4">

                    <div class="card latest-found-card shadow-sm border-0 h-100">

                        <?php if(!empty($report->image)): ?>

                            <img
                                src="<?= $this->Url->image('reports/'.$report->image) ?>"
                                class="card-img-top"
                                style="height:200px;object-fit:cover;">

                        <?php else: ?>

                            <img
                                src="https://placehold.co/400x250?text=No+Image"
                                class="card-img-top"
                                style="height:200px;object-fit:cover;">

                        <?php endif; ?>

                        <div class="card-body">

                            <!-- TYPE -->

                            <span class="badge <?= $report->type == 'Found' ? 'bg-success' : 'bg-danger' ?> mb-2">

                                <?= strtoupper($report->type) ?>

                            </span>

                            <h6 class="fw-bold">

                                <?= h($report->item_name) ?>

                            </h6>


                            <small class="mb-3">

                                📍 <?= h($report->location) ?>

                            </small>

                            <br>

                            <small class="mb-3">

                                📅 <?= h($report->report_date) ?>

                            </small>

                            <br>

                            <small class="mb-3">

                                👤 <?= h($report->user->name) ?>

                            </small>
                            
                            <br><br>

                            <?= $this->Html->link(

                                'View Details',

                                [
                                    'action'=>'view',
                                    $report->id
                                ],

                                [
                                    'class'=>'btn purple-btn w-100 rounded-pill'
                                ]

                            ) ?>

                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

        <?php else: ?>

            <div class="col-12">

                <div class="alert alert-info text-center">

                    No reports found.

                </div>

            </div>

        <?php endif; ?>

    </div>

    <!-- PAGINATION -->

    <div class="d-flex justify-content-center mt-4">

        <?= $this->Paginator->numbers() ?>

    </div>

</div>