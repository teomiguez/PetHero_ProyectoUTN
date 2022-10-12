<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Pagina Registro </title>

    <!-- Link use Css_file -->
    <link rel="stylesheet" href="css/styles.css">

    <!-- Link use Boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        
</head>

<body class="bg-color">
    <main class="container text-center mx-5">
        <section class="bg-white text-dark py-2 px-3 border-5 rounded-4">
            <h2 class="text-center py-2"> Registrarse </h2>
            <form action="" method="" class="text-start">
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
                            <input id="dni" name="dni" type="number" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 my-2">
                        <div>
                            <label for="tel" class="form-label"> Telefono </label>
                            <input id="tel" name="tel" type="tel" class="form-control" placeholder="123456789" required>
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

                    <div class="col-12 col-md-6 my-2">
                        <div>
                            <label for="check_password" class="form-label"> Confirmar Contraseña </label>
                            <input id="check_password" name="check_password" type="password" class="form-control"
                                placeholder="" required>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 my-2">
                        <div>
                            <label for="radio_option" class="form-label "> Eres un... </label>

                            <br>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="radio_option" id="radio_dueño"
                                    value="option1" onclick="enabledFields()" required>
                                <label class="form-check-label" for="radio_dueño"> Dueño </label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="radio_option" id="radio_guardian"
                                    value="option2" onclick="enabledFields()" required>
                                <label class="form-check-label" for="radio_guardian"> Guardian </label>
                            </div>
                        </div>
                    </div>

                    <hr class="my-3">

                    <div class="col-12 col-md-6 my-2">
                        <div>
                            <div class="d-inline-block">
                                <label for="street" class="form-label"> Calle </label>
                                <input id="street" name="street" type="text" class="form-control" disabled required>
                            </div>

                            <div class="d-inline-block">
                                <label for="nro" class="form-label"> Altura </label>
                                <input id="nro" name="nro" type="text" class="form-control" disabled required>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 my-2">
                        <div>
                            <label for="days_checks" class="form-check"> Dias disponibles </label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="check_monday" name="check[]" value="option1"
                                    disabled>
                                <label class="form-check-label" for="check_monday"> Lu </label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="check_tuesday" name="check[]" value="option2"
                                    disabled>
                                <label class="form-check-label" for="check_tuesday"> Ma </label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="check_wednesday" name="check[]" value="option3"
                                    disabled>
                                <label class="form-check-label" for="check_wednesday"> Mi </label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="check_thursday" name="check[]" value="option4"
                                    disabled>
                                <label class="form-check-label" for="check_thursday"> Jue </label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="check_friday" name="check[]" value="option5"
                                    disabled>
                                <label class="form-check-label" for="check_friday"> Vie </label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="check_saturday" name="check[]" value="option6"
                                    disabled>
                                <label class="form-check-label" for="check_saturday"> Sa </label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="check_sunday" name="check[]" value="option7"
                                    disabled>
                                <label class="form-check-label" for="check_sunday"> Do </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 my-2">
                        <div>
                            <select id="tipo_perro" class="form-select form-select-sm"
                                aria-label=".form-select-sm example" name="tipo" disabled required>
                                <option selected> Tamaño del perro</option>
                                <option value="chico"> Chico </option>
                                <option value="mediano"> Mediano </option>
                                <option value="grande"> Grande </option>
                            </select>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 my-2">
                        <div class="mb-3 row">
                            <label for="cost" class="col-sm-2 col-form-label"> Remuneracion </label>
                            <div class="col-sm-10">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">$</span>
                                    <input id="cost" type="text" class="form-control" name="cost"
                                        aria-label="Amount (to the nearest dollar)" disabled required>
                                </div>
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

    <!-- Archivos JS -->
    <script src="js/EnableFields.js"></script>

    <!-- Funcionalidades JS propias de Boostrap (para uso de compoentes especificos) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>