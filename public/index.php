<?php require __DIR__ . '/../bootstrap.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>CRUD de Usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            min-height: 100vh;
        }
        .navbar {
            margin-bottom: 2rem;
        }
        .alert {
            --bs-alert-padding-y: 0px;
            --bs-alert-border-radius: 0px;
        }
    </style>

</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/">Sistema de Usuários</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item"><a href="/" class="nav-link">Início</a></li>
                <li class="nav-item"><a href="?page=create_user" class="nav-link">Cadastrar</a></li>
                <li class="nav-item"><a href="?page=contato" class="nav-link">Suporte</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <?php
    if ($msg = get('message')) {
        echo $msg;
    }
    try {
        require load();
    } catch (Exception $e) {
        echo "<div class='alert alert-danger'>".$e->getMessage()."</div>";
    }
    ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
