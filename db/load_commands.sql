START TRANSACTION;

SET foreign_key_checks = 0;

-- Load data into skill
LOAD DATA LOCAL INFILE
'C:/xampp/htdocs/purplesky/db/skill.txt'
REPLACE INTO TABLE skill
FIELDS TERMINATED BY ','
LINES STARTING BY '(' TERMINATED BY ')\r'
(name, quantifiable)
SET skill_id = NULL;

-- Load data into location
LOAD DATA LOCAL INFILE
'C:/xampp/htdocs/purplesky/db/location.txt'
REPLACE INTO TABLE location
FIELDS TERMINATED BY ','
LINES STARTING BY '(' TERMINATED BY ')\r'
(name)
SET location_id = NULL;

-- Load data into account
LOAD DATA LOCAL INFILE
'C:/xampp/htdocs/purplesky/db/account.txt'
REPLACE INTO TABLE account
FIELDS TERMINATED BY ','
LINES STARTING BY '(' TERMINATED BY ')\r'
(email, ip_address, password, salt, active, first_name, last_name)
SET id = NULL;

-- Load data into account_group
LOAD DATA LOCAL INFILE
'C:/xampp/htdocs/purplesky/db/account_group.txt'
REPLACE INTO TABLE account_group
FIELDS TERMINATED BY ','
LINES STARTING BY '(' TERMINATED BY ')\r'
(user_id, group_id)
SET id = NULL;

-- Load data into staff
LOAD DATA LOCAL INFILE
'C:/xampp/htdocs/purplesky/db/staff.txt'
REPLACE INTO TABLE staff
FIELDS TERMINATED BY ','
LINES STARTING BY '(' TERMINATED BY ')\r'
(staff_id, current_location, pay_rate);

-- Load data into staff_skill
LOAD DATA LOCAL INFILE
'C:/xampp/htdocs/purplesky/db/staff_skill.txt'
REPLACE INTO TABLE staff_skill
FIELDS TERMINATED BY ','
LINES STARTING BY '(' TERMINATED BY ')\r'
(staff_id, skill_id, skill_level);

SET foreign_key_checks = 1;
COMMIT;