<?php
    namespace Models;

    use Models\Pet as Pet;

    class Cat extends Pet
    {
        private $id;
        
        // -> SETTERS Y GETTERS
        
        public function getId()
        {
            return $this->id;
        }

        public function setId($id)
        {
            $this->id = $id;
        }

        // <- SETTERS Y GETTERS
    }

?>    