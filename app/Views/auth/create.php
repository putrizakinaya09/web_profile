<?= $this->extend('layouts/auth') ?>
<?= $this->section('content') ?>
<main class="form-signin">
    <?php if (session('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif ?>
    <?php if (session('error')) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif ?>
    <form autocomplete="false" action="<?= base_url('/auth/store') ?>" method="post">
        <img class="mb-4" src="<?= base_url() ?>/assets/images/bootstrap-logo.svg" alt="" width="72" height="57">
        <h1 class="h3 mb-3 fw-normal">Please sign up</h1>
        <?php if (count($validation->getErrors())) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $validation->listErrors() ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif ?>
        <div class="form-floating">
            <input type="name" class="form-control <?= ($validation->hasError('name')) ? 'is-invalid' : '' ?>" id="name" name="name" placeholder="Tatia Naya">
            <label for="name">Name</label>
        </div>
        <div class="form-floating">
            <input type="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : '' ?>" id="email" name="email" placeholder="tatia@example.com">
            <label for="email">Email address</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>" id="password" name="password" placeholder="Password">
            <label for="password">Password</label>
        </div>
        <div class="form-floating mb-2">
            <input type="password" class="form-control <?= ($validation->hasError('retype-password')) ? 'is-invalid' : '' ?>" id="retype-password" name="retype-password" placeholder="Re-type Password">
            <label for="retype-password">Re-type Password</label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign up</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2022</p>
    </form>
</main>

<script>
    window.setTimeout(function() {
        $(".alert").fadeOut(2000, 0).slideUp(500, function() {
            $(this).remove()
        })
    }, 2000)
</script>

<?= $this->endSection() ?>
</html>