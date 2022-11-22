<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Recuperar contraseña </title>

    <!-- Link use Css_file -->
    <link rel="stylesheet" href=" <?php echo CSS_PATH . "styles.css" ?> ">

    <!-- Link use Boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        
</head>

<body class="bg-img">
    <main class="coteiner position-absolute top-50 start-50 translate-middle">
        <section class="bg-white text-dark py-2 px-3 border-5 rounded-4">
            <h2 class="text-center py-4"> Recuperar contraseña </h2>
            <form action="<?php echo FRONT_ROOT . " Auth/RecoverPassword" ?>" method="POST">
                <div>
                    <label for="email" class="form-label"> Email </label>
                    <input id="email" name="email" type="email" class="form-control" placeholder="example@email.com" required>
                </div>

                <br>

                <div>
                    <label for="dni" class="form-label"> Cual es el DNI? </label>
                    <input id="dni" name="dni" type="number" class="form-control" min="1000000" max="99000000" required>
                </div>

                <br>

                <div class="d-grid gap-2">
                <a class="btn btn-primary" role="button" href="<?php echo FRONT_ROOT . "Auth/ShowLogin" ?>"> Volver </a>    
                <button class="btn btn-primary" type="submit"> Recuperar </button>
                </div>
            </form>
        </section>
    </main>

    <?php if(isset($alert)) { ?>
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