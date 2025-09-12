<!DOCTYPE html>
<html>
<head>
    <title>System Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .sidebar {
            width: 220px;
            position: fixed;
            top: 0; left: 0;
            height: 100%;
            background: #0d6efd;
            color: white;
            padding: 20px 0;
        }
        .sidebar a {
            display: block;
            color: white;
            padding: 12px 20px;
            text-decoration: none;
        }
        .sidebar a:hover {
            background: rgba(255,255,255,0.2);
            border-radius: 5px;
        }
        .content {
            margin-left: 240px;
            padding: 20px;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }
        .btn-view {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h4 class="text-center">Dashboard</h4>
        <a href="<?= site_url('programs') ?>">Programs</a>
        <a href="<?= site_url('projects') ?>">Projects</a>
        <a href="<?= site_url('services') ?>">Services</a>
        <a href="<?= site_url('equipment') ?>">Equipment</a>
        <a href="<?= site_url('facilities') ?>">Facilities</a>
        <a href="<?= site_url('participants') ?>">Participants</a>
        <a href="<?= site_url('outcomes') ?>">Outcomes</a>
    </div>

    <!-- Main Content -->
    <div class="content">
        <h2>Welcome to the System Dashboard</h2>
        <div class="row mt-4">
            <!-- Programs -->
            <div class="col-md-3">
                <div class="card text-center p-3">
                    <h5>Programs</h5>
                    <p><?= esc($programsCount ?? 0) ?></p>
                    <a href="<?= site_url('programs') ?>" class="btn btn-primary btn-view">View Programs</a>
                </div>
            </div>
            <!-- Projects -->
            <div class="col-md-3">
                <div class="card text-center p-3">
                    <h5>Projects</h5>
                    <p><?= esc($projectsCount ?? 0) ?></p>
                    <a href="<?= site_url('projects') ?>" class="btn btn-primary btn-view">View Projects</a>
                </div>
            </div>
            <!-- Services -->
            <div class="col-md-3">
                <div class="card text-center p-3">
                    <h5>Services</h5>
                    <p><?= esc($servicesCount ?? 0) ?></p>
                    <a href="<?= site_url('services') ?>" class="btn btn-primary btn-view">View Services</a>
                </div>
            </div>
            <!-- Equipment -->
            <div class="col-md-3">
                <div class="card text-center p-3">
                    <h5>Equipment</h5>
                    <p><?= esc($equipmentCount ?? 0) ?></p>
                    <a href="<?= site_url('equipment') ?>" class="btn btn-primary btn-view">View Equipment</a>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <!-- Facilities -->
            <div class="col-md-3">
                <div class="card text-center p-3">
                    <h5>Facilities</h5>
                    <p><?= esc($facilitiesCount ?? 0) ?></p>
                    <a href="<?= site_url('facilities') ?>" class="btn btn-primary btn-view">View Facilities</a>
                </div>
            </div>
            <!-- Participants -->
            <div class="col-md-3">
                <div class="card text-center p-3">
                    <h5>Participants</h5>
                    <p><?= esc($participantsCount ?? 0) ?></p>
                    <a href="<?= site_url('participants') ?>" class="btn btn-primary btn-view">View Participants</a>
                </div>
            </div>
            <!-- Outcomes -->
            <div class="col-md-3">
                <div class="card text-center p-3">
                    <h5>Outcomes</h5>
                    <p><?= esc($outcomesCount ?? 0) ?></p>
                    <a href="<?= site_url('outcomes') ?>" class="btn btn-primary btn-view">View Outcomes</a>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="card mt-4 p-3">
            <h5>Recent Activity</h5>
            <ul>
                <li>New project created</li>
                <li>Equipment added</li>
                <li>Outcome recorded</li>
            </ul>
        </div>
    </div>
</body>
</html>
