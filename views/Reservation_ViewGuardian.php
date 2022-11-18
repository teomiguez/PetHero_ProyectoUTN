<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Ver Reserva </title>

    <!-- Link use Css_file -->
    <link rel="stylesheet" href="css/styles.css">
    
    <!-- Link use Boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

    <!-- Link icon's Boostrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    
</head>

<body>
    <!-- Barra de navegacion -->
    <?php

    include('nav-guardian.php');

    ?>

    <br>
    
    <main class="container text-center">
        <div class="col-md-6 offset-md-3">
            <h2 class="text-center my-3"> Reserva nro. <?php echo $reserv->getId_reservation() ?> </h2>
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th scope="row"> Tamaño: </th>
                        <td> <?php echo $reserv->getPet_size() ?> </td>
                    </tr>
                    <tr>
                        <th scope="row"> Raza: </th>
                        <td> <?php echo $reserv->getPet_breed() ?> </td>
                    </tr>
                    <tr>
                        <th scope="row"> Desde: </th>
                        <td> <?php echo $reserv->getFirst_day() ?> </td>
                    </tr>
                    <tr>
                        <th scope="row"> Hasta: </th>
                        <td> <?php echo $reserv->getLast_day() ?> </td>
                    </tr>
                    <tr>
                        <th scope="row"> Días totales: </th>
                        <td> <?php echo $reserv->getTotal_days() ?> </td>
                    </tr>
                </tbody>
            </table>    
            <div class="text-center">
                <div class="row justify-content-evenly">
                    <div class="col-4">
                        <a class="btn btn-primary px-5" role="button" href="<?php echo FRONT_ROOT . "Guardian/ShowHome_Guardian" ?>"> Volver </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php if($alert != '') { ?>
        <div class="position-absolute top-0 start-50 translate-middle-x">
            <div class="alert alert-<?php echo $alert['type'] ?>" role="alert">
                <?php echo $alert['text'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    <?php } ?>

    <!-- Funcionalidades JS propias de Boostrap (para uso de componentes especificos) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>