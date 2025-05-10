<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Create Task<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Create New Task</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="<?= site_url('tasks') ?>" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Tasks
            </a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-plus-circle me-1"></i>
                    Task Details
                </div>
                <div class="card-body">
                    <form action="<?= site_url('tasks/store') ?>" method="post">
                        <?= csrf_field() ?>
                        
                        <?php if(isset($errors) && is_array($errors)): ?>
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    <?php foreach($errors as $error): ?>
                                        <li><?= esc($error) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        
                        <div class="mb-3">
                            <label for="title" class="form-label">Task Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="<?= old('title') ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="4"><?= old('description') ?></textarea>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="priority" class="form-label">Priority</label>
                                <select class="form-select" id="priority" name="priority">
                                    <option value="low" <?= old('priority') == 'low' ? 'selected' : '' ?>>Low</option>
                                    <option value="medium" <?= old('priority') == 'medium' || old('priority') == '' ? 'selected' : '' ?>>Medium</option>
                                    <option value="high" <?= old('priority') == 'high' ? 'selected' : '' ?>>High</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" name="status">
                                    <option value="pending" <?= old('status') == 'pending' || old('status') == '' ? 'selected' : '' ?>>Pending</option>
                                    <option value="in-progress" <?= old('status') == 'in-progress' ? 'selected' : '' ?>>In Progress</option>
                                    <option value="completed" <?= old('status') == 'completed' ? 'selected' : '' ?>>Completed</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="due_date" class="form-label">Due Date</label>
                                <input type="date" class="form-control" id="due_date" name="due_date" value="<?= old('due_date') ?>">
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="<?= site_url('tasks') ?>" class="btn btn-secondary me-md-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">Create Task</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-info-circle me-1"></i>
                    Task Information
                </div>
                <div class="card-body">
                    <h5 class="card-title">Creating a New Task</h5>
                    <p class="card-text">Fill in the form with your task details. All fields except Description and Due Date are required.</p>
                    
                    <h6 class="mt-3">Priority Levels</h6>
                    <ul class="list-unstyled">
                        <li><span class="badge bg-success">Low</span> - Low urgency tasks</li>
                        <li><span class="badge bg-warning">Medium</span> - Regular priority tasks</li>
                        <li><span class="badge bg-danger">High</span> - Urgent tasks requiring immediate attention</li>
                    </ul>
                    
                    <h6 class="mt-3">Status Options</h6>
                    <ul class="list-unstyled">
                        <li><span class="badge bg-secondary">Pending</span> - Not started yet</li>
                        <li><span class="badge bg-primary">In Progress</span> - Currently being worked on</li>
                        <li><span class="badge bg-success">Completed</span> - Finished tasks</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
