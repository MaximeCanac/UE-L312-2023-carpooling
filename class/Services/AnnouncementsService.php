<?php

namespace App\Services;

use App\Entities\Announcement;
use App\Entities\Reservation;
use DateTime;

class AnnouncementsService
{
    /**
     * Create or update an Announcement.
     */
    public function setAnnouncement(?string $id, string $destination, string $date, string $description, string $price): bool
    {
        $announcementId = '';

        $dataBaseService = new DataBaseService();
        $dateDateTime = new DateTime($date);
        if (empty($id)) {
            $announcementId = $dataBaseService->createAnnouncement($destination, $dateDateTime, $description, $price);
        } else {
            $dataBaseService->updateAnnouncement($id, $destination, $dateDateTime, $description, $price);
            $announcementId = $id;
        }

        return $announcementId;
    }

    /**
     * Return all Announcements.
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
                $announcement->setDestination($announcementDTO['destination']);
                $date = new DateTime($announcementDTO['date']);
                if ($date !== false) {
                    $announcement->setdate($date);
                }
                $announcement->setDescription($announcementDTO['description']);
                $announcement->setPrice($announcementDTO['price']);

                // Get Reservations of this Announcement:
                $reservations = $this->getAnnouncementReservations($userDTO['id']);
                $announcements->setReservations($reservations);

                $announcements[] = $announcement;
            }
        }

        return $announcements;
    }


    /**
     * Return the searched announcement
     *
     * @param int $id
     * @return array
     */
    public function getAnnouncement(int $id): Announcement
    {
        $announcements = [];

        $dataBaseService = new DataBaseService();
        $announcementsDTO = $dataBaseService->getAnnouncement($id);
        if (!empty($announcementsDTO)) {
            foreach ($announcementsDTO as $announcementDTO) {
                $announcement = new Announcement();
                $announcement->setId($announcementDTO['id']);
                $announcement->setDestination($announcementDTO['destination']);
                $date = new DateTime($announcementDTO['date']);
                if ($date !== false) {
                    $announcement->setdate($date);
                }
                $announcement->setDescription($announcementDTO['description']);
                $announcement->setPrice($announcementDTO['price']);
                return $announcement;
            }
        }

        $nullAnnouncement = new Announcement();
        return $nullAnnouncement;
    }

    /**
     * Delete an Announcement.
     */
    public function deleteAnnouncement(string $id): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->deleteAnnouncement($id);

        return $isOk;
    }

    /**
     * Create relation bewteen an announcement and his reservation.
     */
    public function setAnnouncementReservation(string $announcementId, string $reservationId): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->setAnnouncementReservation($announcementId, $reservationId);

        return $isOk;
    }

    /**
     * Get cars of given user id.
     */
    public function getAnnouncementReservations(string $announcementId): array
    {
        $announcementReservations = [];

        $dataBaseService = new DataBaseService();

        // Get relation users and cars :
        $announcementReservationsDTO = $dataBaseService->getAnnouncementReservations($announcementId);
        if (!empty($announcementReservationsDTO)) {
            foreach ($announcementReservationsDTO as $announcementReservationDTO) {
                $reservation = new Reservation();
                $reservation->setId($announcementReservationDTO['id']);
                $reservation->setDate($announcementReservationDTO['date']);
                $reservation->setAnnouncement($announcementReservationDTO['announcement']);
                $announcementReservations[] = $reservation;
            }
        }

        return $announcementReservations;
    }
}
