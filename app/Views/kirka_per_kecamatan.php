<?= $this->extend('guest') ?>

<?= $this->section('content') ?>
<?php $kecs = ['Karangmalang', 'Kedawung', 'Ngrampal']; ?>
<div class="container">
    <div class="dropdown my-3">
        <a class="btn btn_purple dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?= $kec; ?>
        </a>
        <ul class="dropdown-menu">
            <?php foreach ($kecs as $i) : ?>
                <li style="font-size: small;"><a class="dropdown-item <?= ($i == $kec ? 'btn_purple border_radius' : ''); ?>" href="<?= base_url('kirka_per_kecamatan'); ?>/<?= $i; ?>"><?= $i; ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>

    <table class="table table-bordered table-stripped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Kelurahan</th>
                <th scope="col">Kirka</th>
                <th scope="col">Suara</th>
                <th scope="col">Selisih</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total_kirka = 0;
            $total_suara = 0;
            $total_selisih = 0;
            ?>
            <?php foreach ($data as $k => $i) : ?>
                <?php
                $total_kirka += $i['total_kirka'];
                $total_suara += $i['total_suara'];
                $total_selisih += ($i['total_kirka'] - $i['total_suara']);
                ?>
                <tr>
                    <th scope="row"><?= $k + 1; ?></th>
                    <td><?= $i['kelurahan']; ?></td>
                    <td style="text-align: right;"><?= angka($i['total_kirka']); ?></td>
                    <td style="text-align: right;"><?= angka($i['total_suara']); ?></td>
                    <td style="text-align: right;"><?= angka($i['total_kirka'] - $i['total_suara']); ?></td>
                </tr>


            <?php endforeach; ?>
            <tr>
                <th style="text-align: center;" colspan="2">TOTAL</th>
                <th style="text-align: right;"><?= angka($total_kirka); ?></th>
                <th style="text-align: right;"><?= angka($total_suara); ?></th>
                <th style="text-align: right;"><?= angka($total_selisih); ?></th>
            </tr>

        </tbody>
    </table>

</div>

<?= $this->endSection() ?>