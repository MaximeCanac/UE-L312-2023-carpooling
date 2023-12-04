CREATE TABLE `users`
(
    `id`        int AUTO_INCREMENT NOT NULL,
    `firstname` varchar(255) NOT NULL,
    `lastname`  varchar(255) NOT NULL,
    `email`     varchar(255) NOT NULL,
    `birthday`  datetime     NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `birthday`)
VALUES (1, 'Vincent', 'Godé', 'hello@vincentgo.fr', '1990-11-08'),
       (2, 'Albert', 'Dupond', 'sonemail@gmail.com', '1985-11-08'),
       (3, 'Thomas', 'Dumoulin', 'sonemail2@gmail.com', '1985-10-08');


CREATE TABLE `announcements`
(
    `id`          int          NOT NULL,
    `destination` varchar(255) NOT NULL,
    `date`        datetime     NOT NULL,
    `description` varchar(255) DEFAULT NULL,
    `price`       float        DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `announcements` (`id`, `destination`, `date`, `description`, `price`)
VALUES (1, 'albi', '2023-01-01 00:00:00', 'test', 1);

CREATE TABLE `announcements_cars`
(
    `id`              int NOT NULL,
    `announcement_id` int NOT NULL,
    `car_id`          int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

CREATE TABLE `announcements_reservations`
(
    `id`              int NOT NULL,
    `announcement_id` int NOT NULL,
    `reservation_id`  int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

CREATE TABLE `cars`
(
    `id`    int          NOT NULL,
    `brand` varchar(255) NOT NULL,
    `model` varchar(255) NOT NULL,
    `color` varchar(255) NOT NULL,
    `place` int          NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

CREATE TABLE `reservations`
(
    `id`           int      NOT NULL,
    `date`         datetime NOT NULL,
    `announcement` int      NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

CREATE TABLE `users_announcements`
(
    `id`              int NOT NULL,
    `user_id`         int NOT NULL,
    `announcement_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

CREATE TABLE `users_cars`
(
    `id`      int NOT NULL,
    `user_id` int NOT NULL,
    `car_id`  int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
