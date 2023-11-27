<?php

use App\Controllers\CarsController;

require __DIR__ . '/vendor/autoload.php';

$controller = new CarsController();
echo $controller->createCar();
?>

<p>Ajout d'une voiture</p>
<form method="post" action="cars_create.php" name ="carCreateForm">
    <label for="brand">Brand :</label>
    <input type="text" name="brand">
    <br />
    <label for="model">Model :</label>
    <input type="text" name="model">
    <br />
    <label for="year">Date de la voiture au format dd-mm-yyyy :</label>
    <input type="text" name="year">
    <br />
    <label for="place">Place :</label>
    <input type="text" name="place">
    <br />
    <input type="submit" value="Ajouter une voiture">
</form>
