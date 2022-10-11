<?php
    namespace DAO;

    interface IDAO
    {
        function Add($obj);
        function GetAll();
        function GetById($id);
        function Remove($id);
    }

?>