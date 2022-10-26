<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Dueño - Perfiles Mascotas </title>

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

    <?php // echo var_dump($_SESSION); ?>

    <br>

    <main class="container">

        <div class="row">

            <div class="col-12 col-sm-12 col-md-12 col-lg-3">
                *Calendario*
            </div>

            <div class="col-12 col-sm-8 col-lg-5 mb-3">
                <h2 class="text-center"> Lista de mascotas </h2>

                <form action="">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Buscar mascota..."
                            aria-label="Buscar mascota..." aria-describedby="button-addon2">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>

                <div class="mb-3">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th scope="col"> Nombre </th>
                                <th scope="col"> Mascota </th>
                                <th scope="col"> Raza </th>
                                <th scope="col"> Tamaño </th>
                                <th scope="col"> # </th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach ($petsList as $pet) {
                            ?>
                            <tr>
                                <td> <?php echo $pet->getName() ?> </td>
                                <td> <?php echo $pet->getType() ?> </td>
                                <td> <?php echo $pet->getBreed() ?> </td>
                                <td> <?php echo $pet->getSize() ?> </td>
                                <td> <a href="#"> ver </a> </td>
                            </tr>
                        </tbody>

                        <?php } ?>
                    </table>
                    
                </div>

                <!-- Button whit modal -->
                <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal"
                    data-bs-target="#createPet_modal">
                    Crear perfil
                </button>
            </div>

            <div class="col-12 col-sm-4 text-center">
                rellenar...
            </div>
        </div>

    </main>

    <!-- Footer -->
    <?php
        include('footer.php');
    ?>

    <!-- Modal -->
    <div class="modal fade" id="createPet_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"> Crear perfil de Mascota</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo FRONT_ROOT . " Auth/CreatePet" ?>" method="POST" class="text-start">
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
                                    value="Gato" required 
                                />
                                <label class="form-check-label" for="radio_gato"> Gato </label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="radio_option" id="radio_perro" 
                                    value="Perro" required 
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
                                <option value="chico"> Chico </option>
                                <option value="mediano"> Mediano </option>
                                <option value="grande"> Grande </option>
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

    <!-- Funcionalidades JS propias de Boostrap (para uso de componentes especificos) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>