<!DOCTYPE html>
<html>

<head>
    <style>
        table {
            border-collapse: collapse;
        }

        td,
        th {
            border: 1px solid black;
            font-size: 12px;
            padding: 4px;
        }
    </style>
</head>

<body>
    <div style="font-size:12px;font-weight:bold;text-align:center;"><?= $judul; ?></div>

    <table style="margin-top:20px;width:100%">
        <thead>
            <tr>
                <th style="text-align: center;">TPS</th>
                <th style="text-align: center;">NAMA</th>
                <th style="text-align: center;">RT</th>
                <th style="text-align: center;">DUKUH</th>
                <th style="text-align: center;">KELURAHAN</th>
                <th style="text-align: center;">KECAMATAN</th>
                <th style="text-align: center;">WILAYAH</th>
                <th style="text-align: center;">SUB WILAYAH</th>
                <th style="text-align: center;">DIVISI</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $db = db('kirka');
            $q = $db->limit(500)->get()->getResultArray();

            ?>

            <?php foreach ($q as $i) : ?>
                <tr>
                    <td><?= $i['tps']; ?></td>
                    <td><?= $i['nama_konstituen']; ?></td>
                    <td><?= $i['rt']; ?></td>
                    <td><?= $i['dukuh']; ?></td>
                    <td><?= $i['kelurahan']; ?></td>
                    <td><?= $i['kecamatan']; ?></td>
                    <td><?= $i['wilayah']; ?></td>
                    <td><?= $i['sub_wilayah']; ?></td>
                    <td><?= $i['divisi']; ?></td>
                </tr>

            <?php endforeach; ?>

        </tbody>
    </table>

</body>

</html>