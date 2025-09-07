<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?><?= $title ?><?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <a href="<?= site_url('/projects') ?>">&laquo; Back to all projects</a>
    
    <?php if (session()->has('success')): ?>
        <div class="alert alert-success mt-4"><?= session('success') ?></div>
    <?php endif; ?>
    <?php if (session()->has('error')): ?>
        <div class="alert alert-danger mt-4"><?= session('error') ?></div>
    <?php endif; ?>

    <div class="card my-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h2><?= esc($project['name']) ?></h2>
                <a href="<?= site_url('projects/edit/' . $project['id']) ?>" class="btn btn-warning">Edit Project</a>
            </div>
        </div>
        <div class="card-body">
            <p><?= esc($project['description']) ?></p>
            <hr>
            <div class="row">
                <div class="col-md-3"><strong>Status:</strong> <span class="badge bg-primary"><?= esc($project['status']) ?></span></div>
                <div class="col-md-3"><strong>Budget:</strong> $<?= number_format($project['budget'], 2) ?></div>
                <div class="col-md-3"><strong>Start Date:</strong> <?= esc($project['start_date']) ?></div>
                <div class="col-md-3"><strong>End Date:</strong> <?= esc($project['end_date']) ?></div>
            </div>
        </div>
    </div>

    <!-- Linked Items -->
    <div class="row">
        <!-- Participants -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5>Participants</h5>
                </div>
                <div class="card-body">
                    <form action="<?= site_url('projects/link_participant/' . $project['id']) ?>" method="post" class="mb-3">
                        <?= csrf_field() ?>
                        <div class="input-group">
                            <select name="participant_id" class="form-select">
                                <option value="">Link a participant...</option>
                                <?php foreach($all_participants as $p): ?>
                                    <option value="<?= $p['id'] ?>"><?= esc($p['first_name'] . ' ' . $p['last_name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                            <button class="btn btn-primary" type="submit">Link</button>
                        </div>
                    </form>
                    <ul class="list-group">
                        <?php foreach($participants as $p): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?= esc($p['first_name'] . ' ' . $p['last_name']) ?>
                            <a href="<?= site_url('projects/unlink_participant/' . $project['id'] . '/' . $p['id']) ?>" class="btn-close"></a>
                        </li>
                        <?php endforeach; ?>
                        <?php if (empty($participants)): ?>
                            <li class="list-group-item text-muted">No participants linked.</li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Equipment -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header"><h5>Equipment</h5></div>
                <div class="card-body">
                    <form action="<?= site_url('projects/link_equipment/' . $project['id']) ?>" method="post" class="mb-3">
                        <?= csrf_field() ?>
                         <div class="input-group">
                            <select name="equipment_id" class="form-select">
                                <option value="">Link equipment...</option>
                                <?php foreach($all_equipment as $e): ?>
                                    <option value="<?= $e['id'] ?>"><?= esc($e['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                            <button class="btn btn-primary" type="submit">Link</button>
                        </div>
                    </form>
                    <ul class="list-group">
                        <?php foreach($equipment as $e): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?= esc($e['name']) ?>
                            <a href="<?= site_url('projects/unlink_equipment/' . $project['id'] . '/' . $e['id']) ?>" class="btn-close"></a>
                        </li>
                        <?php endforeach; ?>
                        <?php if (empty($equipment)): ?>
                            <li class="list-group-item text-muted">No equipment linked.</li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
         <!-- Services -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header"><h5>Services</h5></div>
                 <div class="card-body">
                    <form action="<?= site_url('projects/link_service/' . $project['id']) ?>" method="post" class="mb-3">
                        <?= csrf_field() ?>
                         <div class="input-group">
                            <select name="service_id" class="form-select">
                                <option value="">Link a service...</option>
                                <?php foreach($all_services as $s): ?>
                                    <option value="<?= $s['id'] ?>"><?= esc($s['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                            <button class="btn btn-primary" type="submit">Link</button>
                        </div>
                    </form>
                    <ul class="list-group">
                        <?php foreach($services as $s): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?= esc($s['name']) ?>
                            <a href="<?= site_url('projects/unlink_service/' . $project['id'] . '/' . $s['id']) ?>" class="btn-close"></a>
                        </li>
                        <?php endforeach; ?>
                        <?php if (empty($services)): ?>
                            <li class="list-group-item text-muted">No services linked.</li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Outcomes -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>Outcomes</h5>
                    <a href="<?= site_url('outcomes/new/' . $project['id']) ?>" class="btn btn-sm btn-primary">Add Outcome</a>
                </div>
                <ul class="list-group list-group-flush">
                    <?php foreach($outcomes as $o): ?>
                    <li class="list-group-item">
                        <p><?= esc($o['description']) ?></p>
                        <small class="text-muted">Metric: <?= esc($o['metric']) ?> | Target: <?= esc($o['target_value']) ?> | Actual: <?= esc($o['actual_value']) ?></small>
                         <div class="mt-2">
                             <a href="<?= site_url('outcomes/edit/' . $o['id']) ?>" class="btn btn-sm btn-outline-secondary">Edit</a>
                             <form action="<?= site_url('outcomes/delete/' . $o['id']) ?>" method="post" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                <?= csrf_field() ?>
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                             </form>
                         </div>
                    </li>
                    <?php endforeach; ?>
                    <?php if (empty($outcomes)): ?>
                        <li class="list-group-item text-muted">No outcomes defined.</li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
