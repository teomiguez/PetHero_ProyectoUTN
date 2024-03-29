<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Guardian Home </title>

    <!-- Link use Css_file -->
    <link rel="stylesheet" href=" <?php echo CSS_PATH . "styles.css" ?> ">

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

    <main class="container-fluid">

        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-4 ">
                <h2 class="text-center"> Listado de reservas </h2>

                <div class="mb-3">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th scope="col"> Desde </th>
                                <th scope="col"> Hasta </th>
                                <th scope="col"> Ver </th>
                                <th scope="col"> Confirmar </th>
                        </tr>
                        </thead>
                        <tbody> 
                            <?php  
                                if (isset ($dailyReservs)) {
                                    foreach ($dailyReservs as $reserv) {
                            ?>

                            <tr class="align-middle">
                                <td> <?php echo $reserv->getFirst_day() ?> </td>
                                <td> <?php echo $reserv->getLast_day() ?> </td>
                                <td>
                                    <form action="<?php echo FRONT_ROOT . " Guardian/ShowReservation " ?>" method="POST">
                                        <button class="btn btn-link" type="submit" name="id" value="<?php echo $reserv->getId_reservation() ?>">
                                            <i class="bi bi-eye-fill text-primary"></i>  
                                        </button>
                                    </form> 
                                </td>
                                <?php if($reserv->getIs_accepted() == 0) {  ?>
                                    <td class="d-inline-flex"> 
                                        <form action="<?php echo FRONT_ROOT . "Reservation/AcceptedReserv" ?>" method="POST">
                                            <button class="btn btn-link" type="submit" name="id" 
                                                    value="<?php echo $reserv->getId_reservation() ?>">
                                                <i class="bi bi-check-circle"></i>    
                                            </button>
                                        </form>

                                        <form action="<?php echo FRONT_ROOT . "Reservation/DenyReserv" ?>" method="POST">
                                            <button class="btn btn-link" type="submit" name="id" 
                                                    value="<?php echo $reserv->getId_reservation() ?>">
                                                <i class="bi bi-x-circle"></i>    
                                            </button>
                                        </form>
                                    </td>
                                <?php } ?>
                            </tr>

                            <?php } 
                                } ?> 
                        </tbody>
                    </table>
                    
                </div>
            </div>

            <div class="col-12 col-sm-4 ">
                <h2 class="text-center"> Estadías disponibles </h2>

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
                                            if ($diff->days == 1) {echo $diff->days .' día'; } else { echo $diff->days .' días'; } ;
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

            <div class="col-12 col-sm-8 col-lg-4 ">
                <h2 class="text-center"> Reservas pasadas </h2>

                <div class="mb-3">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th scope="col"> Desde </th>
                                <th scope="col"> Hasta </th>
                                <th scope="col"> Ver </th>
                            </tr>
                        </thead>
                        <tbody> 
                            <?php
                                if (isset ($pastReserv)) {
                                    foreach ($pastReserv as $reserv) {
                            ?>

                            <tr class="align-middle">
                                <td> <?php echo $reserv->getFirst_day() ?> </td>
                                <td> <?php echo $reserv->getLast_day() ?> </td>
                                <td class="d-inline-flex">
                                    <form action="<?php echo FRONT_ROOT . " Guardian/ShowReservation " ?>" method="POST">
                                        <button class="btn btn-link" type="submit" name="id" value="<?php echo $reserv->getId_reservation() ?>">
                                            <i class="bi bi-eye-fill text-primary"></i>  
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <?php } 
                                } ?> 
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>

    </main>

    <!-- Modal - add new AvStay -->
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

    <?php if($alert != '') { ?>
        <div class="position-absolute top-0 start-50 translate-middle-x">
            <div class="alert alert-<?php echo $alert['type'] ?>" role="alert">
                <?php echo $alert['text'] ?>
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