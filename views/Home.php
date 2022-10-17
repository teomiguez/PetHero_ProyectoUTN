<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Pagina Principal </title>

    <!-- Link use Css_file -->
    <link rel="stylesheet" href="css/styles.css">

    <!-- Link use Boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        
</head>

<body class="bg-color">
    <main class="coteiner position-absolute top-50 start-50 translate-middle">
        <section class="text-center mb-5">
            <h1 class="display-1">
                <strong>
                    PET HERO
                </strong>
            </h1>
            <h2 class="lead display-6">
                <em>
                    "Cuidalos con quien vos creas el mejor"
                </em>
            </h2>
        </section>

        <section class="bg-white text-dark py-2 px-3 border-5 rounded-4">
            <h2 class="text-center py-4"> Iniciar Sesion </h2>
            <form action="<?php echo FRONT_ROOT . "Auth/Login" ?>" method="POST">

                <div>
                    <label for="mail" class="form-label">Email</label>
                    <input id="mail" name="email" type="email" class="form-control" placeholder="example@email.com" required>
                </div>

                <br>

                <div>
                    <label for="password" class="form-label">Contraseña</label>
                    <input id="password" name="password" type="password" class="form-control" placeholder="" required>
                </div>

                <br>

                <div class="d-grid gap-2">
                    <button class="btn btn-primary" type="submit">Ingresar</button>
                </div>

                <br>

                <div class="d-flex justify-content-center">
                    <p class="px-2"> Aún no tenes cuenta? </p>
                    <a href=<?php echo FRONT_ROOT . "Auth/ShowRegist" ?>> Registrarse </a>
                </div>


            </form>
        </section>
    </main>

    <!-- Funcionalidades JS propias de Boostrap (para uso de compoentes especificos) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>