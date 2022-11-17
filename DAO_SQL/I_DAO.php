<?php
    namespace DAO_SQL;

    interface I_DAO
    {
        //function Add($obj); 
        
        function GetAll();
        
        function GetById($id);
        
        function Remove($id);
    }

?>