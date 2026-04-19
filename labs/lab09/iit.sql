CREATE DATABASE IF NOT EXISTS `iit`;
USE `iit`;

CREATE TABLE `actors` (
  `actorid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `last_name` varchar(100) NOT NULL,
  `first_names` varchar(100) NOT NULL,
  `dob` date DEFAULT NULL,
  PRIMARY KEY (`actorid`)
);

CREATE TABLE `movies` (
  `movieid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `year` char(4) DEFAULT NULL,
  PRIMARY KEY (`movieid`)
);

CREATE TABLE `actors_movies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `actorid` int(10) unsigned NOT NULL,
  `movieid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `actorid` (`actorid`),
  KEY `movieid` (`movieid`)
);

INSERT INTO `actors`
VALUES (1, 'Holland', 'Tom', '1969-05-14'),
(2, 'Coleman', 'Zendaya', '1963-12-18'),
(3, 'Robbie', 'Margot', '1984-11-22'),
(4, 'Pitt', 'Brad', '1961-05-06'),
(5, 'Smith', 'Will', '1957-06-23'),
(6, 'Cruise', 'Tom', '1949-12-04'),
(7, 'Pratt', 'Chris', '1949-06-22'),
(8, 'Denzel', 'Washington', '1954-12-28'),
(9, 'Jackson', 'Samuel L.', '1948-12-21'),
(10, 'Dicaprio', 'Leonardo', '1974-11-11'),
(11, 'Gadot', 'Gal', '1959-04-30'),
(12, 'Elba', 'Idris', '1972-09-06');

INSERT INTO `movies`
VALUES (1, 'Elizabeth', '1998'),
(2, 'Black Widow', '2021'),
(3, 'Oh Brother Where Art Thou?', '2000'),
(4, 'The Lord of the Rings: The Fellowship of the Ring', '2001'),
(5, 'Up in the Air', '2009'),
(6, 'The Aviator', '2004'),
(7, 'Fargo', '1996'),
(8, 'Pulp Fiction', '1994'),
(9, 'Inception', '2010'),
(10, 'SpiderMan: No Way Home', '2021');

INSERT INTO `actors_movies` (`actorid`, `movieid`) VALUES
(1, 10),
(1, 4),
(1, 6),
(2, 10),
(3, 2),
(4, 5),
(4, 3),
(5, 7),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(9, 6),
(10, 4),
(11, 2),
(12, 5);