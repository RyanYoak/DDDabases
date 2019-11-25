CREATE database if not exists DDdatabase;

use DDdatabase;

/* table 1*/
CREATE TABLE if not exists employee (
	employee_id   int,
	first_name     varchar(20) NOT NULL,
	last_name      varchar(20) NOT NULL,
	middle_name    varchar(20),
  ssn              bigint,
  birthday         date,
  gender         	varchar(7),
	email          varchar(20) NOT NULL,
	phone          bigint,
  address        varchar(255) NOT NULL,
	position			 varchar(50),
	wage					 numeric(9, 2),
	hiring_date		 date,
	primary key (employee_ID)
	);



/* table 6 */
CREATE TABLE if not exists supplier (
  supplier_id int,
  name varchar(20) NOT NULL,
  industry  varchar(20),
  phone int NOT NULL,
  email varchar(50) NOT NULL,
  address varchar(50) NOT NULL,
  website varchar(255),
  primary key(supplier_id)
);