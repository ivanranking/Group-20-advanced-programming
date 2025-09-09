<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?><?= $title ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<style>
    body {
        background: #f8f9fc;
        font-family: 'Segoe UI', sans-serif;
    }

    /* Sidebar */
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        width: 240px;
        height: 100vh;
        background: #343a40;
        color: #fff;
        transition: all 0.3s;
        padding-top: 70px;
    }

    .sidebar .nav-link {
        color: #adb5bd;
        padding: 12px 20px;
        font-weight: 500;
        border-radius: 8px;
        margin: 6px 12px;
        transition: 0.2s;
    }

    .sidebar .nav-link:hover, 
    .sidebar .nav-link.active {
        background: #495057;
        color: #fff;
    }

    .sidebar .nav-link i {
        margin-right: 10px;
    }

    /* Top Navbar */
    .top-navbar {
        position: fixed;
        top: 0;
        left: 240px;
        right: 0;
        height: 60px;
        background: #fff;
        border-bottom: 1px solid #dee2e6;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 20px;
        z-index: 1000;
    }

    .top-navbar .navbar-brand {
        font-weight: 700;
        color: #333;
    }

    .top-navbar .nav-item .nav-link {
        color: #495057;
        font-weight: 500;
    }

    /* Main Content */
    .main-content {
        margin-left: 240px;
        padding: 80px 30px 30px 30px;
    }

    /* Summary cards (same as before) */
    .summary-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.06);
        padding: 24px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        background: #fff;
    }
    .summary-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 28px rgba(0,0,0,0.12);
    }
    .summary-title {
        font-size: 0.85rem;
        font-weight: 600;
        color: #6c757d;
        margin-bottom: 8px;
    }
    .summary-value {
        font-size: 1.75rem;
        font-weight: 700;
    }
    .summary-sub {
        font-size: 0.9rem;
        font-weight: 500;
        color: #6c757d;
    }
    .badge-status {
        font-size: 0.75rem;
        font-weight: 600;
        border-radius: 12px;
        padding: 4px 10px;
    }

    /* List cards */
    .list-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.06);
    }
    .list-card .card-header {
        background: transparent;
        border-bottom: none;
        font-weight: 600;
        font-size: 0.95rem;
    }

    /* Quick actions */
    .quick-actions {
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-radius: 16px;
        color: #fff;
    }
    .quick-actions h6 {
        font-size: 0.9rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .quick-btn {
        background: #fff;
        color: #333;
        border-radius: 10px;
        padding: 10px;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }
    .quick-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.12);
    }
    .btn-icon {
        margin-right: 8px;
        font-size: 1rem;
    }
</style>

<!-- Sidebar -->
<div class="sidebar">
    <nav class="nav flex-column">
        <a class="nav-link active" href="<?= site_url('dashboard') ?>"><i class="fas fa-home"></i> Dashboard</a>
        <a class="nav-link" href="<?= site_url('facilities') ?>"><i class="fas fa-building"></i> Facilities</a>
        <a class="nav-link" href="<?= site_url('services') ?>"><i class="fas fa-cogs"></i> Services</a>
        <a class="nav-link" href="<?= site_url('projects') ?>"><i class="fas fa-project-diagram"></i> Projects</a>
        <a class="nav-link" href="<?= site_url('programs') ?>"><i class="fas fa-calendar-alt"></i> Programs</a>
        <a class="nav-link" href="<?= site_url('equipment') ?>"><i class="fas fa-tools"></i> Equipment</a>
        <a class="nav-link" href="<?= site_url('participants') ?>"><i class="fas fa-users"></i> Participants</a>
        <a class="nav-link" href="<?= site_url('outcomes') ?>"><i class="fas fa-chart-line"></i> Outcomes</a>
        <a class="nav-link" href="<?= site_url('settings') ?>"><i class="fas fa-cog"></i> Settings</a>
    </nav>
</div>

<!-- Top Navbar -->
<div class="top-navbar">
    <a class="navbar-brand" href="<?= site_url('dashboard') ?>">Admin Dashboard</a>
    <ul class="nav">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown">
                <i class="fas fa-user-circle me-1"></i> Admin
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="<?= site_url('profile') ?>">Profile</a></li>
                <li><a class="dropdown-item" href="<?= site_url('settings') ?>">Settings</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-danger" href="<?= site_url('logout') ?>">Logout</a></li>
            </ul>
        </li>
    </ul>
</div>

<!-- Main Content -->
<div class="main-content">
    <!-- Summary Cards -->
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="summary-card">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="summary-title">Facilities</span>
                    <i class="fas fa-building text-secondary"></i>
                </div>
                <div class="summary-value"><?= $facility_count ?? 0 ?> <span class="summary-sub">Active</span></div>
                <span class="badge-status bg-success-subtle text-success">&lt; 5%</span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="summary-card">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="summary-title">Services</span>
                    <i class="fas fa-cogs text-warning"></i>
                </div>
                <div class="summary-value"><?= $service_count ?? 0 ?> <span class="summary-sub">Open</span></div>
                <span class="badge-status bg-danger-subtle text-danger">&lt; 2%</span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="summary-card">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="summary-title">Projects</span>
                    <i class="fas fa-project-diagram text-primary"></i>
                </div>
                <div class="summary-value"><?= $project_count ?? 0 ?> <span class="summary-sub">Upcoming</span></div>
                <span class="badge-status bg-danger-subtle text-danger">&lt; 2%</span>
            </div>
        </div>
    </div>

    <!-- Recent Projects & Programs -->
    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card list-card mb-4">
                <div class="card-header d-flex justify-content-between">
                    <span>Recent Projects</span>
                    <a href="<?= site_url('projects') ?>" class="btn btn-sm btn-outline-primary">View All</a>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <?php foreach($recent_projects as $project): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <a href="<?= site_url('projects/' . $project['id']) ?>" class="fw-bold"><?= esc($project['name']) ?></a>
                                    <br><small class="text-muted">Status: <span class="badge bg-secondary"><?= esc($project['status']) ?></span></small>
                                </div>
                                <div class="btn-group btn-group-sm">
                                    <a href="<?= site_url('projects/' . $project['id'] . '/edit') ?>" class="btn btn-outline-warning btn-sm">Edit</a>
                                    <form action="<?= site_url('projects/' . $project['id']) ?>" method="post" class="d-inline">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-outline-danger btn-sm">Del</button>
                                    </form>
                                </div>
                            </li>
                        <?php endforeach; ?>
                        <?php if (empty($recent_projects)): ?>
                            <li class="list-group-item text-muted">No projects yet.</li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card list-card mb-4">
                <div class="card-header d-flex justify-content-between">
                    <span>Recent Programs</span>
                    <a href="<?= site_url('programs') ?>" class="btn btn-sm btn-outline-success">View All</a>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <?php foreach($recent_programs as $program): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <a href="<?= site_url('programs/' . $program['id']) ?>" class="fw-bold"><?= esc($program['name']) ?></a>
                                    <br><small class="text-muted">Created: <?= date('M d, Y', strtotime($program['created_at'])) ?></small>
                                </div>
                                <div class="btn-group btn-group-sm">
                                    <a href="<?= site_url('programs/' . $program['id'] . '/edit') ?>" class="btn btn-outline-warning btn-sm">Edit</a>
                                    <form action="<?= site_url('programs/' . $program['id']) ?>" method="post" class="d-inline">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-outline-danger btn-sm">Del</button>
                                    </form>
                                </div>
                            </li>
                        <?php endforeach; ?>
                        <?php if (empty($recent_programs)): ?>
                            <li class="list-group-item text-muted">No programs yet.</li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="quick-actions p-4 mt-5">
        <h6 class="mb-4"><i class="fas fa-rocket me-2"></i>Quick Actions</h6>
        <div class="row g-3">
            <div class="col-md-3 col-6">
                <a href="<?= site_url('projects/new') ?>" class="quick-btn"><i class="fas fa-project-diagram btn-icon text-primary"></i>New Project</a>
            </div>
            <div class="col-md-3 col-6">
                <a href="<?= site_url('programs/new') ?>" class="quick-btn"><i class="fas fa-calendar-alt btn-icon text-success"></i>New Program</a>
            </div>
            <div class="col-md-3 col-6">
                <a href="<?= site_url('participants/new') ?>" class="quick-btn"><i class="fas fa-users btn-icon text-info"></i>New Participant</a>
            </div>
            <div class="col-md-3 col-6">
                <a href="<?= site_url('equipment/new') ?>" class="quick-btn"><i class="fas fa-tools btn-icon text-danger"></i>New Equipment</a>
            </div>
            <div class="col-md-3 col-6">
                <a href="<?= site_url('services/new') ?>" class="quick-btn"><i class="fas fa-cogs btn-icon text-warning"></i>New Service</a>
            </div>
            <div class="col-md-3 col-6">
                <a href="<?= site_url('facilities/new') ?>" class="quick-btn"><i class="fas fa-building btn-icon text-dark"></i>New Facility</a>
            </div>
            <div class="col-md-3 col-6">
                <a href="<?= site_url('outcomes/new') ?>" class="quick-btn"><i class="fas fa-chart-line btn-icon text-secondary"></i>New Outcome</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap + FontAwesome -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
<?= $this->endSection() ?>
