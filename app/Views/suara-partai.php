<?= $this->extend('logged') ?>

<?= $this->section('content') ?>
<?php
$db = db(menu()['tabel']);
$q = $db->get()->getResultArray();
$dapil = ['Karangmalang', 'Kedawung', 'Ngrampal', 'All'];

?>
<div class="card mt-2">
    <div class="card-body shadow shadow-sm">

        <?php if (!$q && session('role') == 'Root') : ?>
            <div class="input-group input-group-sm mb-3">
                <a href="<?= base_url(menu()['controller']); ?>/generate" class="btn_add"><i class="fa-regular fa-paper-plane"></i> Generate</a>
            </div>
        <?php endif; ?>

        <?php foreach ($dapil as $i) : ?>
            <div class="form-check-inline form-check form-switch">
                <input class="form-check-input dapil" name="dapil" data-url="<?= base_url(menu()['controller']); ?>/<?= $i; ?>" type="radio" role="switch" <?= (url(4) == '' && $i == 'Karangmalang' ? 'checked' : (url(4) !== '' && url(4) == $i ? 'checked' : '')); ?>>
                <label class="form-check-label"><?= $i; ?></label>
            </div>
        <?php endforeach; ?>

        <?php if ($count == 0) : ?>
            <div class="mt-2 body_warning"><i class="fa-solid fa-circle-exclamation"></i> Data not found!.</div>
        <?php else : ?>
            <div class="input-group input-group-sm mb-1">
                <span class="input-group-text">Cari data</span>
                <input type="text" class="form-control cari" placeholder="...">
            </div>
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th style="text-align: center;" scope="col">#</th>
                        <th style="text-align: center;" scope="col">Partai</th>
                        <td class="d-none d-md-table-cell">Kel</td>
                        <td>Tps</td>
                        <td class="d-none d-md-table-cell">Pj</td>
                        <th style="text-align: center;" scope="col">Suara</th>
                    </tr>
                </thead>
                <tbody class="tabel_search">
                    <?php foreach ($data as $k => $d) : ?>
                        <?php foreach ($d['data'] as $i) : ?>
                            <tr>
                                <td style="text-align: center;"><?= $i['no_partai']; ?></td>
                                <td><?= $i['partai']; ?></td>
                                <td class="d-none d-md-table-cell"><?= $i['kelurahan']; ?></td>
                                <td><?= $i['tps']; ?></td>
                                <td class="d-none d-md-table-cell"><?= $i['pj']; ?></td>
                                <td contenteditable="true" class="suara" data-tabel="<?= menu()['tabel']; ?>" data-id="<?= $i['id']; ?>" style="text-align: right;"><?= $i['suara']; ?></td>
                            </tr>

                        <?php endforeach; ?>
                        <tr class="bg_light">
                            <td colspan="5" style="text-align: right;font-weight:bold;" class="d-none d-md-table-cell">TOTAL</td>
                            <td style="text-align: right;" class="d-none d-md-table-cell"><?= $d['total']; ?></td>
                            <td colspan="3" style="text-align: right;font-weight:bold;" class="d-md-none d-sm-table-cell">TOTAL</td>
                            <td style="text-align: right;" class="d-md-none d-sm-table-cell"><?= $d['total']; ?></td>
                        </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>

        <?php endif; ?>
    </div>

</div>

<?= $this->endSection() ?>