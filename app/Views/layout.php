<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?> | Tasks for Today</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f7f8f2;
            color: #243b2f;
        }

        nav {
            background: #006b3f;
            padding: 16px;
            border-bottom: 5px solid #f5b335;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin-right: 20px;
            font-weight: bold;
        }

        nav a:hover {
            color: #f5b335;
        }

        nav form { display: inline; }
        nav button { background: none; border: 0; color: white; cursor: pointer; font: inherit; font-weight: bold; padding: 0; }

        .container {
            max-width: 900px;
            margin: 40px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            border-top: 6px solid #f5b335;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #006b3f;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #d9dfd5;
        }

        th {
            background: #e8f1e9;
            color: #006b3f;
        }

        .badge {
            background: #f5b335;
            color: #1f3d2b;
            padding: 5px 10px;
            border-radius: 20px;
            font-weight: bold;
            text-transform: capitalize;
        }

        label { display: block; font-weight: bold; margin-top: 16px; }
        input, select { box-sizing: border-box; display: block; margin-top: 6px; padding: 10px; width: 100%; }
        button, .button { background: #006b3f; border: 0; border-radius: 5px; color: white; display: inline-block; margin-top: 20px; padding: 10px 16px; text-decoration: none; }
        button:hover, .button:hover { background: #004d2d; }
        .secondary { background: #68756d; }
        .danger { background: #a52a2a; }
        .error { color: #a52a2a; font-weight: bold; }
        .success { color: #006b3f; font-weight: bold; }
        .actions { white-space: nowrap; }
    </style>
</head>
<body>
    <nav>
        <a href="<?= site_url('/') ?>">Today</a>
        <a href="<?= site_url('tasks') ?>">Task List</a>
        <a href="<?= site_url('profile') ?>">Profile</a>
        <a href="<?= site_url('about') ?>">About</a>
        <?php if (session()->get('isLoggedIn')): ?>
            <a href="<?= site_url('tasks/new') ?>">New Task</a>
            <form method="post" action="<?= site_url('logout') ?>" style="display:inline"><?= csrf_field() ?><button type="submit">Logout</button></form>
        <?php else: ?>
            <a href="<?= site_url('login') ?>">Login</a>
        <?php endif; ?>
    </nav>

    <div class="container">
        <?php if (session()->getFlashdata('message')): ?><p class="success"><?= esc(session()->getFlashdata('message')) ?></p><?php endif; ?>
        <?= $this->renderSection('content') ?>
    </div>
</body>
</html>
