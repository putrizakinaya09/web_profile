<?= $this->extend('layouts/auth') ?>
<?= $this->section('content') ?>
<main class="form-signin">
    <form autocomplete="false" action="<?= base_url('/auth/login') ?>" method="post">
        <img class="mb-4" src="<?= base_url() ?>/assets/images/bootstrap-logo.svg" alt="" width="72" height="57">
        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
        <?php if (count($validation->getErrors())) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $validation->listErrors() ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif ?>
        <div class="form-floating">
            <input value="<?= old('email') ?>" type="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : '' ?>" id="email" name="email" placeholder="tatia@example.com">
            <label for="email">Email address</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>" id="password" name="password" placeholder="Password">
            <label for="password">Password</label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2022</p>
    </form>
</main>

<?= $this->endSection() ?>