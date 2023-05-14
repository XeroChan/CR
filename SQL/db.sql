DROP DATABASE if exists db_car_rental;
CREATE DATABASE if not exists db_car_rental;
USE db_car_rental;

CREATE TABLE IF NOT EXISTS tbl_cars (
                                        Car_ID int UNSIGNED NOT NULL AUTO_INCREMENT,
                                        Make varchar(15),
    Model varchar(15),
    YearOfManufacture year,
    Color varchar(15),
    RegistrationNumber varchar(10),
    CurrentMileage int,
    TransmissionType varchar(10),
    FuelType varchar(10),
    NumberOfSeats int,
    RentalRatePerDay DECIMAL(4,2),
    AirConditioning BOOLEAN, -- bool
    AvailabilityStatus BOOLEAN, # bool
    CarIMG varchar(500),
    PRIMARY KEY(Car_ID)
    );

CREATE TABLE IF NOT EXISTS tbl_customers (
                                             Customer_ID int UNSIGNED NOT NULL AUTO_INCREMENT,
                                             FirstName varchar(30),
    LastName varchar(30),
    EmailAddress varchar(50),
    PhoneNumber varchar(20),
    DriversLicenseNumber varchar(40),
    Country varchar(20),
    City varchar(20),
    PostalCode varchar(10),
    ResidentialAddress varchar(50),
    PRIMARY KEY(Customer_ID)
    );

CREATE TABLE IF NOT EXISTS tbl_reservations (
                                                Reservation_ID int UNSIGNED NOT NULL AUTO_INCREMENT,
                                                Car_ID int UNSIGNED NOT NULL,
                                                StartDate DATETIME,
                                                EndDate DATETIME,
                                                RentalCost DECIMAL(6,2),
    RentalStatus BOOLEAN, -- bool
    PRIMARY KEY(Reservation_ID)
    );

CREATE TABLE IF NOT EXISTS tbl_payment (
                                           Payment_ID int UNSIGNED NOT NULL AUTO_INCREMENT,
                                           Reservation_ID int UNSIGNED NOT NULL,
                                           PaymentDate DATETIME,
                                           Amount int,
                                           Method varchar(20),
    PRIMARY KEY(Payment_ID),
    FOREIGN KEY(Reservation_ID)
    REFERENCES tbl_reservations(Reservation_ID)
    ON DELETE CASCADE
    ON UPDATE CASCADE
    );

CREATE TABLE IF NOT EXISTS tbl_location (
                                            Location_ID int UNSIGNED NOT NULL AUTO_INCREMENT,
                                            LocationName varchar(40),
    LocationAddress varchar(40),
    Country varchar(20),
    City varchar(20),
    PostalCode varchar(10),
    PhoneNumber varchar(20),
    PRIMARY KEY(Location_ID)
    );

CREATE TABLE IF NOT EXISTS tbl_maintenance (
                                               Maintenance_ID int UNSIGNED NOT NULL AUTO_INCREMENT,
                                               Car_ID int UNSIGNED NOT NULL,
                                               MaintenanceDate DATETIME,
                                               MaintenanceType DECIMAL(4,2),
    MaintenanceCost int,
    Description varchar(100),
    PRIMARY KEY(Maintenance_ID)
    );

CREATE TABLE IF NOT EXISTS tbl_customer_reservation_car (
                                                            Customer_reservation_car_ID int UNSIGNED NOT NULL AUTO_INCREMENT,
                                                            Customer_ID int UNSIGNED NOT NULL,
                                                            Reservation_ID int UNSIGNED NOT NULL,
                                                            Car_ID int UNSIGNED NOT NULL,
                                                            PRIMARY KEY(Customer_reservation_car_ID),
    FOREIGN KEY(Customer_ID)
    REFERENCES tbl_customers(Customer_ID)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
    FOREIGN KEY(Reservation_ID)
    REFERENCES tbl_reservations(Reservation_ID)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
    FOREIGN KEY(Car_ID)
    REFERENCES tbl_cars(Car_ID)
    ON DELETE CASCADE
    ON UPDATE CASCADE
    );

CREATE TABLE IF NOT EXISTS tbl_car_maintenance (
                                                   Car_maintenance_ID int UNSIGNED NOT NULL AUTO_INCREMENT,
                                                   Car_ID int UNSIGNED NOT NULL,
                                                   Maintenance_ID int UNSIGNED NOT NULL,
                                                   PRIMARY KEY(Car_maintenance_ID),
    FOREIGN KEY(Car_ID)
    REFERENCES tbl_cars(Car_ID)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
    FOREIGN KEY(Maintenance_ID)
    REFERENCES tbl_maintenance(Maintenance_ID)
    ON DELETE CASCADE
    ON UPDATE CASCADE
    );

CREATE TABLE IF NOT EXISTS tbl_car_location (
                                                Car_location_ID int UNSIGNED NOT NULL AUTO_INCREMENT,
                                                Car_ID int UNSIGNED NOT NULL,
                                                Location_ID int UNSIGNED NOT NULL,
                                                PRIMARY KEY(Car_location_ID),
    FOREIGN KEY(Car_ID)
    REFERENCES tbl_cars(Car_ID)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
    FOREIGN KEY(Location_ID)
    REFERENCES tbl_location(Location_ID)
    ON DELETE CASCADE
    ON UPDATE CASCADE
    );

CREATE TABLE IF NOT EXISTS tbl_review (
                                          Review_ID int UNSIGNED NOT NULL AUTO_INCREMENT,
                                          Review varchar(100) NOT NULL,
    PRIMARY KEY(Review_ID)
    );

CREATE TABLE IF NOT EXISTS tbl_users (
                                                    User_ID int UNSIGNED NOT NULL AUTO_INCREMENT,
                                                    Username varchar(50),
                                                    Password varchar(50) NOT NULL,
                                                    PRIMARY KEY(User_ID)
    );

CREATE TABLE IF NOT EXISTS tbl_users_reviews (
                                         User_review_ID int UNSIGNED NOT NULL AUTO_INCREMENT,
                                         User_ID int unsigned NOT NULL,
                                         Review_ID int unsigned NOT NULL,
                                         PRIMARY KEY(User_review_ID),
                                         FOREIGN KEY(User_ID)
                                             REFERENCES tbl_users(User_ID)
                                             ON DELETE CASCADE
                                             ON UPDATE CASCADE,
                                         FOREIGN KEY(Review_ID)
                                             REFERENCES tbl_review(Review_ID)
                                             ON DELETE CASCADE
                                             ON UPDATE CASCADE
);

LOAD DATA INFILE 'D:/xampp/htdocs/CR/SQL/cars.csv'
    INTO TABLE tbl_cars
    FIELDS TERMINATED BY ','
    IGNORE 1 ROWS;

LOAD DATA INFILE 'D:/xampp/htdocs/CR/SQL/customers.csv'
    INTO TABLE tbl_customers
    FIELDS TERMINATED BY ','
    IGNORE 1 ROWS;

LOAD DATA INFILE 'D:/xampp/htdocs/CR/SQL/reservation.csv'
    INTO TABLE tbl_reservations
    FIELDS TERMINATED BY ','
    IGNORE 1 ROWS;

LOAD DATA INFILE 'D:/xampp/htdocs/CR/SQL/payment.csv'
    INTO TABLE tbl_payment
    FIELDS TERMINATED BY ','
    IGNORE 1 ROWS;

LOAD DATA INFILE 'D:/xampp/htdocs/CR/SQL/location.csv'
    INTO TABLE tbl_location
    FIELDS TERMINATED BY ','
    IGNORE 1 ROWS;

LOAD DATA INFILE 'D:/xampp/htdocs/CR/SQL/maintenance.csv'
    INTO TABLE tbl_maintenance
    FIELDS TERMINATED BY ','
    IGNORE 1 ROWS;

LOAD DATA INFILE 'D:/xampp/htdocs/CR/SQL/cust_resv_car.csv'
    INTO TABLE tbl_customer_reservation_car
    FIELDS TERMINATED BY ','
    IGNORE 1 ROWS;

LOAD DATA INFILE 'D:/xampp/htdocs/CR/SQL/car_maintenance.csv'
    INTO TABLE tbl_car_maintenance
    FIELDS TERMINATED BY ','
    IGNORE 1 ROWS;

LOAD DATA INFILE 'D:/xampp/htdocs/CR/SQL/car_location.csv'
    INTO TABLE tbl_car_location
    FIELDS TERMINATED BY ','
    IGNORE 1 ROWS;