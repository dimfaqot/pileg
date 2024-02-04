<?= $this->extend('logged') ?>

<?= $this->section('content') ?>
<?php
$db = db(menu()['tabel']);
$q = $db->get()->getResultArray();
$dapil = ['Karangmalang', 'Kedawung', 'Ngrampal'];

?>
<div class="card mt-2">
    <div class="card-body shadow shadow-sm">

        <?php if (!$q && session('role') == 'Root') : ?>
            <div class="input-group input-group-sm mb-3">
                <a href="<?= base_url(menu()['controller']); ?>/generate" class="btn_add"><i class="fa-regular fa-paper-plane"></i> Generate</a>
            </div>
        <?php endif; ?>

        <div class="input-group input-group-sm mb-2">
            <button class="btn_purple dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><?= $kecamatan; ?></button>
            <ul class="dropdown-menu">
                <?php foreach ($dapil as $i) : ?>
                    <li><a class="dropdown-item <?= ($kecamatan == $i ? 'bg_purple text-white' : ''); ?>" href="<?= base_url(url()); ?>/<?= $i; ?>/<?= $kelurahan; ?>"><?= $i; ?></a></li>
                <?php endforeach; ?>
            </ul>
            <button class="btn_save dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><?= $kelurahan; ?></button>
            <ul class="dropdown-menu">
                <?php foreach ($kelurahans as $i) : ?>
                    <li><a class="dropdown-item <?= ($i['kelurahan'] == $kelurahan ? 'bg_primary text-white' : ''); ?>" href="<?= base_url(url()); ?>/<?= $kecamatan; ?>/<?= $i['kelurahan']; ?>"><?= $i['kelurahan']; ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>

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
                        <td>Nama</td>
                        <th style="text-align: center;" scope="col">Suara</th>
                    </tr>
                </thead>
                <tbody class="tabel_search">
                    <?php foreach ($data as $k => $d) : ?>
                        <?php $rowspan = count($d['data']); ?>
                        <?php foreach ($d['data'] as $n => $i) : ?>
                            <tr>
                                <?php if ($n == 0) : ?>
                                    <td rowspan="<?= $rowspan; ?>" style="text-align: center;"><?= $i['no_partai']; ?></td>
                                    <td rowspan="<?= $rowspan; ?>"><?= $i['partai']; ?></td>
                                <?php endif; ?>
                                <td class="d-none d-md-table-cell"><?= $i['kelurahan']; ?></td>
                                <td><?= $i['tps']; ?></td>
                                <td class="d-none d-md-table-cell"><?= $i['pj']; ?></td>
                                <td><?= $i['nama']; ?></td>
                                <td contenteditable="true" class="suara" data-tabel="<?= menu()['tabel']; ?>" data-id="<?= $i['id']; ?>" style="text-align: right;"><?= $i['suara']; ?></td>
                            </tr>

                        <?php endforeach; ?>
                        <tr class="bg_light">
                            <td colspan="6" style="text-align: right;font-weight:bold;" class="d-none d-md-table-cell">TOTAL</td>
                            <td style="text-align: right;" class="d-none d-md-table-cell"><?= $d['total']; ?></td>
                            <td colspan="4" style="text-align: right;font-weight:bold;" class="d-md-none d-sm-table-cell">TOTAL</td>
                            <td style="text-align: right;" class="d-md-none d-sm-table-cell"><?= $d['total']; ?></td>
                        </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>

        <?php endif; ?>
    </div>

</div>

<?= $this->endSection() ?>