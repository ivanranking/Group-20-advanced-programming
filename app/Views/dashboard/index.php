<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?><?= $title ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<style>
    .icon-circle {
        height: 50px;
        width: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        color: #fff;
        font-size: 1.5rem;
    }

    /* Enhanced button styles for Quick Actions */
    .quick-action-btn {
        position: relative;
        overflow: hidden;
        transform: translateY(0);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .quick-action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
    }

    .quick-action-btn:active {
        transform: translateY(0);
        transition: all 0.1s ease;
    }

    .quick-action-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }

    .quick-action-btn:hover::before {
        left: 100%;
    }

    .manage-btn {
        border: 2px solid rgba(255,255,255,0.3) !important;
        backdrop-filter: blur(10px);
        background: rgba(255,255,255,0.05) !important;
    }

    .manage-btn:hover {
        background: rgba(255,255,255,0.1) !important;
        border-color: rgba(255,255,255,0.5) !important;
        transform: translateY(-1px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.2) !important;
    }

    .create-btn {
        background: rgba(255,255,255,0.95) !important;
        color: #495057 !important;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .create-btn:hover {
        background: #ffffff !important;
        color: #212529 !important;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.15) !important;
    }

    .btn-icon {
        width: 20px;
        text-align: center;
        margin-right: 8px;
        font-size: 0.9em;
    }

    .count-badge {
        background: linear-gradient(45deg, #28a745, #20c997);
        border-radius: 12px;
        padding: 2px 8px;
        font-size: 0.75em;
        font-weight: bold;
        min-width: 20px;
        text-align: center;
        box-shadow: 0 2px 4px rgba(0,0,0,0.2);
    }

    .gradient-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none !important;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }

    .section-title {
        font-size: 0.9em;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 1rem;
        opacity: 0.9;
    }
</style>

<div class="container mt-5">
    <h1 class="mb-4">Dashboard</h1>

    <!-- Stats Cards -->
    <div class="row">
        <div class="col-md-4 col-xl-3 mb-4">
            <div class="card shadow border-start-primary h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Programs</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $program_count ?></div>
                        </div>
                        <div class="col-auto">
                            <div class="icon-circle bg-primary"><i class="fas fa-calendar-alt"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-xl-3 mb-4">
            <div class="card shadow border-start-success h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Projects</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $project_count ?></div>
                        </div>
                        <div class="col-auto">
                           <div class="icon-circle bg-success"><i class="fas fa-project-diagram"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-xl-3 mb-4">
            <div class="card shadow border-start-info h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Participants</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $participant_count ?></div>
                        </div>
                        <div class="col-auto">
                            <div class="icon-circle bg-info"><i class="fas fa-users"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-xl-3 mb-4">
            <div class="card shadow border-start-warning h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Equipment</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $equipment_count ?></div>
                        </div>
                        <div class="col-auto">
                            <div class="icon-circle bg-warning"><i class="fas fa-tools"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-xl-3 mb-4">
            <div class="card shadow border-start-secondary h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Facilities</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $facility_count ?? 0 ?></div>
                        </div>
                        <div class="col-auto">
                            <div class="icon-circle bg-secondary"><i class="fas fa-building"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-xl-3 mb-4">
            <div class="card shadow border-start-dark h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Outcomes</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $outcome_count ?? 0 ?></div>
                        </div>
                        <div class="col-auto">
                            <div class="icon-circle bg-dark"><i class="fas fa-chart-line"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Projects Section -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Projects</h6>
                    <a href="<?= site_url('projects') ?>" class="btn btn-sm btn-outline-primary">View All</a>
                </div>
                <div class="card-body">
                      <ul class="list-group list-group-flush">
                         <?php foreach($recent_projects as $project): ?>
                             <li class="list-group-item d-flex justify-content-between align-items-center">
                                 <div>
                                     <a href="<?= site_url('projects/' . $project['id']) ?>" class="text-decoration-none">
                                         <strong><?= esc($project['name']) ?></strong>
                                     </a>
                                     <br><small class="text-muted">Status: <span class="badge bg-secondary"><?= esc($project['status']) ?></span></small>
                                 </div>
                                 <div class="btn-group btn-group-sm">
                                     <a href="<?= site_url('projects/' . $project['id'] . '/edit') ?>" class="btn btn-outline-warning btn-sm">Edit</a>
                                     <form action="<?= site_url('projects/' . $project['id']) ?>" method="post" class="d-inline">
                                         <?= csrf_field() ?>
                                         <input type="hidden" name="_method" value="DELETE">
                                         <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this project?')">Del</button>
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

        <!-- Programs Section -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-success">Recent Programs</h6>
                    <a href="<?= site_url('programs') ?>" class="btn btn-sm btn-outline-success">View All</a>
                </div>
                <div class="card-body">
                      <ul class="list-group list-group-flush">
                         <?php foreach($recent_programs as $program): ?>
                             <li class="list-group-item d-flex justify-content-between align-items-center">
                                 <div>
                                     <a href="<?= site_url('programs/' . $program['id']) ?>" class="text-decoration-none">
                                         <strong><?= esc($program['name']) ?></strong>
                                     </a>
                                     <br><small class="text-muted">Created: <?= date('M d, Y', strtotime($program['created_at'])) ?></small>
                                 </div>
                                 <div class="btn-group btn-group-sm">
                                     <a href="<?= site_url('programs/' . $program['id'] . '/edit') ?>" class="btn btn-outline-warning btn-sm">Edit</a>
                                     <form action="<?= site_url('programs/' . $program['id']) ?>" method="post" class="d-inline">
                                         <?= csrf_field() ?>
                                         <input type="hidden" name="_method" value="DELETE">
                                         <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this program?')">Del</button>
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

    <!-- Second Row -->
    <div class="row">
        <!-- Participants Section -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-info">Recent Participants</h6>
                    <a href="<?= site_url('participants') ?>" class="btn btn-sm btn-outline-info">View All</a>
                </div>
                <div class="card-body">
                      <ul class="list-group list-group-flush">
                         <?php foreach($recent_participants as $participant): ?>
                             <li class="list-group-item d-flex justify-content-between align-items-center">
                                 <div>
                                     <a href="<?= site_url('participants/' . $participant['id']) ?>" class="text-decoration-none">
                                         <strong><?= esc($participant['name']) ?></strong>
                                     </a>
                                     <br><small class="text-muted">Role: <?= esc($participant['role']) ?></small>
                                 </div>
                                 <div class="btn-group btn-group-sm">
                                     <a href="<?= site_url('participants/' . $participant['id'] . '/edit') ?>" class="btn btn-outline-warning btn-sm">Edit</a>
                                     <form action="<?= site_url('participants/' . $participant['id']) ?>" method="post" class="d-inline">
                                         <?= csrf_field() ?>
                                         <input type="hidden" name="_method" value="DELETE">
                                         <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this participant?')">Del</button>
                                     </form>
                                 </div>
                             </li>
                         <?php endforeach; ?>
                         <?php if (empty($recent_participants)): ?>
                             <li class="list-group-item text-muted">No participants yet.</li>
                         <?php endif; ?>
                     </ul>
                </div>
            </div>
        </div>

        <!-- Equipment Section -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-warning">Recent Equipment</h6>
                    <a href="<?= site_url('equipment') ?>" class="btn btn-sm btn-outline-warning">View All</a>
                </div>
                <div class="card-body">
                      <ul class="list-group list-group-flush">
                         <?php foreach($recent_equipment as $equipment): ?>
                             <li class="list-group-item d-flex justify-content-between align-items-center">
                                 <div>
                                     <a href="<?= site_url('equipment/' . $equipment['id']) ?>" class="text-decoration-none">
                                         <strong><?= esc($equipment['name']) ?></strong>
                                     </a>
                                     <br><small class="text-muted">Capability: <?= esc($equipment['capability'] ?? 'N/A') ?></small>
                                 </div>
                                 <div class="btn-group btn-group-sm">
                                     <a href="<?= site_url('equipment/' . $equipment['id'] . '/edit') ?>" class="btn btn-outline-warning btn-sm">Edit</a>
                                     <form action="<?= site_url('equipment/' . $equipment['id']) ?>" method="post" class="d-inline">
                                         <?= csrf_field() ?>
                                         <input type="hidden" name="_method" value="DELETE">
                                         <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this equipment?')">Del</button>
                                     </form>
                                 </div>
                             </li>
                         <?php endforeach; ?>
                         <?php if (empty($recent_equipment)): ?>
                             <li class="list-group-item text-muted">No equipment yet.</li>
                         <?php endif; ?>
                     </ul>
                </div>
            </div>
        </div>

        <!-- Facilities Section -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-secondary">Recent Facilities</h6>
                    <a href="<?= site_url('facilities') ?>" class="btn btn-sm btn-outline-secondary">View All</a>
                </div>
                <div class="card-body">
                      <ul class="list-group list-group-flush">
                         <?php foreach($recent_facilities as $facility): ?>
                             <li class="list-group-item d-flex justify-content-between align-items-center">
                                 <div>
                                     <a href="<?= site_url('facilities/' . $facility['id']) ?>" class="text-decoration-none">
                                         <strong><?= esc($facility['name']) ?></strong>
                                     </a>
                                     <br><small class="text-muted">Location: <?= esc($facility['location'] ?? 'N/A') ?></small>
                                 </div>
                                 <div class="btn-group btn-group-sm">
                                     <a href="<?= site_url('facilities/' . $facility['id'] . '/edit') ?>" class="btn btn-outline-warning btn-sm">Edit</a>
                                     <form action="<?= site_url('facilities/' . $facility['id']) ?>" method="post" class="d-inline">
                                         <?= csrf_field() ?>
                                         <input type="hidden" name="_method" value="DELETE">
                                         <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this facility?')">Del</button>
                                     </form>
                                 </div>
                             </li>
                         <?php endforeach; ?>
                         <?php if (empty($recent_facilities)): ?>
                             <li class="list-group-item text-muted">No facilities yet.</li>
                         <?php endif; ?>
                     </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Third Row -->
    <div class="row">
        <!-- Services Section -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-dark">Recent Services</h6>
                    <a href="<?= site_url('services') ?>" class="btn btn-sm btn-outline-dark">View All</a>
                </div>
                <div class="card-body">
                      <ul class="list-group list-group-flush">
                         <?php foreach($recent_services as $service): ?>
                             <li class="list-group-item d-flex justify-content-between align-items-center">
                                 <div>
                                     <a href="<?= site_url('services/' . $service['id']) ?>" class="text-decoration-none">
                                         <strong><?= esc($service['name']) ?></strong>
                                     </a>
                                     <br><small class="text-muted">Type: <?= esc($service['type'] ?? 'N/A') ?></small>
                                 </div>
                                 <div class="btn-group btn-group-sm">
                                     <a href="<?= site_url('services/' . $service['id'] . '/edit') ?>" class="btn btn-outline-warning btn-sm">Edit</a>
                                     <form action="<?= site_url('services/' . $service['id']) ?>" method="post" class="d-inline">
                                         <?= csrf_field() ?>
                                         <input type="hidden" name="_method" value="DELETE">
                                         <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this service?')">Del</button>
                                     </form>
                                 </div>
                             </li>
                         <?php endforeach; ?>
                         <?php if (empty($recent_services)): ?>
                             <li class="list-group-item text-muted">No services yet.</li>
                         <?php endif; ?>
                     </ul>
                </div>
            </div>
        </div>

        <!-- Outcomes Section -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-danger">Recent Outcomes</h6>
                    <a href="<?= site_url('outcomes') ?>" class="btn btn-sm btn-outline-danger">View All</a>
                </div>
                <div class="card-body">
                      <ul class="list-group list-group-flush">
                         <?php foreach($recent_outcomes as $outcome): ?>
                             <li class="list-group-item d-flex justify-content-between align-items-center">
                                 <div>
                                     <a href="<?= site_url('outcomes/' . $outcome['id']) ?>" class="text-decoration-none">
                                         <strong>Outcome #<?= $outcome['id'] ?></strong>
                                     </a>
                                     <br><small class="text-muted">Project: <?= esc($outcome['project_id'] ?? 'N/A') ?></small>
                                 </div>
                                 <div class="btn-group btn-group-sm">
                                     <a href="<?= site_url('outcomes/' . $outcome['id'] . '/edit') ?>" class="btn btn-outline-warning btn-sm">Edit</a>
                                     <form action="<?= site_url('outcomes/' . $outcome['id']) ?>" method="post" class="d-inline">
                                         <?= csrf_field() ?>
                                         <input type="hidden" name="_method" value="DELETE">
                                         <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this outcome?')">Del</button>
                                     </form>
                                 </div>
                             </li>
                         <?php endforeach; ?>
                         <?php if (empty($recent_outcomes)): ?>
                             <li class="list-group-item text-muted">No outcomes yet.</li>
                         <?php endif; ?>
                     </ul>
                </div>
            </div>
        </div>
    </div>

        <div class="col-lg-4 mb-4">
            <div class="card gradient-card mb-4">
                <div class="card-header py-3 border-0 bg-transparent">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-rocket mr-2"></i>Quick Actions
                    </h6>
                </div>
                <div class="card-body">
                    <!-- Create New Section -->
                    <div class="mb-4">
                        <h6 class="section-title">
                            <i class="fas fa-plus-circle mr-1"></i>Create New
                        </h6>
                        <div class="row g-2">
                            <div class="col-12">
                                <a href="<?= site_url('projects/new') ?>" class="btn create-btn quick-action-btn w-100 d-flex align-items-center justify-content-center">
                                    <i class="fas fa-project-diagram btn-icon text-success"></i>
                                    <span class="fw-bold">New Project</span>
                                </a>
                            </div>
                            <div class="col-12">
                                <a href="<?= site_url('programs/new') ?>" class="btn create-btn quick-action-btn w-100 d-flex align-items-center justify-content-center">
                                    <i class="fas fa-calendar-alt btn-icon text-primary"></i>
                                    <span class="fw-bold">New Program</span>
                                </a>
                            </div>
                            <div class="col-12">
                                <a href="<?= site_url('participants/new') ?>" class="btn create-btn quick-action-btn w-100 d-flex align-items-center justify-content-center">
                                    <i class="fas fa-users btn-icon text-info"></i>
                                    <span class="fw-bold">New Participant</span>
                                </a>
                            </div>
                            <div class="col-12">
                                <a href="<?= site_url('equipment/new') ?>" class="btn create-btn quick-action-btn w-100 d-flex align-items-center justify-content-center">
                                    <i class="fas fa-tools btn-icon text-danger"></i>
                                    <span class="fw-bold">New Equipment</span>
                                </a>
                            </div>
                            <div class="col-12">
                                <a href="<?= site_url('services/new') ?>" class="btn create-btn quick-action-btn w-100 d-flex align-items-center justify-content-center">
                                    <i class="fas fa-cogs btn-icon text-warning"></i>
                                    <span class="fw-bold">New Service</span>
                                </a>
                            </div>
                            <div class="col-12">
                                <a href="<?= site_url('facilities/new') ?>" class="btn create-btn quick-action-btn w-100 d-flex align-items-center justify-content-center">
                                    <i class="fas fa-building btn-icon text-dark"></i>
                                    <span class="fw-bold">New Facility</span>
                                </a>
                            </div>
                            <div class="col-12">
                                <a href="<?= site_url('outcomes/new') ?>" class="btn create-btn quick-action-btn w-100 d-flex align-items-center justify-content-center">
                                    <i class="fas fa-chart-line btn-icon text-secondary"></i>
                                    <span class="fw-bold">New Outcome</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Manage All Section -->
                    <div>
                        <h6 class="section-title">
                            <i class="fas fa-tasks mr-1"></i>Manage All
                        </h6>
                        <div class="row g-2">
                            <div class="col-12">
                                <a href="<?= site_url('projects') ?>" class="btn manage-btn quick-action-btn w-100 d-flex align-items-center justify-content-center">
                                    <i class="fas fa-list btn-icon"></i>
                                    <span>Projects</span>
                                    <span class="count-badge ms-auto"><?= $project_count ?? 0 ?></span>
                                </a>
                            </div>
                            <div class="col-12">
                                <a href="<?= site_url('programs') ?>" class="btn manage-btn quick-action-btn w-100 d-flex align-items-center justify-content-center">
                                    <i class="fas fa-calendar btn-icon"></i>
                                    <span>Programs</span>
                                    <span class="count-badge ms-auto bg-primary"><?= $program_count ?? 0 ?></span>
                                </a>
                            </div>
                            <div class="col-12">
                                <a href="<?= site_url('participants') ?>" class="btn manage-btn quick-action-btn w-100 d-flex align-items-center justify-content-center">
                                    <i class="fas fa-user-friends btn-icon"></i>
                                    <span>Participants</span>
                                    <span class="count-badge ms-auto bg-info"><?= $participant_count ?? 0 ?></span>
                                </a>
                            </div>
                            <div class="col-12">
                                <a href="<?= site_url('equipment') ?>" class="btn manage-btn quick-action-btn w-100 d-flex align-items-center justify-content-center">
                                    <i class="fas fa-wrench btn-icon"></i>
                                    <span>Equipment</span>
                                    <span class="count-badge ms-auto bg-danger"><?= $equipment_count ?? 0 ?></span>
                                </a>
                            </div>
                            <div class="col-12">
                                <a href="<?= site_url('services') ?>" class="btn manage-btn quick-action-btn w-100 d-flex align-items-center justify-content-center">
                                    <i class="fas fa-concierge-bell btn-icon"></i>
                                    <span>Services</span>
                                    <span class="count-badge ms-auto bg-warning text-dark"><?= $service_count ?? 0 ?></span>
                                </a>
                            </div>
                            <div class="col-12">
                                <a href="<?= site_url('facilities') ?>" class="btn manage-btn quick-action-btn w-100 d-flex align-items-center justify-content-center">
                                    <i class="fas fa-city btn-icon"></i>
                                    <span>Facilities</span>
                                    <span class="count-badge ms-auto bg-dark"><?= $facility_count ?? 0 ?></span>
                                </a>
                            </div>
                            <div class="col-12">
                                <a href="<?= site_url('outcomes') ?>" class="btn manage-btn quick-action-btn w-100 d-flex align-items-center justify-content-center">
                                    <i class="fas fa-chart-bar btn-icon"></i>
                                    <span>Outcomes</span>
                                    <span class="count-badge ms-auto bg-secondary"><?= $outcome_count ?? 0 ?></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Font Awesome for icons -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
<?= $this->endSection() ?>