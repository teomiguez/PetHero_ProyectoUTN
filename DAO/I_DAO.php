<?php
    namespace DAO;

    interface I_DAO
    {
        function Add($obj);
        function GetAll();
        function GetById($id);
        function Remove($id);
    }

?>