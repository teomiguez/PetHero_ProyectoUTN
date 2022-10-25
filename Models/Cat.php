<?php
    namespace Models;

    use Models\Pet as Pet;

    class Cat extends Pet
    {
        $id_cat;
        
        // -> SETTERS Y GETTERS
        
        public function getId_cat()
        {
            return $this->id_cat;
        }

        public function setId_cat($id_cat)
        {
            $this->id_cat = $id_cat;
        }

        // <- SETTERS Y GETTERS
    }

?>    