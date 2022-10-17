<?php
    namespace DAO;

    use Models\Pet as Pet;

    interface I_PetDAO
    {
        function Add(Pet $pet);
        function GetAll();
        function GetById($id);
        function GetByOwner($id_owner);
        function Remove($id);
    }

?>