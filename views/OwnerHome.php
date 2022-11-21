<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Dueño Home </title>


    <!-- Link use Css_file -->
    <link rel="stylesheet" href=" <?php echo CSS_PATH . "styles.css" ?> ">

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

    <main class="container-fluid">

        <div class="row">

            <div class="col-12 col-sm-12 col-md-12 col-lg-4 pt-3">
                <h2 class="text-center"> Reservas aceptadas </h2>

                <div class="mb-3">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th scope="col"> Desde </th>
                                <th scope="col"> Hasta </th>
                                <th scope="col"> Mascota </th>
                                <th scope="col"> Ver </th>
                        </tr>
                        </thead>
                        <tbody> 
                            <?php  
                                if (isset ($dailyReservs)) {
                                    foreach ($dailyReservs as $reserv) {
                            ?>

                            <tr class="align-middle">
                                <td> <?php echo $reserv['reserv']->getFirst_day() ?> </td>
                                <td> <?php echo $reserv['reserv']->getLast_day() ?> </td>
                                <td> <?php echo $reserv['pet'] ?> </td>
                                <td>
                                    <form action="<?php echo FRONT_ROOT . " Owner/ShowReservation " ?>" method="POST">
                                        <button class="btn btn-link" type="submit" name="id_coupon" value="<?php echo $reserv['coupon']->getId_paymentCoupon() ?>">
                                            <i class="bi bi-eye-fill text-primary"></i>  
                                        </button>
                                    </form> 
                                </td>
                            <?php if($reserv['coupon']->getIs_payment() == 0) { ?>
                                <td>
                                    <form action="<?php echo FRONT_ROOT . " Owner/Show_PaymentCoupon " ?>" method="POST">
                                        <button class="btn btn-link" type="submit" name="id" value="<?php echo $reserv['coupon']->getId_paymentCoupon() ?>">
                                            <i class="bi bi-credit-card text-primary"></i>
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

            <div class="text-center col-12 col-sm-8 col-lg-4 pt-3" >
                <h2 class="text-center"> Lista de guardianes </h2>
            
                <!-- Filtro -->
                <div class="my-4 border border-dark p-2 border-opacity-50 rounded-2">
                    <h5 class="text-center mb-3"> Filtrar por disponibilidad </h5>
                    <form action="<?php echo FRONT_ROOT . " Owner/ShowHome_FilterGuardians" ?>" method="POST">
                        <div class="d-flex justify-content-evenly text-center">
                            <?php if (isset($datesSelect)) {?>
                            
                                <div class="my-1">
                                    <label for="first_day" class="form-label"> Desde </label>
                                    <input id="first_day" name="first_day" type="date" class="form-control" 
                                    value="<?php echo $datesSelect['first_day'] ?>" required>
                                </div>

                                <div class="my-1">
                                    <label for="last_day" class="form-label"> Hasta </label>
                                    <input id="last_day" name="last_day" type="date" class="form-control" 
                                    value="<?php echo $datesSelect['last_day'] ?>" required>
                                </div>

                            <?php } else { ?>
                            
                                <div class="my-1">
                                    <label for="first_day" class="form-label"> Desde </label>
                                    <input id="first_day" name="first_day" type="date" class="form-control" required>
                                </div>

                                <div class="my-1">
                                    <label for="last_day" class="form-label"> Hasta </label>
                                    <input id="last_day" name="last_day" type="date" class="form-control" required>
                                </div>

                            <?php } ?>
                            
                            <button class="btn btn-outline-secondary mx-1 my-2" type="submit" id="button-addon2">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>    
                    </form>
                </div>

                <!-- Tabla/Lista -->
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th scope="col"> Nombre </th>
                            <th scope="col"> Apellido </th>
                            <th scope="col"> Telefono </th>
                            <th scope="col">  </th>
                        </tr>
                    </thead>
                    
                    <?php
                        if(isset($guardiansAviable)) {
                            foreach ($guardiansAviable as $guardian) {
                    ?>

                    <tbody>
                        <tr class="align-middle">
                            <td> <?php echo $guardian->getName() ?> </td>
                            <td> <?php echo $guardian->getLast_name() ?> </td>
                            <td> <?php echo $guardian->getTelephone() ?> </td>
                            <td> 
                                <form action="<?php echo FRONT_ROOT . "Owner/ShowViewGuardian" ?>" method="POST">
                                    <button class="btn btn-link" type="submit" name="id" value="<?php echo $guardian->getId_guardian() ?>">
                                        <i class="bi bi-eye-fill text-primary"></i>  
                                    </button>
                                </form> 
                            </td>
                        </tr>
                    </tbody>

                    <?php   } 
                        }
                        else if(isset($guardians)) { 
                            foreach($guardians as $guardian) {
                    ?>

                        <tbody>
                            <tr class="align-middle">
                                <td> <?php echo $guardian->getName() ?> </td>
                                <td> <?php echo $guardian->getLast_name() ?> </td>
                                <td> <?php echo $guardian->getTelephone() ?> </td>
                                <td> 
                                    <form action="<?php echo FRONT_ROOT . "Owner/ShowViewGuardian" ?>" method="POST">
                                        <button class="btn btn-link" type="submit" name="id" value="<?php echo $guardian->getId_guardian() ?>">
                                            <i class="bi bi-eye-fill text-primary"></i>  
                                        </button>
                                    </form> 
                                </td>
                            </tr>
                        </tbody> 
  
                    <?php } 
                        } 
                    ?>
                    
                    </table>

                <!-- Button whit modal -->
                <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal"
                    data-bs-target="#requestReservation_modal">
                    Solicitar reserva
                </button>
            </div>

            <div class="col-12 col-sm-4 col-lg-4 pt-3">
                <h2 class="text-center"> Reservas pasadas </h2>
                <div class="mb-3">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th scope="col"> Desde </th>
                                <th scope="col"> Hasta </th>
                                <th scope="col"> Mascota </th>
                                <th scope="col"> Ver </th>
                        </tr>
                        </thead>
                        <tbody> 
                            <?php  
                                if (isset ($pastReserv)) {
                                    foreach ($pastReserv as $reserv) {
                            ?>

                            <tr class="align-middle">
                                <td> <?php echo $reserv['reserv']->getFirst_day() ?> </td>
                                <td> <?php echo $reserv['reserv']->getLast_day() ?> </td>
                                <td> <?php echo $reserv['pet'] ?> </td>
                                <td>
                                    <form action="<?php echo FRONT_ROOT . " Owner/ShowReservation " ?>" method="POST">
                                        <button class="btn btn-link" type="submit" name="id_coupon" value="<?php echo $reserv['coupon']->getId_paymentCoupon() ?>">
                                            <i class="bi bi-eye-fill text-primary"></i>  
                                        </button>
                                    </form> 
                                </td>
                            <?php if($reserv['is_reviewed'] == 0) { ?>
                                <td>
                                    <form action="<?php echo FRONT_ROOT . " Owner/ShowReviewed_Guardian " ?>" method="POST">
                                        <button class="btn btn-link" type="submit" name="id_coupon" value="<?php echo $reserv['coupon']->getId_paymentCoupon() ?>">
                                            <i class="bi bi-stars text-primary"></i>
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
        </div>

    </main>

    <!-- Modal - request reservation -->
    <div class="modal fade" id="requestReservation_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"> Solicitar una reserva </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo FRONT_ROOT . "Reservation/RequestReservation" ?>" method="POST" class="text-start">
                        <?php if (isset($datesSelect)) {?>
                        
                            <div class="my-1">
                                <label for="first_day" class="form-label"> Desde </label>
                                <input id="first_day" name="first_day" type="date" class="form-control" 
                                value="<?php echo $datesSelect['first_day'] ?>" required>
                            </div>

                            <div class="my-1">
                                <label for="last_day" class="form-label"> Hasta </label>
                                <input id="last_day" name="last_day" type="date" class="form-control" 
                                value="<?php echo $datesSelect['last_day'] ?>" required>
                            </div>

                        <?php } else { ?>

                            <div class="my-1">
                                <label for="first_day" class="form-label"> Desde </label>
                                <input id="first_day" name="first_day" type="date" class="form-control" required>
                            </div>

                            <div class="my-1">
                                <label for="last_day" class="form-label"> Hasta </label>
                                <input id="last_day" name="last_day" type="date" class="form-control" required>
                            </div>

                        <?php } ?>

                        <!-- SELECT GUARDIAN -->
                        <div class="my-1">    
                            <label for="id_guardian" class="form-label"> Seleccione el guardian </label>
                            <select id="id_guardian" class="form-select form-select-sm"
                                aria-label=".form-select-sm example" name="id_guardian" required>
                                <?php if (isset($guardiansAviable))
                                {
                                    foreach ($guardiansAviable as $guardian)
                                    { ?>
                                    <option value="<?php echo $guardian->getId_guardian() ?>"> <?php echo $guardian->getName() . " " . $guardian->getLast_name() . " - Preferencia: " . $guardian->getSizeCare() ?> </option>
                                     <?php 
                                     }
                                     
                                } elseif(isset($guardians))
                                {
                                    foreach ($guardians as $guardian)
                                    { ?>
                                    <option value="<?php echo $guardian->getId_guardian() ?>"> <?php echo $guardian->getName() . " " . $guardian->getLast_name() . " - Preferencia: " . $guardian->getSizeCare() ?> </option>
                                     <?php 
                                     } 
                                } ?>
                                
                            </select>
                        </div>

                        <!-- SELECT PET -->
                        <div class="my-1">    
                            <label for="id_pet" class="form-label"> Seleccione la mascota </label>
                            <select id="id_pet" class="form-select form-select-sm"
                                aria-label=".form-select-sm example" name="id_pet" required>
                                <?php foreach ($petsList as $pet) { ?>
                                <option value="<?php echo $pet->getId_pet() ?>"> <?php echo $pet->getName() . " - " . $pet->getType() . " - " . $pet->getBreed() . " - " . $pet->getSize() ?> </option>
                                <?php } ?>
                            </select>
                        </div>

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

    <?php if($alert != '') { ?>
        <div class="position-absolute top-0 start-50 translate-middle-x">
            <div class="alert alert-<?php echo $alert['type'] ?>" role="alert">
                <?php echo $alert['text'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    <?php } ?>


    <!-- Boostrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>