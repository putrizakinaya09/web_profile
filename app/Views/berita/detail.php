<?= $this->extend('layouts/layout') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <h1 class="text-center"><?= $articles->title ?></h1>
    <div class="row my-5">
        <div class="col-md-12">
            <?= $articles->content ?>
        </div>
    </div>

</div>
<?= $this->endSection() ?>