UPDATE general_settings SET general_settings_value = 'Assistência São João del-Rei' WHERE general_settings_key = 'franchise_name';

INSERT INTO contexts (contexts_name) VALUES ('Saudações');
INSERT INTO contexts (contexts_name) VALUES ('Assistência');
INSERT INTO contexts (contexts_name) VALUES ('Estabelecimentos');
INSERT INTO contexts (contexts_name) VALUES ('Sugestão');
INSERT INTO contexts (contexts_name) VALUES ('Avaliação');
INSERT INTO contexts (contexts_name) VALUES ('Despedida');

INSERT INTO interactions (interactions_content, contexts_id_fk) VALUES ('Seja bem-vindo à __FRANCHISE_NAME__', 1); -- 1

INSERT INTO interactions (interactions_content, contexts_id_fk) VALUES ('Você quer ver as categorias ou buscar um estabelecimento/profissional?', 2); -- 2
INSERT INTO interactions (interactions_content, contexts_id_fk) VALUES ('Aqui estão as categorias', 2); -- 3
INSERT INTO interactions (interactions_content, contexts_id_fk) VALUES ('Função não implementada.', 2); -- 4

INSERT INTO interactions (interactions_content, contexts_id_fk) VALUES ('Desculpe, não temos nenhuma recomendação para advogados.', 3); -- 5
INSERT INTO interactions (interactions_content, contexts_id_fk) VALUES ('Esses são os mecânicos.', 3); -- 6
INSERT INTO interactions (interactions_content, contexts_id_fk) VALUES ('Desculpe, não temos nenhuma recomendação para material de construção.', 3); -- 7
INSERT INTO interactions (interactions_content, contexts_id_fk) VALUES ('Desculpe, não temos nenhuma recomendação para auto peças.', 3); -- 8
INSERT INTO interactions (interactions_content, contexts_id_fk) VALUES ('Desculpe, não temos nenhuma recomendação para loja de roupas.', 3); -- 9
INSERT INTO interactions (interactions_content, contexts_id_fk) VALUES ('Desculpe, não temos nenhuma recomendação para loja de decoração.', 3); -- 10

INSERT INTO interactions (interactions_content, contexts_id_fk) VALUES ('Gostaria de sugerir algum estabelecimento ou profissional?', 4); -- 11

INSERT INTO interactions (interactions_content, contexts_id_fk) VALUES ('Gostaria de avaliar nossa assistência?', 5); -- 12
INSERT INTO interactions (interactions_content, contexts_id_fk) VALUES ('A assistência foi útil?', 5); -- 13
INSERT INTO interactions (interactions_content, contexts_id_fk) VALUES ('Você recomendaria?', 5); -- 14

INSERT INTO interactions (interactions_content, contexts_id_fk) VALUES ('Obrigado pela visita!', 6); -- 15

INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (1, 2, 2, NULL);

INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (2, 3, 1, 'Categorias');
INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (2, 4, 1, 'Buscar');

INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (4, 2, 1, 'Voltar');

INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (3, 5, 1, 'Advogados');
INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (3, 6, 1, 'Mecânicos');
INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (3, 7, 1, 'Material de Construção');
INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (3, 8, 1, 'Auto Peças');
INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (3, 9, 1, 'Lojas de Roupas');
INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (3, 10, 1, 'Lojas de Decoração');

INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (5, 3, 1, 'Voltar');
INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (7, 3, 1, 'Voltar');
INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (8, 3, 1, 'Voltar');
INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (9, 3, 1, 'Voltar');
INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (10, 3, 1, 'Voltar');

INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (6, 3, 1, 'Outras Categorias');
INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (6, 4, 1, 'Buscar');
INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (6, 11, 1, 'Finalizar');

INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (11, 12, 8, 'Sim, eu gostaria');
INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (11, 12, 1, 'Não');

INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (12, 13, 1, 'Sim');
INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (12, 15, 1, 'Não');

INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (13, 14, 1, 'Sim');
INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (13, 14, 1, 'Não');

INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (14, 15, 1, 'Sim');
INSERT INTO interactions_transitions (interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value) VALUES (14, 15, 1, 'Não');

INSERT INTO shops (shops_name, shops_description, shops_specialty, shops_logo_image, shops_cep, shops_uf, shops_city, shops_neighbourhood, shops_street, shops_number, shops_complement, shops_reference, shops_map_url, interactions_id_fk) VALUES ('Autorizada Chevrolet', 'Oficina mecânica especializada em veículos produzidos pela GMB.', 'Injeção Eletrônica, Retífica, Revisões', 'https://www.car-brand-names.com/wp-content/uploads/2015/08/Chevrolet-symbol.jpg', '06020015', 'SP', 'Osasco', 'Vila Yara', 'Av. dos Autonomistas', 1001, '', '', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d117091.68685672914!2d-46.83816889225935!3d-23.492359254501388!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ceff43197d7063%3A0xa115b830b349879e!2sCarrera%20Chevrolet%20-%20Osasco!5e0!3m2!1spt-BR!2sbr!4v1595467708873!5m2!1spt-BR!2sbr', 6);

INSERT INTO shops_phones (shops_phones_type, shops_phones_number, shops_id_fk) VALUES (1, '4002-1515', 1);

SELECT shops_id, shops_name, shops_description, shops_specialty, shops_logo_image, shops_cep, shops_uf, shops_city, shops_neighbourhood, shops_street, shops_number, shops_complement, shops_reference, shops_map_url FROM shops WHERE interactions_id_fk = 6;


