<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Pagina Registro </title>

    <!-- Link use Css_file -->
    <link rel="stylesheet" href=" <?php echo CSS_PATH . "styles.css" ?> ">

    <!-- Link use Boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

</head>

<body class="bg-img">
    <main class="container text-center my-5 mx-5">
        <section class="bg-white text-dark py-2 px-3 border-5 rounded-4">
            <h2 class="text-center py-2"> Registrarse </h2>
            <form action="<?php echo FRONT_ROOT . " Auth/Register" ?>" method="POST" class="text-start">
                <div class="row">
                    <div class="col-12 col-md-6 my-2">
                        <div>
                            <label for="name" class="form-label"> Nombre </label>
                            <input id="name" name="name" type="text" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 my-2">
                        <div>
                            <label for="last_name" class="form-label"> Apellido </label>
                            <input id="last_name" name="last_name" type="text" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 my-2">
                        <div>
                            <label for="dni" class="form-label"> DNI </label>
                            <input id="dni" name="dni" type="number" class="form-control" min="1000000" max="99000000" required>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 my-2">
                        <div>
                            <label for="tel" class="form-label"> Teléfono  </label>
                            <input id="tel" name="tel" type="tel" class="form-control" placeholder="223xxxxxxx" 
                                pattern="[2]{2}[3]{1}[0-9]{3}[0-9]{4}" required>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 my-2">
                        <div>
                            <label for="email" class="form-label"> Email </label>
                            <input id="email" name="email" type="email" class="form-control"
                                placeholder="example@email.com" required>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 my-2">
                        <div>
                            <label for="password" class="form-label"> Contraseña </label>
                            <input id="password" name="password" type="password" class="form-control" placeholder=""
                                required>
                        </div>
                    </div>


                    <!--Confirmar contraseña sin uso -->

                    <div class="col-12 col-md-6 my-2">
                        <!-- <div>
                            <label for="check_password" class="form-label"> Confirmar Contraseña </label>
                            <input id="check_password" name="check_password" type="password" class="form-control"
                                placeholder="" required>
                        </div> -->
                    </div>

                    <div class="col-12 col-md-6 my-2">
                        <div>
                            <label for="radio_option" class="form-label "> Eres un... </label>

                            <br>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="radio_option" id="radio_dueño" value="dueño" 
                                    onclick= "disabledFields()" checked required 
                                />
                                <label class="form-check-label" for="radio_dueño"> Dueño </label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="radio_option" id="radio_guardian" value="guardian"
                                    onclick= "enabledFields()" required 
                                />
                                <label class="form-check-label" for="radio_guardian"> Guardián </label>
                            </div>
                        </div>
                    </div>

                    <hr class="my-3">

                    <div class="col-12 col-md-6 my-2">
                        <label for="street" class="form-label"> Calle </label>
                        <input id="street" name="street" type="text" class="form-control" required disabled />

                        <label for="nro" class="form-label"> Altura </label>
                        <input id="nro" name="nro" type="number" class="form-control" min="1" max="9999" required disabled />
                    </div>

                    <div class="col-12 col-md-6 my-2">
                        <div>
                            <label for="typeSize" class="form-label"> Tamaño de preferencia de la mascota </label>    
                            <select id="typeSize" class="form-select" aria-label="form-select" name="typeSize" required disabled>
                                    <option value="1"> Chico </option>
                                    <option value="2"> Mediano </option>
                                    <option value="3"> Grande </option>
                            </select>
                        </div>

                        <div>
                        <label for="cost" class="form-label"> Remuneración x Dia </label>     
                        <div class="input-group mb-3">
                                <span class="input-group-text">$</span>
                                <input id="cost" type="number" class="form-control" name= "cost" aria-label="Amount (to the nearest dollar)" 
                                    min="1" required disabled>
                            </div>
                        </div>
                    </div>

                    <hr class="my-3">

                    <div class="d-grid gap-2 col-6 mx-auto mb-2">
                        <button class="btn btn-primary" type="submit">Registrarme</button>
                    </div>
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

    <!-- Funcionalidades JS -->
    <script src=" <?php echo JS_PATH . "FormController.js" ?> " ></script>
    
    <!-- Funcionalidades JS propias de Boostrap (para uso de componentes especificos) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"
    >
    </script>
</body>

</html>