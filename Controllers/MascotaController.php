<?php
    namespace Controllers;

    use DAO\MascotaDAO as MascotaDAO;
    use Models\Mascota as Mascota;

    class MascotaController 
    {
        private $mascotaDAO;
        
        public function __contruct()
        {
            $this->mascotaDAO = new MascotaDAO();
        } 

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."MascotasPerfiles.php");
        }

        public function ShowListView()
        {
            $mascotaList = $this->mascotaDAO->getAll();
            
            require_once(VIEWS_PATH."MascotasPerfiles.php");
        }

        public function Add($id_dueño, $name, $img, $tamaño, $video = "", $obs)
        {
            $mascota = new Mascota();

            $mascota->setId_dueño($id_dueño);
            $mascota->setNombre($name);
            $mascota->setImg($img);
            $mascota->setTamaño($tamaño);
            $mascota->setVideo($video);
            $mascota->setObervaciones($obs);

            $this->mascotaDAO->Add($mascota);

            this->ShowListView();
        }
    }

?>