<?php

namespace App\Services;

use App\Entities\Announcement;
use DateTime;

class AnnouncementsService
{
    /**
     * Create or update an user.
     */
    public function setAnnouncement(?string $id, string $firstname, string $lastname, string $email, string $birthday): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $birthdayDateTime = new DateTime($birthday);
        if (empty($id)) {
            $isOk = $dataBaseService->createAnnouncement($firstname, $lastname, $email, $birthdayDateTime);
        } else {
            $isOk = $dataBaseService->updateAnnouncement($id, $firstname, $lastname, $email, $birthdayDateTime);
        }

        return $isOk;
    }

    /**
     * Return all users.
     */
    public function getAnnouncements(): array
    {
        $announcements = [];

        $dataBaseService = new DataBaseService();
        $announcementsDTO = $dataBaseService->getAnnouncements();
        if (!empty($announcementsDTO)) {
            foreach ($announcementsDTO as $announcementDTO) {
                $announcement = new Announcement();
                $announcement->setId($announcementDTO['id']);
                $announcement->setFirstname($announcementDTO['firstname']);
                $announcement->setLastname($announcementDTO['lastname']);
                $announcement->setEmail($announcementDTO['email']);
                $date = new DateTime($announcementDTO['birthday']);
                if ($date !== false) {
                    $announcement->setbirthday($date);
                }
                $announcements[] = $announcement;
            }
        }

        return $announcements;
    }

    /**
     * Delete an user.
     */
    public function deleteAnnouncement(string $id): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->deleteAnnouncement($id);

        return $isOk;
    }
}
