DROP DATABASE IF EXISTS chefia_db;

CREATE DATABASE chefia_db;

USE chefia_db;

CREATE TABLE contexts (contexts_id		INT PRIMARY KEY AUTO_INCREMENT,
					   contexts_name	VARCHAR(256));
                       
CREATE TABLE interactions (interactions_id 		INT PRIMARY KEY AUTO_INCREMENT,
						   interactions_text	TEXT,
                           contexts_id_fk		INT,
                           FOREIGN KEY (contexts_id_fk) REFERENCES contexts (contexts_id));
                           
CREATE TABLE alternatives (alternatives_id		INT PRIMARY KEY AUTO_INCREMENT,
						   alternatives_text	VARCHAR(512),
                           interactions_id_fk	INT,
                           FOREIGN KEY (interactions_id_fk) REFERENCES interactions (interactions_id));

CREATE TABLE transitions_types (transitions_types_id	INT PRIMARY KEY AUTO_INCREMENT,
								transitions_types_name	VARCHAR(16));
                           
CREATE TABLE interactions_transitions (interactions_transitions_id 		INT PRIMARY KEY AUTO_INCREMENT,
                                       interactions_transitions_value	VARCHAR(128),
                                       interactions_transitions_from	INT,
                                       interactions_transitions_to		INT,
                                       transitions_types_id_fk			INT,
                                       FOREIGN KEY (interactions_transitions_from) REFERENCES interactions (interactions_id),
                                       FOREIGN KEY (interactions_transitions_to) REFERENCES interactions (interactions_id),
                                       FOREIGN KEY (transitions_types_id_fk) REFERENCES transitions_types (transitions_types_id));