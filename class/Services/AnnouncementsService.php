<?php

namespace App\Services;

use App\Entities\Announcement;
use DateTime;

class AnnouncementsService
{
    /**
     * Create or update an user.
     */
    public function setAnnouncement(?string $id, string $id_user, string $id_car, string $destination, string $date, string $description, string $price): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $dateDateTime = new DateTime($date);
        if (empty($id)) {
            $isOk = $dataBaseService->createAnnouncement($id_user, $id_car, $destination, $dateDateTime, $description, $price);
        } else {
            $isOk = $dataBaseService->updateAnnouncement($id, $id_user, $id_car, $destination, $dateDateTime, $description, $price);
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
                $announcement->setUserId($announcementDTO['id_user']);
                $announcement->setCarId($announcementDTO['id_car']);
                $announcement->setDestination($announcementDTO['destination']);
                $date = new DateTime($announcementDTO['date']);
                if ($date !== false) {
                    $announcement->setdate($date);
                }
                $announcement->setDescription($announcementDTO['description']);
                $announcement->setPrice($announcementDTO['price']);
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
