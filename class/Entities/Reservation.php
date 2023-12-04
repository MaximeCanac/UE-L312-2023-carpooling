<?php

namespace App\Entities;

use DateTime;
use \App\Controllers\AnnouncementsController;

class Reservation
{
    private $id;
    private $announcementId;
    private $userId;
    private $date;
    private $announcementObject;



    /* GETTERS */
    public function getId(): int {
        return $this->$id;
    }

    public function getAnnouncementId(): int {
        return $this->$announcementId;
    }

    public function getUserId(): int {
        return $this->$userId;
    }

    public function getDate(): DateTime {
        return $this->$date;
    }

    public function getAnnouncement(): Announcement {
        return $this->announcementObject;
    }





    /* SETTERS */
    public function setId(int $id): void {
        $this->$id = $id;
    }

    public function setAnnouncementId(int $announcementId): void {
        $this->$announcementId = $announcementId;
    }

    public function setUserId(int $userId): void {
        $this->$userId = $userId;
    }

    public function setDate(string $date): void {
        $this->$date = $date;
    }

    public function setAnnouncement(Announcement $announcement) {
        $this->announcementObject = $announcement;
    }


}

?>
