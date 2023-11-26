<?= $this->extend('guest') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-center" style="margin-top:200px;">
    <div class="card" style="width:500px;">
        <div class="card-body text-center p-5">
            <img class="mb-3 mt-2" width="100" src="<?= base_url(); ?>logo.png" alt="LOGO">
            <form action="<?= base_url(); ?>auth" method="post">
                <div class="form-floating mb-2">
                    <input type="text" name="username" class="form-control" placeholder="Username">
                    <label>Username</label>
                </div>
                <div class="form-floating">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <label>Password</label>
                </div>

                <div class="d-grid mt-4">
                    <button class="btn_save" type="submit"><i class="fa-solid fa-arrow-right-to-bracket"></i> Login</button>
                </div>

            </form>
        </div>
    </div>

</div>
<?= $this->endSection() ?>