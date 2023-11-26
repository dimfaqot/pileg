<?= $this->extend('logged') ?>

<?= $this->section('content') ?>

<div class="card mt-2">
    <div class="card-body shadow shadow-sm">

        <div class="input-group input-group-sm mb-3">
            <button data-bs-toggle="modal" data-bs-target="#add_<?= menu()['controller']; ?>" class="btn_add"><i class="fa-solid fa-circle-plus"></i> <?= menu()['menu']; ?></button>

        </div>



        <div class="modal fade" id="add_<?= menu()['controller']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="d-flex justify-content-between px-4 py-3">
                            <div class="judul_modal">
                                <i class="<?= menu()['icon']; ?>"></i> <?= menu()['menu']; ?>
                            </div>
                            <a href="" type="button" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i></a>
                        </div>
                        <div class="px-4 pb-3">
                            <form action="<?= base_url(menu()['controller']); ?>/add" method="post">
                                <input type="hidden" name="url" value="<?= base_url(menu()['controller']); ?>">
                                <div class="form-floating mb-3">
                                    <input type="text" name="tps" class="form-control" placeholder="Kategori" required>
                                    <label>Nama Tps</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" name="alamat" class="form-control" placeholder="Alamat" required>
                                    <label>Dukuh/Rt/Rw</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" name="kecamatan" class="form-control indonesia add_kecamatan" data-order="add" data-col="kecamatan" data-indonesia_id="3314" data-id="" placeholder="Kecamatan" required>
                                    <label>Kecamatan</label>
                                    <ul class="p-1 dropdown-menu body_add_kecamatan" style="font-size:small;">

                                    </ul>


                                    <div class="body_feedback_add_kecamatan invalid-feedback"></div>
                                </div>

                                <div class="form-floating mb-3 add_kelurahan">

                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" name="pj" class="form-control" placeholder="Saksi">
                                    <label>Saksi</label>
                                </div>
                                <div class="text-center mt-4">
                                    <button type="submit" href="" class="btn_save"><i class="fa-solid fa-circle-check"></i> Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if (count($data) == 0) : ?>
            <div class="mt-2 body_warning"><i class="fa-solid fa-circle-exclamation"></i> Data not found!.</div>
        <?php else : ?>
            <div class="input-group input-group-sm mb-1">
                <span class="input-group-text">Cari data</span>
                <input type="text" class="form-control cari" placeholder="...">
            </div>
            <table class="table table-sm table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="text-align: center;" scope="col">#</th>
                        <th style="text-align: center;" scope="col">Tps</th>
                        <th class="d-none d-md-table-cell">Alamat</th>
                        <th class="d-none d-md-table-cell" style="text-align: center;" scope="col">Kecamatan</th>
                        <th style="text-align: center;" scope="col">Kelurahan</th>
                        <th style="text-align: center;" scope="col">Saksi</th>
                        <th style="text-align: center;" scope="col">Act</th>
                    </tr>
                </thead>
                <tbody class="tabel_search">

                    <?php foreach ($data as $k => $i) : ?>
                        <tr>
                            <td style="text-align: center;"><?= ($k + 1); ?></td>
                            <td><?= $i['tps']; ?></td>
                            <td class="d-none d-md-table-cell"><?= $i['alamat']; ?></td>
                            <td class="d-none d-md-table-cell"><?= $i['kecamatan']; ?></td>
                            <td><?= $i['kelurahan']; ?></td>
                            <td><?= $i['pj']; ?></td>
                            <td style="text-align: center;">
                                <div class="d-flex justify-content-center gap-2">
                                    <div class="btn_act_main" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit data."><a href="" data-bs-toggle="modal" data-bs-target="#detail_<?= $i['id']; ?>" style="font-size: medium;"><i class="fa-solid fa-circle-info text_main"></i></a></div>
                                    <div class="btn_act_danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete data"><a href="" class="confirm" data-id="<?= $i['id']; ?>" data-message="Are you sure?" data-controller="<?= menu()['controller']; ?>" data-tabel="<?= menu()['tabel']; ?>" data-method="delete" style="font-size: medium;"><i class="fa-solid fa-circle-xmark text_danger"></i></a></div>
                                </div>
                            </td>
                        </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>

            <?php foreach ($data as $i) : ?>
                <div class="modal fade" id="detail_<?= $i['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="d-flex justify-content-between px-4 py-3">
                                    <div class="judul_modal">
                                        <i class="<?= menu()['icon']; ?>"></i> <?= $i['tps']; ?>
                                    </div>
                                    <a href="" type="button" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i></a>
                                </div>
                                <div class="px-4 pb-3">
                                    <form action="<?= base_url(menu()['controller']); ?>/update" method="post">
                                        <input type="hidden" name="id" value="<?= $i['id']; ?>">
                                        <input type="hidden" name="url" value="<?= base_url(menu()['controller']); ?>">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="tps" value="<?= $i['tps']; ?>" class="form-control" placeholder="Nama Tps" required>
                                            <label>Nama Tps</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" name="alamat" value="<?= $i['alamat']; ?>" class="form-control" placeholder="Alamat" required>
                                            <label>Dukuh/Rt/Rw</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" name="kecamatan" value="<?= $i['kecamatan']; ?>" class="form-control indonesia update_kecamatan_<?= $i['id']; ?>" data-order="update" data-col="kecamatan" data-indonesia_id="3314" data-id="<?= $i['id']; ?>" placeholder="Kecamatan" required>
                                            <label>Kecamatan</label>
                                            <ul class="p-1 dropdown-menu body_update_kecamatan_<?= $i['id']; ?>" style="font-size:small;">

                                            </ul>


                                            <div class="body_feedback_update_kecamatan_<?= $i['id']; ?> invalid-feedback"></div>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="text" name="kelurahan" value="<?= $i['kelurahan']; ?>" class="form-control indonesia update_kelurahan_<?= $i['id']; ?>" data-order="update" data-col="kelurahan" data-indonesia_id="" data-id="<?= $i['id']; ?>" placeholder="Kelurahan">
                                            <label>Kelurahan</label>
                                            <ul class="p-1 dropdown-menu body_update_kelurahan_<?= $i['id']; ?>" style="font-size:small;">

                                            </ul>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" name="pj" value="<?= $i['pj']; ?>" class="form-control" placeholder="Pj" required>
                                            <label>Pj</label>
                                        </div>


                                        <div class="text-center mt-4">
                                            <button type="submit" href="" class="btn_save"><i class="fa-solid fa-circle-check"></i> Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>

        <?php endif; ?>
    </div>

</div>

<?= $this->endSection() ?>