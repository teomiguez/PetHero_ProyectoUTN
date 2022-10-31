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
    <?php
        include('nav-owner.php');
    ?>

    <br>

    <main class="container">

        <div class="row">

            <div class="col-12 col-sm-12 col-md-12 col-lg-3 pt-3">
                *Listado de Reservas activas y a pagar*
            </div>

            <div class="col-12 col-sm-8 col-lg-5 pt-3">
                <h2 class="text-center"> Lista de guardianes </h2>
            
                <!-- Filtro -->
                <div class="my-4 border border-dark p-2 border-opacity-50 rounded-2">
                    <h5 class="text-center mb-3"> Filtrar por disponibilidad </h5>
                    <form action="" method="">
                        <div class="d-flex justify-content-evenly text-center">
                            <div class="mx-1">
                                <label for="first_day" class="form-label"> Desde </label>
                                <input id="first_day" name="first_day" type="date" class="form-control" required>
                            </div>
        
                            <div class="mx-1">
                                <label for="last_day" class="form-label"> Hasta </label>
                                <input id="last_day" name="last_day" type="date" class="form-control" required>
                            </div>
                            
                            <button class="btn btn-outline-secondary align-items-center mx-1" type="submit" id="button-addon2">
                                *Filtrar*
                            </button>
                        </div>    
                    </form>
                </div>

                <table class="table text-center">
                    <thead>
                        <tr>
                            <th scope="col"> Nombre </th>
                            <th scope="col"> Apellido </th>
                            <th scope="col"> Telefono </th>
                            <th scope="col">  </th>
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
                            <td> <a href="#"> <i class="bi bi-eye-fill"></i> </a> </td>
                        </tr>
                    </tbody>   
                
                    <?php } ?>
                </table>

                <!-- Button whit modal -->
                <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal"
                    data-bs-target="#requestReservation_modal">
                    Solicitar reserva
                </button>
            </div>

            <div class="col-12 col-sm-4 pt-3">
                *Listado de reservas pasadas + opcion review*
            </div>
        </div>

    </main>
    
    <!-- Footer -->
    <?php
        include('footer.php');
    ?>

    <!-- Modal -->
    <div class="modal fade" id="requestReservation_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"> Solicitar una reserva </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo FRONT_ROOT . "" ?>" method="POST" class="text-start">
                        

                        <hr class="my-3">

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Cerrar </button>
                            <button type="submit" class="btn btn-primary"> Solicitar </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Boostrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>