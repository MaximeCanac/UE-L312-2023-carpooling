<?php

namespace App\Controllers;

use App\Services\UsersService;

class AnnouncementController
{
    /**
     * Return the html for the create action.
     */
    public function createAnnouncement(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['user']) &&
            isset($_POST['car']) &&
            isset($_POST['destination']) &&
            isset($_POST['date']) &&
            isset($_POST['description']) &&
            isset($_POST['price'])) {
            // Create the Announcement :
            $announcementsService = new AnnouncementsService();
            $isOk = $announcementsService->setAnnouncement(
                null,
                $_POST['firstname'],
                $_POST['lastname'],
                $_POST['email'],
                $_POST['birthday']
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
        $announcementService = new AnnouncementsService();
        $announcements = $announcementsService->getAnnouncements();

        // Get html :
        foreach ($announcements as $announcement) {
            $html .=
                '#' . $announcement->getId() . ' ' .
                $announcement->getFirstname() . ' ' .
                $announcement->getLastname() . ' ' .
                $announcement->getEmail() . ' ' .
                $announcement->getBirthday()->format('d-m-Y') . '<br />';
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
        if (isset($_POST['id']) &&
            isset($_POST['firstname']) &&
            isset($_POST['lastname']) &&
            isset($_POST['email']) &&
            isset($_POST['birthday'])) {
            // Update the user :
            $announcementsService = new AnnouncementsService();
            $isOk = $announcementsService->setAnnouncement(
                $_POST['id'],
                $_POST['firstname'],
                $_POST['lastname'],
                $_POST['email'],
                $_POST['birthday']
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
     * Delete an user.
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
