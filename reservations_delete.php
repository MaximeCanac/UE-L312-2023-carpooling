<?php

use App\Controllers\ReservationsController;

require __DIR__ . '/vendor/autoload.php';

$controller = new ReservationsController();
if(isset($_POST['delete_reservation'])) {
    if(isset($_POST['id_reservation'])) {
        if($controller->deleteReservation($_POST['id_reservation'])) {
            $message = '<p style="color:green;"><b>Succès:</b> Réservation supprimée.</p>';
        }
        else {
            $message = '<p style="color:red;"><b>Erreur:</b> Une erreur est survenue.</p>';
        }
    }
    else {
        $message = '<p style="color:red;"><b>Erreur:</b> Vous devez remplir tous les champs.</p>';
    }
}
?>

<p>Supression d'une réservation</p>
<form method="post" action="reservations_delete.php" name ="reservationsDeleteForm">
    <label for="id_reservation">Id :</label>
    <input type="text" name="id_reservation">
    <br />
    <input type="submit" value="Supprimer une réservation" name="delete_reservation">
</form>
