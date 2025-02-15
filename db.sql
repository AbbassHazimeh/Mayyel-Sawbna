-- Drop existing tables if they exist
DROP TABLE IF EXISTS MAY_HAVE;
DROP TABLE IF EXISTS CUSTOMER;
DROP TABLE IF EXISTS HOTEL;
DROP TABLE IF EXISTS BOOKING;
DROP TABLE IF EXISTS PAYMENT;
DROP TABLE IF EXISTS ROOM_;

-- Create PAYMENT table
CREATE TABLE PAYMENT (
   PAYMENT_ID INT AUTO_INCREMENT NOT NULL,
   AMOUNT DECIMAL(10,2),
   PAYMENT_DATE DATETIME,
   PAYMENT_METHOD VARCHAR(100),
   PAYMENT_STATUS VARCHAR(100),
   PRIMARY KEY (PAYMENT_ID)
) ENGINE=InnoDB;

-- Create HOTEL table (ROOM_ID foreign key removed)
CREATE TABLE HOTEL (
   HOTEL_ID INT AUTO_INCREMENT NOT NULL,
   HOTEL_NAME VARCHAR(100),
   LOCATION VARCHAR(100),
   CONTACT_NUMBER VARCHAR(100),
   TOTAL_ROOMS INT,
   HOTEL_DESCRIPTION TEXT,
   PRIMARY KEY (HOTEL_ID)
) ENGINE=InnoDB;

-- Create ROOM_ table (HOTEL_ID added as a foreign key)
CREATE TABLE ROOM_ (
   ROOM_ID INT AUTO_INCREMENT NOT NULL,
   HOTEL_ID INT NOT NULL,
   ROOM_TYPE VARCHAR(100),
   ROOM_PRICE DECIMAL(10,2),
   CAPACITY INT,
   PRIMARY KEY (ROOM_ID),
   FOREIGN KEY (HOTEL_ID) REFERENCES HOTEL(HOTEL_ID) ON DELETE CASCADE
) ENGINE=InnoDB;
ALTER TABLE room_ DROP COLUMN ROOM_TYPE;
-- Create CUSTOMER table
CREATE TABLE CUSTOMER (
   CUSTOMER_ID INT AUTO_INCREMENT NOT NULL,
   FIRST_NAME VARCHAR(50),
   LAST_NAME VARCHAR(50),
   EMAIL VARCHAR(100),
   PASSWORD VARCHAR(100), 
   PHONE_NUMBER VARCHAR(100),
   ADDRESS VARCHAR(255),
   PRIMARY KEY (CUSTOMER_ID)
) ENGINE=InnoDB;

-- Create BOOKING table
CREATE TABLE BOOKING (
   BOOKING_ID INT AUTO_INCREMENT NOT NULL,
   PAYMENT_ID INT NOT NULL,
   CUSTOMER_ID INT NOT NULL,
   CHECK_IN_DATE DATETIME,
   CHECK_OUT_DATE DATETIME,
   NUMBER_OF_GUESTS INT,
   BOOKING_STATUS VARCHAR(100),
   PRIMARY KEY (BOOKING_ID),
   FOREIGN KEY (PAYMENT_ID) REFERENCES PAYMENT(PAYMENT_ID),
   FOREIGN KEY (CUSTOMER_ID) REFERENCES CUSTOMER(CUSTOMER_ID)
) ENGINE=InnoDB;

-- Create MAY_HAVE table
CREATE TABLE MAY_HAVE (
   ROOM_ID INT NOT NULL,
   BOOKING_ID INT NOT NULL,
   ROOM_BOOKING_ID INT AUTO_INCREMENT NOT NULL,
   PRIMARY KEY (ROOM_BOOKING_ID),
   FOREIGN KEY (ROOM_ID) REFERENCES ROOM_(ROOM_ID),
   FOREIGN KEY (BOOKING_ID) REFERENCES BOOKING(BOOKING_ID)
) ENGINE=InnoDB;

-- Create indexes
CREATE INDEX idx_room_hotel ON ROOM_(HOTEL_ID);
CREATE INDEX idx_booking_customer ON BOOKING(PAYMENT_ID);
CREATE INDEX idx_may_have_room ON MAY_HAVE(ROOM_ID);
CREATE INDEX idx_may_have_booking ON MAY_HAVE(BOOKING_ID);

-- Triggers
DELIMITER $$

CREATE TRIGGER check_email_exists_before_insert 
BEFORE INSERT ON CUSTOMER
FOR EACH ROW
BEGIN
    DECLARE email_count INT;
    
    -- Check if the email already exists
    SELECT COUNT(*) INTO email_count FROM CUSTOMER WHERE EMAIL = NEW.EMAIL;
    
    IF email_count > 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Email already exists';
    END IF;
END $$

DELIMITER ;


--Insertions in the tables
INSERT INTO hotel (HOTEL_ID, HOTEL_NAME, LOCATION, CONTACT_NUMBER, TOTAL_ROOMS, HOTEL_DESCRIPTION)
VALUES
(1, 'Portaluna Hotel & Resort', 'Jounieh Bay', '+961777888', '4', 'Featuring an outdoor swimming pool and open-plan garden fitness center, Portaluna Hotel & Resort offers rooms with sweeping views over the bay of Jounieh or of the floodlit Harissa statue. The hotel offers full board included in the price with a healthy buffet serving breakfast, lunch and dinner. Free WiFi is available throughout the entire property. All rooms are air-conditioned and feature a modern interior. They include a mini-bar and a flat-screen satellite TV. Some rooms have a spa bath in front of large windows, which offer stunning sea views.');
INSERT INTO hotel (HOTEL_ID, HOTEL_NAME, LOCATION, CONTACT_NUMBER, TOTAL_ROOMS, HOTEL_DESCRIPTION)
VALUES
(2, 'Markazia Suites', 'Central Business District, Beirut', '+96170777888', '4', 'Enjoy a comfortable stay at the elegant Markazia Suites, conveniently located in the Central Business District of Beirut, within a walking distance of major attractions. Markazia Suites provide comfort with ample living space and kitchen facilities. There is a mobile business center for work needs. You can enjoy Authentic Punjabi Cuisine at our Indian Restaurant Jaipur as well as fine Lebanese cuisine.');
INSERT INTO hotel (HOTEL_ID, HOTEL_NAME, LOCATION, CONTACT_NUMBER, TOTAL_ROOMS, HOTEL_DESCRIPTION)
VALUES
(3, 'Anoor Studios & Apartments', 'Gemmayze, Beirut', '+96170777888', '4', 'Anoor Studios & Apartments in Gemmayze offers accommodations in Beirut, 4.5 miles from Pigeon Rock and 12 miles from Jeita Grotto. The property is around 14 miles from Casino du Liban, 16 miles from Our Lady of Lebanon, and 24 miles from Byblos Archeological Site. Parking on-site is available, and the apartment features bike rental for guests who want to explore the surrounding area.');
INSERT INTO hotel (HOTEL_ID, HOTEL_NAME, LOCATION, CONTACT_NUMBER, TOTAL_ROOMS, HOTEL_DESCRIPTION)
VALUES
(4, 'Radisson BLU Martinez Hotel', 'Central Beirut', '+96170777888', '4', 'In central Beirut, the Radisson BLU Martinez Hotel features spacious rooms with free Wi-Fi and a spa center featuring an indoor swimming pool, hot tub, sauna and gym. All of the air-conditioned rooms at Radisson BLU are bright and have soft lighting. Each room comes equipped with a satellite flat-screen TV and tea/coffee maker. Room service is available 24/7.');
INSERT INTO hotel (HOTEL_ID, HOTEL_NAME, LOCATION, CONTACT_NUMBER, TOTAL_ROOMS, HOTEL_DESCRIPTION)
VALUES
(5, 'voco Beirut Central District by IHG', 'Beirut', '+96170777888', '4', 'Located in Beirut, a 15-minute walk from Gemayzeh Street (Rue Gouraud), voco Beirut Central District by IHG provides accommodations with a seasonal outdoor swimming pool, private parking, a restaurant and a bar. This 5-star hotel offers a concierge service and luggage storage space. The property has a 24-hour front desk, airport transportation, room service and free WiFi throughout the property.');
INSERT INTO hotel (HOTEL_ID, HOTEL_NAME, LOCATION, CONTACT_NUMBER, TOTAL_ROOMS, HOTEL_DESCRIPTION)
VALUES
(6, 'Sky Suites', 'Beirut City Center', '+96170777888', '4', 'Sky Suites offers modern accommodations with free Wi-Fi and a kitchen in Beirut’s city center. It has an outdoor pool and a gym. The air-conditioned suites and studios at Sky open onto a balcony. Each comes with an open-plan living room with a sofa and a satellite TV with a DVD player. There is a dining table, and a microwave is in the well-equipped kitchen.');
INSERT INTO hotel (HOTEL_ID, HOTEL_NAME, LOCATION, CONTACT_NUMBER, TOTAL_ROOMS, HOTEL_DESCRIPTION)
VALUES
(7, 'Phenicia Residence', 'Beirut', '+96170777888', '4', 'The accommodations come with a satellite flat-screen TV. Some units include a seating area and/or balcony. A dishwasher, an oven, and a microwave are also provided. Each unit has a private bathroom with a bath or shower. Towels are offered. Hamra nightlife is 0.8 mi from Phenicia Residence, while Gemayzeh Street (Rue Gouraud) is 1.2 mi away. The nearest airport is Rafic Hariri Airport, 5 mi from Phenicia Residence. Private parking is available on site.');
INSERT INTO hotel (HOTEL_ID, HOTEL_NAME, LOCATION, CONTACT_NUMBER, TOTAL_ROOMS, HOTEL_DESCRIPTION)
VALUES
(8, 'Le Grand Chalet Zaarour', 'Zaarour', '+96170777888', '4', 'Le Grand Chalet Zaarour is located in Zaarour, just 28 mi from Beirut and 50 mi from Jounieh. Guests can enjoy the on-site restaurant. Each room has a flat-screen TV with satellite channels. Some rooms include a sitting area to relax in after a busy day. Certain rooms have views of the mountains or garden and pool. All rooms are fitted with a private bathroom fitted with a shower glass. For your comfort, you will find bathrobes and slippers, including free amenities upon arrival and Mini Bar service.');

--insertion of rooms
INSERT INTO room (ROOM_ID, HOTEL_ID, ROOM_PRICE, CAPACITY) VALUES
-- Rooms for Hotel 1 (Portaluna Hotel & Resort)
(1, 1, 100, 2),
(2, 1, 150, 3),
(3, 1, 200, 4),
(4, 1, 250, 5),

-- Rooms for Hotel 2 (Markazia Suites)
(5, 2, 120, 2),
(6, 2, 170, 3),
(7, 2, 220, 4),
(8, 2, 270, 5),

-- Rooms for Hotel 3 (Anoor Studios & Apartments)
(9, 3, 90, 2),
(10, 3, 140, 3),
(11, 3, 190, 4),
(12, 3, 240, 5),

-- Rooms for Hotel 4 (Radisson BLU Martinez Hotel)
(13, 4, 130, 2),
(14, 4, 180, 3),
(15, 4, 230, 4),
(16, 4, 280, 5),

-- Rooms for Hotel 5 (voco Beirut Central District by IHG)
(17, 5, 110, 2),
(18, 5, 160, 3),
(19, 5, 210, 4),
(20, 5, 260, 5),

-- Rooms for Hotel 6 (Sky Suites)
(21, 6, 95, 2),
(22, 6, 145, 3),
(23, 6, 195, 4),
(24, 6, 245, 5),

-- Rooms for Hotel 7 (Phenicia Residence)
(25, 7, 125, 2),
(26, 7, 175, 3),
(27, 7, 225, 4),
(28, 7, 275, 5),

-- Rooms for Hotel 8 (Le Grand Chalet Zaarour)
(29, 8, 105, 2),
(30, 8, 155, 3),
(31, 8, 205, 4),
(32, 8, 255, 5);
