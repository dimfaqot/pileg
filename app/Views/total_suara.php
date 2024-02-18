<?= $this->extend('guest') ?>

<?= $this->section('content') ?>


<div class="container mt-2" style="margin-bottom: 100px;">
    <h1 class="bg_main text-white border_radius py-2 px-3"><?= strtoupper($judul); ?> PKB</h1>
    <table class="table table-bordered table-striped" style="font-size: 18px;">
        <thead>
            <tr>
                <th style="text-align: center;" scope="col">#</th>
                <th style="text-align: center;" scope="col">Kecamatan</th>
                <th style="text-align: center;" scope="col">Kirka</th>
                <th style="text-align: center;" scope="col">Suara Jiwa</th>
                <th style="text-align: center;" scope="col">Suara Partai</th>
                <th style="text-align: center;" scope="col">Suara Partai Dari Seluruh Caleg</th>
                <th style="text-align: center;" scope="col">Jumlah (Suara Partai + Suara Seluruh Caleg)</th>
            </tr>
        </thead>
        <tbody>
            <?php $total_partai = 0;
            $total_partai_caleg = 0;
            $total_kirka = 0;
            $total_jiwa = 0; ?>
            <?php foreach (per_kecamatan() as $k => $i) : ?>
                <?php $total_partai += $i['partai'];
                $total_kirka += $i['total_kirka'];
                $total_partai_caleg += $i['partai_caleg'];
                $total_jiwa += $i['jiwa']; ?>
                <tr>
                    <th scope="row"><?= $k + 1; ?></th>
                    <td><?= $i['kec']; ?></td>
                    <td style="text-align: right;"><?= angka($i['total_kirka']); ?></td>
                    <td style="text-align: right;"><?= angka($i['jiwa']); ?></td>
                    <td style="text-align: right;"><?= angka($i['partai']); ?></td>
                    <td style="text-align: right;"><?= angka($i['partai_caleg']); ?></td>
                    <td style="text-align: right;"><?= angka($i['partai'] + $i['partai_caleg']); ?></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <th style="text-align: center;" scope="row" colspan="2">TOTAL</th>
                <th style="text-align: right;"><?= angka($total_kirka); ?></th>
                <th style="text-align: right;"><?= angka($total_jiwa); ?></th>
                <th style="text-align: right;"><?= angka($total_partai); ?></th>
                <th style="text-align: right;"><?= angka($total_partai_caleg); ?></th>
                <th style="text-align: right;"><?= angka($total_partai + $total_partai_caleg); ?></th>
            </tr>
        </tbody>
    </table>

    <h2 class="bg_main text-white p-2 border_radius">TOTAL SUARA PARTAI</h2>
    <div class="card mt-2">
        <canvas id="myChartPartai"></canvas>
    </div>

    <table class="table table-sm table-striped table-bordered mt-3">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Partai</th>
                <th scope="col">Suara</th>
                <th scope="col">Pembagian</th>
                <th scope="col">Urutan Kursi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['kursi'] as $k => $i) : ?>

                <tr>
                    <th scope="row"><?= $k + 1; ?></th>
                    <td><?= $i['partai']; ?></td>
                    <td><?= angka($i['total_suara']); ?></td>
                    <td><?= $i['pembagian']; ?></td>
                    <td><?= $i['urutan_kursi']; ?></td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>