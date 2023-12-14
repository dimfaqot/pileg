<?= $this->extend('guest') ?>

<?= $this->section('content') ?>

<div class="container" style="margin-bottom: 70px;">
    <div class="row g-2">
        <?php foreach (get_all_partai() as $p) : ?>
            <?php $total_suara = 0; ?>
            <?php $total_suara += total_suara('partai', $p['id']); ?>
            <div class="col-md-4 body_cari_partai" data-partai="<?= $p['partai']; ?>">
                <div class="card mt-2">
                    <div class="card-body shadow shadow-sm">
                        <div class="p-2 <?= ($p['partai'] == 'Golkar' ? '' : 'text-white'); ?> d-flex justify-content-between" style="background-color: <?= $p['color']; ?>;font-weight:bold;">
                            <div><?= $p['no_partai']; ?> <?= strtoupper($p['partai']); ?></div>
                            <div class="px-3 border_radius" style="border: 1px solid white;"><?= angka(total_suara('partai', $p['id'])); ?></div>
                        </div>
                        <table class="table">
                            <tbody>
                                <?php foreach (get_all_caleg() as $i) : ?>
                                    <?php if ($p['id'] == $i['partai_id']) : ?>
                                        <?php $total_suara += total_suara('caleg', $i['id']); ?>
                                        <tr>
                                            <th><?= $i['no_caleg']; ?></th>
                                            <th><?= $i['nama']; ?></th>
                                            <td style="text-align: right;"><?= total_suara('caleg', $i['id']); ?></td>
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