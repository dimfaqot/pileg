<?= $this->extend('guest') ?>

<?= $this->section('content') ?>

<?php
$wilayahs = ['Eksternal', 'Internal', 'All'];
$kelurahans = explode(",", sub_wilayah($sub_wilayah)['wilayah']);

?>

<div class="container mt-4">
    <div class="input-group input-group-sm">
        <button class="btn_purple dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><?= str_replace("_", " ", $sub_wilayah); ?></button>
        <ul class="dropdown-menu">
            <?php foreach (sub_wilayah() as $i) : ?>
                <li style="font-size: small;"><a class="dropdown-item <?= ($sub_wilayah == $i['url'] ? 'bg_purple text-white' : ''); ?>" href="<?= base_url('kirka/sub_wilayah'); ?>/<?= $i['url']; ?>/<?= $kelurahan; ?>/<?= $wilayah; ?>"><?= $i['text']; ?></a></li>
            <?php endforeach; ?>
        </ul>
        <button class="btn_save dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><?= $kelurahan; ?></button>
        <ul class="dropdown-menu">
            <?php foreach ($kelurahans as $i) : ?>
                <li style="font-size: small;"><a class="dropdown-item <?= ($i == $kelurahan ? 'bg_primary text-white' : ''); ?>" href="<?= base_url('kirka/sub_wilayah'); ?>/<?= $sub_wilayah; ?>/<?= $i; ?>/<?= $wilayah; ?>"><?= $i; ?></a></li>
            <?php endforeach; ?>
        </ul>
        <button class="btn_save dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><?= $wilayah; ?></button>
        <ul class="dropdown-menu">
            <?php foreach ($wilayahs as $i) : ?>
                <li style="font-size: small;"><a class="dropdown-item <?= ($i == $wilayah ? 'bg_primary text-white' : ''); ?>" href="<?= base_url('kirka/sub_wilayah'); ?>/<?= $sub_wilayah; ?>/<?= $kelurahan; ?>/<?= $i; ?>"><?= $i; ?></a></li>
            <?php endforeach; ?>
        </ul>

        <a target="_blank" href="<?= base_url('kirka/download'); ?>/<?= $sub_wilayah; ?>/<?= $kelurahan; ?>/<?= $wilayah; ?>" class="btn_save"><i class="fa-regular fa-file-pdf"></i> Download</a>
    </div>
</div>

<table class="table table-sm table-bordered mt-3">
    <thead>
        <tr>
            <th style="text-align: center;" scope="col">TPS</th>
            <th style="text-align: center;" scope="col">KORDES</th>
            <th style="text-align: center;" scope="col">PENGKIRKA <span style="font-style: italic;">(Int/Eks)</span></th>
            <th style="text-align: center;" scope="col">KONSTITUEN</th>
            <th style="text-align: center;" scope="col">NIK</th>
            <th style="text-align: center;" scope="col">DUKUH</th>
            <th style="text-align: center;" scope="col">RT</th>
            <th style="text-align: center;" scope="col">JUMLAH</th>
            <th style="text-align: center;" scope="col">KIRKA</th>
            <th style="text-align: center;" scope="col">JIWA</th>
            <th style="text-align: center;" scope="col">PARTAI</th>
            <th style="text-align: center;" scope="col">%</th>
            <th style="text-align: center;" scope="col">KOMPETITOR</th>
        </tr>
    </thead>

    <!-- rowspan tps, dukuh, jumlah, total, jiwa, partai, dan % dari total konstituen -->
    <!-- rowspan dukuh dari total konstituen di dukuh tersebut -->
    <!-- rowspan rt dari total konstituen di rt tersebut -->
    <!-- rowspan kordes dari total konstituen di bawah kordes tersebut -->
    <!-- rowspan pengkirka dari total konstituen di bawah pengkirka tersebut -->
    <tbody>
        <?php
        $tps_done = [];
        ?>
        <?php foreach (tps($kelurahan) as $i) : ?>
            <?php
            $total_konstituen = total_konstituen($kelurahan, $i['no_tps'], $wilayah);
            $kordes = kordes($kelurahan, $i['no_tps'], $wilayah);
            $kordes_done = [];
            ?>

            <?php foreach ($kordes as $k) : ?>
                <?php

                $pengkirka = pengkirka($kelurahan, $i['no_tps'], $k['kordes'], $wilayah);
                $konstituen_by_kordes = konstituen_by_kordes($kelurahan, $i['no_tps'], $k['kordes'], $wilayah);

                $pengkirka_done = [];
                ?>

                <?php foreach ($pengkirka as $p) : ?>
                    <?php
                    $konstituen = konstituen($kelurahan, $i['no_tps'], $k['kordes'], $p['pengkirka'], $wilayah);
                    ?>

                    <?php foreach ($konstituen as $ks) : ?>
                        <tr>
                            <?php if (!in_array($i['no_tps'], $tps_done)) : ?>
                                <td scope="row" rowspan="<?= $total_konstituen; ?>" style="text-align:center;"><?= $i['no_tps']; ?></td>
                            <?php endif; ?>

                            <?php if (!in_array($k['kordes'], $kordes_done)) : ?>
                                <td scope="row" rowspan="<?= $konstituen_by_kordes; ?>"><?= $k['kordes']; ?></td>
                                <?php $kordes_done[] = $k['kordes']; ?>
                            <?php endif; ?>

                            <?php if (!in_array($p['pengkirka'], $pengkirka_done)) : ?>
                                <td scope="row" rowspan="<?= count($konstituen); ?>"><?= $p['pengkirka']; ?> <span style="font-style: italic;">(<?= ($p['wilayah'] == 'Internal' ? 'Int' : 'Eks'); ?>)</span></td>
                            <?php endif; ?>

                            <td scope="row"><?= $ks['nama_konstituen']; ?></td>
                            <td scope="row"><?= $ks['nik']; ?></td>
                            <td scope="row"><?= $ks['dukuh']; ?></td>
                            <td scope="row"><?= $ks['rt']; ?></td>

                            <?php if (!in_array($p['pengkirka'], $pengkirka_done)) : ?>
                                <td scope="row" rowspan="<?= count($konstituen); ?>" style="text-align:center;"><?= count($konstituen); ?></td>
                                <?php $pengkirka_done[] = $p['pengkirka']; ?>
                            <?php endif; ?>

                            <?php if (!in_array($i['no_tps'], $tps_done)) : ?>

                                <td scope="row" rowspan="<?= $total_konstituen; ?>" style="text-align:center;"><?= $total_konstituen; ?></td>
                                <td scope="row" rowspan="<?= $total_konstituen; ?>" style="text-align:center;"><?= suara_jiwa($i['id'])['suara']; ?></td>
                                <td scope="row" rowspan="<?= $total_konstituen; ?>" style="text-align:center;"><?= suara_pkb($i['id'])['suara']; ?></td>
                                <td scope="row" rowspan="<?= $total_konstituen; ?>" style="text-align:center;"><?= round(((suara_jiwa($i['id'])['suara'] + suara_pkb($i['id'])['suara']) / $total_konstituen) * 100); ?>%</td>
                                <td scope="row" rowspan="<?= $total_konstituen; ?>">
                                    <?php foreach (kompetitor($i['id']) as $kp) : ?>
                                        <?= $kp['nama']; ?> (<?= $kp['suara']; ?>)<br>
                                    <?php endforeach; ?>
                                </td>

                                <?php $tps_done[] = $i['no_tps']; ?>
                            <?php endif; ?>


                        </tr>
                    <?php endforeach; ?>

                <?php endforeach; ?>


            <?php endforeach; ?>
        <?php endforeach; ?>


        <!-- <tr>
            <th scope="row" rowspan="6" style="vertical-align: middle;text-align:center;">1</th>
            <th scope="row" rowspan="6" style="vertical-align: middle;text-align:center;">Srimulyo</th>
            <th scope="row" rowspan="6" style="vertical-align: middle;text-align:center;">1</th>
            <th scope="row" rowspan="3" style="vertical-align: middle;text-align:center;">Joko</th>
            <th scope="row" rowspan="2" style="vertical-align: middle;text-align:center;">Fajar</th>
            <th scope="row" style="vertical-align: middle;text-align:center;">Ismail</th>
            <th scope="row" rowspan="2" style="vertical-align: middle;text-align:center;">2</th>
            <th scope="row" rowspan="6" style="vertical-align: middle;text-align:center;">6</th>
            <th scope="row" rowspan="6" style="vertical-align: middle;text-align:center;">10</th>
            <th scope="row" rowspan="6" style="vertical-align: middle;text-align:center;">10</th>
            <th scope="row" rowspan="6" style="vertical-align: middle;text-align:center;">10%</th>
        </tr>
        <tr>
            <th scope="row" style="vertical-align: middle;text-align:center;">Dimas</th>
        </tr>
        <tr>
            <th scope="row" rowspan="2" style="vertical-align: middle;text-align:center;">Ibnu</th>
            <th scope="row" style="vertical-align: middle;text-align:center;">Damar</th>
            <th scope="row" rowspan="2" style="vertical-align: middle;text-align:center;">2</th>
        </tr>
        <tr>
            <th scope="row" rowspan="3" style="vertical-align: middle;text-align:center;">Aguseh</th>
            <th scope="row" style="vertical-align: middle;text-align:center;">Jo</th>
        </tr>
        <tr>
            <th scope="row" rowspan="2" style="vertical-align: middle;text-align:center;">Ihsan</th>
            <th scope="row" style="vertical-align: middle;text-align:center;">Ikmal</th>
            <th scope="row" rowspan="2" style="vertical-align: middle;text-align:center;">2</th>
        </tr>
        <tr>
            <th scope="row" style="vertical-align: middle;text-align:center;">Jesika</th>
        </tr> -->

    </tbody>
</table>

<?= $this->endSection() ?>