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
INSERT INTO partner (`name`, `image`) VALUES ('Le plus important', "leplusimportant.png");

TRUNCATE team_member;

INSERT INTO team_member (`name`, `job`, `image`) VALUES ('Jennifer Leblond', 'Direction administrative et Présidence', 'jennifer.png');
INSERT INTO team_member (`name`, `job`, `image`) VALUES ('Héloîse Nio', "Direction de l'école", "heloise.png");
INSERT INTO team_member (`name`, `job`, `image`) VALUES ('Mariame Camara', 'Direction pédagogique', "mariame.png");
INSERT INTO team_member (`name`, `job`, `image`) VALUES ('Bérénice Geoffray', "Chargée de l'insertion professionnelle", "berenice.png");
INSERT INTO team_member (`name`, `job`, `image`) VALUES ('Hanae El Bakkali', "Psychothérapeute", "hanae.png");
INSERT INTO team_member (`name`, `job`, `image`) VALUES ('Amal Allaoui', 'Responsable des ateliers chant', "amal.png");
INSERT INTO team_member (`name`, `job`, `image`) VALUES ('Cécile Adebiyi', "Professeure", "cecile.png");
INSERT INTO team_member (`name`, `job`, `image`) VALUES ('Hadidja Himidi', "Professeure", "hadidja.png");
INSERT INTO team_member (`name`, `job`, `image`) VALUES ('Karine Richarme', "Professeure", "karine.png");
INSERT INTO team_member (`name`, `job`, `image`) VALUES ('Marie Demestre', "Professeure", "marie.png");
INSERT INTO team_member (`name`, `job`, `image`) VALUES ('Nathalie Bourg', "Responsable des ateliers théâtre", "nathalie.png");

TRUNCATE press_item;

INSERT INTO `press_item` (`id`, `title`, `issue`, `source`, `published_at`, `link`, `document`)
VALUES
    (1, '\'L\'Échappée volée\' au chevet du bonheur', 'Le Point', 'le_point', '2017-05-11', 'http://www.lepoint.fr/innovation/l-echappee-volee-au-chevet-du-bonheur-11-05-2017-2126695_1928.php', NULL),
    (2, 'Une école de français pour les réfugiés et les demandeurs d’asile', 'France Inter', 'france_inter', '2017-05-11', 'https://www.franceinter.fr/idees/une-ecole-de-francais-pour-les-refugies-et-les-demandeurs-d-asile', NULL),
    (3, 'Le bonheur à portée de mots', 'L\'ADN', 'l_adn', '2017-04-27', 'http://www.ladn.eu/entreprises-innovantes/exponential-happiness/le-bonheur-a-portee-de-mots/', NULL),
    (4, 'Partenariat avec Thot, l’école de français pour les réfugiés et demandeurs d’asile', 'Centre de langue française', 'cci', '2017-04-27', 'http://www.centredelanguefrancaise.paris/partenariat-avec-l-ecole-thot/', NULL),
    (5, 'Tribune : En plus de l’exil, le transfert', 'Libération', 'liberation', '2017-03-23', 'http://www.liberation.fr/debats/2017/03/23/en-plus-de-l-exil-le-transfert_1557838', NULL),
    (6, 'Citoyenneté. Parler français, un horizon pour tous', 'L’Humanité', 'l_humanite', '2017-03-09', 'http://www.humanite.fr/citoyennete-parler-francais-un-horizon-pour-tous-632957', NULL),
    (7, 'L’école Thot : outil d’intégration pour les migrants', 'Solidarum', NULL, '2017-03-08', 'http://www.solidarum.org/inclusion-sociale/l-ecole-thot-outil-d-integration-pour-migrants', NULL),
    (8, '8 jeunes femmes entrepreneures qui comptent pour la France', 'WizBii', NULL, '2017-03-08', 'https://laruche.wizbii.com/entrepreneures-2017/', NULL),
    (9, 'Thot, à l’école du français et de la dignité retrouvée', 'France 24', 'france_24', '2017-03-01', 'http://www.france24.com/fr/20170301-thot-ecole-francais-migrants-refugies-paris', NULL),
    (10, 'Grand reportage : L’école où les migrants apprennent le français', 'BC Afrique', 'bbc_afrique', '2017-01-31', 'https://www.youtube.com/watch?v=MTTyZeAZD5I', NULL),
    (11, 'Abd Al Malik parle de Thot', 'Arte (28 Minutes)', 'arte', '2017-01-26', 'https://www.youtube.com/watch?v=pVp7FLPxOmw', NULL),
    (12, '\'La France s\'engage\' pour l’enseignement du français aux réfugiés', 'Carenews', 'carenews', '2017-01-23', 'http://www.carenews.com/fr/news/6961-la-france-s-engage-pour-l-enseignement-du-francais-aux-refugies', NULL),
    (13, '\'La France s\'engage\' : l\'école des migrants récompensée', 'JDD', 'jdd', '2017-01-15', 'http://www.lejdd.fr/Societe/La-France-s-engage-l-ecole-des-migrants-recompensee-839965', NULL),
    (14, 'Jennifer Leblond invitée à l’émission “Tous acteurs du changement”', 'LCI', 'lci', '2017-01-15', 'http://www.lci.fr/replay/replay-tous-acteurs-du-changement-du-15-janvier-2017-thot-l-ecole-qui-apprend-le-francais-aux-migrants-2021820.html ', NULL),
    (15, 'Thot, une école diplômante de français réservée aux migrants', 'RFI', 'rfi', '2017-01-13', 'http://www.rfi.fr/emission/20170113-thot-une-ecole-diplomante-francais-reservee-migrants', NULL),
    (16, 'Les 29 femmes qu’on retiendra de 2016', 'Madmoizelle', 'madmoizelle', '2016-12-31', 'http://www.madmoizelle.com/role-modele-femmes-2016-692887', NULL),
    (17, 'L\'école de français pour les réfugiés obtient 93% de réussite chez ses premiers élèves', 'Huffington Post', 'huffington_post', '2016-12-06', 'http://www.huffingtonpost.fr/2016/12/06/lecole-de-francais-pour-les-refugies-obtient-93-de-reussite-ch/', NULL),
    (18, 'Héloïse Nio, intervenante à la conférence Ted \'Rien de bien méchant\'', 'TedX 2016 Université Paris-Dauphine', 'ted_x', '2016-11-25', 'https://www.youtube.com/watch?v=WaW0rLa2nAA', NULL),
    (19, 'Interview : Judith Aquien, l\'une des fondatrices de l’école Thot', 'Les petits Frenchies', 'petit_frenchies', '2016-11-20', 'https://fr.petitsfrenchies.com/interview-judith-aquien-lune-des-fondatrices-de-lecole-thot/', NULL),
    (20, 'Semaine mondiale de l\'entrepreneur : ces Françaises qui déboîtent', 'RTL Girls', 'rtl', '2016-11-15', 'http://www.rtl.fr/girls/identites/en-images-semaine-mondiale-de-l-entrepreneur-ces-francaises-qui-deboitent-7785768739', NULL),
    (21, 'Thot, l’école de français pour les réfugiés : infographie', 'Blog Ulule', 'ulule', '2016-11-09', 'http://chouette.ulule.com/post/152895488187/thot-l%C3%A9cole-de-fran%C3%A7ais-pour-les-r%C3%A9fugi%C3%A9s', NULL),
    (22, 'Périphéries (Édouard Zambeaux) - \'C\'est le temps de rire maintenant\'', 'France Inter', 'france_inter', '2016-10-28', 'https://www.franceinter.fr/emissions/peripheries/peripheries-28-octobre-2016', NULL),
    (23, 'Revue de presse de Frédéric Pommier - de 2\'16 à 3\'33', 'France Inter', 'france_inter', '2016-10-09', 'http://www.franceinter.fr/emissions/la-revue-de-presse-de-frederic-pommier/la-revue-de-presse-de-frederic-pommier-09-octobre-2016', NULL),
    (24, 'Reportage chez Thot par Frédérique Lebel', 'Accents d’Europe', 'rfi', '2016-09-22', 'https://www.youtube.com/watch?v=QONw7MZ5FBM', NULL),
    (25, 'Des séances psy pour les migrants', 'Psychologies', 'psychologies', '2016-09-01', 'http://www.psychologies.com/Planete/Societe/Interviews/Des-seances-psy-pour-les-migrants', NULL),
    (26, 'Ali, demandeur d’asile, tente de construire sa vie loin de sa famille', 'Psychologies', 'psychologies', '2016-09-01', 'http://www.psychologies.com/Planete/Societe/Articles-et-Dossiers/Ali-demandeur-d-asile-tente-de-construire-sa-vie-loin-de-sa-famille', NULL),
    (27, 'Thot, une école diplômante pour les réfugiés', 'Kiyo', NULL, '2016-09-08', 'http://www.kiyoblog.com/single-post/2016/09/08/Thot-l%C3%A9cole-de-langue-pour-les-r%C3%A9fugi%C3%A9s', NULL),
    (28, 'Des solutions pour une intégration réussie des réfugiés', 'We Are Up', NULL, '2016-08-30', 'http://weareup.com/des-solutions-pour-une-integration-reussie-des-refugies/?utm_campaign=IntegrationRefugies&utm_medium=newsletterdirex7&utm_source=NewsletterDirex7&utm_content=postdu30082016&utm_term=VF', NULL),
    (29, 'Thot dans le Grand Reportage de BBC Afrique', 'BBC Afrique', 'bbc_afrique', '2016-08-27', 'https://www.youtube.com/watch?v=zIvNMosII0g', NULL),
    (30, 'Judith Aquien a créé Thot, une école de français pour les réfugiés', 'Happy Project', NULL, '2016-07-06', 'http://www.happyproject.world/single-post/2016/07/06/Judith-Aquien-elle-a-cr%C3%A9%C3%A9-une-%C3%A9cole-de-fran%C3%A7ais-pour-les-r%C3%A9fugi%C3%A9s', NULL),
    (31, 'Une école pour les migrants (numéro du 1er au 7 juillet 2016)', 'Marianne', 'marianne', '2016-07-01', 'http://www.marianne.net/ecole-les-migrants-100244200.html', NULL),
    (32, 'Judith Aquien invitée au Grand Angle du 64 Minutes', 'TV5MONDE', 'tv5_monde', '2016-06-30', 'https://www.youtube.com/watch?v=NHo02x-xUkc&', NULL),
    (33, 'TedX Champs-Elysées Salon En exil : l’éducation pour se reconnecter avec les autres et avec son avenir', 'TedX Champs-Elysées', 'ted_x', '2016-06-24', 'http://tedxchampselyseesed.com/articles/en-exil-leducation-pour-se-reconnecter-avec-les-autres-et-avec-son-avenir-10/', NULL),
    (34, 'Thot : Une école de français au service des réfugiés', 'UP Le Mag', NULL, '2016-06-24', 'http://www.up-inspirer.fr/26826-thot-une-ecole-de-francais-au-service-des-refugies', NULL),
    (35, 'Ecole Thot : Des cours de français, pour redonner une voix aux réfugiés', '20 Minutes', '20_minutes', '2016-06-20', 'http://www.20minutes.fr/paris/1867675-20160620-ecole-thot-cours-francais-redonner-voix-refugies', NULL),
    (36, 'Où apprendre le français et être diplômé quand on est réfugié ?', 'Huffington Post', 'huffington_post', '2016-06-20', 'http://www.huffingtonpost.fr/jennifer-leblond/journee-mondiale-des-refugies-video_b_10522138.html', NULL),
    (37, 'Judith Aquien parle de Thot', 'UP Fest \'Le temps des héros\'', NULL, '2016-06-18', 'http://up-conferences.fr/fest/', NULL),
    (38, 'Thot, une école diplômante pour les demandeurs d’asile et les réfugiés', 'Faiseurs de boîte', NULL, '2016-06-13', 'http://www.faiseursdeboite.fr/thot-association-ecole-langue-francaise', NULL),
    (39, 'L’association Thot ouvre à Paris une école de français pour les migrants', 'Le Monde', 'le_monde', '2016-06-13', 'http://www.lemonde.fr/immigration-et-diversite/article/2016/06/13/l-association-thot-ouvre-a-paris-une-ecole-de-francais-pour-les-migrants_4949471_1654200.html', NULL),
    (40, 'Paris : c\'est la rentrée des classes pour 40 réfugiés', 'Le Parisien', 'le_parisien', '2016-06-13', 'http://www.leparisien.fr/societe/paris-c-est-la-rentree-des-classes-pour-40-refugies-09-06-2016-5869837.php', NULL),
    (41, 'À Paris, une école pour l\'insertion des migrants', 'La Croix', 'la_croix', '2016-06-13', 'http://www.la-croix.com/Famille/Education/A-Paris-une-ecole-pour-l-insertion-des-migrants-2016-06-13-1200768298', NULL),
    (42, 'Thot, une école de français pour transmettre un horizon aux migrants', 'Carenews', 'carenews', '2016-06-06', 'http://www.carenews.com/fr/news/5337-thot-une-ecole-de-francais-pour-transmettre-un-horizon-aux-migrants', NULL),
    (43, 'Montreuil : elles ont monté une école de français pour réfugiés', 'Le Parisien', 'le_parisien', '2016-06-02', 'http://www.leparisien.fr/montreuil-93100/montreuil-elles-ont-monte-une-ecole-de-francais-pour-refugies-02-06-2016-5851387.php', NULL),
    (44, 'Paris : une association lance une école de langue française pour les réfugiés', 'Le Figaro', 'le_figaro', '2016-06-02', 'http://www.lefigaro.fr/actualite-france/2016/06/02/01016-20160602ARTFIG00161-paris-une-association-lance-une-ecole-de-langue-francaise-pour-les-refugies.php', NULL),
    (45, '12 femmes qui vont bousculer votre quotidien', 'Les Inrocks', 'les_inrocks', '2016-05-31', 'http://www.lesinrocks.com/2016/05/31/actualite/12-femmes-bousculer-quotidien-11826880/', NULL),
    (46, 'Focus : \"Thot, une école pour les migrants\", avec Judith Aquien, présidente de Thot à 48\'', '\"Rue des écoles\"', 'france_culture', '2016-05-29', 'http://www.franceculture.fr/emissions/rue-des-ecoles/rue-des-ecoles-dimanche-29-mai-2016', NULL),
    (47, 'Migrants: comment aider?', 'Mediapart', 'mediapart', '2016-05-26', 'https://www.mediapart.fr/journal/france/260516/migrants-comment-aider', NULL),
    (48, 'Les réfugiés et l’éducation, une problématique préoccupante', 'Good Morning Crowdfunding', NULL, '2016-05-26', 'http://www.goodmorningcrowdfunding.com/international-refugies-leducation-problematique-preoccupante-02260516/', NULL),
    (49, 'Une école diplômante pour apprendre le français aux réfugiés', 'La Part du colibri', NULL, '2016-05-23', 'http://lapartducolibri.fr/?p=837', NULL),
    (50, 'Judith Aquien, Présidente de Thot, sélectionnée parmi les 8 modèles féminins 2016', 'W(e) Talk — conférence \"Artisanes du commun, qui forment ensemble pour un autre demain\"', 'le_point', '2016-05-21', 'http://2016.wetalk-community.org/modeles-feminins/', NULL),
    (51, 'A Paris, une \"école des réfugiés\" pour apprendre le français', 'L’Express via l’AFP', 'l_express', '2016-05-20', 'http://www.lexpress.fr/actualites/1/styles/a-paris-une-ecole-des-refugies-pour-apprendre-le-francais_1794126.html', NULL),
    (52, 'A Paris, une \"école des réfugiés\" pour apprendre le français', 'L\'Obs', 'l_obs', '2016-05-20', 'http://tempsreel.nouvelobs.com/societe/20160520.AFP5837/a-paris-une-ecole-des-refugies-pour-apprendre-le-francais.html', NULL),
    (53, 'A Paris, une \"école des réfugiés\" pour apprendre le français', 'RTL', 'rtl', '2016-05-20', 'http://www.rtl.be/info/monde/international/a-paris-une-ecole-des-refugies-pour-apprendre-le-francais-819890.aspx', NULL),
    (54, 'Thot, l\'école qui apprend le français aux réfugiés', 'Le Point', 'le_point', '2016-05-20', 'http://www.lepoint.fr/societe/thot-l-ecole-qui-apprend-le-francais-aux-refugies-20-05-2016-2040741_23.php', NULL),
    (55, 'Héloïse a cofondé une école pour former les exilés à la langue française', 'L\'Etudiant', 'l_etudiant', '2016-05-19', 'http://www.letudiant.fr/jobsstages/creation-entreprise/heloise-nio-25-ans-cofondatrice-d-une-ecole-pour-former-les-exiles-a-la-langue-francaise.html', NULL),
    (56, 'Elles veulent créer une école de français pour les réfugiés', 'Le Parisien', 'le_parisien', '2016-05-19', 'http://www.leparisien.fr/montreuil-93100/montreuil-elles-veulent-creer-une-ecole-de-francais-pour-les-refugies-19-05-2016-5810251.php', NULL),
    (57, '\"Une école pour apprendre le français aux réfugiés\"', 'Le Courrier de l\'Atlas', 'courrier_atlas', '2016-05-18', 'http://www.lecourrierdelatlas.com/1138518052016Une-ecole-pour-apprendre-le-francais-aux-refugies.html', NULL),
    (58, 'Du crowdfunding pour créer une école apprenant le français aux réfugiés', 'actualitte', 'actualitte', '2016-05-13', 'https://savoir.actualitte.com/article/scolarite/1798/du-crowdfunding-pour-creer-une-ecole-apprenant-le-francais-aux-refugies', NULL),
    (59, 'Thot, l’école diplômante pour les réfugiés qui veulent apprendre le français', 'Clique.tv', 'clique', '2016-05-11', 'http://www.clique.tv/thot-lecole-diplomante-pour-les-refugies/', NULL),
    (60, '« Avec Thot, on transmet un horizon aux réfugiés. »', 'Pressée', NULL, '2016-05-11', 'http://pressee.fr/judith-aquien-il-faut-transmettre-un-horizon-aux-refugies/#more-898', NULL),
    (61, 'In Francia apre “Thot”, scuola di francese per richiedenti asilo e rifugiati', 'Redattore Sociale', NULL, '2016-05-11', 'http://www.redattoresociale.it/Notiziario/Articolo/507633/In-Francia-apre-Thot-scuola-di-francese-per-richiedenti-asilo-e-rifugiati', NULL),
    (62, 'Judith Aquien invitée de Marie Misset et Armel Hemme', 'Nova - 2h 1/4 avant la fin du monde', 'nova', '2016-05-09', 'http://www.novaplanet.com/radionova/bientot-2h-14-avant-la-fin-du-monde-thot-la-formation-qui-apprend-le-francais-aux-refugies', NULL),
    (63, 'Sarah Constantin met 20/20 à Thot - 20\'24\'\'', 'L\'Autre JT', NULL, '2016-05-05', 'https://youtu.be/eWT6qQ79b-g?t=1m34s', NULL),
    (64, 'Le Resome, pour que l’école accueille les réfugiés dans la dignité', 'Télérama', 'telerama', '2016-05-05', 'http://www.telerama.fr/monde/le-resome-pour-que-l-ecole-accueille-les-refugies-dans-la-dignite,141947.php', NULL),
    (65, 'Thot invité au journal de midi', 'LCI', 'lci', '2016-05-05', 'https://www.youtube.com/watch?v=KqqYWuFPRpE&feature=youtu.be', NULL),
    (66, 'Thot, un grand pas vers l\'intégration', 'Annie All Music', NULL, '2016-05-02', 'http://annieallmusic.blogspot.fr/2016/05/thot-un-grand-pas-vers-lintegration.html', NULL),
    (67, '\"Ils ferment les frontières, ouvrons nos écoles\" - tribune du Résome dans Libération', 'Libération', 'liberation', '2016-05-02', 'http://www.liberation.fr/debats/2016/05/02/ils-ferment-les-frontieres-ouvrons-nos-ecoles_1450031', NULL),
    (68, 'Chronique de Marie-Madeleine Rigopoulos sur Thot - 26\'30\"', 'Cosmopolitaine, France Inter', 'france_inter', '2016-05-01', 'http://bit.ly/1SVONvB', NULL),
    (69, 'Le magazine LCFF nous offre une page de publicité (numéro 40, mai 2016)', 'Langue et culture françaises & francophones', NULL, '2016-05-01', 'http://issuu.com/lcf-magazine/docs/lcff_magazine_n__40-_issuu/43?e=6017579/35344828', NULL),
    (70, 'Thot, l’école diplomante de français pour élèves en migration', 'Intégrales Mag', NULL, '2016-04-30', 'http://www.integrales-productions.com/2016/04/30/thot-lecole-diplomante-de-francais-pour-eleves-en-migration/', NULL),
    (71, 'Chronique de Côme Bastin sur Thot', 'Le futur c\'est maintenant, Nova', 'nova', '2016-04-30', 'http://www.novaplanet.com/radionova/61238/episode-thot-la-formation-qui-apprend-le-francais-aux-refugies', NULL),
    (72, 'Elle a quitté son job pour créer Thot, une école de français destinée aux réfugiés', 'Cheek Magazine', 'cheek', '2016-04-29', 'http://cheekmagazine.fr/societe/thot-judith-aquien-ecole-francais-refugies/', NULL),
    (73, 'Thot, une école pour les réfugiés à soutenir sur Ulule', 'One Heart', NULL, '2016-04-29', 'http://bit.ly/1QPVrPj', NULL),
    (74, 'Le but de l’association Thot est que les réfugiés fassent partie de la France ', 'Le Courrier du Soir', NULL, '2016-04-27', 'http://www.lecourrier-du-soir.com/articles/h%C3%A9lo%C3%AFse-%C2%AB-le-de-l%E2%80%99association-thot-est-que-les-r%C3%A9fugi%C3%A9s-fassent-partie-de-la-france-%C2%BB', NULL),
    (75, 'Elles lancent une école de français pour les réfugiés', 'Conso Collaborative', NULL, '2016-04-26', 'http://consocollaborative.com/article/elles-lancent-une-ecole-de-francais-pour-les-refugies-grace-au-crowdfunding/', NULL),
    (76, 'Journal Régional — 1\'36\"', 'RCF', NULL, '2016-04-26', 'https://rcf.fr/actualite/journal-regional-du-mardi-26-avril', NULL),
    (77, 'Thot FLE, une école diplômante pour migrants', 'Agito', NULL, '2016-04-22', 'http://agi.to/agitox-actualite-fle-edu-76/', NULL),
    (78, 'Une école pour migrants gratuite et diplômante pourrait voir le jour en France', 'Libération', 'liberation', '2016-04-18', 'http://www.liberation.fr/direct/element/une-ecole-pour-migrants-gratuite-et-diplomante-pourrait-voir-le-jour-en-france_35401/', NULL),
    (79, 'Chronique « Ma Parole » : Interview d\'Imaad Ali, directeur pédagogique de l\'école Thot - 17\'55', 'RFI', 'rfi', '2016-04-18', 'http://www.rfi.fr/emission/20160418-institut-francais-bucarest', NULL),
    (80, 'Chronique « Ma Parole » : on vous présente Thot', 'Émission « Danse avec les mots »', 'rfi', '2016-04-11', 'https://savoirs.rfi.fr/fr/communaute/langue-francaise/ma-parole-on-vous-presente-thot', NULL),
    (86, 'Heloise Nio. Etorkinen aldean', 'Argia', NULL, '2017-04-30', NULL, 'ArticleArgia-Thot-Heloise-Nio.pdf'),
    (85, 'De l\'exil à l\'ancrage linguistique', 'Magazine Mémoire - Centre Primo Levi', NULL, '2018-04-01', NULL, 'CPLmagazinememoiren72-BD-18-18.pdf'),
    (83, 'L’intégration sur le bout de la langue', 'ELLE', 'elle', '2016-10-07', NULL, 'ELLE_Integration_Langue.pdf'),
    (84, 'Parti pris', 'L’Humanité dimanche', 'l_humanite', '2018-08-02', NULL, 'HD620_20180802_p008-11 planche.pdf'),
    (82, 'Réfugiés - En lisant, en écrivant (n°555 du 6 au 12 avril 2017)', 'L’Humanité Dimanche', 'l_humanite', '2017-04-06', NULL, 'HumaniteDimanche555.pdf'),
    (81, 'Judith Aquien - La directrice (n°54 du 13 avril au 10 mai 2017)', 'Society', 'society', '2017-04-13', NULL, 'Society54.pdf'),
    (87, 'Reportage RTBF', 'RTBF', 'rtbf', '2018-06-13', 'https://www.rtbf.be/auvio/detail_la-semaine-de-l-europe-reportages?id=2363044', NULL),
    (88, 'Abd Al Malik chez ARTE', 'ARTE', 'arte', '2017-01-26', 'https://www.youtube.com/watch?v=Z5Nsq7LyXKg', NULL),
    (89, 'Enseignement aux réfugiés : Pourquoi ne pas laisser nos étudiants finir leur cycle ?', 'Respect Mag', NULL, '2017-03-29', 'https://www.respectmag.com/27528-etudiants-thot-transferts', NULL),
    (90, 'Quand les réfugiés passent un vrai diplôme de langue française', 'Le Figaro', 'le_figaro', '2017-06-22', 'http://www.lefigaro.fr/actualite-france/2017/06/22/01016-20170622ARTFIG00062-quand-les-refugies-passent-un-vrai-diplome-de-langue-francaise.php', NULL),
    (91, 'Ces personnalités qui prônent le partage et l\'éducation', 'Grazia', 'grazia', '2017-06-23', 'https://www.grazia.fr/news-et-societe/societe/ces-personnalites-qui-pronent-le-partage-et-l-education-858892', NULL),
    (92, 'France : Tour d’horizon des associations d’aide aux migrants', 'Info Migrants', NULL, '2017-07-03', 'http://www.infomigrants.net/fr/post/3944/france-tour-d-horizon-des-associations-d-aide-aux-migrants', NULL),
    (93, 'Ce qui fait réellement de nous des individus au sein de la société, c’est notre capacité à nous exprimer', 'Au féminin', 'au_feminin', '2017-08-29', 'https://www.aufeminin.com/news-societe/thot-ecole-diplomante-francais-pour-migrants-s2356432.html', NULL),
    (94, 'Traiter les troubles psychiques des migrants, un défi de taille', '20 minutes', '20_minutes', '2017-09-05', 'https://www.20minutes.fr/sante/2126583-20170905-traiter-troubles-psychiques-migrants-defi-taille', NULL),
    (95, 'Immigration: la France trop chiche pour l\'intégration des nouveaux arrivants, selon un rapport', 'Nouvel Obs', 'le_nouvel_obs', '2017-09-06', 'https://www.nouvelobs.com/societe/20170906.AFP9825/immigration-la-france-trop-chiche-pour-l-integration-des-nouveaux-arrivants-selon-un-rapport.html', NULL),
    (96, 'Live - Ce soir, dès 18h, «En direct de Mediapart»: Amandine Gay, Cédric Herrou, Olivier Besancenot, Octobre-17, solidaires des migrants', 'Médiapart', 'mediapart', '2017-09-28', 'https://blogs.mediapart.fr/la-redaction-de-mediapart/blog/280917/ce-soir-des-18h-en-direct-de-mediapart-amandine-gay-cedric-herrou-olivier-besancenot?fbclid=IwAR2ZVWopIJFrqXhThL5Lot6IMm46RUvTV6__TkhLAOQJ1FnGK-Kqy9NVFCI', NULL),
    (97, 'Pour venir en aide aux réfugiés, 26 artistes mettent leurs œuvres aux enchères à Paris', 'Clique TV', 'clique', '2017-10-07', 'http://www.clique.tv/vente-encheres-refugies/', NULL),
    (98, 'Generation xx: Judith Aquien, co-fondatrice de Thot', 'Deezer', 'deezer', '2017-10-18', 'https://www.deezer.com/fr/episode/3789829', NULL),
    (99, 'L\'Ecole Thot, une école diplômante pour les migrants', 'RFI', 'rfi', '2017-10-24', 'http://www.rfi.fr/emission/20171024-ecole-thot-une-ecole-diplomante-migrants', NULL),
    (100, 'Abd al Malik, parrain de l’association Thot', 'Carenews', 'carenews', '2017-10-31', 'http://www.carenews.com/fr/news/9185-refugies-cnj9-abd-al-malik-parrain-de-l-association-thot', NULL),
    (101, 'La stratégie des jésuites pour améliorer l’intégration des réfugiés', 'La Croix', 'la_croix', '2017-12-14', 'https://www.la-croix.com/France/Immigration/strategie-jesuites-ameliorer-lintegration-refugies-2017-12-13-1200899257', NULL),
    (102, 'Apprendre le français, une \'libération\' pour les réfugiés et demandeurs d\'asile', 'France 24', 'france_24', '2017-12-18', 'https://www.france24.com/fr/video/20171218-apprendre-le-francais-une-liberation-refugies-demandeurs-dasile', NULL),
    (103, 'Trophées, bières & gifs : la Nuit des Festivals comme si vous y étiez', 'Tous les festivals', NULL, '2018-02-09', 'https://www.touslesfestivals.com/actualites/trophees-bieres-gifs-la-nuit-des-festivals-comme-si-vous-y-etiez-190218', NULL),
    (104, 'Thot, pour apprendre le français', 'RFI', 'rfi', '2018-11-14', 'http://www.rfi.fr/emission/20181114-ecole-thot', NULL),
    (105, 'Abd Al Malik nous raconte son engagement contre l\'illettrisme et les inégalités', 'Le Mouv\'', 'le_mouv', '2018-11-16', 'https://www.mouv.fr/emissions/mouv-13-actu/abd-al-malik-nous-raconte-son-engagement-contre-l-illettrisme-et-les-inegalites-345625', NULL);
