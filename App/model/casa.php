<?php

namespace App\model;

class Casa{
    private $id_casa;
    private $status_agua;
    private $status_energia;

    public function getIdCasa(){
        return $this->id_casa;
    }
    public function setIdCasa($id_casa){
        $this->id_casa = $id_casa;
    }

    public function getStatusAgua(){
        return $this->status_agua;
    }
    public function setStatusAgua($status){
        $this->status_agua = $status;
    }

    public function getStatusEnergia(){
        return $this->status_energia;
    }
    public function setStatusEnergia($status){
        $this->status_energia = $status;
    }
}

?>