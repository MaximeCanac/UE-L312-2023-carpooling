<?php

use App\Controllers\AnnouncementsController;
use App\Services\ReservationsService;

require __DIR__ . '/vendor/autoload.php';

$controller = new AnnouncementsController();
echo $controller->createAnnouncement();

/*$reservationsService = new ReservationsService();
$reservations = $reservationsService->getReservations();*/
?>

<p>Création d'une annonce</p>
<form method="post" action="announcements_create.php" name ="announcementCreateForm">
    <label for="destination">Destination :</label>
    <input type="text" name="destination">
    <br />
    <label for="date">Date du départ au format dd-mm-yyyy :</label>
    <input type="text" name="date">
    <br />
    <label for="description">Description :</label>
    <input type="text" name="description">
    <br />
    <label for="price">Prix :</label>
    <input type="number" name="price">
    <br />
    <!--<label for="reservations">Reservations(s) :</label>
    <?php /*foreach ($reservations as $reservation): */?>
        <?php /*$reservationName = $reservation->getDate() . ' '. $reservation->getAnnouncement() ; */?>
        <input type="checkbox" name="reservations[]" value="<?php /*echo $reservation->getId(); */?>"><?php /*echo $reservationName; */?>
        <br />
    <?php /*endforeach; */?>
    <br />-->
    <input type="submit" value="Créer une annonce">
</form>
