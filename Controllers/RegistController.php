<?php
    namespace Controllers;
    
    use Controllers\DueñoController as dueñoController;
    use Controllers\GuardianController as guardianController;

    class RegistController
    {
        public function Regist()
        {   
            if($_POST)
            {
                $name = $_POST['name']; 
                $last_name = $_POST['last_name']; 
                $dni = $_POST['dni']; 
                $tel = $_POST['tel']; 
                $email = $_POST['email']; 
                $pass = $_POST['password']; 
                
                $radio = $_POST['radio_option'];
        
                if ($radio == 'option1')
                {
                    dueñoController->Add($name, $last_name, $dni, $tel, $email, $pass);
                } 
                else
                {
                    $calle = $_POST['street'];
                    $altura = $_POST['nro'];
                    $dir = $calle . $altura;
        
                    $checks = $_POST['check'];
                    $cantChecks = count($checks);
                    $days = array();
        
                    for ($i=0 ; $i < $cantChecks ; $i++)
                    {
                        switch ($checks[$i])
                        {
                            case 'option1':
                                array_push($days, 'Lu');
                                break;
                            case 'option2':
                                array_push($days, 'Ma');
                                break;
                            case 'option3':
                                array_push($days, 'Mi');
                                break;
                            case 'option4':
                                array_push($days, 'Jue');
                                break;
                            case 'option5':
                                array_push($days, 'Vie');
                                break;
                            case 'option6':
                                array_push($days, 'Sa');
                                break;
                            case 'option7':
                                array_push($days, 'Do');
                                break;
                        }
                    }
        
                    $tipo = $_POST['tipo'];
                    $costo = $_POST['cost']
                    
                    guardianController->Add($name, $last_name, $dni, $tel, $dir, $email, $pass, $days, $tipo, $costo)
                }
            }
        }
    }


?>