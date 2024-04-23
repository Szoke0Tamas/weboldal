CREATE TABLE FELHASZNALO (
    ID NUMBER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    felhasznalonev NVARCHAR2(35) UNIQUE NOT NULL,
    felhasznalo_kep VARCHAR2(255),
    email NVARCHAR2(255) UNIQUE NOT NULL,
    jelszo NVARCHAR2(255) NOT NULL,
    telepules NVARCHAR2(50),
    munkaterulet NVARCHAR2(50),
    hobbi NVARCHAR2(255),
    bemutatkozas NVARCHAR2(255),
    szuletesi_datum DATE NOT NULL,
    regisztracios_datum DATE NOT NULL
);

CREATE TABLE JOGOK (
    ID NUMBER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    FELHASZNALO_ID NUMBER UNIQUE NOT NULL,
    moderator NUMBER(1) NOT NULL,
    admin NUMBER(1) NOT NULL,
    felfuggesztett NUMBER(1) NOT NULL,
    tiltott NUMBER(1) NOT NULL,
    FOREIGN KEY (FELHASZNALO_ID) REFERENCES FELHASZNALO(ID) ON DELETE CASCADE
);


CREATE TABLE BEJEGYZESEK (
    ID NUMBER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    FELHASZNALO_ID NUMBER NOT NULL,
    cim NVARCHAR2(255) NOT NULL,
    leiras NCLOB NOT NULL,
    kepek BLOB DEFAULT NULL,
    datum DATE NOT NULL,
    FOREIGN KEY (FELHASZNALO_ID) REFERENCES FELHASZNALO(ID) ON DELETE CASCADE
);


CREATE TABLE ERTESITESEK (
    ID NUMBER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    K_FELHASZNALO_ID NUMBER NOT NULL,
    F_FELHASZNALO_ID NUMBER NOT NULL,
    elolvasva NUMBER(1) NOT NULL,
    tipus VARCHAR2(20) NOT NULL,
    datum DATE NOT NULL,
    FOREIGN KEY (K_FELHASZNALO_ID) REFERENCES FELHASZNALO(ID) ON DELETE CASCADE,
    FOREIGN KEY (F_FELHASZNALO_ID) REFERENCES FELHASZNALO(ID) ON DELETE CASCADE
);

CREATE TABLE UZENETEK (
    ID NUMBER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    K_FELHASZNALO_ID NUMBER NOT NULL,
    F_FELHASZNALO_ID NUMBER NOT NULL,
    tartalom NCLOB NOT NULL,
    elolvasva NUMBER(1) NOT NULL,
    datum DATE NOT NULL,
    FOREIGN KEY (K_FELHASZNALO_ID) REFERENCES FELHASZNALO(ID) ON DELETE CASCADE,
    FOREIGN KEY (F_FELHASZNALO_ID) REFERENCES FELHASZNALO(ID) ON DELETE CASCADE
);

CREATE TABLE KAPCSOLATOK (
    ID NUMBER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    K_FELHASZNALO_ID NUMBER NOT NULL,
    F_FELHASZNALO_ID NUMBER NOT NULL,
    statusz NUMBER(1) NOT NULL,
    datum DATE NOT NULL,
    FOREIGN KEY (K_FELHASZNALO_ID) REFERENCES FELHASZNALO(ID) ON DELETE CASCADE,
    FOREIGN KEY (F_FELHASZNALO_ID) REFERENCES FELHASZNALO(ID) ON DELETE CASCADE
);


CREATE TABLE JELENTESEK (
    ID NUMBER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    FELHASZNALO_ID NUMBER NOT NULL,
    kire NVARCHAR2(100) NOT NULL,
    indok NVARCHAR2(100) NOT NULL,
    leiras NCLOB NOT NULL,
    FOREIGN KEY (FELHASZNALO_ID) REFERENCES FELHASZNALO(ID) ON DELETE CASCADE
);

INSERT INTO felhasznalo (felhasznalonev,email,jelszo,szuletesi_datum,regisztracios_datum)VALUES ('mod1','mod1@gg.com','4321', TO_DATE('1991-01-01', 'YYYY-MM-DD'),  SYSDATE);
INSERT INTO felhasznalo (felhasznalonev,email,jelszo,szuletesi_datum,regisztracios_datum)VALUES ('mod2','mod2@gg.com','4321', TO_DATE('1991-01-01', 'YYYY-MM-DD'),  SYSDATE);
INSERT INTO felhasznalo (felhasznalonev,email,jelszo,szuletesi_datum,regisztracios_datum)VALUES ('mod3','mod3@gg.com','1357', TO_DATE('1992-01-01', 'YYYY-MM-DD'),  SYSDATE);
INSERT INTO felhasznalo (felhasznalonev,email,jelszo,szuletesi_datum,regisztracios_datum)VALUES ('mod4','mod4@gg.com','7531', TO_DATE('1993-01-01', 'YYYY-MM-DD'),  SYSDATE);
INSERT INTO felhasznalo (felhasznalonev,email,jelszo,szuletesi_datum,regisztracios_datum)VALUES ('admin1','adid5@gg.com','2468', TO_DATE('1994-01-01', 'YYYY-MM-DD'),  SYSDATE);
INSERT INTO felhasznalo (felhasznalonev,email,jelszo,szuletesi_datum,regisztracios_datum)VALUES ('admin2','adika6@gg.com','8642', TO_DATE('1995-01-01', 'YYYY-MM-DD'),  SYSDATE);
INSERT INTO felhasznalo (felhasznalonev, email, jelszo, telepules, munkaterulet, hobbi, bemutatkozas, szuletesi_datum, regisztracios_datum)
VALUES('user1','user1184@example.com', 'password1', 'Budapest', 'IT', 'programming', 'Hello', TO_DATE('1990-01-02', 'YYYY-MM-DD'), SYSDATE);
INSERT INTO felhasznalo (felhasznalonev, email, jelszo, telepules, munkaterulet, hobbi, bemutatkozas, szuletesi_datum, regisztracios_datum)
VALUES('user2','user2184@example.com', 'password1', 'Budapest', 'IT', 'programming', 'Hello', TO_DATE('1990-01-03', 'YYYY-MM-DD'), SYSDATE);
INSERT INTO felhasznalo (felhasznalonev, email, jelszo, telepules, munkaterulet, hobbi, bemutatkozas, szuletesi_datum, regisztracios_datum)
VALUES('user3','user3184@example.com', 'password1', 'Budapest', 'IT', 'programming', 'Hello', TO_DATE('1990-01-04', 'YYYY-MM-DD'), SYSDATE);
INSERT INTO felhasznalo (felhasznalonev, email, jelszo, telepules, munkaterulet, hobbi, bemutatkozas, szuletesi_datum, regisztracios_datum)
VALUES('user4','user4184@example.com', 'password1', 'Budapest', 'IT', 'programming', 'Hello', TO_DATE('1990-01-05', 'YYYY-MM-DD'), SYSDATE);
INSERT INTO felhasznalo (felhasznalonev, email, jelszo, telepules, munkaterulet, hobbi, bemutatkozas, szuletesi_datum, regisztracios_datum)
VALUES('user5','user5184@example.com', 'password1', 'Budapest', 'IT', 'programming', 'Hello', TO_DATE('1990-01-07', 'YYYY-MM-DD'), SYSDATE);
INSERT INTO felhasznalo (felhasznalonev, email, jelszo, telepules, munkaterulet, hobbi, bemutatkozas, szuletesi_datum, regisztracios_datum)
VALUES('user6','user6184@example.com', 'password1', 'Budapest', 'IT', 'programming', 'Hello', TO_DATE('1990-01-08', 'YYYY-MM-DD'), SYSDATE);
INSERT INTO felhasznalo (felhasznalonev, email, jelszo, telepules, munkaterulet, hobbi, bemutatkozas, szuletesi_datum, regisztracios_datum)
VALUES('use7','use7184@example.com', 'password1', 'Budapest', 'IT', 'programming', 'Hello', TO_DATE('1990-01-09', 'YYYY-MM-DD'), SYSDATE);
INSERT INTO felhasznalo (felhasznalonev, email, jelszo, telepules, munkaterulet, hobbi, bemutatkozas, szuletesi_datum, regisztracios_datum)
VALUES('user8','user8184@example.com', 'password1', 'Budapest', 'IT', 'programming', 'Hello', TO_DATE('1990-01-10', 'YYYY-MM-DD'), SYSDATE);
INSERT INTO felhasznalo (felhasznalonev, email, jelszo, telepules, munkaterulet, hobbi, bemutatkozas, szuletesi_datum, regisztracios_datum)
VALUES('user9','user94@example.com', 'password1', 'Budapest', 'IT', 'programming', 'Hello', TO_DATE('1990-01-11', 'YYYY-MM-DD'), SYSDATE);
INSERT INTO felhasznalo (felhasznalonev, email, jelszo, telepules, munkaterulet, hobbi, bemutatkozas, szuletesi_datum, regisztracios_datum)
VALUES('user10','user91284@example.com', 'password1', 'Budapest', 'IT', 'programming', 'Hello', TO_DATE('1990-01-11', 'YYYY-MM-DD'), SYSDATE);
INSERT INTO felhasznalo (felhasznalonev, email, jelszo, telepules, munkaterulet, hobbi, bemutatkozas, szuletesi_datum, regisztracios_datum)
VALUES('user11','user984@example.com', 'password1', 'Budapest', 'IT', 'programming', 'Hello', TO_DATE('1990-01-11', 'YYYY-MM-DD'), SYSDATE);
INSERT INTO felhasznalo (felhasznalonev, email, jelszo, telepules, munkaterulet, hobbi, bemutatkozas, szuletesi_datum, regisztracios_datum)
VALUES('user43r','user184@example.com', 'password1', 'Budapest', 'IT', 'programming', 'Hello', TO_DATE('1990-01-11', 'YYYY-MM-DD'), SYSDATE);
INSERT INTO felhasznalo (felhasznalonev, email, jelszo, telepules, munkaterulet, hobbi, bemutatkozas, szuletesi_datum, regisztracios_datum)
VALUES('user231','user39184@example.com', 'password1', 'Budapest', 'IT', 'programming', 'Hello', TO_DATE('1990-01-11', 'YYYY-MM-DD'), SYSDATE);
INSERT INTO felhasznalo (felhasznalonev, email, jelszo, telepules, munkaterulet, hobbi, bemutatkozas, szuletesi_datum, regisztracios_datum)
VALUES('user98','uer9184@example.com', 'password1', 'Budapest', 'IT', 'programming', 'Hello', TO_DATE('1990-01-11', 'YYYY-MM-DD'), SYSDATE);
INSERT INTO felhasznalo (felhasznalonev, email, jelszo, telepules, munkaterulet, hobbi, bemutatkozas, szuletesi_datum, regisztracios_datum)
VALUES('user79','us914@example.com', 'password1', 'Budapest', 'IT', 'programming', 'Hello', TO_DATE('1990-01-11', 'YYYY-MM-DD'), SYSDATE);
INSERT INTO felhasznalo (felhasznalonev, email, jelszo, telepules, munkaterulet, hobbi, bemutatkozas, szuletesi_datum, regisztracios_datum)
VALUES('usese9','usir84@example.com', 'password1', 'Budapest', 'IT', 'programming', 'Hello', TO_DATE('1990-01-11', 'YYYY-MM-DD'), SYSDATE);
INSERT INTO felhasznalo (felhasznalonev, email, jelszo, telepules, munkaterulet, hobbi, bemutatkozas, szuletesi_datum, regisztracios_datum)
VALUES('user89','user98184@example.com', 'password1', 'Budapest', 'IT', 'programming', 'Hello', TO_DATE('1990-01-11', 'YYYY-MM-DD'), SYSDATE);
INSERT INTO felhasznalo (felhasznalonev, email, jelszo, telepules, munkaterulet, hobbi, bemutatkozas, szuletesi_datum, regisztracios_datum)
VALUES('user91','user91c@example.com', 'password1', 'Budapest', 'IT', 'programming', 'Hello', TO_DATE('1990-01-11', 'YYYY-MM-DD'), SYSDATE);
INSERT INTO felhasznalo (felhasznalonev, email, jelszo, telepules, munkaterulet, hobbi, bemutatkozas, szuletesi_datum, regisztracios_datum)
VALUES('usera9','uber9184@example.com', 'password1', 'Budapest', 'IT', 'programming', 'Hello', TO_DATE('1990-01-11', 'YYYY-MM-DD'), SYSDATE);
INSERT INTO felhasznalo (felhasznalonev, email, jelszo, telepules, munkaterulet, hobbi, bemutatkozas, szuletesi_datum, regisztracios_datum)
VALUES('ukiraj9','kiraj4@example.com', 'password1', 'Budapest', 'IT', 'programming', 'Hello', TO_DATE('1990-01-11', 'YYYY-MM-DD'), SYSDATE);
INSERT INTO felhasznalo (felhasznalonev, email, jelszo, telepules, munkaterulet, hobbi, bemutatkozas, szuletesi_datum, regisztracios_datum)
VALUES('1user9','1user9184@example.com', 'password1', 'Budapest', 'IT', 'programming', 'Hello', TO_DATE('1990-01-11', 'YYYY-MM-DD'), SYSDATE);
INSERT INTO felhasznalo (felhasznalonev, email, jelszo, telepules, munkaterulet, hobbi, bemutatkozas, szuletesi_datum, regisztracios_datum)
VALUES('use12r9','us23er9184@example.com', 'password1', 'Budapest', 'IT', 'programming', 'Hello', TO_DATE('1990-01-11', 'YYYY-MM-DD'), SYSDATE);
INSERT INTO felhasznalo (felhasznalonev, email, jelszo, telepules, munkaterulet, hobbi, bemutatkozas, szuletesi_datum, regisztracios_datum)
VALUES('user00','user001@secter00.com', 'password1', 'Budapest', 'IT', 'programming', 'Hello', TO_DATE('1990-01-11', 'YYYY-MM-DD'), SYSDATE);
INSERT INTO felhasznalo (felhasznalonev, email, jelszo, telepules, munkaterulet, hobbi, bemutatkozas, szuletesi_datum, regisztracios_datum)
VALUES('useR','userR@example.com', 'password1', 'Budapest', 'IT', 'programming', 'Hello', TO_DATE('1990-01-11', 'YYYY-MM-DD'), SYSDATE);
INSERT INTO felhasznalo (felhasznalonev, email, jelszo, telepules, munkaterulet, hobbi, bemutatkozas, szuletesi_datum, regisztracios_datum)
VALUES('errror','uroror4@example.com', 'password1', 'Budapest', 'IT', 'programming', 'Hello', TO_DATE('1990-01-11', 'YYYY-MM-DD'), SYSDATE);
INSERT INTO felhasznalo (felhasznalonev, email, jelszo, telepules, munkaterulet, hobbi, bemutatkozas, szuletesi_datum, regisztracios_datum)
VALUES('rawkey','urawkeyi@example.com', 'password1', 'Budapest', 'IT', 'programming', 'Hello', TO_DATE('1990-01-11', 'YYYY-MM-DD'), SYSDATE);


INSERT INTO JOGOK (FELHASZNALO_ID, moderator, admin, felfuggesztett, tiltott) VALUES (1,1, 0, 0, 0);
INSERT INTO JOGOK (FELHASZNALO_ID, moderator, admin, felfuggesztett, tiltott) VALUES (2,1, 0, 0, 0);
INSERT INTO JOGOK (FELHASZNALO_ID, moderator, admin, felfuggesztett, tiltott) VALUES (3,1, 0, 0, 0);
INSERT INTO JOGOK (FELHASZNALO_ID, moderator, admin, felfuggesztett, tiltott) VALUES (4,1, 0, 0, 0);
INSERT INTO JOGOK (FELHASZNALO_ID, moderator, admin, felfuggesztett, tiltott) VALUES (5,0, 1, 0, 0);
INSERT INTO JOGOK (FELHASZNALO_ID, moderator, admin, felfuggesztett, tiltott) VALUES (6,0, 1, 0, 0);
INSERT INTO JOGOK (FELHASZNALO_ID, moderator, admin, felfuggesztett, tiltott) VALUES (7,0, 0, 1, 0);
INSERT INTO JOGOK (FELHASZNALO_ID, moderator, admin, felfuggesztett, tiltott) VALUES (8,0, 0, 0, 0);
INSERT INTO JOGOK (FELHASZNALO_ID, moderator, admin, felfuggesztett, tiltott) VALUES (9,0, 0, 0, 0);
INSERT INTO JOGOK (FELHASZNALO_ID, moderator, admin, felfuggesztett, tiltott) VALUES (10,0, 0, 0, 0);
INSERT INTO JOGOK (FELHASZNALO_ID, moderator, admin, felfuggesztett, tiltott) VALUES (11,0, 0, 0, 1);
INSERT INTO JOGOK (FELHASZNALO_ID, moderator, admin, felfuggesztett, tiltott) VALUES (12,0, 0, 0, 0);
INSERT INTO JOGOK (FELHASZNALO_ID, moderator, admin, felfuggesztett, tiltott) VALUES (13,0, 0, 0, 0);
INSERT INTO JOGOK (FELHASZNALO_ID, moderator, admin, felfuggesztett, tiltott) VALUES (14,0, 0, 1, 0);
INSERT INTO JOGOK (FELHASZNALO_ID, moderator, admin, felfuggesztett, tiltott) VALUES (15,0, 0, 1, 0);
INSERT INTO JOGOK (FELHASZNALO_ID, moderator, admin, felfuggesztett, tiltott) VALUES (16,0, 0, 0, 1);
INSERT INTO JOGOK (FELHASZNALO_ID, moderator, admin, felfuggesztett, tiltott) VALUES (17,0, 0, 0, 1);
INSERT INTO JOGOK (FELHASZNALO_ID, moderator, admin, felfuggesztett, tiltott) VALUES (18,0, 0, 0, 0);
INSERT INTO JOGOK (FELHASZNALO_ID, moderator, admin, felfuggesztett, tiltott) VALUES (19,0, 0, 0, 0);
INSERT INTO JOGOK (FELHASZNALO_ID, moderator, admin, felfuggesztett, tiltott) VALUES (20,0, 0, 0, 0);
INSERT INTO JOGOK (FELHASZNALO_ID, moderator, admin, felfuggesztett, tiltott) VALUES (21,0, 0, 0, 0);
INSERT INTO JOGOK (FELHASZNALO_ID, moderator, admin, felfuggesztett, tiltott) VALUES (22,0, 0, 1, 0);
INSERT INTO JOGOK (FELHASZNALO_ID, moderator, admin, felfuggesztett, tiltott) VALUES (23,0, 0, 1, 0);
INSERT INTO JOGOK (FELHASZNALO_ID, moderator, admin, felfuggesztett, tiltott) VALUES (24,0, 0, 0, 0);
INSERT INTO JOGOK (FELHASZNALO_ID, moderator, admin, felfuggesztett, tiltott) VALUES (25,0, 0, 0, 0);
INSERT INTO JOGOK (FELHASZNALO_ID, moderator, admin, felfuggesztett, tiltott) VALUES (26,0, 0, 0, 1);
INSERT INTO JOGOK (FELHASZNALO_ID, moderator, admin, felfuggesztett, tiltott) VALUES (27,0, 0, 0, 1);
INSERT INTO JOGOK (FELHASZNALO_ID, moderator, admin, felfuggesztett, tiltott) VALUES (28,0, 0, 0, 0);
INSERT INTO JOGOK (FELHASZNALO_ID, moderator, admin, felfuggesztett, tiltott) VALUES (29,0, 0, 0, 0);
INSERT INTO JOGOK (FELHASZNALO_ID, moderator, admin, felfuggesztett, tiltott) VALUES (30,0, 0, 0, 0);
INSERT INTO JOGOK (FELHASZNALO_ID, moderator, admin, felfuggesztett, tiltott) VALUES (31,0, 0, 0, 0);
INSERT INTO JOGOK (FELHASZNALO_ID, moderator, admin, felfuggesztett, tiltott) VALUES (32,0, 0, 1, 0);




INSERT INTO ERTESITESEK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, elolvasva, tipus, datum)
VALUES(2, 4, 0, 'uzenet', TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO ERTESITESEK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, elolvasva, tipus, datum)
VALUES(3, 30, 0, 'uzenet', TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO ERTESITESEK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, elolvasva, tipus, datum)
VALUES(6, 32, 0, 'jeloles', TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO ERTESITESEK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, elolvasva, tipus, datum)
VALUES(30, 12, 0, 'uzenet', TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO ERTESITESEK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, elolvasva, tipus, datum)
VALUES(5, 8, 0, 'uzenet', TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO ERTESITESEK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, elolvasva, tipus, datum)
VALUES(5, 4, 1, 'jeloles', TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO ERTESITESEK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, elolvasva, tipus, datum)
VALUES(4, 9, 0, 'uzenet', TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO ERTESITESEK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, elolvasva, tipus, datum)
VALUES(16, 7, 0, 'uzenet', TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO ERTESITESEK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, elolvasva, tipus, datum)
VALUES(8, 4, 0, 'uzenet', TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO ERTESITESEK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, elolvasva, tipus, datum)
VALUES(4, 31, 0, 'uzenet', TO_DATE('2024-03-23', 'YYYY-MM-DD'));

INSERT INTO BEJEGYZESEK (FELHASZNALO_ID, cim, leiras, datum)
VALUES(3, 'Bejegyzes  ceme', 'Ez egy teszt bejegyzes leeresa.', TO_DATE('2024-01-23', 'YYYY-MM-DD'));
INSERT INTO BEJEGYZESEK (FELHASZNALO_ID, cim, leiras, datum)
VALUES(5, 'Bejegyzes  ceme', 'Ez egy teszt bejegyzes leeresa.',  TO_DATE('2024-02-23', 'YYYY-MM-DD'));
INSERT INTO BEJEGYZESEK (FELHASZNALO_ID, cim, leiras, datum)
VALUES(6, 'Bejegyzes  ceme', 'Ez egy teszt bejegyzes leeresa.', TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO BEJEGYZESEK (FELHASZNALO_ID, cim, leiras, datum)
VALUES(7, 'Bejegyzes  ceme', 'Ez egy teszt bejegyzes leeresa.', TO_DATE('2024-03-01', 'YYYY-MM-DD'));
INSERT INTO BEJEGYZESEK (FELHASZNALO_ID, cim, leiras, datum)
VALUES(3, 'Bejegyzes  ceme', 'Ez egy teszt bejegyzes leeresa.', TO_DATE('2024-03-02', 'YYYY-MM-DD'));
INSERT INTO BEJEGYZESEK (FELHASZNALO_ID, cim, leiras, datum)
VALUES(9, 'Bejegyzes  ceme', 'Ez egy teszt bejegyzes leeresa.',  TO_DATE('2024-03-03', 'YYYY-MM-DD'));
INSERT INTO BEJEGYZESEK (FELHASZNALO_ID, cim, leiras, datum)
VALUES(4, 'Bejegyzes  ceme', 'Ez egy teszt bejegyzes leeresa.', TO_DATE('2024-03-04', 'YYYY-MM-DD'));
INSERT INTO BEJEGYZESEK (FELHASZNALO_ID, cim, leiras, datum)
VALUES(1, 'Bejegyzes  ceme', 'Ez egy teszt bejegyzes leeresa.', TO_DATE('2024-03-05', 'YYYY-MM-DD'));
INSERT INTO BEJEGYZESEK (FELHASZNALO_ID, cim, leiras, datum)
VALUES(2, 'Bejegyzes  ceme', 'Ez egy teszt bejegyzes leeresa.', TO_DATE('2024-03-07', 'YYYY-MM-DD'));
INSERT INTO BEJEGYZESEK (FELHASZNALO_ID, cim, leiras, datum)
VALUES(12, 'Bejegyzes  ceme', 'Ez egy teszt bejegyzes leeresa.', TO_DATE('2024-03-08', 'YYYY-MM-DD'));
INSERT INTO BEJEGYZESEK (FELHASZNALO_ID, cim, leiras, datum)
VALUES(24, 'Bejegyzes  ceme', 'Ez egy teszt bejegyzes leeresa.',  TO_DATE('2024-03-09', 'YYYY-MM-DD'));
INSERT INTO BEJEGYZESEK (FELHASZNALO_ID, cim, leiras, datum)
VALUES(15, 'Bejegyzes  ceme', 'Ez egy teszt bejegyzes leeresa.',  TO_DATE('2024-03-10', 'YYYY-MM-DD'));
INSERT INTO BEJEGYZESEK (FELHASZNALO_ID, cim, leiras, datum)
VALUES(26, 'Bejegyzes  ceme', 'Ez egy teszt bejegyzes leeresa.',  TO_DATE('2024-03-11', 'YYYY-MM-DD'));
INSERT INTO BEJEGYZESEK (FELHASZNALO_ID, cim, leiras, datum)
VALUES(17, 'Bejegyzes  ceme', 'Ez egy teszt bejegyzes leeresa.',  TO_DATE('2024-03-12', 'YYYY-MM-DD'));
INSERT INTO BEJEGYZESEK (FELHASZNALO_ID, cim, leiras, datum)
VALUES(28, 'Bejegyzes  ceme', 'Ez egy teszt bejegyzes leeresa.', TO_DATE('2024-03-22', 'YYYY-MM-DD'));
INSERT INTO BEJEGYZESEK (FELHASZNALO_ID, cim, leiras, datum)
VALUES(29, 'Bejegyzes  ceme', 'Ez egy teszt bejegyzes leeresa.', TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO BEJEGYZESEK (FELHASZNALO_ID, cim, leiras, datum)
VALUES(30, 'Bejegyzes  ceme', 'Ez egy teszt bejegyzes leeresa.',TO_DATE('2024-03-24', 'YYYY-MM-DD'));
INSERT INTO BEJEGYZESEK (FELHASZNALO_ID, cim, leiras, datum)
VALUES(11, 'Bejegyzes  ceme', 'Ez egy teszt bejegyzes leeresa.',  TO_DATE('2024-03-11', 'YYYY-MM-DD'));
INSERT INTO BEJEGYZESEK (FELHASZNALO_ID, cim, leiras, datum)
VALUES(2, 'Bejegyzes  ceme', 'Ez egy teszt bejegyzes leeresa.',TO_DATE('2024-03-27', 'YYYY-MM-DD'));
INSERT INTO BEJEGYZESEK (FELHASZNALO_ID, cim, leiras, datum)
VALUES(3, 'Bejegyzes  ceme', 'Ez egy teszt bejegyzes leeresa.',  TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO BEJEGYZESEK (FELHASZNALO_ID, cim, leiras, datum)
VALUES(4, 'Bejegyzes  ceme', 'Ez egy teszt bejegyzes leeresa.',  TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO BEJEGYZESEK (FELHASZNALO_ID, cim, leiras, datum)
VALUES(5, 'Bejegyzes  ceme', 'Ez egy teszt bejegyzes leeresa.',  TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO BEJEGYZESEK (FELHASZNALO_ID, cim, leiras, datum)
VALUES(6, 'Bejegyzes  ceme', 'Ez egy teszt bejegyzes leeresa.', TO_DATE('2024-03-25', 'YYYY-MM-DD'));
INSERT INTO BEJEGYZESEK (FELHASZNALO_ID, cim, leiras, datum)
VALUES(10, 'Bejegyzes  ceme', 'Ez egy teszt bejegyzes leeresa.',TO_DATE('2024-03-24', 'YYYY-MM-DD'));
INSERT INTO BEJEGYZESEK (FELHASZNALO_ID, cim, leiras, datum)
VALUES(6, 'Bejegyzes  ceme', 'Ez egy teszt bejegyzes leeresa.', TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO BEJEGYZESEK (FELHASZNALO_ID, cim, leiras, datum)
VALUES(9, 'Bejegyzes  ceme', 'Ez egy teszt bejegyzes leeresa.', TO_DATE('2024-03-22', 'YYYY-MM-DD'));

INSERT INTO KAPCSOLATOK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, statusz, datum)
VALUES(3, 1, 1, TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO KAPCSOLATOK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, statusz, datum)
VALUES(2, 1, 1, TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO KAPCSOLATOK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, statusz, datum)
VALUES(4, 6, 1, TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO KAPCSOLATOK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, statusz, datum)
VALUES(3,6, 1, TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO KAPCSOLATOK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, statusz, datum)
VALUES(7, 8, 1, TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO KAPCSOLATOK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, statusz, datum)
VALUES(5, 9, 1, TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO KAPCSOLATOK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, statusz, datum)
VALUES(6, 12, 1, TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO KAPCSOLATOK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, statusz, datum)
VALUES(7, 13, 1, TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO KAPCSOLATOK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, statusz, datum)
VALUES(8, 23, 1, TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO KAPCSOLATOK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, statusz, datum)
VALUES(9, 22, 1, TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO KAPCSOLATOK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, statusz, datum)
VALUES(11, 31, 1, TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO KAPCSOLATOK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, statusz, datum)
VALUES(21, 4, 1, TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO KAPCSOLATOK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, statusz, datum)
VALUES(12, 1, 1, TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO KAPCSOLATOK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, statusz, datum)
VALUES(12, 2, 1, TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO KAPCSOLATOK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, statusz, datum)
VALUES(16, 3, 1, TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO KAPCSOLATOK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, statusz, datum)
VALUES(17, 4, 1, TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO KAPCSOLATOK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, statusz, datum)
VALUES(19, 5, 1, TO_DATE('2024-03-23', 'YYYY-MM-DD'));


INSERT INTO UZENETEK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, tartalom, elolvasva, datum)
VALUES
(4, 1, 'Ez egy teszt uzenet.', 0, TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO UZENETEK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, tartalom, elolvasva, datum)
VALUES
(3, 13, 'Ez egy teszt uzenet.', 0, TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO UZENETEK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, tartalom, elolvasva, datum)
VALUES
(2, 24, 'Ez egy teszt uzenet.', 0, TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO UZENETEK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, tartalom, elolvasva, datum)
VALUES
(13, 11, 'Ez egy teszt uzenet.', 0, TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO UZENETEK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, tartalom, elolvasva, datum)
VALUES
(14, 5, 'Ez egy teszt uzenet.', 0, TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO UZENETEK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, tartalom, elolvasva, datum)
VALUES
(15, 2, 'Ez egy teszt uzenet.', 0, TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO UZENETEK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, tartalom, elolvasva, datum)
VALUES
(16, 9, 'Ez egy teszt uzenet.', 0, TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO UZENETEK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, tartalom, elolvasva, datum)
VALUES
(17, 8, 'Ez egy teszt uzenet.', 0, TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO UZENETEK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, tartalom, elolvasva, datum)
VALUES
(28, 7, 'Ez egy teszt uzenet.', 0, TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO UZENETEK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, tartalom, elolvasva, datum)
VALUES
(9, 6, 'Ez egy teszt uzenet.', 0, TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO UZENETEK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, tartalom, elolvasva, datum)
VALUES
(2, 4, 'Ez egy teszt uzenet.', 0, TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO UZENETEK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, tartalom, elolvasva, datum)
VALUES
(17, 14, 'Ez egy teszt uzenet.', 0, TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO UZENETEK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, tartalom, elolvasva, datum)
VALUES
(2, 3, 'Ez egy teszt uzenet.', 0, TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO UZENETEK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, tartalom, elolvasva, datum)
VALUES
(23, 2, 'Ez egy teszt uzenet.', 0, TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO UZENETEK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, tartalom, elolvasva, datum)
VALUES
(25, 11, 'Ez egy teszt uzenet.', 0, TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO UZENETEK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, tartalom, elolvasva, datum)
VALUES
(1, 14, 'Ez egy teszt uzenet.', 0, TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO UZENETEK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, tartalom, elolvasva, datum)
VALUES
(7, 1, 'Ez egy teszt uzenet.', 0, TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO UZENETEK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, tartalom, elolvasva, datum)
VALUES
(7, 27, 'Ez egy teszt uzenet.', 0, TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO UZENETEK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, tartalom, elolvasva, datum)
VALUES
(8, 2, 'Ez egy teszt uzenet.', 0, TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO UZENETEK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, tartalom, elolvasva, datum)
VALUES
(26, 3, 'Ez egy teszt uzenet.', 0, TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO UZENETEK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, tartalom, elolvasva, datum)
VALUES
(7, 17, 'Ez egy teszt uzenet.', 0, TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO UZENETEK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, tartalom, elolvasva, datum)
VALUES
(6, 4, 'Ez egy teszt uzenet.', 0, TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO UZENETEK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, tartalom, elolvasva, datum)
VALUES
(5, 18, 'Ez egy teszt uzenet.', 0, TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO UZENETEK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, tartalom, elolvasva, datum)
VALUES
(22, 7, 'Ez egy teszt uzenet.', 0, TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO UZENETEK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, tartalom, elolvasva, datum)
VALUES
(23, 18, 'Ez egy teszt uzenet.', 0, TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO UZENETEK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, tartalom, elolvasva, datum)
VALUES
(12, 19, 'Ez egy teszt uzenet.', 0, TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO UZENETEK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, tartalom, elolvasva, datum)
VALUES
(11, 10, 'Ez egy teszt uzenet.', 0, TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO UZENETEK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, tartalom, elolvasva, datum)
VALUES
(10, 12, 'Ez egy teszt uzenet.', 0, TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO UZENETEK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, tartalom, elolvasva, datum)
VALUES
(19, 13, 'Ez egy teszt uzenet.', 0, TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO UZENETEK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, tartalom, elolvasva, datum)
VALUES
(18, 14, 'Ez egy teszt uzenet.', 0, TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO UZENETEK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, tartalom, elolvasva, datum)
VALUES
(17, 15, 'Ez egy teszt uzenet.', 0, TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO UZENETEK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, tartalom, elolvasva, datum)
VALUES
(15, 16, 'Ez egy teszt uzenet.', 0, TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO UZENETEK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, tartalom, elolvasva, datum)
VALUES
(5, 17, 'Ez egy teszt uzenet.', 0, TO_DATE('2024-03-23', 'YYYY-MM-DD'));
INSERT INTO UZENETEK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, tartalom, elolvasva, datum)
VALUES
(4, 18, 'Ez egy teszt uzenet.', 0, TO_DATE('2024-03-23', 'YYYY-MM-DD'));

INSERT INTO JELENTESEK (FELHASZNALO_ID, kire, indok, leiras)
VALUES
(4, 'user1', 'SPAM', 'Ez a felhasznele sok keretlen reklemot keld.');
INSERT INTO JELENTESEK (FELHASZNALO_ID, kire, indok, leiras)
VALUES
(1, 'user2', 'SPAM', 'Ez a felhasznele sok keretlen reklemot keld.');
INSERT INTO JELENTESEK (FELHASZNALO_ID, kire, indok, leiras)
VALUES
(16, 'user3', 'SPAM', 'Ez a felhasznele sok keretlen reklemot keld.');
INSERT INTO JELENTESEK (FELHASZNALO_ID, kire, indok, leiras)
VALUES
(21, 'user4', 'SPAM', 'Ez a felhasznele sok keretlen reklemot keld.');
INSERT INTO JELENTESEK (FELHASZNALO_ID, kire, indok, leiras)
VALUES
(19, 'user5', 'SPAM', 'Ez a felhasznele sok keretlen reklemot keld.');
INSERT INTO JELENTESEK (FELHASZNALO_ID, kire, indok, leiras)
VALUES
(29, 'user6', 'SPAM', 'Ez a felhasznele sok keretlen reklemot keld.');
INSERT INTO JELENTESEK (FELHASZNALO_ID, kire, indok, leiras)
VALUES
(13, 'user7', 'SPAM', 'Ez a felhasznele sok keretlen reklemot keld.');
INSERT INTO JELENTESEK (FELHASZNALO_ID, kire, indok, leiras)
VALUES
(5, 'user18', 'SPAM', 'Ez a felhasznele sok keretlen reklemot keld.');


CREATE OR REPLACE TRIGGER jog_giver
    AFTER INSERT ON
    FELHASZNALO
    FOR EACH ROW
    BEGIN
    INSERT INTO JOGOK (FELHASZNALO_ID, moderator, admin, felfuggesztett, tiltott) VALUES (:NEW.ID,0, 0, 0, 0);
    END;
/

CREATE OR REPLACE TRIGGER notification_trigger
AFTER INSERT ON KAPCSOLATOK
FOR EACH ROW
DECLARE
    v_k_user_id NUMBER;
    v_f_user_id NUMBER;
BEGIN
    v_k_user_id := :NEW.K_FELHASZNALO_ID;
    v_f_user_id := :NEW.F_FELHASZNALO_ID;

    INSERT INTO ERTESITESEK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, elolvasva, tipus, datum)
    VALUES (v_k_user_id, v_f_user_id, 0, 'jelőlés', SYSDATE);
END;
/