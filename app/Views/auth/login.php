<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<style>
    /* CSS khusus untuk halaman login */
    .login-container {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 80vh;
    }
    .login-card {
        width: 100%;
        max-width: 450px;
    }
</style>

<div class="container login-container">
    <div class="card login-card shadow-lg border-0">
        <div class="card-body p-4 p-md-5">
            <div class="text-center mb-4">
                <h2 class="card-title fw-bold">Silahkan Login</h2>
                <!-- <p class="text-muted"></p> -->
            </div>

            <!-- Menampilkan pesan error atau sukses -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <form action="<?= base_url('login/process') ?>" method="POST">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Masuk</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>