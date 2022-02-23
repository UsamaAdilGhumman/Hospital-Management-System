CREATE TABLE Doctor( 
doctor_id int NOT Null AUTO_INCREMENT,
 doctor_name varchar(20),
 doctor_specialist varchar(20),
 doctor_cost int,
 doctor_mobile varchar(11),
 doctor_gender varchar(1),
 doctor_email varchar(30), 
doctor_password varchar(20),
 doctor_address varchar(30),
 PRIMARY KEY(doctor_id));

CREATE TABLE Patient( 
patient_id int NOT null AUTO_INCREMENT,
 patient_name varchar(20),
 patient_mobile varchar(20),
 patient_gender varchar(1),
 patient_email varchar(30),
 patient_password varchar(20), 
patient_address varchar(30),
 patient_blood_group varchar(3),
 PRIMARY KEY (patient_id));

CREATE TABLE Appointment( 
appointment_id int not null AUTO_INCREMENT,
 appointment_date date,
 appointment_description varchar(40),
 solution varchar(30),
 test varchar(30),
 fee int,
  PRIMARY KEY (appointment_id), 
  appointment_doctor_id int,
  FOREIGN KEY (appointment_doctor_id) REFERENCES doctor(doctor_id),
  appointment_patient_id int,
  FOREIGN KEY (appointment_patient_id) REFERENCES Patient(patient_id));

CREATE TABLE Test(
test_id int not null AUTO_INCREMENT,
test_name varchar(20),
PRIMARY KEY(test_id));

CREATE TABLE Specialist(
specialist_id int not null AUTO_INCREMENT,
specialist_name varchar(30),
PRIMARY KEY(specialist_id));

CREATE TABLE admin(
email varchar(20),
password varchar(20));

INSERT INTO admin VALUES ('admin','admin');

CREATE TABLE bloodGroup(
blood_id int not null AUTO_INCREMENT,
blood_name varchar(30)
PRIMARY KEY(blood_id));

insert into bloodGroup(blood_name) values ('A+'),('A-'),('B+'),('B-'),('AB+'),('AB-'),('O+'),('O-');

CREATE VIEW appointment_view as 
SELECT * from appointment JOIN patient on appointment_patient_id = patient_id JOIN doctor on appointment_doctor_id = doctor_id;

