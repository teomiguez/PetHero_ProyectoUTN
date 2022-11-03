<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Guardian - Mi Perfil </title>

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

    /**
        HAY QUE TERMINAR ESTA PÁGINA DE MODIFICACIÓN DEL PERFIL DEL GUARDIAN

        - COMPLETAR LA VISTA DEL FORMULARIO
        - CREAR METODO UPDATE EN GUARDIAN_CONTROLLER (BORRAR EL GUARDIAN EXISTENTE Y AGREGAR EL NUEVO MODIFICADO)

        Nota: Ver de dejar cargado en cada input los datos ya existentes (usar el $user y placeholder) y modificarlos
        Nota2: Modificar el ancla de 'Modificar' del GuardianProfile (quedo feo jaja)
    */
    
    <main class="container text-center">
        <div class="col-md-6 offset-md-3">
            <h2 class="text-center my-3"> Perfil del guardian </h2>
            <form action="" method="">

                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <div class="d-flex">
                                <label class="me-3" for="name" class="form-label"> Nombre </label>
                                <input id="name" name="name" type="text" class="form-control" placeholder="<?php echo $user->getName() ?>" required>    
                            </div>
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
                            <th scope="row"> Dirección: </th>
                            <td> <?php echo $user->getAddress() ?> </td>
                        </tr>
                        <tr>
                            <th scope="row"> Email: </th>
                            <td> <?php echo $user->getEmail() ?> </td>
                        </tr>
                        <tr>
                            <th scope="row"> Contraseña: </th>
                            <td> <?php for ($i=0 ; $i < strlen($user->getPassword()) ; $i++) { echo '*'; } ?> </td>
                        </tr>
                        <tr>
                            <th scope="row"> Preferencia: </th>
                            <td> Tamaño <?php echo $user->getSizeCare() ?> </td>
                        </tr>
                        <tr>
                            <th scope="row"> Remuneración: </th>
                            <td> $<?php echo $user->getCost() ?> x dia </td>
                        </tr>
                        <tr>
                            <th scope="row"> Calificación:  </th>
                            <td> <?php echo $user_review->getReview() ?> (<?php echo $user_review->getQuantity_reviews() ?>) </td> 
                        </tr>
                    </tbody>
            </form>
                <div class="d-grid gap-2 col-6 me-auto">
                    <a href="">  </a>
                </div>
            </table>    
        </div>
    </main>

    <!-- Linea divisoria main/footer -->
    <?php

    include('footer.php');

    ?>

    <!-- Funcionalidades JS propias de Boostrap (para uso de componentes especificos) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>