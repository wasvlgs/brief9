ALTER TABLE `client` ADD `password` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `email`;


ALTER TABLE `client` ADD `role` INT(11) NOT NULL AFTER `password`;

ALTER TABLE `client` ADD `status` ENUM('active','banned','archived') NOT NULL AFTER `role`;

ALTER TABLE `activite` ADD `type` ENUM('flight','hotel','circuit') NOT NULL AFTER `places_disponibles`;

ALTER TABLE `reservation` ADD `totalPrice` DECIMAL(10,2) NOT NULL AFTER `statut`;

ALTER TABLE `reservation` ADD `customization` JSON NOT NULL AFTER `totalPrice`;

INSERT INTO client (nom, prenom, email, password, role, status) VALUES ('yazza', 'wassim', 'wassim@gmail.com', '$2y$10$C8c/tLqSZz4ZfEWJMdg4QueD/RfKeZU1ahBpBvTSxlLbdPsJN/zGG', 'sAdmin', 'active');


INSERT INTO client (nom, prenom, email, password, role, status) VALUES ('marzouk', 'yacine', 'yacine@gmail.com', '$2y$10$C8c/tLqSZz4ZfEWJMdg4QueD/RfKeZU1ahBpBvTSxlLbdPsJN/zGG', 'admin', 'active');


INSERT INTO client (nom, prenom, email, password, role, status) VALUES ('mahrouch', 'walid', 'walid@gmail.com', '$2y$10$C8c/tLqSZz4ZfEWJMdg4QueD/RfKeZU1ahBpBvTSxlLbdPsJN/zGG', 'client', 'active');