<?= $this->extend('guest') ?>

<?= $this->section('content') ?>
<?php $kec = ['Karangmalang', 'Kedawung', 'Ngrampal']; ?>
<div class="container">
    <div class="dropdown my-3">
        <a class="btn btn_purple dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php foreach ($kec as $i) : ?>
                <?= (url(4) == '' && $i == 'Karangmalang' ? $i : (url(4) !== '' && $i == url(4) ? $i : '')); ?>
            <?php endforeach; ?>
        </a>

        <ul class="dropdown-menu">
            <?php foreach ($kec as $i) : ?>
                <li style="font-size: small;"><a class="dropdown-item <?= (url(4) == '' && $i == 'Karangmalang' ? 'btn_purple border_radius' : (url(4) !== '' && $i == url(4) ? 'btn_purple border_radius' : '')); ?>" href="<?= base_url(url()); ?>/<?= $i; ?>"><?= $i; ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="row g-2">
        <?php $kecamatan = (url(4) == '' ? 'Karangmalang' : url(4)); ?>
        <?php foreach (get_all_partai() as $p) : ?>
            <?php $total_suara = 0; ?>
            <?php $total_suara += get_suara_by_kecamatan('partai', $p['id'], $kecamatan); ?>
            <div class="col-md-4 body_cari_partai" data-partai="<?= $p['partai']; ?>">
                <div class="card mt-2">
                    <div class="card-body shadow shadow-sm">
                        <div class="p-2 <?= ($p['partai'] == 'Golkar' ? '' : 'text-white'); ?> d-flex justify-content-between" style="background-color: <?= $p['color']; ?>;font-weight:bold;">
                            <div><?= $p['no_partai']; ?> <?= strtoupper($p['partai']); ?></div>
                            <div class="px-3 border_radius" style="border: 1px solid white;"><?= angka(get_suara_by_kecamatan('partai', $p['id'], $kecamatan)); ?></div>
                        </div>
                        <table class="table">
                            <tbody>
                                <?php foreach (get_all_caleg() as $i) : ?>
                                    <?php if ($p['id'] == $i['partai_id']) : ?>
                                        <?php $total_suara += get_suara_by_kecamatan('caleg', $i['id'], $kecamatan); ?>
                                        <tr>
                                            <th><?= $i['no_caleg']; ?></th>
                                            <th><?= $i['nama']; ?></th>
                                            <td style="text-align: right;"><?= get_suara_by_kecamatan('caleg', $i['id'], $kecamatan); ?></td>
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