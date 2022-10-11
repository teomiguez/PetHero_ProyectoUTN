<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Pagina Registro </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>
<body>
    <main class="coteiner">
        <section class="bg-white text-dark py-2 px-3 border-5 rounded-4">
            <h2 class="text-center py-2"> Registrarse </h2>
            <form action="" method="">

                <div>
                    <label for="name" class="form-label"> Nombre </label>
                    <input id="name" name="name" type="text" class="form-control" required>
                </div>

                <br>

                <div>
                    <label for="last_name" class="form-label"> Apellido </label>
                    <input id="last_name" name="last_name" type="text" class="form-control" required>
                </div>

                <br>

                <div>
                    <label for="mail" class="form-label"> Email </label>
                    <input id="mail" name="email" type="email" class="form-control" placeholder="example@email.com" required>
                </div>

                <br>

                <div>
                    <label for="password" class="form-label"> Contraseña </label>
                    <input id="password" name="password" type="password" class="form-control" placeholder="" required>
                </div>

                <br>

                <div>
                    <label for="check_password" class="form-label"> Confirmar Contraseña </label>
                    <input id="check_password" name="check_password" type="password" class="form-control" placeholder="" required>
                </div>

                <br>

                <div>
                    <label for="radio_option" class="form-label "> Eres un... </label>

                    <br>

                    <div class="form-check form-check-inline">
                         <input class="form-check-input" type="radio" name="radio_option" id="radio_dueño" value="option1" required>
                        <label class="form-check-label" for="radio_dueño"> Dueño </label>
                    </div>
                    
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="radio_option" id="radio_guardian" value="option2" >
                        <label class="form-check-label" for="radio_guardian"> Guardian </label>
                    </div>
                </div>

                <br>
                
                <div>
                    <div class="d-inline-block">
                        <label for="street" class="form-label"> Calle </label>
                        <input id="street" name="street" type="text" class="form-control" required>
                    </div>

                    <div class="d-inline-block">
                        <label for="nro" class="form-label"> Altura </label>
                        <input id="nro" name="nro" type="text" class="form-control" required>
                    </div>
                </div>
                
                <br>

                <div>
                    <label for="days_checks" class="form-check"> Dias disponibles </label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="check_monday" value="option1" required>
                        <label class="form-check-label" for="check_monday"> Lunes </label>
                    </div>
                    
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="check_tuesday" value="option2">
                        <label class="form-check-label" for="check_tuesday"> Martes </label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="check_wednesday" value="option3">
                        <label class="form-check-label" for="check_wednesday"> Miercoles </label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="check_thursday" value="option4">
                        <label class="form-check-label" for="check_thursday"> Jueves </label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="check_friday" value="option5">
                        <label class="form-check-label" for="check_friday"> Viernes </label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="check_saturday" value="option6">
                        <label class="form-check-label" for="check_saturday"> Sabado </label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="check_sunday" value="option7">
                        <label class="form-check-label" for="check_sunday"> Domingo </label>
                    </div>
                    

                </div>

                <br>

                <div>
                    <label for="tipo_perro" class="form-label"> Tamaño de perro a cuidar</label>
                    <select id="tipo_perro" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
                        <option selected disabled> Tamaño del perro</option>
                        <option value="chico"> Chico </option>
                        <option value="mediano"> Mediano </option>
                        <option value="grande"> Grande </option>
                    </select>
                </div>
                
                <br>
                
                <div class="mb-3 row">
                    <label for="cost" class="col-sm-2 col-form-label"> Valor del cuidado </label>
                    <div class="col-sm-10">
                        <div class="input-group mb-3">
                            <span class="input-group-text">$</span>
                            <input id="cost" type="text" class="form-control" aria-label="Amount (to the nearest dollar)" required>
                        </div>
                    </div>
                </div>

                <br>

                <div class="d-grid gap-2">
                     <button class="btn btn-primary" type="submit">Registrarme</button>
                </div>
        
            </form>
        </section>
    </main>

    <!-- Funcionalidades JS propias de Boostrap (para uso de compoentes especificos) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>