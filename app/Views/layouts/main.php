<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('title') ?> - Task Management</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <style>
        body {
            background-color: #f8f9fa;
        }
        .task-card {
            border-left: 5px solid #6c757d;
            transition: transform 0.2s;
        }
        .task-card:hover {
            transform: translateY(-5px);
        }
        .task-card.high {
            border-left-color: #dc3545;
        }
        .task-card.medium {
            border-left-color: #ffc107;
        }
        .task-card.low {
            border-left-color: #28a745;
        }
        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
        }
        .nav-link {
            color: rgba(255, 255, 255, 0.8);
        }
        .nav-link:hover {
            color: white;
        }
        .nav-link.active {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
        }
    </style>
    
    <?= $this->renderSection('styles') ?>
</head>
<body>
    <?php if(session()->get('isLoggedIn')): ?>
        <div class="container-fluid">
            <div class="row">
                <!-- Sidebar -->
                <div class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
                    <div class="position-sticky pt-3">
                        <div class="text-center mb-4">
                            <h4 class="text-white">Task Management</h4>
                            <p class="text-light"><?= session()->get('name') ?></p>
                        </div>
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link <?= current_url() == site_url('dashboard') ? 'active' : '' ?>" href="<?= site_url('dashboard') ?>">
                                    <i class="fas fa-tachometer-alt me-2"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= strpos(current_url(), '/tasks') !== false ? 'active' : '' ?>" href="<?= site_url('tasks') ?>">
                                    <i class="fas fa-tasks me-2"></i>
                                    Tasks
                                </a>
                            </li>
                            <li class="nav-item mt-5">
                                <a class="nav-link" href="<?= site_url('logout') ?>">
                                    <i class="fas fa-sign-out-alt me-2"></i>
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <!-- Main content -->
                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                    <?php if(session()->getFlashdata('success')): ?>
                        <div class="alert alert-success">
                            <?= session()->getFlashdata('success') ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if(session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger">
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>
                    
                    <?= $this->renderSection('content') ?>
                </main>
            </div>
        </div>
    <?php else: ?>
        <!-- Auth pages layout -->
        <div class="container mt-5">
            <?php if(session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>
            
            <?php if(session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>
            
            <?= $this->renderSection('content') ?>
        </div>
    <?php endif; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <?= $this->renderSection('scripts') ?>
</body>
</html>
