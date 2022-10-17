<?php
    namespace DAO;

    use Models\Owner as Owner;

    interface I_OwnerDAO
    {
        function Add(Owner $owner);
        function GetAll();
        function GetById($id);
        function GetByEmail($email);
        function GetByDni($dni);
        function Remove($id);
    }

?>