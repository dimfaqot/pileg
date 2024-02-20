<!DOCTYPE html>
<html>

<head>
    <style>
        table {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            font-size: 10px;
        }

        td,
        th {
            border: 1px solid #8e959c;
            text-align: left;
            padding: 4px;
            font-size: 10px;
        }

        tr:nth-child(even) {
            background-color: #f5faff;
        }
    </style>
</head>

<body>
    <div style="font-size:10px;font-weight:bold;">KECAMATAN: <?= strtoupper($data['kecamatan']); ?></div>
    <div style="font-size:10px;font-weight:bold;">KELURAHAN: <?= strtoupper($data['kelurahan']); ?></div>

    <table style="margin-top: 15px;">
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
            <?php foreach ($data['data_tps'] as $t) : ?>
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

</body>

</html>