<!DOCTYPE html>
<html>
<head>
    <title>System Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f7fb; margin:0; }
        .sidebar { width: 220px; height:100vh; background:#0d6efd; color:white; float:left; padding:20px 0; }
        .sidebar a { display:block; color:white; padding:10px 20px; text-decoration:none; }
        .sidebar a:hover { background:#0b5ed7; }
        .content { margin-left:220px; padding:20px; }
        .cards { display:grid; grid-template-columns: repeat(3, 1fr); gap:20px; }
        .card { background:white; border-radius:10px; padding:20px; box-shadow:0 2px 8px rgba(0,0,0,0.1); }
        .btn { display:block; margin-top:10px; background:#0d6efd; color:white; padding:8px 15px; border-radius:5px; text-align:center; text-decoration:none; }
        .btn:hover { background:#0b5ed7; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2 style="text-align:center;">Dashboard</h2>
        <a href="<?= site_url('programs') ?>">Programs</a>
        <a href="<?= site_url('projects') ?>">Projects</a>
        <a href="<?= site_url('services') ?>">Services</a>
        <a href="<?= site_url('equipment') ?>">Equipment</a>
        <a href="<?= site_url('facilities') ?>">Facilities</a>
        <a href="<?= site_url('participants') ?>">Participants</a>
        <a href="<?= site_url('outcomes') ?>">Outcomes</a>
    </div>

    <div class="content">
        <h1>Welcome to the System Dashboard</h1>

        <div class="cards">
            <div class="card">
                <h3>Programs</h3>
                <p><?= esc($programs) ?></p>
                <a class="btn" href="<?= site_url('programs') ?>">View Programs</a>
            </div>
            <div class="card">
                <h3>Projects</h3>
                <p><?= esc($projects) ?></p>
                <a class="btn" href="<?= site_url('projects') ?>">View Projects</a>
            </div>
            <div class="card">
                <h3>Services</h3>
                <p><?= esc($services) ?></p>
                <a class="btn" href="<?= site_url('services') ?>">View Services</a>
            </div>
            <div class="card">
                <h3>Equipment</h3>
                <p><?= esc($equipment) ?></p>
                <a class="btn" href="<?= site_url('equipment') ?>">View Equipment</a>
            </div>
            <div class="card">
                <h3>Facilities</h3>
                <p><?= esc($facilities) ?></p>
                <a class="btn" href="<?= site_url('facilities') ?>">View Facilities</a>
            </div>
            <div class="card">
                <h3>Participants</h3>
                <p><?= esc($participants) ?></p>
                <a class="btn" href="<?= site_url('participants') ?>">View Participants</a>
            </div>
            <div class="card">
                <h3>Outcomes</h3>
                <p><?= esc($outcomes) ?></p>
                <a class="btn" href="<?= site_url('outcomes') ?>">View Outcomes</a>
            </div>
        </div>
    </div>
</body>
</html>
