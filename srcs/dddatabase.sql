CREATE database if not exists dddatabase;

use dddatabase;
/*==================== logs - employee - payroll =================== */
/* table 1*/
CREATE TABLE if not exists employee (
	employee_id     int AUTO_INCREMENT,
	first_name      varchar(20) NOT NULL,
	last_name       varchar(20) NOT NULL,
	middle_name     varchar(20),
  ssn             bigint,
  birthday        date NOT NULL,
  gender         	varchar(7),
	email           varchar(100) NOT NULL,
	phone           int NOT NULL,
  address         varchar(255) NOT NULL,
	position		    varchar(50),
	wage			      numeric(9, 2),
	hiring_date		  date,
	CONSTRAINT uni_social UNIQUE (ssn),
	primary key (employee_id)
);

/* table 2 */
CREATE TABLE if NOT EXISTS payroll (
	employee_id     int,
	pay_date        date,
	paycheck_amount	numeric(9,2) NOT NULL,
	foreign key (employee_id) references employee(employee_id),
	CONSTRAINT uni_payroll UNIQUE (employee_id, pay_date)
);

/* table 3 */
CREATE TABLE IF NOT EXISTS logs(
  employee_id     int,
  log_date        date,
  login_time      time,
  logout_time     time,
  foreign key(employee_id) references employee(employee_id),
  CONSTRAINT uni_login UNIQUE (employee_id, log_date, login_time),
  CONSTRAINT uni_logout UNIQUE (employee_id, log_date, logout_time),
  CONSTRAINT uni_log UNIQUE (employee_id, log_date, login_time, logout_time)
);

/* ======================== Customer - Orders - Items - Supplies - Supplier ======================== */

/* table 4 */
CREATE TABLE IF NOT EXISTS customer (
	customer_id 	int AUTO_INCREMENT,
	first_name		varchar(20) NOT NULL,
	last_name			varchar(20) NOT NULL,
	middle_name		varchar(20),
	email					varchar(100) NOT NULL,
	phone       	bigint NOT NULL,
  address 			varchar(255),
  primary key(customer_id)
  );

/* table 5 */
CREATE TABLE if not exists supplier (
  supplier_id   int ,
  name          varchar(20) NOT NULL,
  industry      varchar(20),
  phone         bigint NOT NULL,
  email         varchar(100) NOT NULL,
  address       varchar(50) NOT NULL,
  website       varchar(255),
  primary key(supplier_id)
);

/* table 6 */
CREATE TABLE if not exists items(
  product_id    int,
  category      varchar(50),
  unit_price    numeric(9,2) not null,
  quantity      int,
  description   varchar(255),
  primary key(product_id)
);

/* table 7 */
CREATE TABLE IF NOT EXISTS supplies (
  product_id    int,
  supplier_id   int,
  PRIMARY KEY (product_id, supplier_id),
  FOREIGN KEY (product_id) REFERENCES items(product_id),
  FOREIGN KEY (supplier_id) REFERENCES supplier(supplier_id)
);

/* table 9 */
CREATE TABLE if not exists orders(
  customer_id   int,
  product_id    int,
  timestamp     datetime,
  quantity      int,
  primary key (customer_id, product_id, timestamp),
	foreign key (customer_id) references customer(customer_id),
	foreign key (product_id) references items(product_id)
);
