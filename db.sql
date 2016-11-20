# Delete database
DROP DATABASE LeidosDB;

# Create database called 'LeidosDB'
CREATE DATABASE LeidosDB;

# Use the database LeidosDB
USE LeidosDB;

START TRANSACTION;

# Create user_group table
CREATE TABLE user_group (
  groupID integer(3) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
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
  email varchar(100) NOT NULL PRIMARY KEY,
  ipAddress varchar(45) NOT NULL,
  password varchar(255) NOT NULL,
  salt varchar(255) DEFAULT NULL,
  forgotten_password_code varchar(40) DEFAULT NULL,
  forgotten_password_time integer(11) unsigned DEFAULT NULL,
  remember_code varchar(40) DEFAULT NULL,
  createdAt integer(11) unsigned NOT NULL,
  updatedAt datetime DEFAULT NULL,
  last_login integer(11) unsigned DEFAULT NULL,
  active tinyint(1) unsigned DEFAULT NULL,
  group integer(3) NOT NULL,
  firstName varchar(50) DEFAULT NULL,
  lastName varchar(100) DEFAULT NULL,
  FOREIGN KEY ('group') REFERENCES user_group('groupID') ON UPDATE NO ACTION
) ENGINE=InnoDB;

#
# Dumping data for table 'account'
#
INSERT INTO account (`email`, `ipAddress`, `password`, `salt`, `forgotten_password_code`, `createdAt`, `last_login`, `active`, `group`, `firstName`, `lastName`) VALUES
     ('admin@admin.com','127.0.0.1','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36','',NULL,'1268889823','1268889823','1', '1', 'Admin','istrator');


# Create account_group table
CREATE TABLE `account_group` (
  accountEmail int(11) unsigned NOT NULL,
  group integer(3) unsigned NOT NULL,
  PRIMARY KEY (accountEmail, group),
  CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB;

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
     (1,1,1),
     (2,1,2);


DROP TABLE IF EXISTS `login_attempts`;

#
# Table structure for table 'login_attempts'
#

CREATE TABLE `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;


# Create Skill table
CREATE TABLE Skill (
	skillID integer NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name varchar(255) NOT NULL,
	quantifiable tinyint(1) NOT NULL
) ENGINE=InnoDB;

# Create Account table
CREATE TABLE Account (
	email varchar(255) NOT NULL PRIMARY KEY,
	firstName varchar(255) NOT NULL,
	lastName varchar(255) NOT NULL,
	createdAt datetime NOT NULL,
	updatedAt datetime NOT NULL,
	password varchar(255) NOT NULL,
	accessLevel enum('user', 'manager', 'admin') NOT NULL
) ENGINE=InnoDB;

# Create Location table
CREATE TABLE Location (
	locationID integer NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name varchar(255) NOT NULL
) ENGINE=InnoDB;

# Create User table
CREATE TABLE User (
	userID integer NOT NULL PRIMARY KEY AUTO_INCREMENT,
	type enum('employee', 'contractor', 'projectManager') NOT NULL,
	currentLocation integer NOT NULL,
	payRate decimal NOT NULL,
	FOREIGN KEY (currentLocation) REFERENCES Location(locationID) ON DELETE RESTRICT
) ENGINE=InnoDB;

# Create Availability table
CREATE TABLE Availability (
	userID integer NOT NULL,
	day date NOT NULL,
	type enum('holiday', 'work', 'training', 'sick', 'other') NOT NULL,
	PRIMARY KEY (userID, day),
	FOREIGN KEY (userID) REFERENCES User(userID)
) ENGINE=InnoDB;

# Create UserSkill table
CREATE TABLE UserSkill (
	userID integer NOT NULL,
	skillID integer NOT NULL,
	skillLevel enum('normal', 'basic', 'intermediate', 'advanced') NOT NULL,
	PRIMARY KEY (userID, skillID),
	FOREIGN KEY (userID) REFERENCES User(userID) ON DELETE CASCADE,
	FOREIGN KEY (skillID) REFERENCES Skill(skillID)
) ENGINE=InnoDB;

# Create PreferredLocation table
CREATE TABLE PreferredLocation (
	userID integer NOT NULL,
	location integer NOT NULL,
	PRIMARY KEY (userID, location),
	FOREIGN KEY (userID) REFERENCES User(userID) ON DELETE CASCADE,
	FOREIGN KEY (location) REFERENCES Location(locationID)
) ENGINE=InnoDB;

# Create Project table
CREATE TABLE Project (
	projectID integer NOT NULL PRIMARY KEY AUTO_INCREMENT,
	managerID integer NOT NULL,
	title varchar(100) NOT NULL,
	description varchar(255) NOT NULL,
	priority enum('normal', 'high') NOT NULL,
	location integer NOT NULL,
	budget decimal NOT NULL,
	startDate date NOT NULL,
	endDate date NOT NULL,
	FOREIGN KEY (managerID) REFERENCES User(userID) ON DELETE CASCADE,
	FOREIGN KEY (location) REFERENCES Location(locationID)
) ENGINE=InnoDB;

# Create Experience table
CREATE TABLE Experience (
	experienceID integer NOT NULL PRIMARY KEY AUTO_INCREMENT,
	userID integer NOT NULL,
	startDate date NOT NULL,
	endDate date NOT NULL,
	projectID integer,
	title varchar(100) NOT NULL,
	description varchar(255),
	role varchar(100) NOT NULL,
	FOREIGN KEY (userID) REFERENCES User(userID) ON DELETE CASCADE,
	FOREIGN KEY (projectID) REFERENCES Project(projectID) ON DELETE SET NULL
) ENGINE=InnoDB;

# Create Activity table
CREATE TABLE Activity (
	activityID integer NOT NULL PRIMARY KEY AUTO_INCREMENT,
	userID integer NOT NULL,
	description varchar(255) NOT NULL,
	atDate datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (userID) REFERENCES User(userID) ON DELETE CASCADE
) ENGINE=InnoDB;

# Create ProjectLog table
CREATE TABLE ProjectLog (
	noteID integer NOT NULL PRIMARY KEY AUTO_INCREMENT,
	projectID integer NOT NULL,
	description varchar(255) NOT NULL,
	atDate datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (projectID) REFERENCES Project(projectID) ON DELETE CASCADE
) ENGINE=InnoDB;

# Create ProjectDashboard table
CREATE TABLE ProjectDashboard (
	entryID integer NOT NULL PRIMARY KEY AUTO_INCREMENT,
	projectID integer NOT NULL,
	description varchar(255) NOT NULL,
	atDate datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (projectID) REFERENCES Project(projectID) ON DELETE CASCADE
) ENGINE=InnoDB;

# Create ProjectResources table
CREATE TABLE ProjectResources (
	projectID integer NOT NULL,
	userID integer NOT NULL,
	role varchar(50) NOT NULL,
	assignedAt datetime NOT NULL,
	FOREIGN KEY (projectID) REFERENCES Project(projectID) ON DELETE CASCADE
) ENGINE=InnoDB;

# Create ProjectSkills table
CREATE TABLE ProjectSkills (
	projectID integer NOT NULL,
	userID integer NOT NULL,
	skillID integer NOT NULL,
	PRIMARY KEY (projectID, userID, skillID),
	FOREIGN KEY (projectID) REFERENCES Project(projectID) ON DELETE CASCADE
) ENGINE=InnoDB;

# Create PastEmployee table
CREATE TABLE PastEmployee (
	ID integer NOT NULL PRIMARY KEY AUTO_INCREMENT,
	firstName varchar(255) NOT NULL,
	lastName varchar(255) NOT NULL,
	email varchar(255) NOT NULL,
	createdAt datetime NOT NULL,
	deletedAt datetime NOT NULL,
	type enum('employee', 'contractor', 'projectManager') NOT NULL
) ENGINE=InnoDB;

COMMIT;