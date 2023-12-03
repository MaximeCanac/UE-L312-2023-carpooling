<?php

namespace App\Services;

use DateTime;
use Exception;
use PDO;

class DataBaseService
{
    const HOST = '127.0.0.1';
    const PORT = '3306';
    const DATABASE_NAME = 'crpooling';
    const MYSQL_USER = 'root';
    const MYSQL_PASSWORD = '';

    private $connection;

    public function __construct()
    {
        try {
            $this->connection = new PDO(
                'mysql:host=' . self::HOST . ';port=' . self::PORT . ';dbname=' . self::DATABASE_NAME,
                self::MYSQL_USER,
                self::MYSQL_PASSWORD
            );
            $this->connection->exec("SET CHARACTER SET utf8");
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }

    /**
     * Create an user.
     */
    public function createUser(string $firstname, string $lastname, string $email, DateTime $birthday): bool
    {
        $isOk = false;

        $data = [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'birthday' => $birthday->format(DateTime::RFC3339),
        ];
        $sql = 'INSERT INTO users (firstname, lastname, email, birthday) VALUES (:firstname, :lastname, :email, :birthday)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Return all users.
     */
    public function getUsers(): array
    {
        $users = [];

        $sql = 'SELECT * FROM users';
        $query = $this->connection->query($sql);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $users = $results;
        }

        return $users;
    }

    /**
     * Update an user.
     */
    public function updateUser(string $id, string $firstname, string $lastname, string $email, DateTime $birthday): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'birthday' => $birthday->format(DateTime::RFC3339),
        ];
        $sql = 'UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email, birthday = :birthday WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Delete an user.
     */
    public function deleteUser(string $id): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
        ];
        $sql = 'DELETE FROM users WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Create an Announcement.
     */
    public function createAnnouncement(int $userId, int $carId, string $destination, DateTime $date, ?string $description, ?float $price): bool
    {
        $isOk = false;

        $data = [
            'user_id' => $userId,
            'car_id' => $carId,
            'destination' => $destination,
            'date' => $date->format(DateTime::RFC3339),
            'description' => $description,
            'price' => $price
        ];

        $sql = 'INSERT INTO announcements (user_id, car_id, destination, date, description, price) VALUES (:user_id, :car_id, :destination, :date, :description, :price)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Return all Announcement.
     */
    public function getAnnouncements(): array
    {
        $announcements = [];

        $sql = 'SELECT * FROM announcements';
        $query = $this->connection->query($sql);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($results)) {
            $announcements = $results;
        }

        return $announcements;
    }


    /**
     * Return the searched Announcement.
     */
    public function getAnnouncement(int $id): array
    {
        $announcements = [];

        $req = 'SELECT * FROM announcements WHERE id=?';
        $query = $this->connection->prepare($req);
        $query->execute(array($id));
        $results = $query->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($results)) {
            $announcements = $results;
        }

        return $announcements;
    }





    /**
     * Update an Announcement.
     */
    public function updateAnnouncement(int $id, int $userId, int $carId, string $destination, DateTime $date, ?string $description, ?float $price): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
            'user_id' => $userId,
            'car_id' => $carId,
            'destination' => $destination,
            'date' => $date->format(DateTime::RFC3339),
            'description' => $description,
            'price' => $price
        ];

        $sql = 'UPDATE announcements SET user_id = :user_id, car_id = :car_id, destination = :destination, date = :date, description = :description, price = :price WHERE id = :id';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Delete an Announcement.
     */
    public function deleteAnnouncement(int $id): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
        ];

        $sql = 'DELETE FROM announcements WHERE id = :id';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Create an car.
     */
    public function createCar(string $brand, string $model, DateTime $year, int $place): bool
    {
        $isOk = false;

        $data = [
            'brand' => $brand,
            'model' => $model,
            'year' => $year->format(DateTime::RFC3339),
            'place' => $place,
        ];
        $sql = 'INSERT INTO cars (brand, model, year, place) VALUES (:brand, :model, :year, :place)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Return all cars.
     */
    public function getCars(): array
    {
        $cars = [];

        $sql = 'SELECT * FROM cars';
        $query = $this->connection->query($sql);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $cars = $results;
        }

        return $cars;
    }

    /**
     * Update an car.
     */
    public function updateCar(int $id, string $brand, string $model, DateTime $year, int $place): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
            'brand' => $brand,
            'model' => $model,
            'year' => $year->format(DateTime::RFC3339),
            'place' => $place,
        ];
        $sql = 'UPDATE cars SET brand = :brand, model = :model, year = :year, place = :place WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Delete car.
     */
    public function deleteCar(int $id): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
        ];
        $sql = 'DELETE FROM cars WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }


    /**
     * Create a Reservation
     * 
     * @param int $id_announcement : Announcement identifier
     * @param int $id_user : User identifier
     * @param DateTime $date : Current date
     * @return bool
     */
    public function createReservation($id_announcement, $id_user, DateTime $date): bool {
        $returnBool = false;

        $data = array(
            'id_announcement' => $id_announcement,
            'id_user' => $id_user,
            ':reservation_date' => $date->format(DateTime::W3C)
        );

        $sql = 'INSERT INTO reservations(id_announcement, id_user, date) VALUES (:id_announcement, :id_user, :reservation_date)';
        $query = $this->connection->prepare($sql);
        $returnBool = $query->execute($data);

        return $returnBool;
    }



    /**
     * Update a Reservation
     * 
     * @param int $id_reservation : Reservation identifier
     * @param int $id_announcement : Announcement identifier
     * @param int $id_user : User identifier
     * @param DateTime $date : Current date
     * @return bool
     */
    public function updateReservation($id_reservation, $id_announcement, $id_user, DateTime $date): bool {
        $returnBool = false;

        $data = array(
            'id_reservation' => $id_reservation,
            'id_announcement' => $id_announcement,
            'id_user' => $id_user,
            'reservation_date' => $date->format(DateTime::W3C)
        );

        $sql = 'UPDATE reservations SET id_reservation = :id_reservation, id_announcement = :id_announcement, id_user = :id_user, date = :reservation_date;';
        $query = $this->connection->prepare($sql);
        $returnBool = $query->execute($data);

        return $returnBool;
    }



    /**
     * Return all Reservations.
     */
    public function getReservations(): array
    {
        $reservations = [];

        $sql = 'SELECT * FROM reservations';
        $query = $this->connection->query($sql);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($results)) {
            $reservations = $results;
        }

        return $reservations;
    }




    /**
     * Delete a Reservation
     * 
     * @param int $id_reservation : Reservation identifier
     * @return bool
     */
    public function deleteReservation(int $id_reservation): bool {
        $returnBool = false;

        $data = array(
            'id_reservation' => $id_reservation,
        );

        $sql = 'DELETE FROM reservations WHERE id_reservation = :id_reservation';
        $query = $this->connection->prepare($sql);
        $returnBool = $query->execute($data);

        return $returnBool;
    }

}
