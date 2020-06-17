DROP DATABASE IF EXISTS chefia_db;

CREATE DATABASE chefia_db;

USE chefia_db;

CREATE TABLE contexts (contexts_id		INT PRIMARY KEY AUTO_INCREMENT,
					   contexts_name	VARCHAR(256));
                       
CREATE TABLE transitions_types (transitions_types_id	INT PRIMARY KEY AUTO_INCREMENT,
								transitions_types_name	VARCHAR(16));
                       
CREATE TABLE contexts_transitions (contexts_transitions_id 			INT PRIMARY KEY AUTO_INCREMENT,
								   contexts_transitions_from 		INT,
                                   contexts_transitions_to			INT,
                                   transitions_types_id_fk			INT,
                                   interactions_transitions_value	VARCHAR(512),
                                   FOREIGN KEY (contexts_transitions_from) REFERENCES contexts (contexts_id),
                                   FOREIGN KEY (contexts_transitions_to) REFERENCES contexts (contexts_id),
                                   FOREIGN KEY (transitions_types_id_fk) REFERENCES transitions_types (transitions_types_id));