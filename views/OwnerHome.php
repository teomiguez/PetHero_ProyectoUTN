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
    
    <!-- Footer -->
    <?php
        include('footer.php');
    ?>

    <!-- Boostrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>