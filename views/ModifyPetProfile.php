<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Dueño - Perfil Mascota </title>

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
            <form action="<?php echo FRONT_ROOT . " Pet/UpdateProfile_Pet" ?>" method="POST">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <div class="d-flex">
                                <th scope="row"><label class="me-3" for="name" class="form-label"> </label> Nombre: </th> 
                                <td> <input id="name" name="name" type="text" class="form-control" value="<?php echo $pet->getName() ?>" required ></td>    
                            </div>
                        </tr>
                        <tr>
                            <div class="d-flex">
                                <th scope="row"><label class="me-3" for="email"class="form-label"> </label> Tipo: </th> 
                                <td> <?php echo $pet->getType() ?> </td>    
                            </div>
                        </tr>
                        <tr>
                            <div class="d-flex">
                                <th scope="row"><label class="me-3" for="breed" class="form-label"> </label> Raza: </th> 
                                <td> <input id="breed" name="breed" type="text" class="form-control" value="<?php echo $pet->getBreed() ?>" required ></td>    
                            </div>
                        </tr>
                        <tr>
                            <div class="d-flex">
                                <th scope="row"><label class="me-3"  for="size" class="form-label align-middle"> </label> Preferencia: </th> 
                                <td> 
                                    <select id="size" class="form-select" aria-label="form-select" name="size" required >
                                        <option selected value="<?php echo $user->getSizeCare()?>"> <?php echo $pet->getSize()?> </option>
                                        <option value="1"> Chico </option>
                                        <option value="2"> Mediano </option>
                                        <option value="3"> Grande </option>
                                    </select>
                                </td>    
                            </div>         
                        </tr>
                        <tr>
                            <div class="d-flex">
                                <th scope="row"><label class="me-3" for="info" class="form-label"> </label> Observaciones: </th> 
                                <td> <textarea id="info" name="info" class="form-control" rows="3" required></textarea> </td>    
                            </div>
                        </tr>
                    </tbody>
                </table>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary" name="id" value="<?php echo $user->getId_pet() ?>"> Guardar cambios </button>
                    </div>
            </form>
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