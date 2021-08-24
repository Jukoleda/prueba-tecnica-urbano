<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="./views/public/css/styles.css" rel="stylesheet">
    <link href="./views/public/css/jquery-ui.min.css" rel="stylesheet">
    <script src="./views/public/js/lib/jquery-3.6.0.min.js"></script>
    <script src="./views/public/js/lib/jquery-ui.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    <script defer src="./views/public/js/app.js"></script>
    <script defer src="./views/public/js/clientes.js"></script>
    <script defer src="./views/public/js/grupos.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />    <title>Document</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="navbar-brand enlace" id="home">Urbano Expres</div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <div class="nav-link active enlace" id="clientes">Clientes</div>
                        </li>
                        <li class="nav-item">
                            <div class="nav-link enlace" id="grupos">Grupos Clientes</div>
                        </li>
                    </ul>
                    
                </div>
            </nav>
        </div>
        <div id="main">
            <?php
                require_once('partials/ListadoClientes.php');
            ?>
        </div>
        <div class="toast-container position-absolute bottom-0 end-0 mb-5">
            <div class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true" id="messageType">
                <div class="d-flex">
                    <div class="toast-body" id="messageResult">
                        Hello, world! This is a toast message.
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
