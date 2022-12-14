<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Dueño - Perfiles Mascotas </title>

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
        include('nav-owner.php');
    ?>

    <br>

    <main class="container">

        <div class="row">

            <div class="col-12 col-sm-12 col-md-12 col-lg-3">
                
            </div>

            <div class="text-center col-12 col-sm-8 col-lg-5 mb-3">
                <h2 class="text-center mb-3"> Lista de mascotas </h2>

                <div class="mb-3">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th scope="col"> Nombre </th>
                                <th scope="col"> Mascota </th>
                                <th scope="col"> Raza </th>
                                <th scope="col"> Tamaño </th>
                                <th scope="col"> </th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach ($petsList as $pet) {
                            ?>
                            <tr class="align-middle">
                                <td> <?php echo $pet->getName() ?> </td>
                                <td> <?php echo $pet->getType() ?> </td>
                                <td> <?php echo $pet->getBreed() ?> </td>
                                <td> <?php echo $pet->getSize() ?> </td>
                                <td class="d-inline-flex">
                                    <form action="<?php echo FRONT_ROOT . " Pet/ShowView_Profile" ?>" method="POST">
                                        <button class="btn btn-link" type="submit" name="id" value="<?php echo $pet->getId_pet() ?>">
                                            <i class="bi bi-eye-fill text-primary"></i>  
                                        </button>
                                    </form> 
                                    <form action="<?php echo FRONT_ROOT . " Pet/Remove" ?>" method="POST">
                                        <button class="btn btn-link" type="submit" name="id" value="<?php echo $pet->getId_pet() ?>">
                                            <i class="bi bi-trash3 text-danger"></i>    
                                        </button>
                                    </form>  
                                </td>
                            </tr>
                        </tbody>

                        <?php } ?>
                    </table>
                    
                </div>

                <!-- Button whit modal -->
                <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal"
                    data-bs-target="#createPet_modal">
                    Añadir Mascota
                </button>
            </div>

            <div class="col-12 col-sm-4 text-center">
                
            </div>
        </div>

    </main>


    <!-- Modal - create pet -->
    <div class="modal fade" id="createPet_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"> Crear perfil de Mascota</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo FRONT_ROOT . " Pet/CreatePet" ?>" method="POST" enctype="multipart/form-data" class="text-start">
                        <div class="my-1">
                            <label for="formFile" class="form-label">Seleccione una Foto</label>
                            <input id="imgFile" name="imgFile" class="form-control" type="file" required>
                        </div>

                        <div class="my-1">
                            <label for="name" class="form-label"> Nombre </label>
                            <input id="name" name="name" type="text" class="form-control" required>
                        </div>

                        <div class="my-1">    
                            <label for="radio_option" class="form-label "> Tipo de mascota </label>

                            <br>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="radio_option" id="radio_gato" 
                                    value="2" required 
                                />
                                <label class="form-check-label" for="radio_gato"> Gato </label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="radio_option" id="radio_perro" 
                                    value="1" required 
                                />
                                <label class="form-check-label" for="radio_perro"> Perro </label>
                            </div>
                        </div>

                        <div class="my-1">
                            <label for="breed" class="form-label"> Raza </label>
                            <input id="breed" name="breed" type="text" class="form-control" required>
                        </div>

                        <div class="my-1">    
                            <label for="size" class="form-label"> Seleccione el tamaño </label>
                            <select id="size" class="form-select form-select-sm"
                                aria-label=".form-select-sm example" name="size" required>
                                <option value="1"> Chico </option>
                                <option value="2"> Mediano </option>
                                <option value="3"> Grande </option>
                            </select>
                        </div>

                        <div class="my-1">
                            <label for="pvFile" class="form-label"> Plan de vacunacion </label>
                            <input id="pvFile" name="pvFile" class="form-control" type="file" required>
                        </div>

                        <div class="my-1">
                            <label for="video" class="form-label"> Video (opcional) </label>
                            <input id="video" name="video" class="form-control" type="file">
                        </div>

                        <div class="my-1">
                            <label for="info" class="form-label"> Observaciones </label>
                            <textarea id="info" name="info" class="form-control" rows="3" required></textarea>
                        </div> 

                        <hr class="my-3">

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Cerrar </button>
                            <button type="submit" class="btn btn-primary"> Agregar </button>
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

    <!-- Funcionalidades JS propias de Boostrap (para uso de componentes especificos) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>