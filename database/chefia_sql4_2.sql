DROP DATABASE IF EXISTS chefia_db;

CREATE DATABASE chefia_db;

USE chefia_db;

CREATE TABLE interactions (interactions_id 		INT PRIMARY KEY AUTO_INCREMENT,
						   interactions_content	TEXT);
                           
CREATE TABLE transitions_types (transitions_types_id	INT PRIMARY KEY AUTO_INCREMENT,
								transitions_types_name	VARCHAR(16));
                           
CREATE TABLE interactions_transitions (interactions_transitions_id		INT PRIMARY KEY AUTO_INCREMENT,
									   interactions_transitions_from	INT,
                                       interactions_transitions_to		INT,
                                       transitions_types_id_fk			INT,
                                       interactions_transitions_value	VARCHAR(512),
                                       FOREIGN KEY (interactions_transitions_from) REFERENCES interactions (interactions_id),
                                       FOREIGN KEY (interactions_transitions_to) REFERENCES interactions (interactions_id),
                                       FOREIGN KEY (transitions_types_id_fk) REFERENCES transitions_types (transitions_types_id));