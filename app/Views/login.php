<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
    <h1>Login</h1>
    <?php if (session()->getFlashdata('message')): ?><p class="success"><?= esc(session()->getFlashdata('message')) ?></p><?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?><p class="error"><?= esc(session()->getFlashdata('error')) ?></p><?php endif; ?>
    <?php $errors = session()->getFlashdata('errors') ?? []; ?>
    <?php foreach ($errors as $error): ?><p class="error"><?= esc($error) ?></p><?php endforeach; ?>
    <form method="post" action="<?= site_url('login') ?>">
        <?= csrf_field() ?>
        <label for="username">Username</label>
        <input id="username" name="username" value="<?= esc(old('username')) ?>" required>
        <label for="password">Password</label>
        <input id="password" name="password" type="password" required>
        <button type="submit">Log In</button>
    </form>
    <p>Demo account: <strong>demo</strong> / <strong>password</strong></p>
<?= $this->endSection() ?>
