TRUNCATE setting;

INSERT INTO setting (`slug`, `description`, `type`, `value`) VALUES ('nb_students', "Nombre d'étudiants depuis le début de l'école", "int", "200");
INSERT INTO setting (`slug`, `description`, `type`, `value`) VALUES ('percent_diplomas', "Pourcentage de diplomés", "int", "98");
INSERT INTO setting (`slug`, `description`, `type`, `value`) VALUES ('inscriptions_open', "Inscriptions ouvertes", "bool", '1');
INSERT INTO setting (`slug`, `description`, `type`, `value`) VALUES ('inscription_next_date', "Prochaine date d'inscription", "date", "2018-03-01 00:00:00");
INSERT INTO setting (`slug`, `description`, `type`, `value`) VALUES ('inscription_limit_date', "Date limite d'inscription", "date", "2018-03-01 00:00:00");

INSERT INTO setting (`slug`, `description`, `type`, `value`) VALUES ('inscription_link_fr', "Lien inscription français", null, 'https://google.com');
INSERT INTO setting (`slug`, `description`, `type`, `value`) VALUES ('inscription_link_en', "Lien inscription anglais", null, 'https://google.com');
INSERT INTO setting (`slug`, `description`, `type`, `value`) VALUES ('inscription_link_ar', "Lien inscription arabe", null, 'https://google.com');
INSERT INTO setting (`slug`, `description`, `type`, `value`) VALUES ('inscription_link_ps', "Lien inscription pashto", null, 'https://google.com');
INSERT INTO setting (`slug`, `description`, `type`, `value`) VALUES ('inscription_link_fa', "Lien inscription farsi", null, 'https://google.com');

INSERT INTO setting (`slug`, `description`, `type`, `value`) VALUES ('candidatures_open', "Candidatures ouvertes", "bool", '1');
INSERT INTO setting (`slug`, `description`, `type`, `value`) VALUES ('benevoles_open', "Bénévoles ouverts", "bool", '1');

TRUNCATE partner;

INSERT INTO partner (`name`, `image`) VALUES ('Académie de Paris', "academie.png");
INSERT INTO partner (`name`, `image`) VALUES ('Alliance Française', "af.png");
INSERT INTO partner (`name`, `image`) VALUES ('BNP Paribas', "bnp.png");
INSERT INTO partner (`name`, `image`) VALUES ('CCI Paris', "cci.png");
INSERT INTO partner (`name`, `image`) VALUES ('Cité des métiers', "cite.png");
INSERT INTO partner (`name`, `image`) VALUES ('CCI', "cci.png");
INSERT INTO partner (`name`, `image`) VALUES ("Ministère de l'intérieur", "daaen.png");
INSERT INTO partner (`name`, `image`) VALUES ('Fondation EDF', "edf.png");
INSERT INTO partner (`name`, `image`) VALUES ('Fondation de France', "fondation.png");
INSERT INTO partner (`name`, `image`) VALUES ('Forum des images', "forum.png");
INSERT INTO partner (`name`, `image`) VALUES ('Gaîté Lyrique', "gaite.png");
INSERT INTO partner (`name`, `image`) VALUES ("La France S'engage", "lfs.png");
INSERT INTO partner (`name`, `image`) VALUES ('Mairie de Paris', "mairie.png");
INSERT INTO partner (`name`, `image`) VALUES ('Paris Pionnières', "pp.png");
INSERT INTO partner (`name`, `image`) VALUES ('Stavros Narchos Foundation', "snf.png");
INSERT INTO partner (`name`, `image`) VALUES ('Fondation Société Générale', "socgen.png");
INSERT INTO partner (`name`, `image`) VALUES ('La Social Factory', "socialf.png");
INSERT INTO partner (`name`, `image`) VALUES ('TV5 Monde', "tv5.png");
INSERT INTO partner (`name`, `image`) VALUES ('Ulule', "ulule.png");

TRUNCATE team_member;

INSERT INTO team_member (`name`, `job`, `image`) VALUES ('Jennifer Leblond', 'Direction administrative et Présidence', "jennifer.png");
INSERT INTO team_member (`name`, `job`, `image`) VALUES ('Héloîse Nio', "Direction de l'école", "heloise.png");
INSERT INTO team_member (`name`, `job`, `image`) VALUES ('Mariame Camara', 'Direction pédagogique', "mariame.png");
INSERT INTO team_member (`name`, `job`, `image`) VALUES ('Bérénice Geoffray', "Chargée de l'insertion professionnelle", "berenice.png");
INSERT INTO team_member (`name`, `job`, `image`) VALUES ('Hanae El Bakkali', "Psychothérapeute", "hanae.png");


