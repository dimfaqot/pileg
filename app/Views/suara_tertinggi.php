<?= $this->extend('guest') ?>

<?= $this->section('content') ?>
<?php $kecamatans = ['Karangmalang', 'Kedawung', 'Ngrampal'];
$orders = [
    ['url' => 'partai', 'text' => 'Partai PKB'],
    ['url' => 'caleg', 'text' => 'Caleg Gus Tawa']
];
$kets = [
    ['url' => 'DESC', 'text' => 'Tertinggi'],
    ['url' => 'ASC', 'text' => 'Terendah']
];
?>

<div class="container mt-2" style="margin-bottom: 100px;">
    <div class="input-group input-group-sm">
        <button class="btn_add dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><?= upper_first($order); ?></button>
        <ul class="dropdown-menu">
            <?php foreach ($orders as $i) : ?>
                <li><a class="dropdown-item <?= ($i['url'] == $order ? 'bg_purple text-white' : ''); ?>" href="<?= base_url('suara_tertinggi'); ?>/<?= $i['url']; ?>/<?= $ket; ?>/<?= $kecamatan; ?>/<?= $kelurahan; ?>"><?= $i['text']; ?></a></li>
            <?php endforeach; ?>
        </ul>
        <button class="btn_purple dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><?= $kecamatan; ?></button>
        <ul class="dropdown-menu">
            <?php foreach ($kecamatans as $i) : ?>
                <li><a class="dropdown-item <?= ($i == $kecamatan ? 'bg_purple text-white' : ''); ?>" href="<?= base_url('suara_tertinggi'); ?>/<?= $order; ?>/<?= $ket; ?>/<?= $i; ?>/<?= $kelurahan; ?>"><?= $i; ?></a></li>
            <?php endforeach; ?>
        </ul>
        <button class="btn_save dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><?= $kelurahan; ?></button>
        <ul class="dropdown-menu">
            <?php foreach (get_all_kelurahan($kecamatan) as $i) : ?>
                <li><a class="dropdown-item <?= ($kelurahan == $i['kelurahan'] ? 'bg_primary text-white' : ''); ?>" href="<?= base_url('suara_tertinggi'); ?>/<?= $order; ?>/<?= $ket; ?>/<?= $kecamatan; ?>/<?= $i['kelurahan']; ?>"><?= $i['kelurahan']; ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="input-group input-group-sm my-2">
        <?php foreach ($kets as $i) : ?>
            <a href="<?= base_url('suara_tertinggi'); ?>/<?= $order; ?>/<?= $i['url']; ?>/<?= $kecamatan; ?>/<?= $kelurahan; ?>" class="<?= ($i['url'] == $ket ? 'btn_main' : 'btn_secondary'); ?>" type="button"><?= $i['text']; ?></a>
        <?php endforeach; ?>
    </div>

    <div class="input-group input-group-sm mb-2">
        <span class="input-group-text">Cari data</span>
        <input type="text" class="form-control cari" placeholder="...">
    </div>
    <table class="table table-sm table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Kecamatan</th>
                <th scope="col">Kelurahan</th>
                <th scope="col">Tps</th>
                <th scope="col">Suara</th>
            </tr>
        </thead>
        <tbody class="tabel_search">

            <?php foreach ($data as $k => $i) : ?>
                <tr>
                    <th scope="row"><?= ($k + 1); ?></th>
                    <td><?= $i['kecamatan']; ?></td>
                    <td><?= $i['kelurahan']; ?></td>
                    <td><?= $i['tps']; ?></td>
                    <td><?= $i['suara']; ?></td>
                </tr>

            <?php endforeach; ?>

        </tbody>
    </table>
</div>

<?= $this->endSection() ?>