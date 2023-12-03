<?php

namespace App\Services;

use \App\Entities\Reservation;
use DateTime;

class ReservationsService
{
    /**
     * Create or update a Reservation
     * @param int $id_user : User identifier
     * @param int $id_announcement : Announcement identifier
     * @param string $date
     * @param int $id_reservation : Reservation identifier (in case of update)
     * @return bool
     */
    public function setReservation(int $id_user, int $id_announcement, string $date, int $id_reservation=null): bool {
        $returnBool = false;

        $dataBaseService = new DataBaseService();
        $dateDateTime = new DateTime($date);

        if (empty($id_reservation)) {
            $returnBool = $dataBaseService->createReservation($id_reservation, $id_user, $dateDateTime);
        } else {
            $returnBool = $dataBaseService->updateReservation($id_reservation, $id_announcement, $id_user, $dateDateTime);
        }

        return $returnBool;
    }


    /**
     * Get all Reservations
     * @return array
     */
    public function getReservations(): array
    {
        $reservations = [];

        $dataBaseService = new DataBaseService();
        $reservationsDTO = $dataBaseService->getReservations();
        if (!empty($reservationsDTO)) {
            foreach ($reservationsDTO as $reservationDTO) {
                $reservation = new Reservation();
                $reservation->setId($reservationDTO['id_reservation']);
                $reservation->setUserId($reservationDTO['id_user']);
                $reservation->setDate($reservationDTO['date']);
                // $date = new DateTime($reservationDTO['date']);
                // if ($date !== false) {
                //     $reservation->setDate($date);
                // }
                
                $reservation->setAnnouncementId($reservationDTO['id_announcement']);
                
                // Gets the announcement for the current reservation
                $announcentService = new AnnouncementsService();
                $announcement = $announcentService->getAnnouncement($reservationDTO['id_announcement']);

                $reservation->setAnnouncement($announcement);
                $reservations[] = $reservation;
            }
        }

        return $reservations;
    }




    /**
     * Delete a Reservation
     * @param int $id_reservation : Reservation identifier
     * @return bool
     */
    public function deleteReservation(int $id_reservation): bool {
        $returnBool = false;

        $dataBaseService = new DataBaseService();
        $returnBool = $dataBaseService->deleteReservation($id_reservation);

        return $returnBool;
    }


    
}

?>