<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Guardian Home </title>

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

    <main class="container">

        <div class="row">

            <div class="col-12 col-sm-12 col-md-12 col-lg-3 ">
                *Listado de Reservas activas y a confirmar*
            </div>

            <div class="col-12 col-sm-8 col-lg-5 ">
                rellenar...
            </div>
 
            <div class="col-12 col-sm-4 ">
                <h2 class="text-center"> Estadías disponibles </h2>

                <!-- <form action="">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Buscar estadia..."
                            aria-label="Buscar estadia..." aria-describedby="button-addon2">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form> -->

                <div class="mb-3">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th scope="col"> Desde </th>
                                <th scope="col"> Hasta </th>
                                <th scope="col"> Total </th>
                                <th scope="col">  </th>
                        </tr>
                        </thead>
                        <tbody> 
                            <?php  
                                foreach ($avStayList as $avStay) {
                            ?>

                            <tr class="align-middle">
                                <td> <?php echo $avStay->getFirst_day() ?> </td>
                                <td> <?php echo $avStay->getLast_day() ?> </td>
                                <td> <?php  $date1 = new DateTime($avStay->getFirst_day());
                                            $date2 = new DateTime($avStay->getLast_day());
                                            $diff = $date1->diff($date2);                          
                                            echo $diff->days .' dias ';
                                 ?> </td>
                                <td> 
                                    <form action="<?php echo FRONT_ROOT . "AvStay/RemoveStay" ?>" method="POST">
                                        <button class="btn btn-link" type="submit" name="id" 
                                                value="<?php echo $avStay->getId_stay() ?>">
                                            <i class="bi bi-trash3 text-danger"></i>    
                                        </button>
                                    </form> 
                                </td>
                            </tr>
                        </tbody>

                        <?php }  ?> 
                    </table>
                    
                </div>

                <!-- Button whit modal -->
                <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal"
                    data-bs-target="#addAvStay_modal">
                    Agregar estadía
                </button>
            </div>
                
            </div>
        </div>

    </main>

    <!-- Footer -->
    <?php

    include('footer.php');

    ?>


    <!-- Modal -->
    <div class="modal fade" id="addAvStay_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"> Añadir estadia disponible para cuidados</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo FRONT_ROOT . " AvStay/CreateAvStay" ?>" method="POST" class="text-start">
                        <div class="my-1">
                            <label for="first_day" class="form-label"> Desde </label>
                            <input id="first_day" name="first_day" type="date" class="form-control" required>
                        </div>

                        <div class="my-1">
                            <label for="last_day" class="form-label"> Hasta </label>
                            <input id="last_day" name="last_day" type="date" class="form-control" required>
                        </div>

                         <hr class="my-3">

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Cerrar </button>
                            <button type="submit" class="btn btn-primary"> Añadir </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php if(isset($alert_days)) { ?>
        <div class="position-absolute top-0 start-50 translate-middle-x">
            <div class="alert alert-<?php echo $alert_days['type'] ?>" role="alert">
                <?php echo $alert_days['text'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    <?php } ?>

    <!-- Funcionalidades JS propias de Boostrap (para uso de compoentes especificos) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>