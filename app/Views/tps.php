<?= $this->extend('logged') ?>

<?= $this->section('content') ?>
<?php
$dapil = ['Karangmalang', 'Kedawung', 'Ngrampal'];
?>
<div class="card mt-2">
    <div class="card-body shadow shadow-sm">

        <?php if (session('role') == 'Root') : ?>

            <div class="input-group input-group-sm mb-3">
                <button data-bs-toggle="modal" data-bs-target="#add_<?= menu()['controller']; ?>" class="btn_add"><i class="fa-solid fa-circle-plus"></i> <?= menu()['menu']; ?></button>

            </div>

            <div class="input-group input-group-sm mb-2">
                <button class="btn_purple dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><?= $kecamatan; ?></button>
                <ul class="dropdown-menu">
                    <?php foreach ($dapil as $i) : ?>
                        <li><a class="dropdown-item <?= ($kecamatan == $i ? 'bg_purple text-white' : ''); ?>" href="<?= base_url(url()); ?>/<?= $i; ?>/<?= $kelurahan; ?>"><?= $i; ?></a></li>
                    <?php endforeach; ?>
                </ul>
                <button class="btn_save dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><?= $kelurahan; ?></button>
                <ul class="dropdown-menu">
                    <?php foreach ($kelurahans as $i) : ?>
                        <li><a class="dropdown-item <?= ($i['kelurahan'] == $kelurahan ? 'bg_primary text-white' : ''); ?>" href="<?= base_url(url()); ?>/<?= $kecamatan; ?>/<?= $i['kelurahan']; ?>"><?= $i['kelurahan']; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <?php if (session('role') == 'Admin') : ?>

            <form class="mb-2" action="<?= base_url(); ?>upload_dokumen_d" method="post" enctype="multipart/form-data">
                <div class="input-group input-group-sm custom-file-button">
                    <?php if (dokumen_d(explode(" ", session('nama'))[1])['dokumen_d'] == 'file-not-found.jpg') : ?>

                        <a data-url="<?= base_url('files/c1'); ?>/<?= dokumen_d(explode(" ", session('nama'))[1])['dokumen_d']; ?>" href="" style="text-decoration: none;font-weight:bold;" type="button" class="input-group-text text_dark zoom">
                            <i class="fa-regular fa-image"></i> Upload dokumen D
                        </a>

                    <?php else : ?>

                        <a target="_blank" href="<?= base_url('files/dokumen_d'); ?>/<?= dokumen_d(explode(" ", session('nama'))[1])['dokumen_d']; ?>" style="text-decoration: none;font-weight:bold;" type="button" class="input-group-text text_success">
                            <i class="fa-regular fa-image"></i> Upload dokumen D
                        </a>

                    <?php endif; ?>
                    <input type="hidden" name="kelurahan" value="<?= strtolower(explode(" ", session('nama'))[1]); ?>">
                    <input type="hidden" name="id" value="<?= dokumen_d(explode(" ", session('nama'))[1])['id']; ?>">
                    <input type="hidden" name="url" value="<?= base_url('tps'); ?>">
                    <input type="file" name="file" class="form-control">
                    <button class="btn btn-outline-success" type="submit"><i class="fa-solid fa-circle-chevron-up"></i></button>
                </div>


            <?php endif; ?>

            </form>

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
                            <?php if (session('role') == 'Root') : ?>
                                <th class="d-none d-md-table-cell" style="text-align: center;" scope="col">Kecamatan</th>

                            <?php endif; ?>
                            <th style="text-align: center;" scope="col">Kelurahan</th>
                            <th style="text-align: center;" scope="col">Saksi</th>
                            <th style="text-align: center;" scope="col">Dpt</th>
                            <th style="text-align: center;" scope="col">Kirka</th>
                            <?php if (session('role') == 'Admin') : ?>

                                <th scope="col">Hp Saksi</th>

                            <?php endif; ?>
                            <th style="text-align: center;" scope="col">C1</th>
                            <th style="text-align: center;" scope="col">Act</th>
                        </tr>
                    </thead>
                    <tbody class="tabel_search">

                        <?php foreach ($data as $k => $i) : ?>
                            <tr>
                                <td style="text-align: center;"><?= ($k + 1); ?></td>
                                <td><?= $i['tps']; ?></td>
                                <td class="d-none d-md-table-cell"><?= $i['alamat']; ?></td>
                                <?php if (session('role') == 'Root') : ?>
                                    <td class="d-none d-md-table-cell"><?= $i['kecamatan']; ?></td>
                                <?php endif; ?>
                                <td><?= $i['kelurahan']; ?></td>
                                <td class="update_saksi" data-id="<?= $i['id']; ?>" contenteditable="true"><?= $i['pj']; ?></td>
                                <td class="update_dpt" data-id="<?= $i['id']; ?>" contenteditable="true"><?= $i['dpt']; ?></td>
                                <td style="text-align: right;" class="update_kirka" data-id="<?= $i['id']; ?>" contenteditable="true"><?= $i['kirka']; ?></td>
                                <?php if (session('role') == 'Admin') : ?>
                                    <td class="update_hp_saksi" data-id="<?= $i['id']; ?>" contenteditable="true"><?= $i['hp_saksi']; ?></td>


                                <?php endif; ?>
                                <td style="text-align: center;">
                                    <?php if (check_file($i['c1']) == 'img') : ?>
                                        <a data-url="<?= base_url('files/c1'); ?>/<?= $i['c1']; ?>" style="text-decoration:none;" type="button" href="" class="zoom <?= ($i['c1'] !== 'file-not-found.jpg' ? 'text_success' : 'text_dark'); ?>">
                                            <i class="fa-regular fa-image"></i>
                                        </a>
                                    <?php endif; ?>
                                    <?php if (check_file($i['c1']) == 'pdf') : ?>
                                        <a target="_blank" style="text-decoration:none;" type="button" href="<?= base_url('files/c1'); ?>/<?= $i['c1']; ?>" class="<?= ($i['c1'] !== 'file-not-found.jpg' ? 'text_success' : 'text_dark'); ?>">
                                            <i class="fa-solid fa-file-pdf"></i>
                                        </a>
                                    <?php endif; ?>
                                </td>
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
                                                <input type="text" name="kecamatan" value="<?= $i['kecamatan']; ?>" class="form-control indonesia update_kecamatan_<?= $i['id']; ?>" data-order="update" data-col="kecamatan" data-indonesia_id="3314" data-id="<?= $i['id']; ?>" placeholder="Kecamatan" required <?= (session('role') !== 'Root' ? 'disabled' : ''); ?>>
                                                <label>Kecamatan</label>
                                                <ul class="p-1 dropdown-menu body_update_kecamatan_<?= $i['id']; ?>" style="font-size:small;">

                                                </ul>


                                                <div class="body_feedback_update_kecamatan_<?= $i['id']; ?> invalid-feedback"></div>
                                            </div>

                                            <div class="form-floating mb-3">
                                                <input type="text" name="kelurahan" value="<?= $i['kelurahan']; ?>" class="form-control indonesia update_kelurahan_<?= $i['id']; ?>" data-order="update" data-col="kelurahan" data-indonesia_id="" data-id="<?= $i['id']; ?>" placeholder="Kelurahan" <?= (session('role') !== 'Root' ? 'disabled' : ''); ?>>
                                                <label>Kelurahan</label>
                                                <ul class="p-1 dropdown-menu body_update_kelurahan_<?= $i['id']; ?>" style="font-size:small;">

                                                </ul>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="text" name="pj" value="<?= $i['pj']; ?>" class="form-control" placeholder="Saksi">
                                                <label>Saksi</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="text" name="hp_saksi" value="<?= $i['hp_saksi']; ?>" class="form-control" placeholder="Hp Saksi">
                                                <label>Hp Saksi</label>
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