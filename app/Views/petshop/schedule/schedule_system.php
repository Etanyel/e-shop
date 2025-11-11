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

    <div class="">
        <button class="btn btn-primary" data-bs-target="#add_device" data-bs-toggle="modal">Add Device</button>
    </div>
</div>

<div class="modal fade" id="add_device">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h4 class="modal-title">Add Device and Schedule</h4>
                <span class="btn btn-close" data-bs-dismiss="modal"></span>
            </div>

            <form action="/admin/schedules/add" method="post">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="">
                        <p class="fw-semibold text-primary">Device Information</p>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="" class="form-label">Network Name</label>
                            <input type="text" name="network_name" id="" class="form-control" placeholder="eg. Wifi Name of the device">
                        </div>
                        <div class="col-6">
                            <label for="" class="form-label">Pet</label>
                            <input type="text" name="pet" id="" class="form-control" placeholder="eg. (dog, cat, fish)">
                        </div>
                    </div>

                    <div class="">
                        <p class="fw-semibold text-warning">Device Schedules</p>
                    </div>
                    <div class="mb-2">
                        <label for="" class="form-label">Morning Schedule</label>
                        <input type="time" name="morning" id="" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label for="" class="form-label">Noon Schedule</label>
                        <input type="time" name="noon" id="" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label for="" class="form-label">Evening Schedule</label>
                        <input type="time" name="evening" id="" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary">Proceed</button>
                    <span class="btn btn-secondary" data-bs-dismiss="modal">Cancel</span>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="d-flex flex-wrap gap-3">
    <?php foreach ($devices as $d): ?>
        <div class="card text-center border-0 rounded shadow mb-2 p-2" style="width: 18rem;">
            <div class="card-header bg-white">
                <h5 class="mb-0"><?= esc($d['network_name'] ?: 'No Name Yet') ?></h5>
            </div>
            <div class="card-body">
                <div class="">
                    <p class="mb-2 fw-semibold"><?= esc($d['system_name'] ?: 'No Name Yet') ?></p>
                </div>
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

                <form action="admin/system/toggleActive/<?= esc($d['system_id']) ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="form-check form-switch mb-3">
                        <input
                            id="isActive<?= $d['system_id'] ?>"
                            type="checkbox"
                            name="isActive"
                            value="1"
                            class="form-check-input"
                            onchange="this.form.submit()"
                            <?= $d['isActive'] == 1 ? 'checked' : '' ?>>
                        <label for="isActive<?= $d['system_id'] ?>" class="form-check-label <?= esc($d['isActive'] == 1 ? 'text-success fw-semibold' : 'text-muted fw-semibold') ?>">
                            <?= $d['isActive'] == 1 ? 'Active' : 'Inactive' ?>
                        </label>
                    </div>
                </form>

                <button class="btn btn-primary form-control" data-bs-target="#m<?= esc($d['system_id']) ?>" data-bs-toggle="modal">Update Device</button>
            </div>

        </div>

        <!-- Modal -->
        <div class="modal fade" id="m<?= esc($d['system_id']) ?>" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Update Device</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <form action="/admin/schedules" method="post">
                        <?= csrf_field() ?>
                        <div class="modal-body">
                            <div class="mb-3">
                                <input type="hidden" name="id" value="<?= esc($d['system_id']) ?>">
                                <label class="form-label">Network Name</label>
                                <input type="text" name="network_name" value="<?= esc($d['network_name']) ?>" class="form-control"
                                    placeholder="Enter device wifi name">
                            </div>
                            <div>
                                <label class="form-label">Pet</label>
                                <input type="text" name="name" value="<?= esc($d['system_name']) ?>" class="form-control"
                                    placeholder="eg. (dog, cat, fish)">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Morning Schedule</label>
                                <input type="time" value="<?= esc($d['morning_sched']) ?>" name="morning"
                                    class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Noon Schedule</label>
                                <input type="time" name="noon" value="<?= esc($d['noon_sched']) ?>" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Evening Schedule</label>
                                <input type="time" name="evening" value="<?= esc($d['evening_sched']) ?>"
                                    class="form-control">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-primary">Update</button>
                            <span class="btn btn-secondary" data-bs-dismiss="modal">Cancel</span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php $this->endSection() ?>