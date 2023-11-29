<?php

namespace App\Services;

use App\Entities\Reservations;
use DateTime;

class ReservationsService
{
    /**
     * Create or update a Reservation
     * @param int $id_announcement : Announcement identifier
     * @param int $id_user : User identifier
     * @param string $date
     * @param int $id_reservation : Reservation identifier (in case of update)
     * @return bool
     */
    public function setReservation(int $id_announcement, int $id_user, string $date, int $id_reservation=null): bool {
        $returnBool = false;

        $dataBaseService = new DataBaseService();
        $dateDateTime = new DateTime($date);

        if (empty($id_reservation)) {
            $returnBool = $dataBaseService->createReservation($id_announcement, $id_user, $dateDateTime);
        } else {
            $returnBool = $dataBaseService->updateReservation($id_reservation, $id_announcement, $id_user, $dateDateTime);
        }

        return $returnBool;
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