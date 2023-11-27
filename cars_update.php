<?php

use App\Controllers\CarsController;

require __DIR__ . '/vendor/autoload.php';

$controller = new CarsController();
echo $controller->updateCar();
?>

<p>Mise à jour d'une voiture</p>
<form method="post" action="cars_update.php" name ="carUpdateForm">
    <label for="id">Id :</label>
    <input type="text" name="id">
    <br />
    <label for="brand">brand :</label>
    <input type="text" name="brand">
    <br />
    <label for="model">model :</label>
    <input type="text" name="model">
    <br />
    <label for="year">Date de la voiture au format dd-mm-yyyy :</label>
    <input type="text" name="year">
    <br />
    <label for="place">place :</label>
    <input type="text" name="place">
    <br />
    <input type="submit" value="Modifier une voiture">
</form>
