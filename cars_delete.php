<?php

use App\Controllers\AnnouncementsController;

require __DIR__ . '/vendor/autoload.php';

$controller = new AnnouncementsController();
echo $controller->deleteAnnouncement();
?>

<p>Supression d'une annonce</p>
<form method="post" action="announcements_delete.php" name ="announcementsDeleteForm">
    <label for="id">Id :</label>
    <input type="text" name="id">
    <br />
    <input type="submit" value="Supprimer une annonce">
</form>
