<?= $this->extend('logged') ?>

<?= $this->section('content') ?>

<div class="d-flex gap-3">
    <div class="dropdown my-3">
        <a class="btn btn_purple dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php foreach ($data['tps'] as $i) : ?>
                <?php $exp = explode(" ", $i['tps']); ?>
                <?= (url(4) == '' && $exp[0] == 1 ? $i['tps'] : (url(4) !== '' && $exp[0] == url(4) ? $i['tps'] : '')); ?>
            <?php endforeach; ?>
        </a>

        <ul class="dropdown-menu">
            <?php foreach ($data['tps'] as $i) : ?>
                <?php $exp = explode(" ", $i['tps']); ?>
                <li style="font-size: small;"><a class="dropdown-item <?= (url(4) == '' && $exp[0] == 1 ? 'btn_purple border_radius' : (url(4) !== '' && $exp[0] == url(4) ? 'btn_purple border_radius' : '')); ?>" href="<?= base_url(url()); ?>/<?= $exp[0]; ?>"><?= $i['tps']; ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div style="padding-top: 20px;font-weight:bold;">
        <?php foreach ($data['tps'] as $i) : ?>
            <?php $exp = explode(" ", $i['tps']); ?>
            <?= (url(4) == '' && $exp[0] == 1 ? 'Kel. ' . $i['kelurahan'] . ', Dk. ' . $i['alamat'] . ', Pj. ' . $i['pj'] : (url(4) !== '' && $exp[0] == url(4) ? 'Kel. ' . $i['kelurahan'] . ', Dk. ' . $i['alamat'] . ', Pj. ' . $i['pj'] : '')); ?>
        <?php endforeach; ?>
    </div>
</div>


<input class="form-control form-control-sm cari_partai" type="text" placeholder="Cari partai...">

<div class="row g-2">
    <?php foreach ($data['partai'] as $p) : ?>
        <?php $total_suara = $p['suara']; ?>
        <div class="col-md-4 body_cari_partai" data-partai="<?= $p['partai']; ?>">
            <div class="card mt-2">
                <div class="card-body shadow shadow-sm">
                    <div class="p-2 <?= ($p['partai'] == 'Golkar' ? '' : 'text-white'); ?> d-flex justify-content-between" style="background-color: <?= $p['color']; ?>;font-weight:bold;">
                        <div><?= $p['no_partai']; ?> <?= strtoupper($p['partai']); ?></div>
                        <div contenteditable="true" data-id="<?= $p['id']; ?>" class="px-3 border_radius update_suara_partai angka_suara_partai" style="border: 1px solid white;"><?= angka($p['suara']); ?></div>
                    </div>
                    <table class="table">
                        <tbody>
                            <?php foreach ($data['caleg'] as $i) : ?>
                                <?php if ($p['partai_id'] == $i['partai_id']) : ?>
                                    <?php $total_suara += $i['suara']; ?>
                                    <tr>
                                        <th><?= $i['no_caleg']; ?></th>
                                        <th><?= $i['nama']; ?></th>
                                        <td contenteditable="true" style="text-align: right;" class="update_suara_caleg angka_suara_caleg" data-id="<?= $i['id']; ?>"><?= angka($i['suara']); ?></td>
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

<?= $this->endSection() ?>