<?= $this->extend('guest') ?>

<?= $this->section('content') ?>

<div class="container mt-3" style="margin-bottom: 70px;">
    <div class="row g-2">
        <div class="col-md-6">
            <div class="card bg_success_light">
                <div class="card-body">
                    <h5><i class="fa-solid fa-chart-line"></i> TARGET SUARA PKB</h5>
                    <a target="_blank" href="<?= base_url(); ?>bytps" class="card" style="border-radius:15px; text-decoration:none;color:unset;">
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
                    <a target="_blank" href="<?= base_url(); ?>bytps" href="" class="card" style="border-radius:15px;text-decoration:none;color:unset;font-size:15px;">
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
                    <a target="_blank" href="<?= base_url(); ?>suara_belum_masuk" class="card" style="border-radius:15px; text-decoration:none;color:unset;">
                        <?php $persen = round((((jumlah_tps() - count(suara_belum_masuk('partai'))) / jumlah_tps()) * 100), 2); ?>

                        <div class="card-body p-0" style="border-radius:10px;background:linear-gradient(to right, #12a6d7 <?= $persen; ?>%, white <?= $persen; ?>%);">
                            <div class="d-flex p-2">
                                <div style="width: <?= ($persen > 40 ? $persen : '40'); ?>%;" class="<?= ($persen > 40 ? 'text-white' : ''); ?>">
                                    <h6>Jml. Tps <?= angka(jumlah_tps()); ?> (<?= $persen; ?>%)</h6>
                                    <h6>Suara Masuk <?= angka(jumlah_tps() - count(suara_belum_masuk('partai'))); ?> Tps (
                                        <?php
                                        $val = jumlah_tps() - (jumlah_tps() - count(suara_belum_masuk('partai')));


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
                    <a target="_blank" href="<?= base_url(); ?>c1_belum_masuk" href="" class="card" style="border-radius:15px;text-decoration:none;color:unset;font-size:15px;">
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

    </div>
</div>

<?= $this->endSection() ?>