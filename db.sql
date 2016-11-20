# Delete database
DROP DATABASE leidosdb;

# Create database called 'LeidosDB'
CREATE DATABASE leidosdb;

# Use the database LeidosDB
USE leidosdb;

START TRANSACTION;

# Create user_group table
CREATE TABLE user_group (
  id integer(3) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  name varchar(20) NOT NULL,
  description varchar(100) NOT NULL
) ENGINE=InnoDB;

#
# Dumping data for table user_group
#
INSERT INTO user_group (`id`, `name`, `description`) VALUES
     (1,'admin','HR Admin'),
     (2,'manager','Project Manager'),
     (3,'employee','Employee'),
     (4,'contractor','Contractor');

# Create account table
CREATE TABLE account (
  id integer(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  email varchar(100) NOT NULL,
  ipAddress varchar(45) NOT NULL,
  password varchar(255) NOT NULL,
  salt varchar(255) DEFAULT NULL,
  forgotten_password_code varchar(40) DEFAULT NULL,
  forgotten_password_time integer(11) unsigned DEFAULT NULL,
  remember_code varchar(40) DEFAULT NULL,
  createdAt datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updatedAt datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  last_login datetime DEFAULT NULL,
  active tinyint(1) unsigned DEFAULT NULL,
  firstName varchar(50) NOT NULL,
  lastName varchar(50) NOT NULL
) ENGINE=InnoDB;

#
# Dumping data for table 'account'
#
INSERT INTO account (`email`, `ipAddress`, `password`, `salt`, `forgotten_password_code`, `last_login`, `active`, `firstName`, `lastName`) VALUES
     ('admin@admin.com','127.0.0.1','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36','',NULL,'1268889823','1','Admin','istrator');


# Create account_group table
CREATE TABLE account_group (
  id integer(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  user_id integer(11) NOT NULL,
  group_id integer(3) NOT NULL,
  CONSTRAINT uc_account_group UNIQUE (user_id, group_id),
  FOREIGN KEY (user_id) REFERENCES account(id) ON DELETE CASCADE ON UPDATE NO ACTION,
  FOREIGN KEY (group_id) REFERENCES user_group(id) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB;

INSERT INTO account_group (`user_id`, `group_id`) VALUES
     ('1',1),
     ('1',2);


# Create skill table
CREATE TABLE skill (
	skillID integer(8) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name varchar(255) NOT NULL,
	quantifiable tinyint(1) NOT NULL
) ENGINE=InnoDB;

# Create location table
CREATE TABLE location (
	locationID integer(8) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name varchar(255) NOT NULL
) ENGINE=InnoDB;

# Create staff table
CREATE TABLE staff (
	staffID integer(11) NOT NULL PRIMARY KEY,
	currentLocation integer(8) NOT NULL,
	payRate decimal NOT NULL,
	FOREIGN KEY (staffID) REFERENCES account(id) ON DELETE CASCADE,
	FOREIGN KEY (currentLocation) REFERENCES location(locationID) ON DELETE RESTRICT
) ENGINE=InnoDB;

# Create availability table
CREATE TABLE availability (
	staffID integer(11) NOT NULL,
	day date NOT NULL,
	type enum('holiday', 'work', 'training', 'sick', 'other') NOT NULL,
	PRIMARY KEY (staffID, day),
	FOREIGN KEY (staffID) REFERENCES staff(staffID) ON DELETE CASCADE
) ENGINE=InnoDB;

# Create staff_skill table
CREATE TABLE staff_skill (
	staffID integer(11) NOT NULL,
	skillID integer(8) NOT NULL,
	skillLevel enum('normal', 'basic', 'intermediate', 'advanced') NOT NULL,
	PRIMARY KEY (staffID, skillID),
	FOREIGN KEY (staffID) REFERENCES staff(staffID) ON DELETE CASCADE,
	FOREIGN KEY (skillID) REFERENCES skill(skillID) ON DELETE CASCADE
) ENGINE=InnoDB;

# Create preferred_location table
CREATE TABLE preferred_location (
	staffID integer NOT NULL,
	location integer NOT NULL,
	PRIMARY KEY (staffID, location),
	FOREIGN KEY (staffID) REFERENCES staff(staffID) ON DELETE CASCADE,
	FOREIGN KEY (location) REFERENCES location(locationID)
) ENGINE=InnoDB;

# Create project table
CREATE TABLE project (
	projectID integer NOT NULL PRIMARY KEY AUTO_INCREMENT,
	managerID integer NOT NULL,
	title varchar(100) NOT NULL,
	description varchar(255) NOT NULL,
	priority enum('normal', 'high') NOT NULL,
	location integer NOT NULL,
	budget decimal NOT NULL,
	startDate date NOT NULL,
	endDate date NOT NULL,
	FOREIGN KEY (managerID) REFERENCES staff(staffID) ON DELETE CASCADE,
	FOREIGN KEY (location) REFERENCES location(locationID)
) ENGINE=InnoDB;

# Create experience table
CREATE TABLE experience (
	experienceID integer NOT NULL PRIMARY KEY AUTO_INCREMENT,
	staffID integer NOT NULL,
	startDate date NOT NULL,
	endDate date NOT NULL,
	projectID integer,
	title varchar(100) NOT NULL,
	description varchar(255),
	role varchar(100) NOT NULL,
	FOREIGN KEY (staffID) REFERENCES staff(staffID) ON DELETE CASCADE,
	FOREIGN KEY (projectID) REFERENCES project(projectID) ON DELETE SET NULL
) ENGINE=InnoDB;

# Create activity table
CREATE TABLE activity (
	activityID integer NOT NULL PRIMARY KEY AUTO_INCREMENT,
	staffID integer NOT NULL,
	description varchar(255) NOT NULL,
	atDate datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (staffID) REFERENCES staff(staffID) ON DELETE CASCADE
) ENGINE=InnoDB;

# Create project_log table
CREATE TABLE project_log (
	noteID integer NOT NULL PRIMARY KEY AUTO_INCREMENT,
	projectID integer NOT NULL,
	description varchar(255) NOT NULL,
	atDate datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (projectID) REFERENCES project(projectID) ON DELETE CASCADE
) ENGINE=InnoDB;

# Create project_dashboard table
CREATE TABLE project_dashboard (
	entryID integer NOT NULL PRIMARY KEY AUTO_INCREMENT,
	projectID integer NOT NULL,
	description varchar(255) NOT NULL,
	atDate datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (projectID) REFERENCES project(projectID) ON DELETE CASCADE
) ENGINE=InnoDB;

# Create project_resources table
CREATE TABLE project_staff (
	projectID integer NOT NULL,
	staffID integer NOT NULL,
	role varchar(50) NOT NULL,
	assignedAt datetime NOT NULL,
	FOREIGN KEY (projectID) REFERENCES project(projectID) ON DELETE CASCADE
) ENGINE=InnoDB;

# Create project_staff_skills table
CREATE TABLE project_staff_skills (
	projectID integer NOT NULL,
	staffID integer NOT NULL,
	skillID integer NOT NULL,
	PRIMARY KEY (projectID, staffID, skillID),
	FOREIGN KEY (projectID) REFERENCES project(projectID) ON DELETE CASCADE
) ENGINE=InnoDB;

# Create past_staff table
CREATE TABLE past_staff (
	ID integer NOT NULL PRIMARY KEY AUTO_INCREMENT,
	firstName varchar(255) NOT NULL,
	lastName varchar(255) NOT NULL,
	email varchar(255) NOT NULL,
	createdAt datetime NOT NULL,
	deletedAt datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	type enum('employee', 'contractor', 'projectManager') NOT NULL
) ENGINE=InnoDB;

COMMIT;