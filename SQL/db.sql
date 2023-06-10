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

/*CREATE TABLE IF NOT EXISTS tbl_customers (
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
    );*/

CREATE TABLE IF NOT EXISTS tbl_reservations (
                                                Reservation_ID int UNSIGNED NOT NULL AUTO_INCREMENT,
                                                Car_ID int UNSIGNED NOT NULL,
                                                StartDate DATETIME,
                                                EndDate DATETIME,
    PRIMARY KEY(Reservation_ID)
    );

/*CREATE TABLE IF NOT EXISTS tbl_payment (
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
    );*/

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

CREATE TABLE IF NOT EXISTS tbl_users (
                                         User_ID int UNSIGNED NOT NULL AUTO_INCREMENT,
                                         Username varchar(50),
                                         Password varchar(50) NOT NULL,
                                         Name varchar(50),
                                         Surname varchar(50),
                                         Email varchar(50),
                                         Phone varchar(15),
                                         PRIMARY KEY(User_ID)
);

CREATE TABLE IF NOT EXISTS tbl_user_reservation_car (
                                                            Customer_reservation_car_ID int UNSIGNED NOT NULL AUTO_INCREMENT,
                                                            User_ID int UNSIGNED NOT NULL,
                                                            Reservation_ID int UNSIGNED NOT NULL,
                                                            Car_ID int UNSIGNED NOT NULL,
                                                            PRIMARY KEY(Customer_reservation_car_ID),
    FOREIGN KEY(User_ID)
    REFERENCES tbl_users(User_ID)
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

/*LOAD DATA INFILE 'D:/xampp/htdocs/CR/SQL/customers.csv'
    INTO TABLE tbl_customers
    FIELDS TERMINATED BY ','
    IGNORE 1 ROWS;*/

LOAD DATA INFILE 'D:/xampp/htdocs/CR/SQL/reservation.csv'
    INTO TABLE tbl_reservations
    FIELDS TERMINATED BY ','
    IGNORE 1 ROWS;

/*LOAD DATA INFILE 'D:/xampp/htdocs/CR/SQL/payment.csv'
    INTO TABLE tbl_payment
    FIELDS TERMINATED BY ','
    IGNORE 1 ROWS;*/

LOAD DATA INFILE 'D:/xampp/htdocs/CR/SQL/location.csv'
    INTO TABLE tbl_location
    FIELDS TERMINATED BY ','
    IGNORE 1 ROWS;

/*LOAD DATA INFILE 'D:/xampp/htdocs/CR/SQL/maintenance.csv'
    INTO TABLE tbl_maintenance
    FIELDS TERMINATED BY ','
    IGNORE 1 ROWS;*/

/*LOAD DATA INFILE 'D:/xampp/htdocs/CR/SQL/cust_resv_car.csv'
    INTO TABLE tbl_customer_reservation_car
    FIELDS TERMINATED BY ','
    IGNORE 1 ROWS;*/

/*LOAD DATA INFILE 'D:/xampp/htdocs/CR/SQL/car_maintenance.csv'
    INTO TABLE tbl_car_maintenance
    FIELDS TERMINATED BY ','
    IGNORE 1 ROWS;*/

LOAD DATA INFILE 'D:/xampp/htdocs/CR/SQL/car_location.csv'
    INTO TABLE tbl_car_location
    FIELDS TERMINATED BY ','
    IGNORE 1 ROWS;

/*
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

CREATE TABLE IF NOT EXISTS tbl_reservations (
                                                Reservation_ID int UNSIGNED NOT NULL AUTO_INCREMENT,
                                                Car_ID int UNSIGNED NOT NULL,
                                                StartDate DATETIME,
                                                EndDate DATETIME,
    PRIMARY KEY(Reservation_ID)
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

CREATE TABLE IF NOT EXISTS tbl_users (
                                         User_ID int UNSIGNED NOT NULL AUTO_INCREMENT,
                                         Username varchar(50),
                                         Password varchar(50) NOT NULL,
                                         Name varchar(50),
                                         Surname varchar(50),
                                         Email varchar(50),
                                         Phone varchar(15),
                                         PRIMARY KEY(User_ID)
);

CREATE TABLE IF NOT EXISTS tbl_user_reservation_car (
                                                            Customer_reservation_car_ID int UNSIGNED NOT NULL AUTO_INCREMENT,
                                                            User_ID int UNSIGNED NOT NULL,
                                                            Reservation_ID int UNSIGNED NOT NULL,
                                                            Car_ID int UNSIGNED NOT NULL,
                                                            PRIMARY KEY(Customer_reservation_car_ID),
    FOREIGN KEY(User_ID)
    REFERENCES tbl_users(User_ID)
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

INSERT INTO tbl_cars (Car_ID,Make,Model,YearOfManufacture,Color,RegistrationNumber,CurrentMileage,TransmissionType,FuelType,NumberOfSeats,RentalRatePerDay,AirConditioning,AvailabilityStatus,CarIMG) VALUES
(1,"Toyota","Camry",2018,"Red","ABC123",20000,"Automatic","Petrol",5,50.00,1,1,"../Images/t_camry.jpg"),
(2,"Honda","Civic",2019,"Black","DEF456",15000,"Manual","Petrol",5,45.00,1,1,"../Images/h_civic.jpg"),
(3,"Ford","Escape",2020,"White","GHI789",10000,"Automatic","Diesel",5,60.00,0,1,"../Images/f_escape.jpg"),
(4,"Nissan","Altima",2017,"Silver","JKL012",25000,"Automatic","Petrol",5,55.00,0,1,"../Images/n_altima.jpg"),
(5,"Kia","Sorento",2021,"Blue","MNO345",5000,"Automatic","Petrol",7,70.00,1,1,"../Images/k_sorento.jpg"),
(6,"Chevrolet","Cruze",2016,"Gray","PQR678",30000,"Manual","Petrol",5,40.00,0,1,"../Images/c_cruze.jpg"),
(7,"Hyundai","Tucson",2022,"Orange","STU901",2000,"Automatic","Diesel",5,65.00,1,1,"../Images/h_tuscon.jpg"),
(8,"Mazda","CX-5",2019,"Red","VWX234",20000,"Automatic","Petrol",5,55.00,0,1,"../Images/m_cx5.jpg");


INSERT INTO tbl_location (Location_ID,LocationName,LocationAddress,Country,City,PostalCode,PhoneNumber) VALUES
(1,"Downtown Car Rental","123 Main St","USA","New York","10001","555-1234"),
(2,"Airport Car Rental","456 Airport Rd","USA","Los Angeles","90045","555-5678"),
(3,"Beach Car Rental","789 Ocean Blvd","USA","Miami","33139","555-9101"),
(4,"City Car Rental","321 Elm St","USA","Chicago","60601","555-1212"),
(5,"Mountain Car Rental","101 Pine Ave","USA","Denver","80202","555-3434"),
(6,"Suburban Car Rental","555 Maple Ave","USA","Seattle","98101","555-5656"),
(7,"Desert Car Rental","777 Sand St","USA","Phoenix","85004","555-7878"),
(8,"River Car Rental","888 Waterfront Dr","USA","San Francisco","94111","555-9090");

INSERT INTO tbl_car_location (Car_location_ID,Car_ID,Location_ID) VALUES
(1,3,1),
(2,7,3),
(3,5,5),
(4,8,2),
(5,2,4),
(6,1,8),
(7,6,7),
(8,4,6),
(9,3,1),
(10,6,3),
(11,5,5),
(12,8,2),
(13,2,4),
(14,1,8),
(15,6,7),
(16,4,6);
 */