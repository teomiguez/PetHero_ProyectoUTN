<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Guardian - Mi Perfil </title>

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

    include('nav-guardian.php');

    ?>

    <br>

<!-- 
        HAY QUE TERMINAR ESTA PÁGINA DE MODIFICACIÓN DEL PERFIL DEL GUARDIAN

        - CREAR METODO UPDATE EN GUARDIAN_CONTROLLER (BORRAR EL GUARDIAN EXISTENTE Y AGREGAR EL NUEVO MODIFICADO)
        Nota: Modificar el ancla de 'Modificar' del GuardianProfile (quedo feo jaja)
-->
    
    <main class="container text-center">
        <div class="col-md-6 offset-md-3">
            <h2 class="text-center my-3"> Modificar Perfil </h2>
            <form action="" method="">

                <table class="table table-striped">
                    <tbody>
                    <tr>
                            <div class="d-flex">
                                <th scope="row"><label class="me-3" for="name" class="form-label"> </label> Nombre: </th> 
                                <td> <input id="name" name="name" type="text" class="form-control" value="<?php echo $user->getName() ?>" required ></td>    
                            </div>
                        </tr>
                    <tr>
                            <div class="d-flex">
                                <th scope="row"><label class="me-3" for="last_name" class="form-label"></label> Apellido: </th> 
                                <td> <input id="last_name" name="last_name" type="text" class="form-control" value="<?php echo $user->getLast_name() ?>" required></td>    
                            </div>
                    </tr>
                    <tr>
                            <div class="d-flex">
                                <th scope="row"><label class="me-3" for="dni" class="form-label"></label> DNI: </th> 
                                <td> <input id="dni" name="dni" type="number" class="form-control" min="1000000" max="99000000" value="<?php echo $user->getDni() ?>" required></td>    
                            </div>
                    </tr>
                    <tr>
                            <div class="d-flex">
                                <th scope="row"><label class="me-3" for="tel" class="form-label"> </label> Telefono: </th> 
                                <td> <input id="tel" name="tel" type="tel" class="form-control" pattern="[2]{2}[3]{1}[0-9]{3}[0-9]{4}" value="<?php echo $user->getTelephone() ?>" required ></td>    
                            </div>          
                    </tr>
                        <tr>
                            <div class="d-flex">
                                <th scope="row"><label class="me-3" for="adress" class="form-label"> </label> Calle: </th> 
                                <td> <input id="street" name="street" type="text" class="form-control"  value="<?php echo strtok($user->getAddress()," ")   ?> " required ></td>   
                            </div>
                        </tr>     <!-- LA FUNCION QUE RECIBA LA CALLE Y LA ALTURA DEBE UNIRLAS PARA CONFORMAR ADRESS, IGUAL QUE EN EL REGISTERGUARDIAN (SI SE NOS COMPLICA SOLO MOSTRAMOS EL ADRESS Y PONEMOS DISABLED PARA QUE NO SE PUEDA MDIFICAR ;)-->
                        <tr>
                            <div class="d-flex">
                                <th scope="row"><label class="me-3" for="adress" class="form-label"> </label> Altura: </th>
                                <td> <input id="nro" name="nro" type="numer" class="form-control" min="1" max="9999" value="<?php echo filter_var($user->getAddress(), FILTER_SANITIZE_NUMBER_INT) ?> " required> </td>    
                            </div>
                        </tr>
                        <tr>
                            <div class="d-flex">
                                <th scope="row"><label class="me-3" for="email"class="form-label"> </label> Email: </th> 
                                <td> <input id="name" name="name" type="text" class="form-control" value="<?php echo $user->getEmail() ?>" required ></td>    
                            </div>
                    </tr>
                    <tr>
                            <div class="d-flex">
                                <th scope="row"><label class="me-3" for="password" class="form-label"> </label> Contraseña: </th> 
                                <td> <input id="password" name="password" type="password" class="form-control" value="<?php echo $user->getPassword() ?>" required ></td>    
                            </div>
                    </tr>
                            <div class="d-flex">
                                <th scope="row"><label class="me-3"  for="typeSize" class="form-label"> </label> Preferencia: </th> 
                                <td> <select id="typeSize" class="form-select" aria-label="form-select" name="typeSize" value="<?php echo $user->getSizeCare()?>" required >
                                    <option value="chico"> Chico </option>
                                    <option value="mediano"> Mediano </option>
                                    <option value="grande"> Grande </option>
                            </select>
                               </td>    
                            </div>
                        </tr>
                        <tr>
                            <div class="d-flex">
                                <th scope="row"><label class="me-3" for="cost" class="form-label"> </label> Remuneración $ : </th> 
                                <td>  <input id="cost" type="number" class="form-control" name= "cost" aria-label="Amount (to the nearest dollar)" 
                                    min="1" value="<?php echo $user->getCost() ?>" required ></td>    
                            </div>
                        </tr>
                        <tr>
                            <div class="d-flex">
                                <th scope="row"><label class="me-3" for="review" class="form-label"> </label> Calificación : </th> 
                                <td>  <input id="review" type="number" class="form-control" name= "review" value="<?php $user_review->getId_review() ?>" placeholder= "<?php echo $user_review->getReview() ?> (<?php echo $user_review->getQuantity_reviews() ?>)" required disabled></td>    
                            </div>
                        </tr>
                    </tbody>
            </form>
            </table> 
            <div class="d-grid gap-2 col-6 me-auto">
                    <a href=""> Guardar Cambios </a>
                </div>   
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