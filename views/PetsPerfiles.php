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
    <nav class="navbar navbar-expand-lg nav-color border-bottom border-dark">
        <div class="container-fluid">

            <h2 class="navbar-brand fs-3 pt-2">
                <strong>
                    Pet Hero
                </strong>
            </h2>

            <div class="navbar-nav position-absolute top-50 start-50 translate-middle">
                <a href="" class="nav-link text-decoration-none"> *Home* </a>
            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav position-absolute top-50 end-0 translate-middle-y">
                    <li class="nav-item">
                        <a href="#" class="nav-link text-decoration-none"> *Notificaciones* </a>
                    </li>

                    <li class="nav-item">
                        <a href="" class="nav-link text-decoration-none active"> *Mis Mascotas* </a>
                    </li>

                    <li class="nav-item">
                        <a href="" class="nav-link text-decoration-none"> *Mi Perfil* </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <br>

    <main class="container">

        <div class="row">

            <div class="col-12 col-sm-12 col-md-12 col-lg-3 border">
                *Calendario*
            </div>

            <div class="col-12 col-sm-8 col-lg-5 border mb-3">
                <form action="">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Buscar mascota..."
                            aria-label="Buscar mascota..." aria-describedby="button-addon2">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>

                <div class="list-group mb-3">
                    <a href="#" class="list-group-item list-group-item-action"> A first link item </a>
                    <a href="#" class="list-group-item list-group-item-action"> A second link item </a>
                    <a href="#" class="list-group-item list-group-item-action"> A third link item </a>
                    <a href="#" class="list-group-item list-group-item-action"> A fourth link item </a>
                    <a href="#" class="list-group-item list-group-item-action"> A fifth link item </a>
                    <a href="#" class="list-group-item list-group-item-action"> A sixth link item </a>
                </div>

                <!-- Button whit modal -->
                <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal"
                    data-bs-target="#createPet_modal">
                    Crear perfil
                </button>
            </div>

            <div class="col-12 col-sm-4 border">
                rellenar...
            </div>
        </div>

    </main>

    <!-- Linea divisoria main/footer -->
    <hr>

    <footer>
        <div class="text-center">
            <a href="#"> *Red Social* </a>
            <a href="#"> *Red Social* </a>
        </div>
    </footer>

    <!-- Modal -->
    <div class="modal fade" id="createPet_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Funcionalidades JS propias de Boostrap (para uso de compoentes especificos) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>