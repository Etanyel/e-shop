<?php
$this->extend('petshop/users/admin/layout/layout');
?>

<?php $this->section('title') ?>
Scheduling
<?php $this->endSection() ?>

<?php $this->section('content') ?>

<div class="p-2 shadow-sm rounded mb-3 d-flex justify-content-between align-items-center">
    <div>
        <input type="text" name="search" id="search" class="form-control" placeholder="Search devices...">
        <p class="form-text">Search devices here</p>
    </div>
</div>

<div class="d-flex flex-wrap gap-3">
    <?php foreach ($devices as $d): ?>
        <div class="card text-center border-0 rounded shadow mb-2 p-2" style="width: 18rem;">
            <div class="card-header bg-white">
                <h5 class="mb-0"><?= esc($d['system_name'] ?: 'No Name Yet') ?></h5>
            </div>
            <div class="card-body">
                <p class="text-muted mb-2">Device Chip ID: <?= esc($d['chip_id']) ?></p>
                <p class="text-muted mb-2">Device Schedules</p>

                <div class="d-flex flex-column text-start mb-3">
                    <div class="mb-1 p-1 rounded shadow-sm">
                        <span class="fw-semibold">MORNING:</span> <?= esc($d['morning_sched'] ?: 'N/A') ?>
                    </div>
                    <div class="mb-1 p-1 rounded shadow-sm">
                        <span class="fw-semibold">NOON:</span> <?= esc($d['noon_sched'] ?: 'N/A') ?>
                    </div>
                    <div class="mb-1 p-1 rounded shadow-sm">
                        <span class="fw-semibold">EVENING:</span> <?= esc($d['evening_sched'] ?: 'N/A') ?>
                    </div>
                </div>

                <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#m<?= esc($d['chip_id']) ?>">
                    Make Schedule
                </button>
            </div>

        </div>

        <!-- Modal -->
        <div class="modal fade" id="m<?= esc($d['chip_id']) ?>" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Make Schedule</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <form action="/admin/schedules" method="post">
                        <?= csrf_field() ?>
                        <div class="modal-body">
                            <div class="mb-3">
                                <input type="hidden" name="id" value="<?= esc($d['system_id']) ?>">
                                <label class="form-label">Device Name</label>
                                <input type="text" name="name" value="<?= esc($d['system_name']) ?>" class="form-control" placeholder="Enter device name">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Morning Schedule</label>
                                <input type="time" value="<?= esc($d['morning_sched']) ?>" name="morning" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Noon Schedule</label>
                                <input type="time" name="noon" value="<?= esc($d['noon_sched']) ?>" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Evening Schedule</label>
                                <input type="time" name="evening" value="<?= esc($d['evening_sched']) ?>" class="form-control">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-primary">Save Schedule</button>
                            <span class="btn btn-secondary" data-bs-dismiss="modal">Cancel</span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php $this->endSection() ?>