<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
    <h1>All Tasks</h1>

    <?php if (session()->get('isLoggedIn')): ?><a class="button" href="<?= site_url('tasks/new') ?>">Add New Task</a><?php endif; ?>

    <table>
        <tr>
            <th>Task</th>
            <th>Status</th>
            <th>Date</th>
            <?php if (session()->get('isLoggedIn')): ?><th>Actions</th><?php endif; ?>
        </tr>

        <?php foreach ($tasks as $task): ?>
            <tr>
                <td><?= esc($task['title']) ?></td>
                <td><span class="badge"><?= esc($task['status']) ?></span></td>
                <td><?= esc($task['task_date']) ?></td>
                <?php if (session()->get('isLoggedIn')): ?>
                    <td class="actions">
                        <a class="button secondary" href="<?= site_url('tasks/' . $task['id'] . '/edit') ?>">Edit</a>
                        <form method="post" action="<?= site_url('tasks/' . $task['id'] . '/delete') ?>" style="display:inline" onsubmit="return confirm('Archive this task?');">
                            <?= csrf_field() ?><button class="danger" type="submit">Delete</button>
                        </form>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </table>
<?= $this->endSection() ?>
