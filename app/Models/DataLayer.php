<?php

namespace App\Models;

class DataLayer
{
    /**
     * Ritorna la lista dei progetti
     */
    public function listProjects () {
        $projectsList = array();

        $projectsList[] = new Project(1, "Volontariato in Finlandia", "ESC", "Chiara Usanza", 1, 
            2, "Finlandia", "2024-06-01", "2024-07-01", "2024-05-01",
            "Associazione Volontari Finlandesi", 
            "L'Associazione Volontari Finlandesi è un'organizzazione che promuove il volontariato internazionale.",
            "Un'esperienza di volontariato in Finlandia per giovani tra i 18 e i 30 anni.",
            "Il progetto prevede attività di volontariato in diverse aree, come la tutela dell'ambiente e l'assistenza sociale.",
            "Essere tra i 18 e i 30 anni, avere una buona conoscenza dell'inglese.",
            "I costi di viaggio saranno coperti dall'associazione, e sarà fornito un alloggio gratuito durante il soggiorno.");
        $projectsList[] = new Project(2, "My Voice", "YTH", "Davide Leone", 2, 
            5, "Italia", "2024-08-01", "2024-08-15", "2024-07-01",
            "Associazione Giovani Italiani", 
            "L'Associazione Giovani Italiani è un'organizzazione che promuove la partecipazione attiva dei giovani.",
            "Un progetto di scambio giovanile per promuovere la partecipazione attiva dei giovani.",
            "Il progetto include attività culturali, workshop e discussioni su temi sociali.",
            "Essere tra i 18 e i 30 anni, avere interesse per le questioni sociali e culturali.",
            "I costi di viaggio saranno coperti dall'associazione, e sarà fornito un alloggio condiviso durante il soggiorno.");
        $projectsList[] = new Project(3, "Study Visit", "TRG", "Davide Leone", 2, 
            10, "Spagna", "2024-09-01", "2024-09-10", "2024-08-01",
            "Associazione Formazione Europea", 
            "L'Associazione Formazione Europea è un'organizzazione che offre corsi di formazione per giovani professionisti.",
            "Un corso di formazione per migliorare le competenze professionali dei partecipanti.",
            "Il corso include sessioni teoriche e pratiche su vari argomenti professionali.",
            "Essere tra i 18 e i 35 anni, avere un interesse per lo sviluppo professionale.",
            "I costi di viaggio saranno coperti dall'associazione, e sarà fornito un alloggio in hotel durante il soggiorno.");

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
            return new Project(1, "Volontariato in Finlandia", "ESC", "Chiara Usanza", 1, 
                2, "Finlandia", "2024-06-01", "2024-07-01", "2024-05-01",
                "Associazione Volontari Finlandesi", 
                "L'Associazione Volontari Finlandesi è un'organizzazione che promuove il volontariato internazionale.", 
                "Un'esperienza di volontariato in Finlandia per giovani tra i 18 e i 30 anni.",
                "Il progetto prevede attività di volontariato in diverse aree, come la tutela dell'ambiente e l'assistenza sociale.",
                "Essere tra i 18 e i 30 anni, avere una buona conoscenza dell'inglese.",
                "I costi di viaggio saranno coperti dall'associazione, e sarà fornito un alloggio gratuito durante il soggiorno.");
        } elseif($id==2) {
            return new Project(2, "My Voice", "YTH", "Davide Leone", 2, 
                5, "Italia", "2024-08-01", "2024-08-15", "2024-07-01",
                "Associazione Giovani Italiani",
                "L'Associazione Giovani Italiani è un'organizzazione che promuove la partecipazione attiva dei giovani.",
                "Un progetto di scambio giovanile per promuovere la partecipazione attiva dei giovani.",
                "Il progetto include attività culturali, workshop e discussioni su temi sociali.",
                "Essere tra i 18 e i 30 anni, avere interesse per le questioni sociali e culturali.",
                "I costi di viaggio saranno coperti dall'associazione, e sarà fornito un alloggio condiviso durante il soggiorno.");
        } elseif($id==3) {
            return new Project(3, "Study Visit", "TRG", "Davide Leone", 2, 
                10, "Spagna", "2024-09-01", "2024-09-10", "2024-08-01",
                "Associazione Formazione Europea",
                "L'Associazione Formazione Europea è un'organizzazione che offre corsi di formazione per giovani professionisti.", 
                "Un corso di formazione per migliorare le competenze professionali dei partecipanti.",
                "Il corso include sessioni teoriche e pratiche su vari argomenti professionali.",
                "Essere tra i 18 e i 35 anni, avere un interesse per lo sviluppo professionale.",
                "I costi di viaggio saranno coperti dall'associazione, e sarà fornito un alloggio in hotel durante il soggiorno.");
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