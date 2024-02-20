<?= $this->extend('guest') ?>

<?= $this->section('content') ?>


<div class="container mt-3" style="margin-bottom: 100px;">
    <div class="input-group input-group-sm mb-3">

        <button class="btn_purple dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><?= upper_first(str_replace("_", " ", $kecamatan)); ?></button>
        <ul class="dropdown-menu">
            <?php foreach (wilayah_karangmalang() as $i) : ?>
                <li><a class="dropdown-item <?= ($i['text'] == $kecamatan ? 'bg_purple text-white' : ''); ?>" href="<?= base_url('suara_partai_dan_suara_jiwa'); ?>/<?= $i['url']; ?>"><?= $i['text']; ?></a></li>
            <?php endforeach; ?>
        </ul>

        <a target="_blank" href="<?= base_url('suara_partai_dan_suara_jiwa/cetak_pdf'); ?>/<?= $kecamatan; ?>" class="btn_save dropdown-toggle" type="button"><i class="fa-regular fa-file-pdf"></i> Download</a>

    </div>

    <?php foreach ($data as $i) : ?>
        <table>
            <tr>
                <td style="width: 100px;">KECAMATAN</td>
                <td>:</td>
                <th><?= strtoupper($i['kecamatan']); ?></th>
            </tr>
            <tr>
                <td style="width: 100px;">KELURAHAN</td>
                <td>:</td>
                <th><?= strtoupper($i['kelurahan']); ?></th>
            </tr>
        </table>


        <table class="table table-sm table-striped table-bordered">
            <thead>
                <tr>
                    <th style="text-align: center;" scope="col">TPS</th>
                    <th style="text-align: center;" scope="col">DPT</th>
                    <th style="text-align: center;" scope="col">KIRKA</th>
                    <th style="text-align: center;" scope="col">SUARA JIWA</th>
                    <th style="text-align: center;" scope="col">SUARA PKB</th>
                    <th style="text-align: center;" scope="col">SUARA JIWA + SUARA PKB</th>
                    <th style="text-align: center;" scope="col">SELISIH (KIRKA - TOTAL SUARA)</th>
                    <th style="text-align: center;" scope="col">MENTES (TOTAL SUARA / KIRKA X 100)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $dpt = 0;
                $kirka = 0;
                $suara_jiwa = 0;
                $suara_partai = 0;

                ?>
                <?php foreach ($i['data_tps'] as $t) : ?>
                    <?php
                    $dpt += $t['dpt'];
                    $kirka += $t['kirka'];
                    $suara_jiwa += $t['suara_jiwa'];
                    $suara_partai += $t['suara_partai'];
                    ?>

                    <tr>
                        <th style="text-align: center;" scope="row"><?= $t['no_tps']; ?></th>
                        <td style="text-align: right;"><?= angka($t['dpt']); ?></td>
                        <th style="text-align: right;"><?= angka($t['kirka']); ?></th>
                        <td style="text-align: right;"><?= angka($t['suara_jiwa']); ?></td>
                        <td style="text-align: right;"><?= angka($t['suara_partai']); ?></td>
                        <th style="text-align: right;"><?= angka($t['total_suara']); ?></th>
                        <th style="text-align: right;"><?= angka($t['selisih']); ?></th>
                        <th style="text-align: right;"><?= $t['persen']; ?>%</th>
                    </tr>


                <?php endforeach; ?>
                <tr>
                    <th scope="row">TOTAL</th>
                    <th style="text-align: right;"><?= angka($dpt); ?></th>
                    <th style="text-align: right;"><?= angka($kirka); ?></th>
                    <th style="text-align: right;"><?= angka($suara_jiwa); ?></th>
                    <th style="text-align: right;"><?= angka($suara_partai); ?></th>
                    <th style="text-align: right;"><?= angka($suara_jiwa + $suara_partai); ?></th>
                    <th style="text-align: right;"><?= angka($kirka - ($suara_jiwa + $suara_partai)); ?></th>
                    <?php if ($kirka == 0) : ?>
                        <th style="text-align: right;"><?= $suara_jiwa + $suara_partai; ?>%</th>

                    <?php else : ?>
                        <?php if (($suara_jiwa + $suara_partai) == 0) : ?>
                            <th style="text-align: right;">-<?= $kirka; ?>%</th>
                        <?php else : ?>
                            <th style="text-align: right;"><?= round((($suara_jiwa + $suara_partai) / $kirka) * 100); ?>%</th>

                        <?php endif; ?>

                    <?php endif; ?>
                </tr>

            </tbody>
        </table>

    <?php endforeach; ?>
</div>

<?= $this->endSection() ?>