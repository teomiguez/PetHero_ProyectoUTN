<?php
    namespace Models;

    use Models\Pet as Pet;

    class Dog extends Pet
    {
        $id_dog;
        $type;

        // -> SETTERS Y GETTERS
        
        public function getId_dog()
        {
            return $this->id_dog;
        }

        public function setId_dog($id_dog)
        {
            $this->id_dog = $id_dog;
        }

        public function getType()
        {
            return $this->type;
        }

        public function setType($type)
        {
            $this->type = $type;
        }

        // <- SETTERS Y GETTERS

    }

?>