<?php

namespace App\Services;

use DateTime;
use Exception;
use PDO;

class DataBaseService
{
    const HOST = '127.0.0.1';
    const PORT = '3306';
    const DATABASE_NAME = 'carpooling';
    const MYSQL_USER = 'root';
    const MYSQL_PASSWORD = 'password';

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
    public function createUser(string $firstname, string $lastname, string $email, DateTime $birthday): string
    {
        $userId = '';

        $data = [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'birthday' => $birthday->format(DateTime::RFC3339),
        ];
        $sql = 'INSERT INTO users (firstname, lastname, email, birthday) VALUES (:firstname, :lastname, :email, :birthday)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);
        if ($isOk) {
            $userId = $this->connection->lastInsertId();
        }

        return $userId;
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
    public function createAnnouncement(string $destination, DateTime $date, ?string $description, ?float $price): bool
    {
        $announcementID = '';

        $data = [
            'destination' => $destination,
            'date' => $date->format(DateTime::RFC3339),
            'description' => $description,
            'price' => $price
        ];

        $sql = 'INSERT INTO announcements (destination, date, description, price) VALUES (:destination, :date, :description, :price)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);
        if ($isOk) {
            $announcementID = $this->connection->lastInsertId();
        }

        return $announcementID;

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
    public function updateAnnouncement(int $id, string $destination, DateTime $date, ?string $description, ?float $price): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
            'destination' => $destination,
            'date' => $date->format(DateTime::RFC3339),
            'description' => $description,
            'price' => $price
        ];

        $sql = 'UPDATE announcements SET destination = :destination, date = :date, description = :description, price = :price WHERE id = :id';
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
     * Create relation bewteen an user and his car.
     */
    public function setAnnouncementsReservations(string $announcementId, string $reservationId): bool
    {
        $isOk = false;

        $data = [
            'announcementId' => $announcementId,
            'reservationId' => $reservationId,
        ];
        $sql = 'INSERT INTO users_cars (announcement_id, reservation_id) VALUES (:announcementId, :reservationId)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Get cars of given user id.
     */
    public function getAnnouncementReservations(string $announcementId): array
    {
        $announcementReservations = [];

        $data = [
            'announcementId' => $announcementId,
        ];
        $sql = '
            SELECT a.*
            FROM  announcements as a
            LEFT JOIN announcements_reservations as ar ON ar.reservation_id = a.id
            WHERE ar.announcement_id = :announcementId';
        $query = $this->connection->prepare($sql);
        $query->execute($data);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $announcementReservations = $results;
        }

        return $announcementReservations;
    }

    /**
     * Create an car.
     */
    public function createCar(string $brand, string $model, string $color, int $place): bool
    {
        $isOk = false;

        $data = [
            'brand' => $brand,
            'model' => $model,
            'color' => $color,
            'place' => $place,
        ];
        $sql = 'INSERT INTO cars (brand, model, color, place) VALUES (:brand, :model, :color, :place)';
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
    public function updateCar(int $id, string $brand, string $model, string $color, int $place): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
            'brand' => $brand,
            'model' => $model,
            'color' => $color,
            'place' => $place,
        ];
        $sql = 'UPDATE cars SET brand = :brand, model = :model, color = :color, place = :place WHERE id = :id;';
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
     * Create relation bewteen an user and his car.
     */
    public function setUserCar(string $userId, string $carId): bool
    {
        $isOk = false;

        $data = [
            'userId' => $userId,
            'carId' => $carId,
        ];
        $sql = 'INSERT INTO users_cars (user_id, car_id) VALUES (:userId, :carId)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Get cars of given user id.
     */
    public function getUserCars(string $userId): array
    {
        $userCars = [];

        $data = [
            'userId' => $userId,
        ];
        $sql = '
            SELECT c.*
            FROM cars as c
            LEFT JOIN users_cars as uc ON uc.car_id = c.id
            WHERE uc.user_id = :userId';
        $query = $this->connection->prepare($sql);
        $query->execute($data);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $userCars = $results;
        }

        return $userCars;
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
