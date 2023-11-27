<?php

namespace App\Controllers;

use App\Services\AnnouncementsService;

class AnnouncementsController
{
    /**
     * Return the html for the create action.
     */
    public function createAnnouncement(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['user_id']) &&
            isset($_POST['car_id']) &&
            isset($_POST['destination']) &&
            isset($_POST['date']) &&
            isset($_POST['description']) &&
            isset($_POST['price'])) {
            // Create the Announcement :
            $announcementsService = new AnnouncementsService();
            $isOk = $announcementsService->setAnnouncement(
                null,
                $_POST['user_id'],
                $_POST['car_id'],
                $_POST['destination'],
                $_POST['date'],
                $_POST['description'],
                $_POST['price']
            );
            if ($isOk) {
                $html = 'Annonce créé avec succès.';
            } else {
                $html = 'Erreur lors de la création de l\'annonce.';
            }
        }

        return $html;
    }

    /**
     * Return the html for the read action.
     */
    public function getAnnouncements(): string
    {
        $html = '';

        // Get all announcements :
        $announcementsService = new AnnouncementsService();
        $announcements = $announcementsService->getAnnouncements();

        // Get html :
        foreach ($announcements as $announcement) {
            $html .=
                '#' . $announcement->getId() . ' ' .
                $announcement->getUserId() . ' ' .
                $announcement->getCarId() . ' ' .
                $announcement->getDestination() . ' ' .
                $announcement->getDate()->format('d-m-Y') . ' ' .
                $announcement->getDescription() . ' ' .
                $announcement->getPrice() . '<br />' ;
        }

        return $html;
    }

    /**
     * Update the announcement.
     */
    public function updateAnnouncement(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['user_id']) &&
            isset($_POST['car_id']) &&
            isset($_POST['destination']) &&
            isset($_POST['date']) &&
            isset($_POST['description']) &&
            isset($_POST['price'])) {
            // Update the Announcement :
            $announcementsService = new AnnouncementsService();
            $isOk = $announcementsService->setAnnouncement(
                $_POST['user_id'],
                $_POST['car_id'],
                $_POST['destination'],
                $_POST['date'],
                $_POST['description'],
                $_POST['price']
            );
            if ($isOk) {
                $html = 'Annonce mis à jour avec succès.';
            } else {
                $html = 'Erreur lors de la mise à jour de l\'annonce.';
            }
        }

        return $html;
    }

    /**
     * Delete an Announcement.
     */
    public function deleteAnnouncement(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id'])) {
            // Delete the Announcement :
            $announcementsService = new AnnouncementsService();
            $isOk = $announcementsService->deleteAnnouncement($_POST['id']);
            if ($isOk) {
                $html = 'Annonce supprimé avec succès.';
            } else {
                $html = 'Erreur lors de la supression de l\'annonce.';
            }
        }

        return $html;
    }
}