<?php
$this->assign('title', 'Login');
?>

<div id="vanta-bg">
<div class="auth-section">

    <div class="auth-card">

        <div class="logo-circle">
            🔒
        </div>

        <h2 class="auth-title">
            Welcome Back!
        </h2>

        <p class="auth-subtitle">
            Login to your account
        </p>

        <?= $this->Form->create() ?>

        <div class="mb-3">

            <?= $this->Form->label('email', 'Email Address', ['class' => 'form-label']) ?>

            <?= $this->Form->control('email', [
                'label' => false,
                'class' => 'form-control',
                'placeholder' => 'Enter your email'
            ]) ?>

        </div>

        <div class="mb-2">

            <?= $this->Form->label('password', 'Password', ['class' => 'form-label']) ?>

            <?= $this->Form->control('password', [
                'label' => false,
                'class' => 'form-control',
                'placeholder' => 'Enter your password'
            ]) ?>

        </div>

        <div class="text-end mb-4">

            <a href="#" style="text-decoration:none;font-size:14px;color:#6C3BFF;">
                Forgot Password?
            </a>

        </div>

        <?= $this->Form->button('Login', [
            'class' => 'btn btn-purple'
        ]) ?>

        <?= $this->Form->end() ?>

        <div class="auth-footer">

            Don't have an account?

            <?= $this->Html->link(
                'Register here',
                ['controller'=>'Users','action'=>'register']
            ) ?>

        </div>

    </div>

</div>
</div>

    <!-- Bootstraps JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <!-- VARTA Background -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r134/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.halo.min.js"></script>

<script>
VANTA.HALO({
  el: "#vanta-bg",
  mouseControls: true,
  touchControls: true,
  gyroControls: false,
  minHeight: 200.00,
  minWidth: 200.00,
  backgroundColor: 0x2e2260
})
</script>

