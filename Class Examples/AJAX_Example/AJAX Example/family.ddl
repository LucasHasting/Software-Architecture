create database my_db;

use my_db;
create table user (id int primary key auto_increment, 
FirstName varchar(255),
LastName varchar(255),
Age int,
Hometown varchar(255),
Job varchar(255));

insert into user (FirstName, LastName, Age, Hometown, Job) values 
("Peter", "Griffin", 41, "Quahog", "Brewery");
insert into user (FirstName, LastName, Age, Hometown, Job) values 
("Lois", "Griffin", 40, "Newport", "Piano Teacher");
insert into user (FirstName, LastName, Age, Hometown, Job) values 
("Joseph", "Swanson", 39, "Quahog", "Police Officer");
insert into user (FirstName, LastName, Age, Hometown, Job) values 
("Glenn", "Quagmire", 41, "Quahog", "Pilot");
