<?php

use App\Controllers\ReservationsController;

require __DIR__ . '/vendor/autoload.php';

$controller = new ReservationsController();
$message = NULL;

if(isset($_POST['create_reservation'])) {

    if(!empty($_POST['date'])) {
        if($controller->createReservation($_POST['date'])) {
            $message = '<p style="color:green;"><b>Succès:</b> Réservation crée.</p>';
        }
    }
    else {
        $message = '<p style="color:red;"><b>Erreur:</b> Vous devez remplir tous les champs.</p>';
    }

}
?>

<p>Création d'une annonce</p>
<?= $message ?>
<form method="post" action="reservations_create.php" name ="reservationCreateForm">
    <label for="date">Date de la réservation au format dd-mm-yyyy :</label>
    <input type="text" name="date">
    <br />
    <input type="submit" value="Créer une réservation" name="create_reservation">
</form>
