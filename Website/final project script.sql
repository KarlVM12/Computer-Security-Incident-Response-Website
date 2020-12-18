drop database csirt;
create DATABASE csirt;
USE csirt;


CREATE TABLE HANDLER (
	handlerName VARCHAR(50) NOT NULL,
    CONSTRAINT Handler_PK PRIMARY KEY (handlerName)
);

CREATE TABLE INCIDENT (
    incidentID INTEGER NOT NULL,
    incidentType VARCHAR(50),
    creationDate DATE,
    incidentState VARCHAR(30),
    incidentName VARCHAR(40),
    handlerName VARCHAR(50) NOT NULL,
    CONSTRAINT Incident_PK PRIMARY KEY (incidentID),
    CONSTRAINT Incident_FK1 FOREIGN KEY (handlerName)
		REFERENCES HANDLER (handlerName)
        ON UPDATE CASCADE
);

CREATE TABLE PERSON (
    associationID INTEGER NOT NULL,
    lastName VARCHAR(25),
    firstName VARCHAR(25),
    jobTitle VARCHAR(50),
    emailAddress VARCHAR(100),
    CONSTRAINT Person_PK PRIMARY KEY (associationID)
);

CREATE TABLE INVOLVEDPERSON (
    associationID INTEGER NOT NULL,
    incidentID INTEGER NOT NULL,
    CONSTRAINT InvolvedPerson_PK PRIMARY KEY (associationID, incidentID),
    CONSTRAINT InvolvedPerson_FK1 FOREIGN KEY (associationID)
	REFERENCES PERSON (associationID)
	ON UPDATE CASCADE,
    CONSTRAINT InvolvedPerson_FK2 FOREIGN KEY (incidentID)
	REFERENCES INCIDENT (incidentID)
	ON UPDATE CASCADE
);

CREATE TABLE COMMENT (
    commentID INTEGER NOT NULL AUTO_INCREMENT,
    incidentID INTEGER NOT NULL,
    commentDescription VARCHAR(250),
    commentDate DATE,
    handlerName VARCHAR(50) NOT NULL,
    CONSTRAINT Comment_PK PRIMARY KEY (commentID),
    CONSTRAINT Comment_FK1 FOREIGN KEY (incidentID)
        REFERENCES INCIDENT (incidentID)
        ON UPDATE CASCADE,
    CONSTRAINT Comment_FK2 FOREIGN KEY (handlerName)
        REFERENCES HANDLER (handlerName)
        ON UPDATE CASCADE
);

CREATE TABLE IPADDRESS (
    associationID INTEGER NOT NULL,
    IPAddress VARCHAR(32),
    incidentID INTEGER NOT NULL,
    CONSTRAINT IPAddress_PK PRIMARY KEY (associationID, incidentID),
    CONSTRAINT IPAddress_FK1 FOREIGN KEY (associationID)
        REFERENCES PERSON (associationID),
    CONSTRAINT IPAddress_FK2 FOREIGN KEY (incidentID)
        REFERENCES INCIDENT (incidentID)
        ON UPDATE CASCADE
);

/****** INSERT STATEMENTS ******/
INSERT INTO HANDLER VALUES (
	'Steve Woz');
INSERT INTO HANDLER VALUES (
	'John Madoff');
INSERT INTO HANDLER VALUES (
	'Tim Apple');
INSERT INTO HANDLER VALUES (
    'Bill Murray');
    
INSERT INTO PERSON VALUES (
    7654, NULL, NULL, NULL, NULL);
INSERT INTO PERSON VALUES (
	3456, NULL, NULL, NULL, NULL);
INSERT INTO PERSON VALUES (
	6789, NULL, NULL, NULL, NULL);
INSERT INTO PERSON VALUES ( 
    9001, NULL, NULL, NULL, NULL);
INSERT INTO PERSON VALUES ( 
    9987, NULL, NULL, NULL, NULL);
INSERT INTO PERSON VALUES ( 
    8901, NULL, NULL, NULL, NULL);

INSERT INTO INCIDENT VALUES (
	222903, 'Malware', '2020-09-18', 'open', 'Computer Lab 12 Infected', 'Steve Woz');
INSERT INTO INCIDENT VALUES (
	222398, 'Corruption', '2019-10-31', 'stalled', 'Tim Laptop\'s Hard Drive', 'John Madoff'); 
INSERT INTO INCIDENT VALUES (
	543267, 'Hardware Malfunction', '2018-11-20', 'closed', 'Angie\'s Dropped Laptop', 'Tim Apple');
INSERT INTO INCIDENT VALUES (
	726818, 'Theft of Property', '2020-12-20', 'closed', 'Frank\'s Laptop Not Returned in Time', 'John Madoff'); 
INSERT INTO INCIDENT VALUES (
    894933, 'Damaged Laptop', '2020-12-06', 'closed', 'Rosa\'s Laptop screen broken', 'Bill Murray');
INSERT INTO INCIDENT VALUES (
    564789, 'Malware', '2020-03-02', 'closed', 'Tim infected his laptop with malware', 'Bill Murray');
INSERT INTO INCIDENT VALUES (
    109231, 'Software Update', '2020-12-20','open', 'Need to update Kurt\'s software', 'Tim Apple');
INSERT INTO INCIDENT VALUES (
	972132, 'Theft of Property', '2019-11-20', 'closed', 'Needs to return borrowed iPad', 'John Madoff');
    

UPDATE PERSON
SET lastName = 'Claude', firstName = 'Tim', jobTitle = 'Accountant', emailAddress = 'timclaude45@gmail.com'
WHERE associationID = 7654;

UPDATE PERSON
SET lastName = 'Rivera', firstName = 'Angie', jobTitle = 'Secretary', emailAddress = 'angierivera23@gmail.com'
WHERE associationID = 3456;

UPDATE PERSON
SET lastName = 'Clinton', firstName = 'Frank', jobTitle = 'Developer', emailAddress = 'frankcliton12@gmail.com'
WHERE associationID = 6789;

UPDATE PERSON
SET lastName = 'Muller', firstName = 'Rosa', jobTitle = 'Developer', emailAddress = 'rosamuller21@gmail.com'
WHERE associationID = 9001;

UPDATE PERSON
SET lastName = 'Muller', firstName = 'Kurt', jobTitle = 'Designer', emailAddress = 'kurtmuller123@gmail.com'
WHERE associationID = 9987;

UPDATE PERSON
SET lastName = 'Bob', firstName = 'Jim', jobTitle = 'Dingus', emailAddress = 'jimbob67@gmail.com'
WHERE associationID = 8901;

INSERT INTO INVOLVEDPERSON VALUES (
    	7654, 222398);
INSERT INTO INVOLVEDPERSON VALUES (
    	3456, 564789);
INSERT INTO INVOLVEDPERSON VALUES (
    	6789, 726818);
INSERT INTO INVOLVEDPERSON VALUES (
    	9001, 894933);
INSERT INTO INVOLVEDPERSON VALUES (
    	7654, 564789);
INSERT INTO INVOLVEDPERSON VALUES (
    	9987, 109231);
INSERT INTO INVOLVEDPERSON VALUES (
    	8901, 972132);
INSERT INTO INVOLVEDPERSON VALUES (
		9987, 972132);
	
    
INSERT INTO COMMENT VALUES (
	null, 222903, 'The entire lab was infected with malware that encrypted the hard drives of each computer', '2020-09-20', 'Steve Woz');
INSERT INTO COMMENT VALUES (
	null, 222398, 'Tim\'s laptop hard drive has been corrupted. Probably needs a fresh OS install', '2019-11-02', 'John Madoff');
INSERT INTO COMMENT VALUES (
	null, 543267, 'Angie has dropped her laptop, breaking it. Needs a replacement', '2018-11-20', 'Tim Apple');
INSERT INTO COMMENT VALUES (
	null, 543267, 'Angie has been given a new laptop. Issue is closed.', '2018-11-27', 'Tim Apple');
INSERT INTO COMMENT VALUES (
	null, 109231, 'He needs the latest year updates for Premier Pro', '2020-12-21', 'Tim Apple');

INSERT INTO IPADDRESS VALUES (
	7654, '145.10.34.3', 222398);
INSERT INTO IPADDRESS VALUES (
	3456, '127.255.255.255', 543267);
INSERT INTO IPADDRESS VALUES (
	6789, '191.255.130.332', 726818);
INSERT INTO IPADDRESS VALUES (
	8901, '876.232.130.332', 972132);
