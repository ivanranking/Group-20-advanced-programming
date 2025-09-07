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
        <div class="col-lg-8 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Recently Added Projects</h6>
                </div>
                <div class="card-body">
                     <ul class="list-group list-group-flush">
                        <?php foreach($recent_projects as $project): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <a href="<?= site_url('projects/' . $project['id']) ?>"><?= esc($project['name']) ?></a>
                                    <br><small class="text-muted">Status: <span class="badge bg-secondary"><?= esc($project['status']) ?></span></small>
                                </div>
                                <div class="btn-group btn-group-sm">
                                    <a href="<?= site_url('projects/' . $project['id'] . '/edit') ?>" class="btn btn-outline-warning">Edit</a>
                                    <form action="<?= site_url('projects/' . $project['id']) ?>" method="post" class="d-inline">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete this project?')">Delete</button>
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

        <div class="col-lg-4 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Quick Links</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-6"><a href="<?= site_url('programs/new') ?>" class="btn btn-primary btn-sm w-100">New Program</a></div>
                        <div class="col-6"><a href="<?= site_url('programs') ?>" class="btn btn-primary btn-sm w-100">Manage</a></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6"><a href="<?= site_url('projects/new') ?>" class="btn btn-success btn-sm w-100">New Project</a></div>
                        <div class="col-6"><a href="<?= site_url('projects') ?>" class="btn btn-success btn-sm w-100">Manage</a></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6"><a href="<?= site_url('participants/new') ?>" class="btn btn-info btn-sm w-100 text-white">New Participant</a></div>
                        <div class="col-6"><a href="<?= site_url('participants') ?>" class="btn btn-info btn-sm w-100">Manage</a></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6"><a href="<?= site_url('services/new') ?>" class="btn btn-warning btn-sm w-100 text-white">New Service</a></div>
                        <div class="col-6"><a href="<?= site_url('services') ?>" class="btn btn-warning btn-sm w-100">Manage</a></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6"><a href="<?= site_url('equipment/new') ?>" class="btn btn-danger btn-sm w-100 text-white">New Equipment</a></div>
                        <div class="col-6"><a href="<?= site_url('equipment') ?>" class="btn btn-danger btn-sm w-100">Manage</a></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6"><a href="<?= site_url('outcomes/new') ?>" class="btn btn-secondary btn-sm w-100">New Outcome</a></div>
                        <div class="col-6"><a href="<?= site_url('outcomes') ?>" class="btn btn-secondary btn-sm w-100">Manage</a></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6"><a href="<?= site_url('facilities/new') ?>" class="btn btn-dark btn-sm w-100 text-white">New Facility</a></div>
                        <div class="col-6"><a href="<?= site_url('facilities') ?>" class="btn btn-dark btn-sm w-100">Manage</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Font Awesome for icons -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
<?= $this->endSection() ?>