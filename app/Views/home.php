<?= $this->extend('logged') ?>

<?= $this->section('content') ?>
<?php $data = suara_partai('Karangmalang'); ?>

<div class="card mt-2 mb-4">
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
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="border_radius border p-2" style="font-weight: bold;">PDI</div>
                <ol class="list-group list-group-numbered">
                    <li class="list-group-item">A list item</li>
                    <li class="list-group-item">A list item</li>
                    <li class="list-group-item">A list item</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="progress" style="border-radius:3px;">
    <div class="progress-bar" role="progressbar" aria-label="Example with label" style="width: 25%;background-color:red;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Agus Wow</div>
</div>

<?= $this->endSection() ?>