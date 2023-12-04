<?php

use App\Controllers\AnnouncementsController;

require __DIR__ . '/vendor/autoload.php';

$controller = new AnnouncementsController();
echo $controller->createAnnouncement();
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
    <input type="float" name="price">
    <br />
    <input type="submit" value="Créer une annonce">
</form>
