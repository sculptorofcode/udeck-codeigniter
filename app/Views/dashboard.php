<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Dashboard<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="<?= site_url('tasks/create') ?>" class="btn btn-sm btn-primary">
                <i class="fas fa-plus me-1"></i> New Task
            </a>
        </div>
    </div>
    
    <!-- Task summary cards -->
    <div class="row">
        <div class="col-md-4 col-xl-4">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    <h5 class="card-title">Pending Tasks</h5>
                    <h2 class="display-4"><?= $pendingCount ?></h2>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a href="<?= site_url('tasks?status=pending') ?>" class="text-white">View Details</a>
                    <div><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-xl-4">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">
                    <h5 class="card-title">In Progress</h5>
                    <h2 class="display-4"><?= $inProgressCount ?></h2>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a href="<?= site_url('tasks?status=in-progress') ?>" class="text-white">View Details</a>
                    <div><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-xl-4">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">
                    <h5 class="card-title">Completed Tasks</h5>
                    <h2 class="display-4"><?= $completedCount ?></h2>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a href="<?= site_url('tasks?status=completed') ?>" class="text-white">View Details</a>
                    <div><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Recent Tasks -->
    <div class="row mt-4">
        <div class="col">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-clock me-1"></i>
                    Recent Tasks
                </div>
                <div class="card-body">
                    <?php if (empty($recentTasks)): ?>
                        <div class="alert alert-info">No tasks found. Create a new task to get started.</div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Priority</th>
                                        <th>Status</th>
                                        <th>Due Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($recentTasks as $task): ?>
                                        <tr>
                                            <td><?= esc($task['title']) ?></td>
                                            <td>
                                                <span class="badge bg-<?= $task['priority'] == 'high' ? 'danger' : ($task['priority'] == 'medium' ? 'warning' : 'success') ?>">
                                                    <?= ucfirst(esc($task['priority'])) ?>
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge bg-<?= $task['status'] == 'pending' ? 'secondary' : ($task['status'] == 'in-progress' ? 'primary' : 'success') ?>">
                                                    <?= ucfirst(str_replace('-', ' ', esc($task['status']))) ?>
                                                </span>
                                            </td>
                                            <td><?= $task['due_date'] ? date('M d, Y', strtotime($task['due_date'])) : 'No due date' ?></td>
                                            <td>
                                                <a href="<?= site_url('tasks/edit/' . $task['id']) ?>" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="card-footer small text-muted">
                    <a href="<?= site_url('tasks') ?>" class="btn btn-sm btn-outline-secondary">View All Tasks</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
