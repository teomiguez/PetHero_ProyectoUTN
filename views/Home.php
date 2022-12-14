<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Pagina Principal </title>

    <!-- Link use Css_file -->
    <link rel="stylesheet" href=" <?php echo CSS_PATH . "styles.css" ?> ">

    <!-- Link use Boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        
</head>

<body class="bg-img">
    <main class="coteiner position-absolute top-50 start-50 translate-middle">
        <section class="text-center mb-5">
            <h1 class="title-home">
                <strong>
                    PET HERO
                </strong>
            </h1>
            <h2 class="subtitle-home">
                <em>
                    "Cuidalos con quien vos creas el mejor"
                </em>
            </h2>
        </section>

        <section class="bg-white text-dark py-2 px-3 border-5 rounded-4">
            <h2 class="text-center py-4"> Iniciar Sesión </h2>
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
                    <a href="<?php echo FRONT_ROOT . "Auth/ShowRegist" ?>"> Registrarse </a>
                </div>

                <div class="d-flex justify-content-center">
                    <p class="px-2"> Olvidate tú contraseña? </p>
                    <a href="<?php echo FRONT_ROOT . "Auth/ShowRecoverPassword" ?>"> Recuperar contraseña </a>
                </div>

            </form>
        </section>
    </main>

    <?php if(isset($alert)) { ?>
        <div class="position-absolute top-0 start-50 translate-middle-x">
            <div class="alert alert-<?php echo $alert['type'] ?>" role="alert">
                <?php echo $alert['text'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <?php if (isset($alert["text2"])) {?>
                    <hr>
                    <a class="d-flex justify-content-center alert-link" href=" <?php echo FRONT_ROOT . "Auth/ShowRecoverPassword" ?> "> <?php echo $alert["text2"] ?> </a>
                <?php } ?>
            </div>
        </div>
    <?php } ?>

    <!-- Funcionalidades JS propias de Boostrap (para uso de componentes especificos) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>