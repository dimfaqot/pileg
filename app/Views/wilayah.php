<?= $this->extend('guest') ?>
<?php



?>
<?= $this->section('content') ?>
<div class="container">


    <div class="input-group input-group-sm">

        <button class="btn_purple dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><?= $wilayah; ?></button>
        <ul class="dropdown-menu">
            <?php foreach (wilayah_karangmalang() as $i) : ?>
                <li><a class="dropdown-item <?= ($i['text'] == $wilayah ? 'bg_purple text-white' : ''); ?>" href="<?= base_url('wilayah'); ?>/<?= $i['url']; ?>"><?= $i['text']; ?></a></li>
            <?php endforeach; ?>
        </ul>

        <a target="_blank" href="<?= base_url('wilayah/cetak_pdf'); ?>/<?= $wil; ?>" class="btn_save dropdown-toggle" type="button"><i class="fa-regular fa-file-pdf"></i> Download</a>

    </div>

    <?php foreach (rekap_seluruh_caleg('Karangmalang', $wil()) as $i) : ?>
        <table class="table table-sm">
            <thead>

                <tr>
                    <th colspan="<?= count($i['data'][0]['data']) + 1; ?>">Kecamatan: <?= $i['kecamatan']; ?></th>
                </tr>
                <tr>
                    <th colspan="<?= count($i['data'][0]['data']) + 1; ?>">Desa: <?= $i['desa']; ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $x = 0;
                $count = count($i['data']);
                $total_bawah = [];
                ?>


                <?php foreach ($i['data'] as $kd => $d) : ?>

                    <?php $total_samping = 0; ?>
                    <!-- judul -->
                    <?php if ($kd == 0) : ?>

                        <tr>
                            <th scope="row">NO. URUT</th>

                            <?php foreach ($d['data'] as $ks => $s) : ?>
                                <th><?= $s['tps']; ?></th>

                            <?php endforeach; ?>
                            <th scope="row">JUMLAH</th>
                        </tr>

                    <?php endif; ?>

                    <!-- isi -->
                    <!-- array satuan jumlah_bawah -->
                    <tr>
                        <th scope="row"><?= $d['no_urut']; ?></th>
                        <?php foreach ($d['data'] as $ks => $s) : ?>
                            <?php

                            if (!array_key_exists($s['tps_id'], $total_bawah)) {
                                //if it does not exist, create it with a value of 0
                                $total_bawah[$s['tps_id']] = 0;
                            }
                            //Add up the values from each color
                            $total_bawah[$s['tps_id']] += $s['suara'];

                            ?>

                            <!-- total samping -->
                            <?php $total_samping += $s['suara']; ?>

                            <td><?= $s['suara']; ?></td>

                        <?php endforeach; ?>
                        <th><?= $total_samping; ?></th>
                    </tr>


                <?php endforeach; ?>

                <!-- menghitung total jumlah samping -->
                <?php
                $total_bawah_samping = 0;
                foreach ($total_bawah as $tt) {
                    $total_bawah_samping += $tt;
                }
                ?>

                <!-- jumlah bawah -->
                <tr>
                    <th>JUMLAH</th>
                    <?php foreach ($total_bawah as $tb) : ?>

                        <th><?= $tb; ?></th>
                    <?php endforeach; ?>
                    <th><?= $total_bawah_samping; ?></th>
                </tr>



            </tbody>
        </table>
    <?php endforeach; ?>
</div>

<?= $this->endSection() ?>