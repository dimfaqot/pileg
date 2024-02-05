<?= $this->extend('guest') ?>

<?= $this->section('content') ?>
<?php $kecamatans = ['Karangmalang', 'Kedawung', 'Ngrampal'];
$orders = [
    ['url' => 'partai', 'text' => 'Partai PKB'],
    ['url' => 'caleg', 'text' => 'Caleg Gus Tawa']
];
$kets = [
    ['url' => 'sudah', 'text' => 'Suara Masuk'],
    ['url' => 'belum', 'text' => 'Suara Belum Masuk']
];
?>

<div class="container mt-2" style="margin-bottom: 100px;">
    <div class="input-group input-group-sm">
        <button class="btn_add dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><?= upper_first($order); ?></button>
        <ul class="dropdown-menu">
            <?php foreach ($orders as $i) : ?>
                <li><a class="dropdown-item <?= ($i['url'] == $order ? 'bg_purple text-white' : ''); ?>" href="<?= base_url('suara_belum_masuk'); ?>/<?= $i['url']; ?>/<?= $kecamatan; ?>/<?= $kelurahan; ?>/<?= $ket; ?>"><?= $i['text']; ?></a></li>
            <?php endforeach; ?>
        </ul>
        <button class="btn_purple dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><?= $kecamatan; ?></button>
        <ul class="dropdown-menu">
            <?php foreach ($kecamatans as $i) : ?>
                <li><a class="dropdown-item <?= ($i == $kecamatan ? 'bg_purple text-white' : ''); ?>" href="<?= base_url('suara_belum_masuk'); ?>/<?= $order; ?>/<?= $i; ?>/<?= $kelurahan; ?>/<?= $ket; ?>"><?= $i; ?></a></li>
            <?php endforeach; ?>
        </ul>
        <button class="btn_save dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><?= $kelurahan; ?></button>
        <ul class="dropdown-menu">
            <?php foreach (get_all_kelurahan($kecamatan) as $i) : ?>
                <li><a class="dropdown-item <?= ($kelurahan == $i['kelurahan'] ? 'bg_primary text-white' : ''); ?>" href="<?= base_url('suara_belum_masuk'); ?>/<?= $order; ?>/<?= $kecamatan; ?>/<?= $i['kelurahan']; ?>/<?= $ket; ?>"><?= $i['kelurahan']; ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="input-group input-group-sm my-2">
        <?php foreach ($kets as $i) : ?>
            <a href="<?= base_url('suara_belum_masuk'); ?>/<?= $order; ?>/<?= $kecamatan; ?>/<?= $kelurahan; ?>/<?= $i['url']; ?>" class="<?= ($i['url'] == $ket ? 'btn_add' : 'btn_secondary'); ?>" type="button"><?= $i['text']; ?></a>
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
                <th scope="col">Tps</th>
                <th scope="col">Saksi</th>
                <th scope="col">Suara</th>
            </tr>
        </thead>
        <tbody class="tabel_search">
            <?php $total = 0; ?>
            <?php foreach ($data as $k => $i) : ?>
                <?php $total += $i['suara']; ?>
                <tr>
                    <th scope="row"><?= ($k + 1); ?></th>
                    <td><?= $i['tps']; ?></td>
                    <td><?= $i['pj']; ?></td>
                    <td style="text-align: right;"><?= $i['suara']; ?></td>
                </tr>

            <?php endforeach; ?>
            <?php if ($ket == 'sudah') : ?>
                <tr>
                    <th style="text-align: center;" scope="row" colspan="3">TOTAL</th>
                    <th style="text-align: right;" scope="row"><?= $total; ?></th>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>