<?php

namespace App\Models;

class DataLayer
{
    /**
     * Ritorna la lista dei progetti
     */
    public function listProjects () {
        $projectsList = array();

        $projectsList[] = new Project(1, "Volontariato in Finlandia", "ESC", "Chiara Usanza", 1);
        $projectsList[] = new Project(2, "My Voice", "Scambi Giovanili", "Davide Leone", 2);
        $projectsList[] = new Project(3, "Study Visit", "Corsi di Formazione", "Davide Leone", 2);

        return $projectsList;
    }

    /**
     * Ritorna il creatore con l'ID specificato
     */
    public function findCreatorByID($id) {
        if($id==1) {
            return new Creator(1, "Chiara", "Usanza");
        } elseif($id==2) {
            return new Creator(2, "Davide", "Leone");
        } else {
            return null;
        }
    }

    /**
     * Ritorna TRUE se il progetto associato all'ID del creatore esiste, FALSE altrimenti
     */
    public function findProjectByCreatorID($id) {
        if($id==1) {
            return true;
        } elseif($id==2) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Ritorna il progetto con l'ID specificato
     */
    public function findProjectByID($id) {
        if($id==1) {
            return new Project(1, "Volontariato in Finlandia", "ESC", "Chiara Usanza", 1);
        } elseif($id==2) {
            return new Project(2, "My Voice", "Scambi Giovanili", "Davide Leone", 2);
        } elseif($id==3) {
            return new Project(3, "Study Visit", "Corsi di Formazione", "Davide Leone", 2);
        } else {
            return null;
        }
    }

   /**
    * Ritorna la lista dei creatori
    */
    public function listCreators() {
        $creatorsList = array();

        $creatorsList[] =  new Creator(1, "Chiara", "Usanza");
        $creatorsList[] = new Creator(2, "Davide", "Leone");
        $creatorsList[] = new Creator(3, "Cristiana", "Gnutti");

        return $creatorsList;
    }


}