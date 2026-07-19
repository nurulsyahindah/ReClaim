<div class="card table-card">

    <div class="card-body">

        <!-- HEADER -->

        <div class="d-flex justify-content-between align-items-center mb-3">

            <div>

                <h4 class="fw-bold mb-1">
                    Manage Users
                </h4>

                <small class="text-muted">
                    View and manage all registered users.
                </small>

            </div>

            <form method="get">

                <div class="search-toolbar">

                    <input
                        type="text"
                        name="search"
                        class="form-control search-input"
                        placeholder="Search user..."
                        value="<?= h($this->request->getQuery('search')) ?>">

                    <select
                        name="role"
                        class="form-select search-select">

                        <option value="">All Roles</option>

                        <option value="admin"
                        <?= $this->request->getQuery('role')=="admin" ? 'selected' : '' ?>>
                            Admin
                        </option>

                        <option value="user"
                        <?= $this->request->getQuery('role')=="user" ? 'selected' : '' ?>>
                            User
                        </option>

                    </select>

                    <button class="btn search-btn">

                        <i class="bi bi-search"></i>

                    </button>

                </div>

            </form>

        </div>


        <!-- TABLE -->

        <div class="table-responsive">

            <table class="table table-modern align-middle">

                <thead>

                <tr>

                    <th>ID</th>

                    <th>Name</th>

                    <th>Student ID</th>

                    <th>Date Registered</th>

                    <th>Last Updated</th>

                    <th>Role</th>

                    <th class="text-center" width="180">

                        Action

                    </th>

                </tr>

                </thead>

                <tbody>

                <?php foreach($users as $u): ?>

                <tr>

                    <td>

                        <strong>#<?= $u->id ?></strong>

                    </td>

                    <td>

                        <div>

                            <div class="fw-semibold">

                                <?= h($u->name) ?>

                            </div>

                            <small class="text-muted">

                                <?= h($u->email) ?>

                            </small>

                        </div>

                    </td>

                    <td>

                        <?= h($u->student_id) ?>

                    </td>

                    <td>

                        <?= $u->created->format('d M Y') ?>

                    </td>

                    <td>

                        <?= $u->modified->format('d M Y') ?>

                    </td>

                    <td>

                        <?php

                        if($u->role=="admin"){

                            echo '<span class="status-badge status-approved">Admin</span>';

                        }else{

                            echo '<span class="status-badge status-claimed">User</span>';

                        }

                        ?>

                    </td>

                    <td>

                        <div class="d-flex justify-content-center gap-2">

                            <?php if($u->id != $user['id']): ?>

                            <?= $this->Form->postLink(

                                '<i class="bi bi-trash"></i>',

                                ['action'=>'delete',$u->id],

                                [

                                    'class'=>'btn action-reject',

                                    'escape'=>false,

                                    'confirm'=>'Delete this user?'

                                ]

                            ) ?>

                            <?php endif; ?>

                        </div>

                    </td>

                </tr>

                <?php endforeach; ?>

                </tbody>

            </table>



            <div class="d-flex justify-content-between align-items-center mt-4">

                <small class="text-muted">

                    <?= $this->Paginator->counter(

                        'Showing {{current}} of {{count}} users'

                    ) ?>

                </small>

                <nav>

                    <ul class="pagination modern-pagination mb-0">

                        <?= $this->Paginator->prev('‹') ?>

                        <?= $this->Paginator->numbers() ?>

                        <?= $this->Paginator->next('›') ?>

                    </ul>

                </nav>

            </div>

        </div>

    </div>

</div>