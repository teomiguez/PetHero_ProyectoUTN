<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Dueño Home </title>


    <!-- Link use Css_file -->
    <link rel="stylesheet" href="css/styles.css">

    <!-- Link use Boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous" />

    <!-- Link icon's Boostrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />

</head>

<body>
    <!-- Barra de navegacion -->
    <nav class="navbar navbar-expand-lg nav-color border-bottom border-dark">
        <div class="container-fluid">

            <h2 class="navbar-brand fs-3 pt-2">
                <strong>
                    Pet Hero
                </strong>
            </h2>

            <div class="navbar-nav position-absolute top-50 start-50 translate-middle">
                <a href="<?php echo FRONT_ROOT . "Owner/HomeOwner" ?>" class="nav-link active text-decoration-none"> *Home* </a>
            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav position-absolute top-50 end-0 translate-middle-y">
                    <li class="nav-item">
                        <a href="#" class="nav-link text-decoration-none"> *Notificaciones* </a>
                    </li>

                    <li class="nav-item">
                        <a href="<?php echo FRONT_ROOT . "Pet/ShowList" ?>" class="nav-link text-decoration-none"> *Mis Mascotas* </a>
                    </li>

                    <li class="nav-item">
                        <a href="<?php echo FRONT_ROOT . "Owner/ShowProfile" ?>" class="nav-link text-decoration-none"> *Mi Perfil*</a>
                    </li>

                    <li class="nav-item">
                        <a href="<?php echo FRONT_ROOT . "Auth/Logout" ?>" class="nav-link text-decoration-none"> *Salir*</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <br>

    <main class="container">

        <div class="row">

            <div class="col-12 col-sm-12 col-md-12 col-lg-3 pt-3">
                *Listado de Reservas activas y a pagar*
            </div>

            <div class="col-12 col-sm-8 col-lg-5 pt-3">
                <h2 class="text-center"> Lista de guardianes </h2>
            
                <form action="">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Buscar guardian..."
                            aria-label="Buscar guardian..." aria-describedby="button-addon2">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>

                <table class="table text-center">
                    <thead>
                        <tr>
                            <th scope="col"> Nombre </th>
                            <th scope="col"> Apellido </th>
                            <th scope="col"> Telefono </th>
                            <th scope="col"> Perfil </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                            foreach ($guardians as $guardian) {
                        ?>

                        <tr>
                            <td> <?php echo $guardian->getName() ?> </td>
                            <td> <?php echo $guardian->getLast_name() ?> </td>
                            <td> <?php echo $guardian->getTelephone() ?> </td>
                            <td> <a href="#"> ver </a> </td>
                        </tr>
                    </tbody>   
                
                    <?php } ?>
                </table>
            </div>

            <div class="col-12 col-sm-4 pt-3">
                *Listado de reservas pasadas + opcion review*
            </div>
        </div>

    </main>

    <!-- Linea divisoria main/footer -->
    <hr>

    <footer>
        <div class="text-center">
            <a href="#"> *Red Social* </a>
            <a href="#"> *Red Social* </a>
        </div>
    </footer>

    <!-- Boostrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>