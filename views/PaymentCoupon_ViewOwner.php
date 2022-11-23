<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Ver Reserva </title>

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
    
    <main class="container text-center">
    <div class="row">
        <div class="col-6">
                <h2 class="text-center my-3"> Cupon de pago nro. <?php echo $coupon->getId_paymentCoupon() ?> </h2>
                <table class="table table-striped mb-2">
                    <tbody>
                        <tr>
                            <th colspan="2"> Guardian nro. <?php echo $guardian->getId_guardian() ?> </th>
                        </tr>    
                        <tr>
                            <th scope="row"> Nombre y Apellido: </th>
                            <td> <?php echo $guardian->getName() . " " . $guardian->getLast_name() ?> </td>
                        </tr>
                        <tr>
                            <th scope="row"> Precio x dia: </th>
                            <td> <?php echo "$ " . $guardian->getCost() ?> </td>
                        </tr>
                        <tr>
                            <th colspan="2"> Reserva nro. <?php echo $reserv->getId_reservation() ?> </th>
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
                        <tr>
                            <th colspan="2"> Mascota nro. <?php echo $pet->getId_pet() ?> </th>
                        </tr>
                        <tr>
                            <th scope="row"> Nombre: </th>
                            <td> <?php echo $pet->getName() ?> </td>
                        </tr>
                        <tr>
                            <th colapse="2">  </th>
                        </tr>
                        <tr>
                            <th scope="row"> Costo total: </th>
                            <td> <?php echo "$ " . $coupon->getCoupon_cost() ?> </td>
                        </tr>
                    </tbody>
                </table>
                <div class="row justify-content-evenly">
                    <div class="col-4">
                        <a class="btn btn-primary px-5" role="button" href="<?php echo FRONT_ROOT . " Owner/ShowHome_Owner " ?>"> Volver </a>
                    </div>
                </div>
            </div>    
            <div class="col-6">
                <h2 class="text-center my-3"> Datos para el pago </h2>
                <div class="mx-5">
                    <form action="<?php echo FRONT_ROOT . " Owner/PaymentCoupon " ?>" method="POST">
                        <div class="mb-2">
                            <label for="nro" class="form-label"> Número de la tarjeta  </label>
                            <input id="nro" name="nro" type="int" class="form-control" placeholder="XXX-XXXX-XXXX-XXXX" pattern="[0-9]{4}[0-9]{4}[0-9]{4}[0-9]{4}" required>

                            <div class="d-flex justify-content-evenly text-center">
                                <div class="my-1">
                                    <label for="first_month" class="form-label"> Valida desde </label>
                                    <input id="first_month" name="first_month" type="month" class="form-control" required>
                                </div>
    
                                <div class="my-1">
                                    <label for="last_month" class="form-label"> Valida hasta </label>
                                    <input id="last_month" name="last_month" type="month" class="form-control" required>
                                </div>
                            </div>
                            
                            <label for="name" class="form-label"> Titular de la tarjeta </label>
                            <input id="name" name="name" type="text" class="form-control" required>
        
                            <label for="cod_seg" class="form-label"> Codigo de seguridad </label>
                            <input id="cod_seg" name="cod_seg" type="number" class="form-control" min="000" max="999" placeholder="XXX" required>
                        </div>
                        
                        <button class="btn btn-primary px-5" type="submit" name="id" value="<?php echo $coupon->getId_paymentCoupon() ?>">
                            Pagar  
                        </button>
                    </form>
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