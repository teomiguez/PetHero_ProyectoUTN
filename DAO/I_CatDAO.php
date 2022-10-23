<?php
    namespace DAO;

    use Models/Cat as Cat;

    class I_CatDAO
    {
        function Add(Cat $cat);
        function GetAll();
        function GetById($id);
        function GetByOwner($id_owner);
        function Remove($id);
    }

?>