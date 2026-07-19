<div class="card table-card">

    <div class="card-body">

        <!-- ==========================
             HEADER
        ========================== -->

        <div class="d-flex justify-content-between align-items-center mb-3">

            <div>

                <h4 class="fw-bold mb-1">

                    Manage Categories

                </h4>

                <small class="text-muted">

                    Manage item categories used in reports.

                </small>

            </div>

            <form method="get">

                <div class="search-toolbar">

                    <input

                        type="text"

                        name="search"

                        class="form-control search-input"

                        placeholder="Search category..."

                        value="<?= h($this->request->getQuery('search')) ?>">

                    <button class="btn search-btn">

                        <i class="bi bi-search"></i>

                    </button>

                    <button
                        type="button"

                        class="btn btn-success rounded-3"

                        data-bs-toggle="modal"

                        data-bs-target="#addCategoryModal">

                        <i class="bi bi-plus-lg"></i>

                        Add Category

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

                        <th width="80">ID</th>

                        <th>Category Name</th>

                        <th>Created</th>

                        <th>Modified</th>

                        <th width="180">Action</th>

                    </tr>

                </thead>

                <tbody>

                <?php foreach($categories as $category): ?>

                <tr>

                    <td>

                        <?= $category->id ?>

                    </td>

                    <td>

                        <strong>

                            <?= h($category->category_name) ?>

                        </strong>

                    </td>

                    <td>

                        <?= $category->created->format('d M Y') ?>

                        <br>

                        <small class="text-muted">

                            <?= $category->created->format('h:i A') ?>

                        </small>

                    </td>

                    <td>

                        <?= $category->modified->format('d M Y') ?>

                        <br>

                        <small class="text-muted">

                            <?= $category->modified->format('h:i A') ?>

                        </small>

                    </td>

                    <td>

                        <div class="d-flex justify-content-center gap-2">

                            <button

                                type="button"

                                class="btn action-edit"

                                data-bs-toggle="modal"

                                data-bs-target="#editCategoryModal<?= $category->id ?>">

                                <i class="bi bi-pencil"></i>

                            </button>

                            <?= $this->Form->postLink(

                                '<i class="bi bi-trash"></i>',

                                ['action'=>'delete',$category->id],

                                [

                                    'class'=>'btn action-reject',

                                    'escape'=>false,

                                    'confirm'=>'Delete this category?'

                                ]

                            ) ?>

                        </div>

                    </td>

                </tr>

<!-- ==========================
     EDIT CATEGORY MODAL
========================== -->

<div
class="modal fade"
id="editCategoryModal<?= $category->id ?>"
tabindex="-1">

<div class="modal-dialog modal-dialog-centered">

<div class="modal-content rounded-4 border-0">

<?= $this->Form->create($category,[

'url'=>[
'action'=>'edit',
$category->id
]

]) ?>

<div class="modal-header border-0">

<h5 class="modal-title">

<i class="bi bi-pencil-square text-primary me-2"></i>

Edit Category

</h5>

<button
type="button"
class="btn-close"
data-bs-dismiss="modal">

</button>

</div>

<div class="modal-body">

<label class="form-label fw-semibold">

Category Name

</label>

<?= $this->Form->control(

'category_name',

[

'label'=>false,

'class'=>'form-control',

'placeholder'=>'Category Name'

]

) ?>

</div>

<div class="modal-footer border-0">

<button

type="button"

class="btn view-btn2"

data-bs-dismiss="modal">

Cancel

</button>

<button

type="submit"

class="btn view-btn3">

Save Changes

</button>

</div>

<?= $this->Form->end() ?>

</div>

</div>

</div>

                <?php endforeach; ?>

                </tbody>

            </table>

        </div>

        <!-- Pagination -->

        <div class="d-flex justify-content-between align-items-center mt-4">

            <small class="text-muted">

                <?= $this->Paginator->counter(
                    'Showing {{current}} of {{count}} categories'
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

<!-- ==========================
     ADD CATEGORY MODAL
========================== -->

<div
class="modal fade"
id="addCategoryModal"
tabindex="-1"
aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0 rounded-4">

            <?= $this->Form->create(null,[
                'url'=>[
                    'action'=>'add'
                ]
            ]) ?>

            <div class="modal-header border-0 pb-0">

            <h5 class="modal-title">

                <i class="bi bi-tags-fill text-primary me-2"></i>

                    Add Category

            </h5>

                <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"></button>

            </div>

            <div class="modal-body">

                <div class="mb-3">

                    <label class="form-label fw-semibold">

                        Category Name

                    </label>

                    <?= $this->Form->control('category_name',[

                        'label'=>false,

                        'class'=>'form-control',

                        'placeholder'=>'Example: Electronic'

                    ]) ?>

                </div>

            </div>

            <div class="modal-footer border-0">

                <button
                type="button"
                class="btn view-btn2"
                data-bs-dismiss="modal">

                    Cancel

                </button>

                <button
                type="submit"
                class="btn view-btn3">

                    Save Category

                </button>

            </div>

            <?= $this->Form->end() ?>

        </div>

    </div>

</div>