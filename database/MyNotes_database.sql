DROP DATABASE IF EXISTS MyNotes;

CREATE DATABASE MyNotes CHARACTER SET utf8 COLLATE utf8_general_ci;

use MyNotes;

CREATE TABLE colors (
  id int(20) NOT NULL AUTO_INCREMENT,
  color varchar(50) NOT NULL,
  bootstrap varchar(30) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE notes (
  id int(50) NOT NULL AUTO_INCREMENT,
  title varchar(50) DEFAULT NULL,
  description varchar(500) NOT NULL,
  color int(20),
  PRIMARY KEY (id),
  FOREIGN KEY (color) REFERENCES colors(id)
);
