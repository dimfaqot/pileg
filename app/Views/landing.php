<?= $this->extend('guest') ?>

<?= $this->section('content') ?>

<div class="container mt-3" style="margin-bottom: 70px;">
    <?php if (settings()['mode'] == 0) : ?>
        <div class="row g-2 mb-3">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="input-group mb-2">
                            <span style="font-size: small; width:150px;" class="input-group-text">DPT</span>
                            <input style="font-size: small;" type="text" class="form-control form-control-sm" value="<?= angka($data['total_dpt']); ?>" readonly>
                        </div>
                        <div class="input-group mb-2">
                            <span style="font-size: small; width:150px;" class="input-group-text">PEMILIH</span>
                            <input style="font-size: small;" type="text" class="form-control form-control-sm" value="<?= angka($data['total_pemilih']); ?>" readonly>
                        </div>
                        <div class="input-group mb-2">
                            <span style="font-size: small; width:150px;" class="input-group-text">KEIKUTSERTAAN</span>
                            <input style="font-size: small;" type="text" class="form-control form-control-sm" value="<?= round(($data['total_pemilih'] / $data['total_dpt']) * 100); ?>%" readonly>
                        </div>
                        <div class="input-group mb-2">
                            <span style="font-size: small; width:150px;" class="input-group-text">JUMLAH KURSI</span>
                            <input style="font-size: small;" type="text" class="form-control form-control-sm" value="<?= jml_kursi(); ?>" readonly>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="input-group mb-2">
                            <span style="font-size: small; width:150px;" class="input-group-text">KIRKA</span>
                            <input style="font-size: small;" type="text" class="form-control form-control-sm" value="<?= angka($data['total_kirka']); ?>" readonly>
                        </div>
                        <div class="input-group mb-2">
                            <span style="font-size: small; width:150px;" class="input-group-text">SUARA JIWA</span>
                            <input style="font-size: small;" type="text" class="form-control form-control-sm" value="<?= angka($data['total_suara_jiwa']); ?>" readonly>
                        </div>
                        <div class="input-group mb-2">
                            <span style="font-size: small; width:150px;" class="input-group-text">SUARA PKB</span>
                            <input style="font-size: small;" type="text" class="form-control form-control-sm" value="<?= angka($data['total_suara_pkb']); ?>" readonly>
                        </div>
                        <div class="input-group mb-2">
                            <span style="font-size: small; width:150px;" class="input-group-text">SUARA PKB + CALEG</span>
                            <input style="font-size: small;" type="text" class="form-control form-control-sm" value="<?= angka($data['total_suara_caleg_pkb'] + $data['total_suara_pkb']); ?>" readonly>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="input-group mb-2">
                            <span style="font-size: small; width:150px;" class="input-group-text">ELEKTABILITAS PKB</span>
                            <input style="font-size: small;" type="text" class="form-control form-control-sm" value="<?= round((($data['total_suara_pkb'] + $data['total_suara_caleg_pkb']) / $data['total_kirka']) * 100); ?>%" readonly>
                        </div>
                        <div class="input-group mb-2">
                            <span style="font-size: small; width:150px;" class="input-group-text">ELEKTABILITAS JIWA</span>
                            <input style="font-size: small;" type="text" class="form-control form-control-sm" value="<?= round(($data['total_suara_jiwa'] / $data['total_kirka']) * 100); ?>%" readonly>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <table class="table table-sm table-striped table-bordered mb-3">
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
        <h6 style="font-size: small;">TOTAL SUARA (KLIK UNTUK DETAIL)</h6>
        <a href="<?= base_url('total_suara'); ?>" class="progress my-2">
            <?php foreach (per_kecamatan() as $i) : ?>
                <div class="progress-bar <?= $i['bg']; ?>" role="progressbar" aria-label="<?= $i['segment']; ?>" style="width: <?= $i['persen']; ?>%" aria-valuenow="<?= $i['persen']; ?>" aria-valuemin="0" aria-valuemax="100"><?= $i['kec']; ?> (<?= angka($i['suara']); ?>)</div>
            <?php endforeach; ?>
        </a>


        <h6 style="font-size: small;">KIRKA VS JIWA (TOTAL KIRKA <?= angka(kirka_vs_jiwa()['total_kirka']); ?> - <?= angka(kirka_vs_jiwa()['suara']); ?> = <?= angka(kirka_vs_jiwa()['total_kirka'] - kirka_vs_jiwa()['suara']); ?>)</h6>
        <a href="<?= base_url(); ?>suara_tertinggi/caleg/DESC/Karangmalang/Plumbungan" class="progress my-2">
            <div class="progress-bar bg-success" role="progressbar" aria-label="Segment one" style="width: <?= kirka_vs_jiwa()['persen']; ?>%" aria-valuenow="<?= kirka_vs_jiwa()['persen']; ?>" aria-valuemin="0" aria-valuemax="100">Suara <?= angka(kirka_vs_jiwa()['suara']); ?> (<?= kirka_vs_jiwa()['persen']; ?>%)</div>
            <div class="progress-bar bg-secondary" role="progressbar" aria-label="Segment two" style="width: <?= 100 - kirka_vs_jiwa()['persen']; ?>%" aria-valuenow="<?= 100 - kirka_vs_jiwa()['persen']; ?>" aria-valuemin="0" aria-valuemax="100">Kirka <?= angka(kirka_vs_jiwa()['total_kirka'] - kirka_vs_jiwa()['suara']); ?> (<?= 100 - kirka_vs_jiwa()['persen']; ?>%)</div>
        </a>
        <div class="row g-2 mt-2">
            <div class="col-md-6">
                <div class="card bg_success_light">
                    <div class="card-body">
                        <h5><i class="fa-solid fa-chart-line"></i> TARGET SUARA PKB (TANPA CALEG)</h5>
                        <a href="<?= base_url(); ?>bytps" class="card" style="border-radius:15px; text-decoration:none;color:unset;">
                            <?php $persen = round((total_suara_pkb() / target_suara('partai')) * 100, 2); ?>
                            <div class="card-body p-0" style="border-radius:10px;background:linear-gradient(to right, #00ae00 <?= $persen; ?>%, white <?= $persen; ?>%);">
                                <div class="d-flex p-2">
                                    <div style="width: <?= ($persen > 40 ? $persen : '40'); ?>%;" class="<?= ($persen > 40 ? 'text-white' : ''); ?>">
                                        <h6>Target <?= angka(target_suara('partai')); ?> (<?= $persen; ?>%)</h6>
                                        <h6>Suara saat ini <?= angka(total_suara_pkb()); ?> (
                                            <?php
                                            $val = target_suara('partai') - total_suara_pkb();


                                            if ($val == 0) {
                                                echo '0';
                                            } elseif ($val < 0) {
                                                echo '+' . angka(str_replace("-", "", $val));
                                            } else {
                                                echo '-' . angka($val);
                                            }
                                            ?>
                                            )</h6>

                                    </div>
                                    <div style="width: 30%;">
                                        <h6 style="text-align: center;" class="<?= ($persen >= 90 ? 'text-white' : ''); ?>">
                                            <?php
                                            $val = 100 - $persen;

                                            if ($val == 0) {
                                                echo '0%';
                                            } elseif ($val < 0) {
                                                echo '+' . str_replace("-", "", $val) . '%';
                                            } else {
                                                echo '-' . $val . '%';
                                            }
                                            ?>
                                        </h6>
                                    </div>

                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card bg_purple_light">
                    <div class="card-body">
                        <h5><i class="fa-solid fa-chart-gantt"></i> TARGET SUARA JIWA</h5>
                        <a href="<?= base_url(); ?>bytps" href="" class="card" style="border-radius:15px;text-decoration:none;color:unset;font-size:15px;">
                            <?php $persen = round((total_suara_mustawa() / target_suara('jiwa')) * 100, 2); ?>
                            <div class="card-body p-0" style="border-radius:10px;background:linear-gradient(to right, #cc4cd1 <?= $persen; ?>%, white <?= $persen; ?>%);">
                                <div class="d-flex p-2">
                                    <div style="width: <?= ($persen > 40 ? $persen : '40'); ?>%;" class="<?= ($persen > 40 ? 'text-white' : ''); ?>">
                                        <h6>Target <?= angka(target_suara('jiwa')); ?> (<?= $persen; ?>%)</h6>
                                        <h6>Suara saat ini <?= angka(total_suara_mustawa()); ?> (
                                            <?php
                                            $val = target_suara('jiwa') - total_suara_mustawa();


                                            if ($val == 0) {
                                                echo '0';
                                            } elseif ($val < 0) {
                                                echo '+' . angka(str_replace("-", "", $val));
                                            } else {
                                                echo '-' . angka($val);
                                            }
                                            ?>
                                            )</h6>

                                    </div>
                                    <div style="width: 30%;">
                                        <h6 style="text-align: center;" class="<?= ($persen >= 90 ? 'text-white' : ''); ?>">
                                            <?php
                                            $val = 100 - $persen;

                                            if ($val == 0) {
                                                echo '0%';
                                            } elseif ($val < 0) {
                                                echo '+' . str_replace("-", "", $val) . '%';
                                            } else {
                                                echo '-' . $val . '%';
                                            }
                                            ?>
                                        </h6>
                                    </div>

                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card bg_main_light">
                    <div class="card-body">
                        <h5><i class="fa-solid fa-clock-rotate-left"></i> SUARA BELUM MASUK</h5>
                        <a href="<?= base_url(); ?>suara_belum_masuk" class="card" style="border-radius:15px; text-decoration:none;color:unset;">
                            <?php $persen = round(((count(suara_belum_masuk('partai', null, null, 'sudah')) / jumlah_tps()) * 100), 2); ?>

                            <div class="card-body p-0" style="border-radius:10px;background:linear-gradient(to right, #12a6d7 <?= $persen; ?>%, white <?= $persen; ?>%);">
                                <div class="d-flex p-2">
                                    <div style="width: <?= ($persen > 40 ? $persen : '40'); ?>%;" class="<?= ($persen > 40 ? 'text-white' : ''); ?>">
                                        <h6>Jml. Tps <?= angka(jumlah_tps()); ?> (<?= $persen; ?>%)</h6>
                                        <h6>Suara Masuk <?= angka(count(suara_belum_masuk('partai', null, null, 'sudah'))); ?> Tps (
                                            <?php
                                            $val = jumlah_tps() - count(suara_belum_masuk('partai', null, null, 'sudah'));


                                            if ($val == 0) {
                                                echo '0';
                                            } elseif ($val < 0) {
                                                echo '+' . angka(str_replace("-", "", $val));
                                            } else {
                                                echo '-' . angka($val);
                                            }
                                            ?>
                                            )</h6>

                                    </div>
                                    <div style="width: 30%;">
                                        <h6 style="text-align: center;" class="<?= ($persen >= 90 ? 'text-white' : ''); ?>">
                                            <?php
                                            $val = 100 - $persen;

                                            if ($val == 0) {
                                                echo '0%';
                                            } elseif ($val < 0) {
                                                echo '+' . str_replace("-", "", $val) . '%';
                                            } else {
                                                echo '-' . $val . '%';
                                            }
                                            ?>
                                        </h6>
                                    </div>

                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card bg_warning_light">
                    <div class="card-body">
                        <h5><i class="fa-regular fa-file"></i> C1 BELUM MASUK</h5>
                        <a href="<?= base_url(); ?>c1_belum_masuk" href="" class="card" style="border-radius:15px;text-decoration:none;color:unset;font-size:15px;">
                            <?php $persen = round((count(c1_belum_masuk(null, null, 'sudah')) / jumlah_tps()) * 100, 2); ?>
                            <div class="card-body p-0" style="border-radius:10px;background:linear-gradient(to right, #ddb71f <?= $persen; ?>%, white <?= $persen; ?>%);">
                                <div class="d-flex p-2">
                                    <div style="width: <?= ($persen > 40 ? $persen : '40'); ?>%;" class="<?= ($persen > 40 ? 'text-white' : ''); ?>">
                                        <h6>Jml. Tps <?= jumlah_tps(); ?> (<?= $persen; ?>%)</h6>
                                        <h6>C1 Masuk <?= angka(count(c1_belum_masuk(null, null, 'sudah'))); ?> Tps (
                                            <?php
                                            $val = jumlah_tps() - count(c1_belum_masuk(null, null, 'sudah'));


                                            if ($val == 0) {
                                                echo '0';
                                            } elseif ($val < 0) {
                                                echo '+' . angka(str_replace("-", "", $val));
                                            } else {
                                                echo '-' . angka($val);
                                            }
                                            ?>
                                            )</h6>

                                    </div>
                                    <div style="width: 30%;">
                                        <h6 style="text-align: center;" class="<?= ($persen >= 90 ? 'text-white' : ''); ?>">
                                            <?php
                                            $val = 100 - $persen;

                                            if ($val == 0) {
                                                echo '0%';
                                            } elseif ($val < 0) {
                                                echo '+' . str_replace("-", "", $val) . '%';
                                            } else {
                                                echo '-' . $val . '%';
                                            }
                                            ?>
                                        </h6>
                                    </div>

                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card bg_pink_light">
                    <div class="card-body">
                        <h5><i class="fa-solid fa-ranking-star"></i> SUARA TERTINGGI PARTAI</h5>
                        <a href="<?= base_url(); ?>suara_tertinggi/partai/DESC/Karangmalang/Plumbungan" class="card" style="border-radius:15px; text-decoration:none;color:unset;">

                            <div class="card-body p-2">
                                <table class="table table-sm table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Kelurahan</th>
                                            <th scope="col">Tps</th>
                                            <th scope="col">Kirka</th>
                                            <th scope="col">Suara</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach (suara_tertinggi('partai', 'DESC') as $k => $i) : ?>
                                            <?php if ($k < 10) : ?>
                                                <tr>
                                                    <th scope="row"><?= $k + 1; ?></th>
                                                    <td><?= $i['kelurahan']; ?></td>
                                                    <td><?= $i['tps']; ?></td>
                                                    <td><?= $i['kirka']; ?></td>
                                                    <td><?= $i['suara']; ?></td>
                                                </tr>
                                            <?php endif; ?>

                                        <?php endforeach; ?>

                                    </tbody>
                                </table>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card bg_primary_light">
                    <div class="card-body">
                        <h5><i class="fa-solid fa-chart-simple"></i> SUARA TERTINGGI JIWA</h5>
                        <a href="<?= base_url(); ?>suara_tertinggi/caleg/DESC/Karangmalang/Plumbungan" class="card" style="border-radius:15px; text-decoration:none;color:unset;">

                            <div class="card-body p-2">
                                <table class="table table-sm table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Kelurahan</th>
                                            <th scope="col">Tps</th>
                                            <th scope="col">Kirka</th>
                                            <th scope="col">Suara</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach (suara_tertinggi('caleg') as $k => $i) : ?>
                                            <?php if ($k < 10) : ?>
                                                <tr>
                                                    <th scope="row"><?= $k + 1; ?></th>
                                                    <td><?= $i['kelurahan']; ?></td>
                                                    <td><?= $i['tps']; ?></td>
                                                    <td><?= $i['kirka']; ?></td>
                                                    <td><?= $i['suara']; ?></td>
                                                </tr>
                                            <?php endif; ?>

                                        <?php endforeach; ?>

                                    </tbody>
                                </table>
                            </div>
                        </a>
                    </div>
                </div>
            </div>


        </div>
    <?php else : ?>
        <img width="40%" src="<?= base_url(); ?>jiwa.jpg" class="rounded mx-auto d-block" alt="JIWA">

    <?php endif; ?>
</div>

<?= $this->endSection() ?>