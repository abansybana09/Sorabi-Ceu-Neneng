<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="container" style="padding-top: 120px; padding-bottom: 80px;">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body p-5">
                    <h2 class="text-center mb-4">Daftar Akun Baru</h2>
                    <!-- Tampilkan error validasi -->
                    <?php if (session()->get('errors')): ?>
                        <div class="alert alert-danger">
                            <?php foreach (session('errors') as $error): ?>
                                <p class="mb-0"><?= esc($error) ?></p>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('register/process') ?>" method="POST">
                        <?= csrf_field() ?>
                        <div class="mb-3"><label for="fullname" class="form-label">Nama Lengkap</label><input type="text" name="fullname" class="form-control" value="<?= old('fullname') ?>" required></div>
                        <div class="mb-3"><label for="username" class="form-label">Username</label><input type="text" name="username" class="form-control" value="<?= old('username') ?>" required></div>
                        <div class="mb-3"><label for="password" class="form-label">Password</label><input type="password" name="password" class="form-control" required></div>
                        <div class="mb-3"><label for="pass_confirm" class="form-label">Konfirmasi Password</label><input type="password" name="pass_confirm" class="form-control" required></div>
                        <div class="d-grid mt-4"><button type="submit" class="btn btn-primary">Daftar</button></div>
                        <p class="text-center small mt-3">Sudah punya akun? <a href="<?= base_url('login') ?>">Login di sini</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>