<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Dueño - Mi Perfil </title>


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
        include('nav-owner.php');
    ?>

    <br>

    <main class="container">
        <div class="col-md-6 offset-md-3">
            <h2 class="text-center my-3"> Perfil del Dueño </h2>
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th scope="row"> Nombre: </th>
                        <td> <?php echo $user->getName() ?> </td>
                    </tr>
                    <tr>
                        <th scope="row"> Apellido: </th>
                        <td> <?php echo $user->getLast_name() ?> </td>
                    </tr>
                    <tr>
                        <th scope="row"> DNI: </th>
                        <td> <?php echo $user->getDni() ?> </td>
                    </tr>
                    <tr>
                        <th scope="row"> Telefono: </th>
                        <td> <?php echo $user->getTelephone() ?> </td>
                    </tr>
                    <tr>
                        <th scope="row"> Email: </th>
                        <td> <?php echo $user->getEmail() ?> </td>
                    </tr>
                    <tr>
                        <th scope="row"> Contraseña: </th>
                        <td> <?php for ($i=0 ; $i < strlen($user->getPassword()) ; $i++) { echo '*'; } ?> </td>
                    </tr>
                </tbody>
            </table>    
            <div class="text-center">
                <div class="row justify-content-evenly">
                    <div class="col-4">
                        <a class="btn btn-primary px-5" role="button" href="<?php echo FRONT_ROOT . "Owner/ShowHome_Owner" ?>"> Volver </a>
                    </div>
                    <div class="col-4">
                        <a class="btn btn-primary px-5" role="button" href="<?php echo FRONT_ROOT . "Owner/ShowModifyProfile_Owner" ?>"> Modificar </a>
                    </div>
                </div>
            </div>
        </div> 
    </main>

    <!-- Footer -->
    <?php
        include('footer.php');
    ?>

    <!-- Funcionalidades JS propias de Boostrap (para uso de componentes especificos) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>