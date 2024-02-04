<?= $this->extend('guest') ?>

<?= $this->section('content') ?>
<?php $kec = ['Karangmalang', 'Kedawung', 'Ngrampal']; ?>
<?php $kecamatan = (url(4) == '' ? 'Karangmalang' : url(4)); ?>
<?php $kelurahan = get_default_kelurahan($kecamatan, url(5)); ?>
<div class="container mt-2">
    <div class="input-group input-group-sm">
        <button class="btn_purple dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><?= $kecamatan; ?></button>
        <ul class="dropdown-menu">
            <?php foreach ($kec as $i) : ?>
                <li><a class="dropdown-item <?= (url(4) == '' && $i == 'Karangmalang' ? 'bg_purple text-white' : (url(4) !== '' && url(4) == $i ? 'bg_purple text-white' : '')); ?>" href="<?= base_url(url()); ?>/<?= $i; ?>/<?= (url(5) == '' ? 'Plumbungan' : url(5)); ?>"><?= $i; ?></a></li>
            <?php endforeach; ?>
        </ul>
        <button class="btn_save dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><?= $kelurahan; ?></button>
        <ul class="dropdown-menu">
            <?php foreach (get_all_kelurahan($kecamatan) as $i) : ?>
                <li><a class="dropdown-item <?= (url(5) == '' && $i['kelurahan'] == 'Plumbungan' ? 'bg_primary text-white' : (url(5) !== '' && url(5) == $i['kelurahan'] ? 'bg_primary text-white' : '')); ?>" href="<?= base_url(url()); ?>/<?= (url(4) == '' ? 'Karangmalang' : url(4)); ?>/<?= $i['kelurahan']; ?>"><?= $i['kelurahan']; ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="row g-2">
        <?php foreach (get_all_partai() as $p) : ?>
            <?php $total_suara = 0; ?>
            <?php $total_suara += get_suara_by_kelurahan('partai', $p['id'], $kecamatan, $kelurahan); ?>
            <div class="col-md-4 body_cari_partai" data-partai="<?= $p['partai']; ?>">
                <div class="card mt-2">
                    <div class="card-body shadow shadow-sm">
                        <div class="p-2 <?= ($p['partai'] == 'Golkar' ? '' : 'text-white'); ?> d-flex justify-content-between" style="background-color: <?= $p['color']; ?>;font-weight:bold;">
                            <div><?= $p['no_partai']; ?> <?= strtoupper($p['partai']); ?></div>
                            <div class="px-3 border_radius" style="border: 1px solid white;"><?= angka(get_suara_by_kelurahan('partai', $p['id'], $kecamatan, $kelurahan)); ?></div>
                        </div>
                        <table class="table">
                            <tbody>
                                <?php foreach (get_all_caleg() as $i) : ?>
                                    <?php if ($p['id'] == $i['partai_id']) : ?>
                                        <?php $total_suara += get_suara_by_kelurahan('caleg', $i['id'], $kecamatan, $kelurahan); ?>
                                        <tr>
                                            <th><?= $i['no_caleg']; ?></th>
                                            <th><?= $i['nama']; ?></th>
                                            <td style="text-align: right;"><?= get_suara_by_kelurahan('caleg', $i['id'], $kecamatan, $kelurahan); ?></td>
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