<?= $this->extend('guest') ?>
<?php
$kecamatans = ['Karangmalang', 'Kedawung', 'Ngrampal'];


?>
<?= $this->section('content') ?>
<div class="container">
    <?php foreach (rekap_seluruh_caleg() as $i) : ?>
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
                                <th><?= 'TPS ' . $ks + 1; ?></th>

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