<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
    <h1>Today's Tasks</h1>
    <p>Tasks scheduled for <?= date('F j, Y') ?>.</p>

    <?php if (!empty($tasks)): ?>
        <table>
            <tr>
                <th>Task</th>
                <th>Status</th>
            </tr>

            <?php foreach ($tasks as $task): ?>
                <tr>
                    <td><?= esc($task['title']) ?></td>
                    <td><span class="badge"><?= esc($task['status']) ?></span></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No tasks are scheduled for today.</p>
    <?php endif; ?>
<?= $this->endSection() ?>