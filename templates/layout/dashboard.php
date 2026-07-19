<!DOCTYPE html>
<html lang="en">

<head>

<?= $this->Html->charset() ?>

<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>ReClaim User</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<?= $this->Html->css('dashboard') ?>

</head>

<body>

    <?php
        $session = $this->request->getSession();
        $auth = $session->read('Auth');
    ?>

    <?php
        $controller = $this->request->getParam('controller');
        $action = $this->request->getParam('action');
    ?>

<style>

    *{
    font-family:'Poppins',sans-serif;
}

body{
    margin:0;
    font-family:'Poppins',sans-serif;
    background:url('<?= $this->Url->image("dashboard/admin-bg.png") ?>')
               no-repeat
               top center;
    background-size:cover;
    background-attachment:fixed;
    background-color:#f6f7ff;
}

</style>

<!-- ===========================
SIDEBAR
=========================== -->

<div class="sidebar">

<div class="logo">

    <img
        src="<?= $this->Url->image('dashboard/logo-reclaim.png') ?>"
        class="logo-img">

    <div class="logo-text">

        <h2>ReClaim</h2>

        <span>User Panel</span>

    </div>

</div>

<a class="<?= ($controller=='Users' && $action=='dashboard') ? 'active' : '' ?>"
href="<?= $this->Url->build([
'controller'=>'Users',
'action'=>'dashboard'
]) ?>">

<i class="bi bi-grid"></i>

Home

</a>

<a class="<?= ($controller=='Reports' && $action=='index') ? 'active' : '' ?>"
href="<?= $this->Url->build([
'controller'=>'Reports',
'action'=>'index'
]) ?>">

<i class="bi bi-search-heart"></i>

Browse Found Items

</a>

<a class="<?= ($controller=='Reports' && $action=='add') ? 'active' : '' ?>"
href="<?= $this->Url->build([
'controller'=>'Reports',
'action'=>'add'
]) ?>">

<i class="bi bi-plus-circle"></i>

Report an Item

</a>

<a class="<?= ($controller=='Reports' && $action=='myReports') ? 'active' : '' ?>"
href="<?= $this->Url->build([
'controller'=>'Reports',
'action'=>'myReports'
]) ?>">

<i class="bi bi-folder2-open"></i>

My Reports

</a>

<a class="<?= ($controller=='Claims') ? 'active' : '' ?>"
href="<?= $this->Url->build([
'controller'=>'Claims',
'action'=>'myClaims'
]) ?>">

<i class="bi bi-patch-check"></i>

My Claims

</a>

<a href="<?= $this->Url->build([
'controller'=>'Users',
'action'=>'logout'
]) ?>">

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

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<?= $this->fetch('script') ?>

</body>

</html>