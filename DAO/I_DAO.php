<?php
    namespace DAO;

    interface I_DAO
    {
        // ver porque tira error al usar el object

        //function Add(Object $obj);
        
        function GetAll();
        
        function GetById($id);
        
        function Remove($id);
    }

?>