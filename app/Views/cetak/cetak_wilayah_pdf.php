<!DOCTYPE html>
<html>

<head>
    <style>
        table {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            font-size: 12px;
        }

        td,
        th {
            border: 1px solid #8e959c;
            text-align: left;
            padding: 8px;
            font-size: 12px;
        }

        tr:nth-child(even) {
            background-color: #f5faff;
        }
    </style>
</head>

<body>
    <div style="font-size:12px;font-weight:bold;">KECAMATAN: <?= strtoupper($data['kecamatan']); ?></div>
    <div style="font-size:12px;font-weight:bold;">KELURAHAN: <?= strtoupper($data['desa']); ?></div>
    <br>
    <table>



        <?php $x = 0;
        $count = count($data['data']);
        $total_bawah = [];
        $tps_id = [];
        ?>


        <?php foreach ($data['data'] as $kd => $d) : ?>

            <?php $total_samping = 0; ?>
            <!-- judul -->
            <?php if ($kd == 0) : ?>

                <tr>
                    <th style="text-align:center;width:120px;" scope="row">CALEG | TPS</th>

                    <?php foreach ($d['data'] as $ks => $s) : ?>
                        <?php if (!in_array($s['tps_id'], $tps_id)) {
                            $tps_id[] = $s['tps_id'];
                        }
                        ?>
                        <th style="text-align: center;"><?= explode(" ", $s['tps'])[1]; ?></th>

                    <?php endforeach; ?>
                    <th style="text-align: center;" scope="row">JUMLAH</th>
                </tr>

            <?php endif; ?>

            <!-- isi -->
            <!-- array satuan jumlah_bawah -->
            <tr>
                <th style="text-align:center;" scope="row"><?= $d['no_urut']; ?></th>
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

                    <td style="text-align: right;"><?= $s['suara']; ?></td>

                <?php endforeach; ?>
                <th style="text-align: right;"><?= $total_samping; ?></th>
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
            <th style="text-align: center;">JUMLAH</th>
            <?php foreach ($total_bawah as $tb) : ?>
                <th style="text-align: right;"><?= $tb; ?></th>
            <?php endforeach; ?>
            <th style="text-align: right;"><?= $total_bawah_samping; ?></th>
        </tr>
        <tr>
            <th style="text-align: center;">KIRKA</th>
            <?php $total_kirka = 0; ?>
            <?php foreach ($tps_id as $i) : ?>
                <?php $total_kirka += get_tps_by_id($i)['kirka']; ?>
                <td style="text-align: right;"><?= get_tps_by_id($i)['kirka']; ?></td>
            <?php endforeach; ?>
            <th style="text-align: right;"><?= angka($total_kirka); ?></th>
        </tr>
        <tr>
            <th style="text-align: center;">DPT</th>
            <?php $total_dpt = 0; ?>
            <?php foreach ($tps_id as $i) : ?>
                <?php $total_dpt += get_tps_by_id($i)['dpt']; ?>
                <td style="text-align: right;"><?= get_tps_by_id($i)['dpt']; ?></td>
            <?php endforeach; ?>
            <th style="text-align: right;"><?= angka($total_dpt); ?></th>
        </tr>

    </table>

</body>

</html>