<?= $this->extend('guest') ?>

<?= $this->section('content') ?>
<?php $kecamatans = ['Karangmalang', 'Kedawung', 'Ngrampal'];

$kets = [
    ['url' => 'sudah', 'text' => 'C1 Sudah Masuk'],
    ['url' => 'belum', 'text' => 'C1 Belum Masuk']
];
?>

<div class="container mt-2" style="margin-bottom: 100px;">
    <div class="input-group input-group-sm">
        <button class="btn_purple dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><?= $kecamatan; ?></button>
        <ul class="dropdown-menu">
            <?php foreach ($kecamatans as $i) : ?>
                <li><a class="dropdown-item <?= ($i == $kecamatan ? 'bg_purple text-white' : ''); ?>" href="<?= base_url('c1_belum_masuk'); ?>/<?= $i; ?>/<?= $kelurahan; ?>/<?= $ket; ?>"><?= $i; ?></a></li>
            <?php endforeach; ?>
        </ul>
        <button class="btn_save dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><?= $kelurahan; ?></button>
        <ul class="dropdown-menu">
            <?php foreach (get_all_kelurahan($kecamatan) as $i) : ?>
                <li><a class="dropdown-item <?= ($kelurahan == $i['kelurahan'] ? 'bg_primary text-white' : ''); ?>" href="<?= base_url('c1_belum_masuk'); ?>/<?= $kecamatan; ?>/<?= $i['kelurahan']; ?>/<?= $ket; ?>"><?= $i['kelurahan']; ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="input-group input-group-sm my-2">
        <?php foreach ($kets as $i) : ?>
            <a href="<?= base_url('c1_belum_masuk'); ?>/<?= $kecamatan; ?>/<?= $kelurahan; ?>/<?= $i['url']; ?>" class="<?= ($i['url'] == $ket ? 'btn_add' : 'btn_secondary'); ?>" type="button"><?= $i['text']; ?></a>
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
                <th scope="col">C1</th>
            </tr>
        </thead>
        <tbody class="tabel_search">
            <?php foreach ($data as $k => $i) : ?>
                <tr>
                    <th scope="row"><?= ($k + 1); ?></th>
                    <td><?= $i['tps']; ?></td>
                    <td><?= $i['pj']; ?></td>
                    <td style="text-align: right;"><a href="" class="zoom" data-url="<?= base_url('files'); ?>/c1/<?= $i['c1']; ?>"><i class="fa-regular fa-image"></i></a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>