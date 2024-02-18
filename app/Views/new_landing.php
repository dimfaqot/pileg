<?= $this->extend('guest') ?>

<?= $this->section('content') ?>

<div class="container mt-3" style="margin-bottom: 70px;">

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
    <table class="table table-sm table-striped table-bordered">
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
                    <td><?= $i['total_suara']; ?></td>
                    <td><?= $i['pembagian']; ?></td>
                    <td><?= $i['urutan_kursi']; ?></td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>


</div>

<?= $this->endSection() ?>