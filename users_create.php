<?php

use App\Controllers\UsersController;
use App\Services\CarsService;
use App\Services\AnnouncementsService;

require __DIR__ . '/vendor/autoload.php';

$controller = new UsersController();
echo $controller->createUser();

$carsService = new CarsService();
$cars = $carsService->getCars();

$announcementsService = new AnnouncementsService();
$announcements = $announcementsService->getAnnouncements();
?>

<p>Création d'un utilisateur</p>
<form method="post" action="users_create.php" name ="userCreateForm">
    <label for="firstname">Prénom :</label>
    <input type="text" name="firstname">
    <br />
    <label for="lastname">Nom :</label>
    <input type="text" name="lastname">
    <br />
    <label for="email">Email :</label>
    <input type="text" name="email">
    <br />
    <label for="birthday">Date d'anniversaire au format dd-mm-yyyy :</label>
    <input type="text" name="birthday">
    <br />
    <label for="cars">Voiture(s) :</label>
    <?php foreach ($cars as $car): ?>
        <?php $carName = $car->getBrand() . ' ' . $car->getModel() . ' ' . $car->getColor(); ?>
        <input type="checkbox" name="cars[]" value="<?php echo $car->getId(); ?>"><?php echo $carName; ?>
        <br />
    <?php endforeach; ?>
    <br />
    <label for="announcements">Annonce(s) :</label>
    <?php foreach ($announcements as $announcement): ?>
        <?php $announcementName = $announcement->getDestination() . ' ' . $announcement->getDate()->format(DateTime::RFC3339) . ' ' . $announcement->getDescription(). ' ' . $announcement->getPrice(); ?>
        <input type="checkbox" name="announcements[]" value="<?php echo $announcement->getId(); ?>"><?php echo $announcementName; ?>
        <br />
    <?php endforeach; ?>
    <br />
    <input type="submit" value="Créer un utilisateur">
</form>
