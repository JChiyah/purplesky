# Create database called 'LeidosDB'
#CREATE DATABASE LeidosDB;

# Use the database LeidosDB
#USE LeidosDB;

START TRANSACTION;

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