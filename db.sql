DROP DATABASE IF EXISTS db;
CREATE DATABASE db;
USE db;

CREATE TABLE customer(
email_customer VARCHAR(30) PRIMARY KEY NOT NULL,
name_customer VARCHAR(45) NOT NULL,
surname_customer VARCHAR(45) NOT NULL,
password VARCHAR(45) NULL DEFAULT NULL,
phone_customer INT(11) NULL DEFAULT NULL
);

CREATE TABLE staff(
id_staff INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
name_staff VARCHAR(45) NULL DEFAULT NULL,
surname_staff VARCHAR(45) NULL DEFAULT NULL,
phone_staff INT(11) NULL DEFAULT NULL
);

CREATE TABLE vehicle(
license_vehicle VARCHAR (15) PRIMARY KEY NOT NULL,
email_customer VARCHAR(30) NOT NULL,
type_vehicle VARCHAR(45) NOT NULL,
make_vehicle VARCHAR(45) NOT NULL,
engine_type_vehicle VARCHAR(45) NOT NULL,
FOREIGN KEY (email_customer) REFERENCES customer(email_customer) ON DELETE CASCADE)
;

CREATE TABLE booking (
id_booking INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
id_staff INT NOT NULL,
email_customer VARCHAR(30) NOT NULL,
service_type_booking VARCHAR(45) NULL DEFAULT NULL,
comment_booking VARCHAR(150) NULL DEFAULT NULL,
date_booking DATE NULL DEFAULT NULL,
license_vehicle VARCHAR(15) NULL DEFAULT NULL,
status VARCHAR(45) NULL DEFAULT NULL,
INDEX fk_booking_email_customer_idx (email_customer ASC) ,
INDEX fk_booking_staff_idx (id_staff ASC) ,
INDEX fk_booking_license_vehicle_idx (license_vehicle ASC) ,
CONSTRAINT fk_Booking_email_customer FOREIGN KEY (email_customer) REFERENCES customer(email_customer) ON DELETE NO ACTION ON UPDATE NO ACTION,
CONSTRAINT fk_booking_staff FOREIGN KEY (id_staff) REFERENCES staff(id_staff) ON DELETE NO ACTION ON UPDATE NO ACTION,
CONSTRAINT fk_booking_license_vehicle FOREIGN KEY (license_vehicle) REFERENCES vehicle(license_vehicle) ON DELETE NO ACTION ON UPDATE NO ACTION);

CREATE TABLE invoice (
id_invoice INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
id_booking INT NOT NULL,
total_price_invoice DOUBLE NULL,
date_invoice DATE NOT NULL,
license_vehicle VARCHAR(15) NOT NULL,
email_customer VARCHAR(30) NOT NULL,
INDEX fk_booking_email_customer_idx (email_customer ASC) ,
INDEX fk_booking_license_vehicle_idx (license_vehicle ASC) ,
INDEX fk_invoice_booking_idx (id_booking ASC) ,
CONSTRAINT fk_invoice_email_customer FOREIGN KEY (email_customer) REFERENCES customer(email_customer) ON DELETE NO ACTION ON UPDATE NO ACTION,
CONSTRAINT fk_invoice_booking FOREIGN KEY (id_booking) REFERENCES booking(id_booking) ON DELETE NO ACTION ON UPDATE NO ACTION,
CONSTRAINT fk_invoice_license_vehicle FOREIGN KEY (license_vehicle) REFERENCES vehicle(license_vehicle) ON DELETE NO ACTION ON UPDATE NO ACTION);

CREATE TABLE service (
id_service INT PRIMARY KEY NOT NULL,
name_service VARCHAR(45) NULL DEFAULT NULL,
price_service DOUBLE NULL DEFAULT NULL,
id_invoice INT NOT NULL,
INDEX fk_services_invoice_idx (id_invoice ASC) ,
CONSTRAINT fk_services_invoice FOREIGN KEY (id_invoice) REFERENCES invoice(id_invoice) ON DELETE NO ACTION ON UPDATE NO ACTION);

CREATE TABLE admin (
id_admin INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
email_admin VARCHAR(30) NOT NULL,
name_admin VARCHAR(45) NULL DEFAULT NULL,
surname_admin VARCHAR(45) NULL DEFAULT NULL,
password_admin VARCHAR(45) NULL DEFAULT NULL);

CREATE TABLE service_cost (
id_service INT PRIMARY KEY NOT NULL,
name_service VARCHAR(45) NOT NULL,
cost_service DOUBLE NOT NULL);