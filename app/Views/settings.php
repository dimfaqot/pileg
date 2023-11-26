<?= $this->extend('logged') ?>

<?= $this->section('content') ?>

<div class="card mt-2">
    <div class="card-body shadow shadow-sm">
        <?php if (count($data) == 0) : ?>
            <div class="mt-2 body_warning"><i class="fa-solid fa-circle-exclamation"></i> Data not found!.</div>
        <?php else : ?>

            <form action="<?= base_url(menu()['controller']); ?>/update" method="post">
                <input type="hidden" name="id" value="<?= $data['id']; ?>">
                <?php foreach ($cols as $c) : ?>
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control" name="<?= $c; ?>" value="<?= $data[$c]; ?>" placeholder="<?= upper_first(str_replace("_", " ", $c)); ?>">
                        <label><?= upper_first(str_replace("_", " ", $c)); ?></label>
                    </div>
                <?php endforeach; ?>
                <div class="text-center mt-4">
                    <button type="submit" href="" class="btn_save"><i class="fa-solid fa-circle-check"></i> Update</button>
                </div>
            </form>
        <?php endif; ?>
    </div>

</div>

<?= $this->endSection() ?>