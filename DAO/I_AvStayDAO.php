<?php
    namespace DAO;

    use Models\AvStay as AvStay;

    interface I_AvStayDAO
    {
        function Add(AvStay $stay);
        function GetAll();
        function GetById($id);
        //function Update($id); -> (ver) opcion para modificar una estadia
        function Remove($id);
    }

?>