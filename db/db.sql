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
  ip_address varchar(45) NOT NULL,
  password varchar(255) NOT NULL,
  salt varchar(255) DEFAULT NULL,
  forgotten_password_code varchar(40) DEFAULT NULL,
  forgotten_password_time integer(11) unsigned DEFAULT NULL,
  remember_code varchar(40) DEFAULT NULL,
  created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  last_login datetime DEFAULT NULL,
  active tinyint(1) unsigned DEFAULT NULL,
  first_name varchar(50) NOT NULL,
  last_name varchar(50) NOT NULL
) ENGINE=InnoDB;

#
# Dumping data for table 'account'
#
INSERT INTO account (`email`, `ip_address`, `password`, `salt`, `forgotten_password_code`, `last_login`, `active`, `first_name`, `last_name`) VALUES
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
    (1,1),
    (1,2);


# Create skill table
CREATE TABLE skill (
	skill_id integer(8) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name varchar(255) NOT NULL,
	quantifiable tinyint(1) NOT NULL
) ENGINE=InnoDB;

# Create location table
CREATE TABLE location (
	location_id integer(8) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name varchar(255) NOT NULL
) ENGINE=InnoDB;

# Create staff table
CREATE TABLE staff (
	staff_id integer(11) NOT NULL PRIMARY KEY,
	current_location integer(8) NOT NULL,
	pay_rate decimal(10,2) NOT NULL,
	FOREIGN KEY (staff_id) REFERENCES account(id) ON DELETE CASCADE,
	FOREIGN KEY (current_location) REFERENCES location(location_id) ON DELETE RESTRICT
) ENGINE=InnoDB;

# Create availability table
CREATE TABLE availability (
	staff_id integer(11) NOT NULL,
	start_date date NOT NULL,
	end_date date NOT NULL,
	type enum('holiday', 'work', 'training', 'sick', 'other') NOT NULL,
	PRIMARY KEY (staff_id, start_date),
	FOREIGN KEY (staff_id) REFERENCES staff(staff_id) ON DELETE CASCADE
) ENGINE=InnoDB;

# Create staff_skill table
CREATE TABLE staff_skill (
	staff_id integer(11) NOT NULL,
	skill_id integer(8) NOT NULL,
	skill_level enum('normal', 'basic', 'intermediate', 'advanced') NOT NULL,
	PRIMARY KEY (staff_id, skill_id),
	FOREIGN KEY (staff_id) REFERENCES staff(staff_id) ON DELETE CASCADE,
	FOREIGN KEY (skill_id) REFERENCES skill(skill_id) ON DELETE CASCADE
) ENGINE=InnoDB;

# Create preferred_location table
CREATE TABLE preferred_location (
	staff_id integer NOT NULL,
	location integer NOT NULL,
	PRIMARY KEY (staff_id, location),
	FOREIGN KEY (staff_id) REFERENCES staff(staff_id) ON DELETE CASCADE,
	FOREIGN KEY (location) REFERENCES location(location_id)
) ENGINE=InnoDB;

# Create project table
CREATE TABLE project (
	project_id integer NOT NULL PRIMARY KEY AUTO_INCREMENT,
	manager_id integer NOT NULL,
	title varchar(100) NOT NULL,
	description varchar(255) NOT NULL,
	priority enum('normal', 'high') NOT NULL,
	location integer,
	budget decimal(10,2) NOT NULL,
	start_date date NOT NULL,
	end_date date NOT NULL,
	status enum('active', 'scheduled', 'finished', 'delayed', 'unsuccessful', 'cancelled') DEFAULT 'scheduled',
	FOREIGN KEY (manager_id) REFERENCES account(id),
	FOREIGN KEY (location) REFERENCES location(location_id)
) ENGINE=InnoDB;

# Create experience table
CREATE TABLE experience (
	experience_id integer NOT NULL PRIMARY KEY AUTO_INCREMENT,
	staff_id integer NOT NULL,
	start_date date NOT NULL,
	end_date date NOT NULL,
	project_id integer,
	institution varchar(100) NOT NULL,
	description varchar(255),
	role varchar(100) NOT NULL,
  	active tinyint(1) unsigned DEFAULT 1,
	skills varchar(255) NOT NULL,
	FOREIGN KEY (staff_id) REFERENCES staff(staff_id) ON DELETE CASCADE,
	FOREIGN KEY (project_id) REFERENCES project(project_id) ON DELETE SET NULL
) ENGINE=InnoDB;

# Create activity table
CREATE TABLE activity (
	activity_id integer NOT NULL PRIMARY KEY AUTO_INCREMENT,
	user_id integer NOT NULL,
	description varchar(255) NOT NULL,
	at_date datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (user_id) REFERENCES account(id) ON DELETE CASCADE
) ENGINE=InnoDB;

# Create project_log table
CREATE TABLE project_log (
	note_id integer NOT NULL PRIMARY KEY AUTO_INCREMENT,
	project_id integer NOT NULL,
	description varchar(255) NOT NULL,
	at_date datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (project_id) REFERENCES project(project_id) ON DELETE CASCADE
) ENGINE=InnoDB;

# Create project_dashboard table
CREATE TABLE project_dashboard (
	entry_id integer NOT NULL PRIMARY KEY AUTO_INCREMENT,
	project_id integer NOT NULL,
	description varchar(255) NOT NULL,
	at_date datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (project_id) REFERENCES project(project_id) ON DELETE CASCADE
) ENGINE=InnoDB;

# Create project_staff table
CREATE TABLE project_staff (
	project_id integer NOT NULL,
	staff_id integer NOT NULL,
	role varchar(50) NOT NULL,
	assigned_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	start_date date NOT NULL,
	end_date date NOT NULL,
	skills varchar(255) NOT NULL,
	PRIMARY KEY (project_id, staff_id),
	FOREIGN KEY (project_id) REFERENCES project(project_id) ON DELETE CASCADE,
	FOREIGN KEY (staff_id) REFERENCES staff(staff_id)
) ENGINE=InnoDB;

# Create project_task table
CREATE TABLE project_task (
	task_id integer NOT NULL PRIMARY KEY AUTO_INCREMENT,
	project_id integer NOT NULL,
	skills varchar(255) NOT NULL,
	staff varchar(255) NOT NULL,
	description varchar(255) NOT NULL,
	at_date datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	status enum('active', 'scheduled', 'finished', 'cancelled') DEFAULT 'scheduled', 
	FOREIGN KEY (project_id) REFERENCES project(project_id) ON DELETE CASCADE
) ENGINE=InnoDB;

# Create project_task table
CREATE TABLE application (
	application_id integer NOT NULL PRIMARY KEY AUTO_INCREMENT,
	project_id integer NOT NULL,
	staff_id integer NOT NULL,
	comments varchar(255) NOT NULL,
	at_date datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	status enum('submitted', 'acepted', 'rejected') DEFAULT 'submitted', 
	FOREIGN KEY (project_id) REFERENCES project(project_id),
	FOREIGN KEY (staff_id) REFERENCES staff(staff_id)
) ENGINE=InnoDB;

COMMIT;