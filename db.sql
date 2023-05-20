CREATE DATABASE IF NOT EXISTS gymbro;
USE gymbro;
CREATE TABLE IF NOT EXISTS users (
    id int PRIMARY KEY AUTO_INCREMENT,
    username varchar(25) NOT NULL,
    email varchar(50) NOT NULL,
    phone varchar(20) NOT NULL,
    pass varchar(100) NOT NULL,
    createdOn DATETIME NOT NULL DEFAULT NOW()
);

CREATE TABLE IF NOT EXISTS cardio_log (
    userid int NOT NULL,
    typeOfCardio varchar(50) NOT NULL,
    timeSpentMins float NOT NULL,
    cardioDate date NOT NULL,
    createdOn DATETIME NOT NULL DEFAULT NOW(),
    FOREIGN KEY (userid) REFERENCES users(id)
);

CREATE TABLE IF NOT EXISTS lift_log (
    userid int NOT NULL,
    typeOfLift varchar(50) NOT NULL,
    weightAmount float NOT NULL,
    numSets float NOT NULL,
    numReps float NOT NULL,
    liftDate date NOT NULL,
    createdOn DATETIME NOT NULL DEFAULT NOW(),
    FOREIGN KEY (userid) REFERENCES users(id)
);

CREATE TABLE IF NOT EXISTS weight_log (
    userid int NOT NULL,
    weighInLbs float NOT NULL,
    fat float,
    bmi float,
    water float,
    bone float,
    weighInDate date NOT NULL,
    createdOn DATETIME NOT NULL DEFAULT NOW(),
    FOREIGN KEY (userid) REFERENCES users(id)
);