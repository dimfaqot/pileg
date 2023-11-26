<?= $this->extend('logged') ?>

<?= $this->section('content') ?>

<div class="card mt-2">
    <div class="card-body shadow shadow-sm">
        <div class="row g-2">
            <div class="col-md-6">
                <h4><?= session('nama'); ?></h4>
            </div>
            <div class="col-md-6">
                <h4><?= session('role'); ?></h4>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection() ?>