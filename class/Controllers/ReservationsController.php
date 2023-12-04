<?php

namespace App\Controllers;

use App\Services\ReservationsService;

class ReservationsController
{
    /**
     * Creates a reservation
     * 
     * @param int $id_announcement : Announcement identifier
     * @param int $id_user : User identifier
     * @param string $date : Date of reservation
     * @return bool
     */
    public function createReservation(int $id_announcement, int $id_user, string $date): bool {
        $returnBool = false;

        // Create the Reservation :
        $reservationService = new ReservationsService();
        $returnBool = $reservationService->setReservation(
            $id_announcement,
            $id_user,
            $date
        );

        return $returnBool;
    }




    /**
     * Get all reservations
     * 
     * @return string
     */
    public function getReservations(): string {
        $returnString = "";

        // Get all reservations :
        $reservationsService = new ReservationsService();
        $reservations = $reservationsService->getReservations();

        foreach ($reservations as $reservation) {
            $returnString .= ' --- '.var_dump($reservation);
        }

        
        return $returnString;
    }




    /**
     * Updates a reservation
     * 
     * @param int $id_reservation : Reservation identifier to update
     * @param int $id_announcement : Announcement identifier
     * @param int $id_user : User identifier
     * @param string $date : Date of reservation
     * @return bool
     */
    public function updateReservation(int $id_reservation, int $id_announcement, int $id_user, string $date): bool {
        $returnBool = false;

        // Create the Reservation :
        $reservationService = new ReservationsService();
        $returnBool = $reservationService->setReservation(
            $id_announcement,
            $id_user,
            $date,
            $id_reservation
        );

        return $returnBool;
    }



    /**
     * Deletes a Reservation.
     * @param int $id_reservation : Reservation identifier to update
     * @return bool
     */
    public function deleteReservation($id_reservation): bool
    {
        $returnBool = false;

        $reservationsService = new ReservationsService();
        $returnBool = $reservationsService->deleteReservation($id_reservation);

        return $returnBool;
    }
}

?>