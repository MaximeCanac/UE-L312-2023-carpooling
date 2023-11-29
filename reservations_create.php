<?php

use App\Controllers\ReservationsController;

require __DIR__ . '/vendor/autoload.php';

$controller = new ReservationsController();
$message = NULL;

if(isset($_POST['create_reservation'])) {

    if(!empty($_POST['user_id']) && !empty($_POST['announcement_id']) && !empty($_POST['date'])) {
        if($controller->createReservation($_POST['announcement_id'], $_POST['user_id'], $_POST['date'])) {
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
    <label for="user_id">user_id :</label>
    <input type="text" name="user_id">
    <br />
    <label for="announcement_id">announcement_id :</label>
    <input type="text" name="announcement_id">
    <br />
    <label for="date">Date de la réservation au format dd-mm-yyyy :</label>
    <input type="text" name="date">
    <br />
    <input type="submit" value="Créer une réservation" name="create_reservation">
</form>
