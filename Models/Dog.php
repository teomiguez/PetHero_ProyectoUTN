<?php
    namespace Models;

    use Models\Pet as Pet;

    class Dog extends Pet
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