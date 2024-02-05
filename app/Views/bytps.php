<?= $this->extend('guest') ?>

<?= $this->section('content') ?>
<?php $kecamatans = ['Karangmalang', 'Kedawung', 'Ngrampal']; ?>
<div class="container mt-2">
    <div class="input-group input-group-sm">
        <button class="btn_purple dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><?= $kecamatan; ?></button>
        <ul class="dropdown-menu">
            <?php foreach ($kecamatans as $i) : ?>
                <li><a class="dropdown-item <?= ($i == $kecamatan ? 'bg_purple text-white' : ''); ?>" href="<?= base_url(url()); ?>/<?= $i; ?>/<?= $kelurahan; ?>/<?= $tps['id']; ?>"><?= $i; ?></a></li>
            <?php endforeach; ?>
        </ul>
        <button class="btn_save dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><?= $kelurahan; ?></button>
        <ul class="dropdown-menu">
            <?php foreach (get_all_kelurahan($kecamatan) as $i) : ?>
                <li><a class="dropdown-item <?= ($kelurahan == $i['kelurahan'] ? 'bg_primary text-white' : ''); ?>" href="<?= base_url(url()); ?>/<?= $kecamatan; ?>/<?= $i['kelurahan']; ?>/<?= $tps['id']; ?>"><?= $i['kelurahan']; ?></a></li>
            <?php endforeach; ?>
        </ul>
        <button class="btn_add dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><?= get_detail_tps($tps)['tps']; ?></button>
        <ul class="dropdown-menu">
            <?php foreach (get_all_tps($kecamatan, $kelurahan) as $i) : ?>
                <li><a class="dropdown-item <?= ($tps['id'] == $i['id']  ? 'bg_success text-white' : ''); ?>" href="<?= base_url(url()); ?>/<?= $kecamatan; ?>/<?= $kelurahan; ?>/<?= $i['id']; ?>"><?= $i['tps']; ?></a></li>
            <?php endforeach; ?>
        </ul>
        <button class="border_radius">Saksi: <?= get_detail_tps($tps)['pj']; ?></button>
    </div>

    <div class="d-grid mt-2">
        <a href="" data-url="<?= base_url(); ?>files/c1/<?= $tps['c1']; ?>" class="zoom btn btn-sm <?= ($tps['c1'] == 'file-not-found.jpg' ? 'btn_light' : 'btn_add'); ?>"><i class="fa-solid fa-image"></i> Dokumen C1</a>

    </div>
    <div class="row g-2">
        <?php foreach (get_all_partai() as $p) : ?>

            <?php $total_suara = 0; ?>
            <?php $total_suara += get_suara_by_tps('partai', $p['id'], $kecamatan, $kelurahan, $tps); ?>
            <div class="col-md-4 body_cari_partai" data-partai="<?= $p['partai']; ?>">
                <div class="card mt-2">
                    <div class="card-body shadow shadow-sm">
                        <div class="p-2 <?= ($p['partai'] == 'Golkar' ? '' : 'text-white'); ?> d-flex justify-content-between" style="background-color: <?= $p['color']; ?>;font-weight:bold;">
                            <div><?= $p['no_partai']; ?> <?= strtoupper($p['partai']); ?></div>
                            <div class="px-3 border_radius" style="border: 1px solid white;"><?= angka(get_suara_by_tps('partai', $p['id'], $kecamatan, $kelurahan, $tps)); ?></div>
                        </div>
                        <table class="table">
                            <tbody>
                                <?php foreach (get_all_caleg() as $i) : ?>
                                    <?php if ($p['id'] == $i['partai_id']) : ?>
                                        <?php $total_suara += get_suara_by_tps('caleg', $i['id'], $kecamatan, $kelurahan, $tps); ?>
                                        <tr>
                                            <th><?= $i['no_caleg']; ?></th>
                                            <th><?= $i['nama']; ?></th>
                                            <td style="text-align: right;"><?= get_suara_by_tps('caleg', $i['id'], $kecamatan, $kelurahan, $tps); ?></td>
                                        </tr>

                                    <?php endif; ?>

                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-between bg_purple text-white p-2">
                            <div style="font-weight: bold;">TOTAL</div>
                            <div class="px-3" style="font-weight: bold;"><?= angka($total_suara); ?></div>
                        </div>

                    </div>

                </div>
            </div>

        <?php endforeach; ?>
    </div>
</div>

<?= $this->endSection() ?>