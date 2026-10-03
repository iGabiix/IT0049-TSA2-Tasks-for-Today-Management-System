<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
    <h1><?= esc($title) ?></h1>
    <?php $errors = session()->getFlashdata('errors') ?? []; ?>
    <?php foreach ($errors as $error): ?><p class="error"><?= esc($error) ?></p><?php endforeach; ?>
    <?php $isEdit = $task !== null; ?>
    <form method="post" action="<?= $isEdit ? site_url('tasks/' . $task['id']) : site_url('tasks') ?>">
        <?= csrf_field() ?>
        <label for="title">Title</label>
        <input id="title" name="title" maxlength="150" value="<?= esc(old('title', $task['title'] ?? '')) ?>" required>
        <label for="status">Status</label>
        <select id="status" name="status" required>
            <?php foreach (['pending', 'in progress', 'completed'] as $status): ?>
                <option value="<?= esc($status) ?>" <?= old('status', $task['status'] ?? 'pending') === $status ? 'selected' : '' ?>><?= esc(ucwords($status)) ?></option>
            <?php endforeach; ?>
        </select>
        <label for="task_date">Task Date</label>
        <input id="task_date" name="task_date" type="date" value="<?= esc(old('task_date', $task['task_date'] ?? '')) ?>" required>
        <button type="submit"><?= $isEdit ? 'Update Task' : 'Create Task' ?></button>
        <a class="button secondary" href="<?= site_url('tasks') ?>">Cancel</a>
    </form>
<?= $this->endSection() ?>
