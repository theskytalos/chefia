DROP DATABASE IF EXISTS chefia_db;

CREATE DATABASE chefia_db;

USE chefia_db;
                         
CREATE TABLE menu_categories (menu_categories_id	INT PRIMARY KEY AUTO_INCREMENT,
			                  menu_categories_text	VARCHAR(128));
                         
CREATE TABLE menu_items (menu_items_id			INT PRIMARY KEY AUTO_INCREMENT,
			             menu_items_name		VARCHAR(128),
                         menu_items_description VARCHAR(1024),
                         menu_items_price		DECIMAL (10, 2),
                         menu_items_stock		INT,
                         menu_categories_id_fk	INT,
                         FOREIGN KEY (menu_categories_id_fk) REFERENCES menu_categories (menu_categories_id));
                         
CREATE TABLE menu_images (menu_images_id	INT PRIMARY KEY AUTO_INCREMENT,
			              menu_images_path	VARCHAR(1024),
                          menu_items_id_fk	INT,
                          FOREIGN KEY (menu_items_id_fk) REFERENCES menu_items (menu_items_id));
                          
CREATE TABLE restaurant_tables (restaurant_tables_id	INT PRIMARY KEY AUTO_INCREMENT,
								restaurant_tables_alias	VARCHAR(16));
                          
CREATE TABLE requests (requests_id			INT PRIMARY KEY AUTO_INCREMENT,
					   requests_datetime	DATETIME,
                       requests_total_cost	DECIMAL(10, 2),
                       requests_pay_method	INT,
                       requests_table		INT);
                      
CREATE TABLE requests_items (requests_id_fk			INT,
							 menu_items_id_fk		INT,
                             menu_items_quantity	INT,
                             menu_items_note        TEXT,
                             FOREIGN KEY (requests_id_fk) REFERENCES requests (requests_id),
                             FOREIGN KEY (menu_items_id_fk) REFERENCES menu_items (menu_items_id));
                            
CREATE TABLE states (states_id 					INT PRIMARY KEY AUTO_INCREMENT,
					 states_text 				TEXT,
                     states_next_state_id_fk	INT NULL,
                     menu_categories_id_fk		INT NULL,
					 menu_items_id_fk			INT NULL,
                     FOREIGN KEY (states_next_state_id_fk) REFERENCES states (states_id),
                     FOREIGN KEY (menu_categories_id_fk) REFERENCES menu_categories (menu_categories_id),
					 FOREIGN KEY (menu_items_id_fk) REFERENCES menu_items (menu_items_id));
                     
CREATE TABLE alternatives (alternatives_id					INT PRIMARY KEY AUTO_INCREMENT,
						   alternatives_text				TEXT,
                           alternatives_next_state_id_fk	INT,
                           states_id_fk						INT,
                           FOREIGN KEY (alternatives_next_state_id_fk) REFERENCES states (states_id),
                           FOREIGN KEY (states_id_fk) REFERENCES states (states_id));
                            
CREATE TABLE general_settings (general_settings_key		VARCHAR(32) PRIMARY KEY,
                               general_settings_value	VARCHAR(1024));
 