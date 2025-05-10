<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Tasks<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tasks</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="<?= site_url('tasks/create') ?>" class="btn btn-sm btn-primary">
                <i class="fas fa-plus me-1"></i> New Task
            </a>
        </div>
    </div>
    
    <!-- Status filter -->
    <div class="mb-4">
        <div class="btn-group" role="group" aria-label="Filter tasks">
            <a href="<?= site_url('tasks') ?>" class="btn btn-outline-secondary <?= empty($filter) ? 'active' : '' ?>">All</a>
            <a href="<?= site_url('tasks?status=pending') ?>" class="btn btn-outline-secondary <?= $filter == 'pending' ? 'active' : '' ?>">Pending</a>
            <a href="<?= site_url('tasks?status=in-progress') ?>" class="btn btn-outline-secondary <?= $filter == 'in-progress' ? 'active' : '' ?>">In Progress</a>
            <a href="<?= site_url('tasks?status=completed') ?>" class="btn btn-outline-secondary <?= $filter == 'completed' ? 'active' : '' ?>">Completed</a>
        </div>
    </div>
    
    <?php if (empty($tasks)): ?>
        <div class="alert alert-info">
            <h4 class="alert-heading">No tasks found!</h4>
            <p>You don't have any <?= $filter ? $filter : '' ?> tasks at the moment.</p>
            <hr>
            <p class="mb-0">Click the "New Task" button above to create a task.</p>
        </div>
    <?php else: ?>
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4">
            <?php foreach ($tasks as $task): ?>
                <div class="col">
                    <div class="card h-100 task-card <?= $task['priority'] ?>">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span class="badge bg-<?= $task['status'] == 'pending' ? 'secondary' : ($task['status'] == 'in-progress' ? 'primary' : 'success') ?>">
                                <?= ucfirst(str_replace('-', ' ', esc($task['status']))) ?>
                            </span>
                            <span class="badge bg-<?= $task['priority'] == 'high' ? 'danger' : ($task['priority'] == 'medium' ? 'warning' : 'success') ?>">
                                <?= ucfirst(esc($task['priority'])) ?> Priority
                            </span>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?= esc($task['title']) ?></h5>
                            <p class="card-text">
                                <?= nl2br(esc($task['description'])) ?>
                            </p>
                            <?php if ($task['due_date']): ?>
                                <p class="card-text">
                                    <small class="text-muted">
                                        <i class="fas fa-calendar"></i> Due: <?= date('M d, Y', strtotime($task['due_date'])) ?>
                                    </small>
                                </p>
                            <?php endif; ?>
                        </div>
                        <div class="card-footer bg-transparent d-flex justify-content-end">
                            <a href="<?= site_url('tasks/edit/' . $task['id']) ?>" class="btn btn-sm btn-outline-primary me-1">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="<?= site_url('tasks/delete/' . $task['id']) ?>" class="btn btn-sm btn-outline-danger" 
                               onclick="return confirm('Are you sure you want to delete this task?');">
                                <i class="fas fa-trash"></i> Delete
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>
