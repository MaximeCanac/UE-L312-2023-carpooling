<?php

use App\Controllers\ReservationsController;

require __DIR__ . '/vendor/autoload.php';

$controller = new ReservationsController();
$message = null;

if(isset($_POST['update_reservation'])) {

    if(!empty($_POST['id_reservation']) && !empty($_POST['id_user']) && !empty($_POST['id_announcement']) && !empty($_POST['date'])) {
        if($controller->updateReservation($_POST['id_reservation'], $_POST['id_announcement'], $_POST['id_user'], $_POST['date'])) {
            $message = '<p style="color:green;"><b>Succès:</b> Réservation mise à jour.</p>';
        }
    }
    else {
        $message = '<p style="color:red;"><b>Erreur:</b> Vous devez remplir tous les champs.</p>';
    }

}
?>

<p>Mise à jour d'une réservation</p>
<?= $message; ?>
<form method="post" action="reservations_update.php" name ="reservationUpdateForm">
    <label for="id_reservation">Id :</label>
    <input type="text" name="id_reservation">
    <br />
    <label for="id_announcement">id_announcement :</label>
    <input type="text" name="id_announcement">
    <br />
    <label for="id_user">id_user :</label>
    <input type="text" name="id_user">
    <br />
    <label for="date">Date de la réservation au format dd-mm-yyyy :</label>
    <input type="text" name="date">
    <br />
    <input type="submit" name="update_reservation" value="Modifier une réservation">
</form>
