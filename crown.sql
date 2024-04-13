#USE Christopher100051457;
CREATE DATABASE crown;
USE crown;

CREATE TABLE crownLog3
(
	activityID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	crownDate VARCHAR(10),
    crownStart VARCHAR(5),
    crownEnd VARCHAR(5),
    crownParticipants VARCHAR(25),
    crownCategory VARCHAR(25)
);

INSERT INTO crownLog3 VALUES (2, '1988-08-25', '12:05', '12:10', 'Partner', 'Straight');

-- Changes to SQL Database
ALTER TABLE crownlog3
ADD photos VARCHAR(100);

ALTER TABLE crownLog3
RENAME COLUMN photos TO photo; 
