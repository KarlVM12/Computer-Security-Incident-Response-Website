DROP DATABASE csirt;
CREATE DATABASE csirt;
USE csirt;

CREATE TABLE INCIDENT (
	incidentID INTEGER NOT NULL,
    incidentType VARCHAR(50),
    creationDate DATE,
    incidentState VARCHAR(30),
    incidentName VARCHAR(30),
    handlerName VARCHAR(50),
    associationID INTEGER,
    CONSTRAINT Incident_PK PRIMARY KEY (incidentID),
    CONSTRAINT Incident_FK1 FOREIGN KEY (associationID)
		REFERENCES PERSON (associationID)
        ON DELETE CASCADE
);

CREATE TABLE PERSON (
	associationID INTEGER NOT NULL,
    incidentID INTEGER NOT NULL, 
    handlerName VARCHAR(50),
    lastName VARCHAR(25),
    firstName VARCHAR(25),
    jobTitle VARCHAR(50),
    emailAddress VARCHAR(100),
    CONSTRAINT Person_PK PRIMARY KEY (associationID),
    CONSTRAINT Person_FK1 FOREIGN KEY (incidentID)
		REFERENCES INCIDENT (incidentID)
        ON DELETE CASCADE,
	CONSTRAINT Person_FK2 FOREIGN KEY (handlerName)
		REFERENCES INCIDENT (handlerName)
        ON DELETE CASCADE
);

CREATE TABLE COMMENT (
	commentID INTEGER NOT NULL,
    incidentID INTEGER NOT NULL,
    commentDescription VARCHAR(250),
    commentDate DATE,
    handlerName VARCHAR(50),
    CONSTRAINT Comment_PK PRIMARY KEY (commentID),
    CONSTRAINT Comment_FK1 FOREIGN KEY (incidentID)
		REFERENCES INCIDENT (incidentID)
        ON DELETE CASCADE,
    CONSTRAINT Comment_FK2 FOREIGN KEY (handlerName)
		REFERENCES INCIDENT (handlerName)
        ON DELETE CASCADE
);

CREATE TABLE IPADDRESS (
	associationID INTEGER NOT NULL,
    incidentID INTEGER NOT NULL,
    IPAddress VARCHAR(32),
    CONSTRAINT IPAddress_PK PRIMARY KEY (associationID),
    CONSTRAINT IPAddress_FK1 FOREIGN KEY (associationID)
		REFERENCES PERSON (associationID)
        ON DELETE CASCADE,
	CONSTRAINT IPAddress_FK2 FOREIGN KEY (incidentID)
		REFERENCES INCIDENT (incidentID)
        ON DELETE CASCADE
);

/****** INSERT STATEMENTS ******/
INSERT INTO INCIDENT VALUES (
	222903, 'Malware', '2020-09-18', 'open', 'Computer Lab 12 Infected', 'Steve Woz', null);
INSERT INTO INCIDENT VALUES (
	222398, 'Corruption', '2019-10-31', 'stalled', 'Tim Laptop\'s Hard Drive', 'John Madoff', 7654);
INSERT INTO INCIDENT VALUES (
	543267, 'Hardware Malfunction', '2018-11-20', 'closed', 'Angie\'s Dropped Laptop', 'Tim Apple', 3456);
INSERT INTO INCIDENT VALUES (
	726818, 'Theft of Company Property', '2020-12-20', 'closed', 'Frank\'s Laptop Not Returned in Time', 'John Madoff', 6789); 
    
INSERT INTO PERSON VALUES (
	7654, 222398, 'John Madoff', 'Claude', 'Tim', 'Accountant', 'timclaude45@gmail.com');
INSERT INTO PERSON VALUES (
	3456, 543267, 'Tim Apple', 'Rivera', 'Angie', 'Secretary', 'angierivera23@gmail.com');
INSERT INTO PERSON VALUES (
	6789, 726818, 'John Madoff', 'Clinton', 'Frank', 'Developer', 'frankcliton12@gmail.com');
    
INSERT INTO COMMENT VALUES (
	213433, 222903, 'The entire lab was infected with malware that encrypted the hard drives of each computer', '2020-09-20', 'Steve Woz');
INSERT INTO COMMENT VALUES (
	434411, 222398, 'Tim\'s laptop hard drive has been corrupted. Probably needs a fresh OS install', '2019-11-02', 'John Madoff');
INSERT INTO COMMENT VALUES (
	878987, 543267, 'Angie has dropped her laptop, breaking it. Needs a replacement', '2018-11-20', 'Tim Apple');
INSERT INTO COMMENT VALUES (
	878988, 543267, 'Angie has been given a new laptop. Issue is closed.', '2018-11-27', 'Tim Apple');

INSERT INTO IPADDRESS VALUES (
	7654, '145.10.34.3', 222398);
INSERT INTO IPADDRESS VALUES (
	3456, '127.255.255.255', 543267);
INSERT INTO IPADDRESS VALUES (
	6789, '191.255.130.332', 726818);
    
SELECT * FROM INCIDENT;
SELECT * FROM PERSON;
SELECT * FROM COMMENT;
SELECT * FROM IPADDRESS;