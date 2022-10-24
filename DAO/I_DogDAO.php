<?php
    namespace DAO;

    use Models\Dog as Dog;

    interface I_DogDAO
    {
        function Add(Dog $dog);
        function GetAll();
        function GetById($id);
        function GetByOwner($id_owner);
        function Remove($id);
    }
    
?>