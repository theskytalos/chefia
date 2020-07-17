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
						 sugestions_datetime	DATETIME,
						 sugestions_text		VARCHAR(1024));
                             
CREATE TABLE general_settings (general_settings_key		VARCHAR(64) PRIMARY KEY,
                               general_settings_value	VARCHAR(4096));
                               
-- Mandatory Records

INSERT INTO general_settings (general_settings_key, general_settings_value) VALUES ('franchise_name', 'Pepê Gourmet');
INSERT INTO general_settings (general_settings_key, general_settings_value) VALUES ('franchise_image', 'https://www.uairango.com/imagens/img_estabelecimentos/95d7c36981f4541ee29f245dc5765028.png');

INSERT INTO transitions_types (transitions_types_name) VALUES ('button');
INSERT INTO transitions_types (transitions_types_name) VALUES ('auto');
INSERT INTO transitions_types (transitions_types_name) VALUES ('timeout');
INSERT INTO transitions_types (transitions_types_name) VALUES ('add_to_cart');
INSERT INTO transitions_types (transitions_types_name) VALUES ('request_sent');
INSERT INTO transitions_types (transitions_types_name) VALUES ('request_being_made');
INSERT INTO transitions_types (transitions_types_name) VALUES ('request_received');
INSERT INTO transitions_types (transitions_types_name) VALUES ('send_sugestion');

-- Replication of Sent Example --

INSERT INTO contexts (contexts_name) VALUES ('Saudações');
INSERT INTO contexts (contexts_name) VALUES ('Promoções');
INSERT INTO contexts (contexts_name) VALUES ('Cardápio');
INSERT INTO contexts (contexts_name) VALUES ('Solicitar Pedido');
INSERT INTO contexts (contexts_name) VALUES ('Avaliação');
INSERT INTO contexts (contexts_name) VALUES ('Despedida');

INSERT INTO interactions (interactions_content, contexts_id_fk) VALUES ('Seja bem-vindo ao __FRANCHISE_NAME__', 1);
INSERT INTO interactions (interactions_content, contexts_id_fk) VALUES ('Em que posso ajudar?', 1);

INSERT INTO interactions (interactions_content, contexts_id_fk) VALUES ('Desculpe, não temos promoções no momento.', 2);

INSERT INTO interactions (interactions_content, contexts_id_fk) VALUES ('Cardápio', 3);
INSERT INTO interactions (interactions_content, contexts_id_fk) VALUES ('Aqui estão nossas opções de hamburguer', 3);
INSERT INTO interactions (interactions_content, contexts_id_fk) VALUES ('__ITEM__ adicionado no carrinho!', 3);
INSERT INTO interactions (interactions_content, contexts_id_fk) VALUES ('Aqui está o cardápio novamente', 3);
INSERT INTO interactions (interactions_content, contexts_id_fk) VALUES ('Qual tipo de bebida?', 3);
INSERT INTO interactions (interactions_content, contexts_id_fk) VALUES ('Segue nossas opções de refrigerante', 3);
INSERT INTO interactions (interactions_content, contexts_id_fk) VALUES ('__ITEM__ adicionado no carrinho!', 3);

INSERT INTO interactions (interactions_content, contexts_id_fk) VALUES ('Seu pedido está sendo enviado...', 4);
INSERT INTO interactions (interactions_content, contexts_id_fk) VALUES ('Seu pedido foi efetuado com sucesso', 4);
INSERT INTO interactions (interactions_content, contexts_id_fk) VALUES ('Seu pedido está sendo preparado', 4);
INSERT INTO interactions (interactions_content, contexts_id_fk) VALUES ('Seu pedido chegou!', 4);

INSERT INTO interactions (interactions_content, contexts_id_fk) VALUES ('Deseja avaliar o restaurante?', 5);
INSERT INTO interactions (interactions_content, contexts_id_fk) VALUES ('Como avalia o restaurante de modo geral?', 5);

INSERT INTO interactions (interactions_content, contexts_id_fk) VALUES ('O restaurante X agradece a sua visita!', 6);
INSERT INTO interactions (interactions_content, contexts_id_fk) VALUES ('Volte sempre!', 6);

INSERT INTO interactions (interactions_content, contexts_id_fk) VALUES ('Desculpe, não temos nenhuma opção de porção no momento.', 3);
INSERT INTO interactions (interactions_content, contexts_id_fk) VALUES ('Desculpe, não temos nenhuma opção de água no momento.', 3);
INSERT INTO interactions (interactions_content, contexts_id_fk) VALUES ('Desculpe, não temos nenhuma opção de suco no momento.', 3);

INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (1, 2, 2, NULL);

INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (2, 3, 1, 'Promoções');
INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (2, 4, 1, 'Cardápio');

INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (3, 2, 1, 'Voltar');

INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (4, 5, 1, 'Hamburgueres');
INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (4, 8, 1, 'Bebidas');
INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (4, 19, 1, 'Porções');
INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (4, 2, 1, 'Voltar');

INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (5, 7, 1, 'Voltar às opções anteriores');
INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (5, 6, 4, NULL);

INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (6, 5, 1, 'Escolher outro hambúrguer');
INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (6, 7, 1, 'Voltar ao cardápio');
INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (6, 11, 1, 'Finalizar Pedido');

INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (7, 4, 2, NULL);

INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (8, 20, 1, 'Água');
INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (8, 21, 1, 'Suco');
INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (8, 9, 1, 'Refrigerantes');
INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (8, 4, 1, 'Voltar');

INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (9, 8, 1, 'Voltar às bebidas');
INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (9, 7, 1, 'Voltar ao cardápio');
INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (9, 10, 4, NULL);

INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (10, 9, 1, 'Voltar aos refrigerantes');
INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (10, 8, 1, 'Voltar às bebidas');
INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (10, 7, 1, 'Voltar ao cardápio');
INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (10, 11, 1, 'Finalizar Pedido');

INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (11, 12, 5, NULL);

INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (12, 13, 6, NULL);

INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (13, 14, 7, NULL);

INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (14, 15, 2, NULL);

INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (15, 16, 1, 'Sim');
INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (15, 17, 1, 'Não');

INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (17, 18, 2, NULL);

INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (19, 4, 1, 'Voltar');
INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (20, 8, 1, 'Voltar');
INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (21, 8, 1, 'Voltar');

INSERT INTO items (items_name, items_description, items_price, items_stock, interactions_id_fk) VALUES ('X-Burguer', 'Pão, Hamburguer, Queijo, Alface, Tomate', '12.99', NULL, 5);
INSERT INTO items (items_name, items_description, items_price, items_stock, interactions_id_fk) VALUES ('X-Bacon', 'Pão, Hamburguer, Queijo, Bacon, Alface, Tomate', '14.99', NULL, 5);
INSERT INTO items (items_name, items_description, items_price, items_stock, interactions_id_fk) VALUES ('X-Salada', 'Pão, Hamburguer, Alface, Tomate', '9.99', NULL, 5);

INSERT INTO items (items_name, items_description, items_price, items_stock, interactions_id_fk) VALUES ('Coca-Cola', NULL, '4.50', 800, 9);
INSERT INTO items (items_name, items_description, items_price, items_stock, interactions_id_fk) VALUES ('Fanta Uva', NULL, '3.50', 500, 9);
INSERT INTO items (items_name, items_description, items_price, items_stock, interactions_id_fk) VALUES ('Kuat', NULL, '3.50', 500, 9);