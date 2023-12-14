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
                                    <input type="text" name="username" class="form-control" placeholder="Username" required>
                                    <label>Username</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" name="nama" class="form-control" placeholder="Nama" required>
                                    <label>Nama</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" name="role" class="form-control" placeholder="Color" required>
                                    <label>Role</label>
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
                        <th style="text-align: center;">#</th>
                        <th style="text-align: center;">Username</th>
                        <th style="text-align: center;">Nama</th>
                        <th style="text-align: center;">Role</th>
                        <th style="text-align: center;">Login</th>
                        <th style="text-align: center;">Act</th>
                    </tr>
                </thead>
                <tbody class="tabel_search">
                    <?php foreach ($data as $k => $i) : ?>
                        <tr>
                            <td><?= ($k + 1); ?></td>
                            <td><?= $i['username']; ?></td>
                            <td><?= $i['nama']; ?></td>
                            <td><?= $i['role']; ?></td>
                            <td><?= $i['is_login']; ?></td>
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
                                        <i class="<?= menu()['icon']; ?>"></i> <?= $i['nama']; ?>
                                    </div>
                                    <a href="" type="button" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i></a>
                                </div>
                                <div class="px-4 pb-3">
                                    <form action="<?= base_url(menu()['controller']); ?>/update" method="post">
                                        <input type="hidden" name="id" value="<?= $i['id']; ?>">
                                        <input type="hidden" name="url" value="<?= base_url(menu()['controller']); ?>">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="username" value="<?= $i['username']; ?>" class="form-control" placeholder="Username" required>
                                            <label>Username</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" name="nama" value="<?= $i['nama']; ?>" class="form-control" placeholder="Nama" required>
                                            <label>Nama</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" name="role" value="<?= $i['role']; ?>" class="form-control" placeholder="Role" required>
                                            <label>Role</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="number" name="is_login" value="<?= $i['is_login']; ?>" class="form-control" placeholder="Login" required>
                                            <label>Login</label>
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