<?php
    namespace DAO;

    use Models\Guardian as Guardian;

    interface I_GuardianDAO
    {
        function Add(Guardian $guardian);
        function GetAll();
        function GetById($id);
        function GetByEmail($email);
        function GetByDni($dni);
        function Remove($id);
    }

?>