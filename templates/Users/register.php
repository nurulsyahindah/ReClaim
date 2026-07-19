<?php
$this->assign('title', 'Register');
?>

<div id="vanta-bg">
<div class="container auth-section">

    <div class="auth-card">

        <div class="logo-circle">
            👤
        </div>

        <h2 class="auth-title">
            Create New Account
        </h2>

        <?= $this->Form->create($user) ?>

        <div class="mb-3">

            <?= $this->Form->label('name','Full Name',['class'=>'form-label']) ?>

            <?= $this->Form->control('name',[
                'label'=>false,
                'class'=>'form-control',
                'placeholder'=>'Enter your full name'
            ]) ?>

        </div>

        <div class="mb-3">

            <?= $this->Form->label('student_id','Student ID',['class'=>'form-label']) ?>

            <input
            type="text",
            name="student_id",
            class="form-control",
            placeholder="Enter your student ID">

        </div>

        <div class="mb-3">

            <?= $this->Form->label('email','Email Address',['class'=>'form-label']) ?>

            <?= $this->Form->control('email',[
                'label'=>false,
                'class'=>'form-control',
                'placeholder'=>'Enter your email'
            ]) ?>

        </div>

        <div class="mb-3">

            <?= $this->Form->label('password','Password',['class'=>'form-label']) ?>

            <?= $this->Form->control('password',[
                'label'=>false,
                'class'=>'form-control',
                'placeholder'=>'Enter your password'
            ]) ?>

        </div>

        <div class="mb-4">

            <label class="form-label">
                Confirm Password
            </label>

            <input
                type="password"
                class="form-control"
                placeholder="Confirm your password"
            >

        </div>

        <?= $this->Form->button('Register',[
            'class'=>'btn btn-purple'
        ]) ?>

        <?= $this->Form->end() ?>

        <div class="auth-footer">

            Already have an account?

            <?= $this->Html->link(
                'Login Here',
                ['action'=>'login']
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