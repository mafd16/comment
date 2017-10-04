--
-- Creating a User table.
--



--
-- Table User
--
DROP TABLE IF EXISTS User;
CREATE TABLE User (
    "id" INTEGER PRIMARY KEY NOT NULL,
    "acronym" TEXT UNIQUE NOT NULL,
    "password" TEXT,
    "email" TEXT,
    "created" TIMESTAMP,
    "updated" DATETIME,
    "deleted" DATETIME,
    "active" DATETIME,
    "admin" INTEGER
);



-- Create admin user and doe user
-- INSERT INTO User (acronym, password, email, created, admin)
-- VALUES ("admin", "admin", "matt@mullenweg.com", "2017-09-23 15:10:02", "1");

-- INSERT INTO User (acronym, password, email, created, admin)
-- VALUES ("doe", "doe", "doe@google.com", "2017-09-23 15:12:05", "0");
