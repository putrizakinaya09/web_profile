<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= ucfirst($uri->getSegment(2)) ?? '' ?></h1>
    
</div>


<?= $this->endSection() ?>