<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>ReClaim Admin</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<?= $this->Html->css('admin') ?>

<?= $this->Html->meta(
'csrfToken',
$this->request->getAttribute('csrfToken')
) ?>

<style>

    *{
    font-family:'Poppins',sans-serif;
}

body{
    margin:0;
    font-family:'Poppins',sans-serif;
    background:url('<?= $this->Url->image("admin/admin-bg.png") ?>')
               no-repeat
               top center;
    background-size:cover;
    background-attachment:fixed;
    background-color:#f6f7ff;
}

</style>

</head>

<body>

    <?php
        $controller = $this->request->getParam('controller');
        $action = $this->request->getParam('action');
    ?>

<!-- ===========================
SIDEBAR
=========================== -->

<div class="sidebar">

<div class="logo">

    <img
        src="<?= $this->Url->image('admin/logo-reclaim.png') ?>"
        class="logo-img">

    <div class="logo-text">

        <h2>ReClaim</h2>

        <span>Admin Panel</span>

    </div>

</div>

<a class="<?= ($controller=='Users' && $action=='adminDashboard') ? 'active' : '' ?>"
href="<?= $this->Url->build([
'controller'=>'Users',
'action'=>'adminDashboard'
]) ?>">

<i class="bi bi-grid"></i>

Dashboard

</a>

<a class="<?= ($controller=='Reports') ? 'active' : '' ?>"
href="<?= $this->Url->build([
'controller'=>'Reports',
'action'=>'adminIndex'
]) ?>">

<i class="bi bi-folder2-open"></i>

Manage Reports

</a>

<a class="<?= ($controller=='Claims') ? 'active' : '' ?>"
href="<?= $this->Url->build([
'controller'=>'Claims',
'action'=>'adminIndex'
]) ?>">

<i class="bi bi-check-circle"></i>

Manage Claims

</a>

<a class="<?= ($controller=='Users' && $action!='adminDashboard') ? 'active' : '' ?>"
href="<?= $this->Url->build([
'controller'=>'Users',
'action'=>'adminIndex'
]) ?>">

<i class="bi bi-people"></i>

Manage Users

</a>

<a class="<?= ($controller=='Categories') ? 'active' : '' ?>"
href="<?= $this->Url->build([
'controller'=>'Categories',
'action'=>'adminIndex'
]) ?>">

<i class="bi bi-tags"></i>

Manage Categories

</a>

<a href="<?= $this->Url->build(['controller'=>'Users','action'=>'logout']) ?>">

<i class="bi bi-box-arrow-right"></i>

Logout

</a>

</div>

<!-- ===========================
MAIN CONTENT
=========================== -->

<div class="main">

<?= $this->Flash->render() ?>

<?= $this->fetch('content') ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<?= $this->fetch('script') ?>

</body>

</html>