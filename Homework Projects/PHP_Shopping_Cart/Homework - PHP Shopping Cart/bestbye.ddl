create database bestbye;

use bestbye;

create table items (id int primary key auto_increment, brand varchar(255),
product varchar(255), price decimal(5, 2) );

insert into items (brand, product, price) values ("Ring", "Doorbell", 54.99);
insert into items (brand, product, price) values ("Garmin", "Smartwatch", 169.99);
insert into items (brand, product, price) values ("HP", "Chromebook", 148.00);
insert into items (brand, product, price) values ("LG", "Monitor", 229.89);
insert into items (brand, product, price) values ("iRobot", "Roomba", 399.99);
insert into items (brand, product, price) values ("Samsung", "Galaxy", 149.99);
insert into items (brand, product, price) values ("Nintendo", "Switch", 299.99);
insert into items (brand, product, price) values ("Mircosoft", "XBox", 199.99);
insert into items (brand, product, price) values ("Sony", "Playstation", 99.99);