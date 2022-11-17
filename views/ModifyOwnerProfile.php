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
    
    <main class="container text-center">
        <div class="col-md-6 offset-md-3"> 
            <h2 class="text-center my-3"> Modificar Perfil </h2>
            <form action="<?php echo FRONT_ROOT . " Owner/UpdateProfile_Owner" ?>" method="POST">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <div class="d-flex">
                                <th scope="row"><label class="me-3" for="name" class="form-label"> </label> Nombre: </th> 
                                <td> <input id="name" name="name" type="text" class="form-control" value="<?php echo $user->getName() ?>" required ></td>    
                            </div>
                        </tr>
                        <tr>
                            <div class="d-flex">
                                <th scope="row"><label class="me-3" for="last_name" class="form-label"></label> Apellido: </th> 
                                <td> <input id="last_name" name="last_name" type="text" class="form-control" value="<?php echo $user->getLast_name() ?>" required></td>    
                            </div>
                        </tr>
                        <tr>
                            <div class="d-flex">
                                <th scope="row"><label class="me-3" for="dni" class="form-label"></label> DNI: </th> 
                                <td> <?php echo $user->getDni() ?> </td>    
                            </div>
                        </tr>
                        <tr>
                            <div class="d-flex">
                                <th scope="row"><label class="me-3" for="tel" class="form-label"> </label> Telefono: </th> 
                                <td> <input id="tel" name="tel" type="tel" class="form-control" pattern="[2]{2}[3]{1}[0-9]{3}[0-9]{4}" value="<?php echo $user->getTelephone() ?>" required ></td>    
                            </div>          
                        </tr>
                        <tr>
                            <div class="d-flex">
                                <th scope="row"><label class="me-3" for="email"class="form-label"> </label> Email: </th> 
                                <td> <?php echo $user->getEmail() ?> </td>    
                            </div>
                        </tr>
                        <tr>
                            <div class="d-flex">
                                <th scope="row"><label class="me-3" for="password" class="form-label"> </label> Contraseña: </th> 
                                <td> <input id="password" name="password" type="password" class="form-control" value="<?php echo $user->getPassword() ?>" required ></td>    
                            </div>
                        </tr>
                    </tbody>
                </table>
                <div class="row justify-content-evenly">
                    <div class="col-4">
                        <a class="btn btn-primary px-5" role="button" href="<?php echo FRONT_ROOT . "Owner/ShowProfile_Owner"?>"> Volver </a>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary" name="id" value="<?php echo $user->getId_owner() ?>"> Guardar cambios </button>
                    </div>
                </div>
            </form>
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