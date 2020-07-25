DROP DATABASE IF EXISTS chefia_db;

CREATE DATABASE chefia_db
	CHARACTER SET 'utf8mb4'
	COLLATE 'utf8mb4_unicode_ci';

USE chefia_db;

CREATE TABLE contexts (contexts_id		INT PRIMARY KEY AUTO_INCREMENT,
					   contexts_name	VARCHAR(256));
                       
CREATE TABLE interactions (interactions_id 		INT PRIMARY KEY AUTO_INCREMENT,
						   interactions_content	TEXT,
                           contexts_id_fk		INT,
                           FOREIGN KEY (contexts_id_fk) REFERENCES contexts (contexts_id));
                           
CREATE TABLE transitions_types (transitions_types_id	INT PRIMARY KEY AUTO_INCREMENT,
								transitions_types_name	VARCHAR(64));
                           
CREATE TABLE interactions_transitions (interactions_transitions_id		INT PRIMARY KEY AUTO_INCREMENT,
									   interactions_transitions_from	INT,
                                       interactions_transitions_to		INT,
                                       transitions_types_id_fk			INT,
                                       interactions_transitions_value	VARCHAR(512) NULL,
                                       FOREIGN KEY (interactions_transitions_from) REFERENCES interactions (interactions_id),
                                       FOREIGN KEY (interactions_transitions_to) REFERENCES interactions (interactions_id),
                                       FOREIGN KEY (transitions_types_id_fk) REFERENCES transitions_types (transitions_types_id));
                                       
CREATE TABLE items 	(items_id			INT PRIMARY KEY AUTO_INCREMENT,
					 items_name			VARCHAR(128),
					 items_description 	VARCHAR(1024) NULL,
					 items_price		DECIMAL (10, 2) NULL,
					 items_stock		INT NULL,
                     interactions_id_fk	INT,
                     FOREIGN KEY (interactions_id_fk) REFERENCES interactions (interactions_id));
                     
CREATE TABLE items_images (items_images_id	INT PRIMARY KEY AUTO_INCREMENT,
						   items_images_path	VARCHAR(4096),
                           items_id_fk			INT,
                           FOREIGN KEY (items_id_fk) REFERENCES items (items_id));
                           
CREATE TABLE shops (shops_id			INT PRIMARY KEY AUTO_INCREMENT,
					shops_name			VARCHAR(256),
                    shops_description	VARCHAR(1024),
					shops_specialty		VARCHAR(128),
                    shops_logo_image	VARCHAR(4096),
                    shops_cep			VARCHAR(9),
					shops_uf			CHAR(2),
					shops_city			VARCHAR(1024),
					shops_neighbourhood VARCHAR(2048),
					shops_street		VARCHAR(2048),
					shops_number 		INT,
					shops_complement	VARCHAR(2048),
					shops_reference		VARCHAR(2048),
                    shops_map_url		TEXT,
                    interactions_id_fk	INT,
					FOREIGN KEY (interactions_id_fk) REFERENCES interactions (interactions_id));
                    
CREATE TABLE shops_phones (shops_phones_id		INT PRIMARY KEY AUTO_INCREMENT,
						   shops_phones_type	INT,
						   shops_phones_number	VARCHAR(11),
                           shops_id_fk			INT,
                           FOREIGN KEY (shops_id_fk) REFERENCES shops (shops_id));
                     
CREATE TABLE requests (requests_id				INT PRIMARY KEY AUTO_INCREMENT,
					   requests_datetime		DATETIME,
                       requests_total_cost		DECIMAL(10, 2),
                       requests_pay_method		INT,
                       requests_change_for		DECIMAL(10, 2),
                       requests_cep				VARCHAR(9),
                       requests_uf				CHAR(2),
                       requests_city			VARCHAR(1024),
                       requests_neighbourhood 	VARCHAR(2048),
                       requests_street			VARCHAR(2048),
                       requests_number 			INT,
                       requests_complement		VARCHAR(2048),
                       requests_reference		VARCHAR(2048),
                       requests_status			INT);
                       
CREATE TABLE requests_items (requests_id_fk		INT,
							 items_id_fk		INT,
                             items_quantity		INT,
                             items_note        	TEXT,
                             FOREIGN KEY (requests_id_fk) REFERENCES requests (requests_id),
                             FOREIGN KEY (items_id_fk) REFERENCES items (items_id));
                             
CREATE TABLE sugestions (sugestions_id			INT PRIMARY KEY AUTO_INCREMENT,
						 sugestions_datetime 	DATETIME,
						 sugestions_text		VARCHAR(1024));
                             
CREATE TABLE general_settings (general_settings_key		VARCHAR(64) PRIMARY KEY,
                               general_settings_value	VARCHAR(4096));
                               
-- Mandatory Records

INSERT INTO general_settings (general_settings_key, general_settings_value) VALUES ('franchise_name', '');
INSERT INTO general_settings (general_settings_key, general_settings_value) VALUES ('franchise_image', '');

INSERT INTO transitions_types (transitions_types_name) VALUES ('button');
INSERT INTO transitions_types (transitions_types_name) VALUES ('auto');
INSERT INTO transitions_types (transitions_types_name) VALUES ('timeout');
INSERT INTO transitions_types (transitions_types_name) VALUES ('add_to_cart');
INSERT INTO transitions_types (transitions_types_name) VALUES ('request_sent');
INSERT INTO transitions_types (transitions_types_name) VALUES ('request_being_made');
INSERT INTO transitions_types (transitions_types_name) VALUES ('request_received');
INSERT INTO transitions_types (transitions_types_name) VALUES ('send_sugestion');