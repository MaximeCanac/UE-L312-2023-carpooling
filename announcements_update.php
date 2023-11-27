<?php

use App\Controllers\AnnouncementsController;

require __DIR__ . '/vendor/autoload.php';

$controller = new AnnouncementsController();
echo $controller->updateAnnouncement();
?>

<p>Mise à jour d'une annonce</p>
<form method="post" action="announcements_update.php" name ="announcementUpdateForm">
    <label for="id">Id :</label>
    <input type="text" name="id">
    <br />
    <label for="user_id">user_id :</label>
    <input type="text" name="user_id">
    <br />
    <label for="car_id">car_id :</label>
    <input type="text" name="car_id">
    <br />
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
    <input type="text" name="price">
    <br />
    <input type="submit" value="Modifier une annonce">
</form>
