#WARING: Will remove and remake and emptry table if the database exists.
DROP DATABASE IF EXISTS volunteer;


# If we navigate to the install.PHP file, it will attmpt to connect to the MYSQL DB
# using information inside config.php, then use the SQL below to create our table.
CREATE DATABASE volunteer;

use volunteer;

# The primary key is auto incremented.  We could have used a combinational primary
# key between Phone, first, and last, but this makes it more unique but prone to duplicates.
# The date is simply the system timestamp.
CREATE TABLE users (
	id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	firstname VARCHAR(30) NOT NULL,
	lastname VARCHAR(30) NOT NULL,
	email VARCHAR(50) NOT NULL,
	phone VARCHAR(15),  NOT NULL,
	location VARCHAR(50),  NOT NULL,
	date TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP
);