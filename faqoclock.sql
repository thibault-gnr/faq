-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mar 06 Novembre 2018 à 17:40
-- Version du serveur :  5.7.20-0ubuntu0.16.04.1
-- Version de PHP :  7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `faqoclock`
--

-- --------------------------------------------------------

--
-- Structure de la table `app_user`
--

CREATE TABLE `app_user` (
  `id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `app_user`
--

INSERT INTO `app_user` (`id`, `role_id`, `username`, `email`, `password`, `is_active`, `created_date`) VALUES
(1, 1, 'admin', 'admin@admin.fr', '$2y$13$YnlrwYKYW2CU.2wKuIFkOe5jU7uMa0yKTpNY30dbKouXVFdxa0VL2', 1, '2018-11-03 14:52:16'),
(2, 2, 'moderator', 'moderator@moderator.fr', '$2y$13$bp1q1tYjW4eo0sg8xU/6WO3Av98ebxc.bJ9ZfBYHDGXRiH6Fsjkcq', 1, '2018-11-03 14:52:16'),
(3, 3, 'user', 'user@user.fr', '$2y$13$iAsHSzuiQQdOcL6F/8J.luC8x.c7JODIveR17To4p4yQTHxxg95T6', 1, '2018-11-03 14:52:17');

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `validate_comment` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `comment`
--

INSERT INTO `comment` (`id`, `user_id`, `question_id`, `body`, `created_at`, `is_active`, `validate_comment`) VALUES
(1, 1, 1, 'Eaque qui et ut asperiores. Harum debitis aut rerum non. Vel magnam debitis quia distinctio.', '1981-03-01 05:41:58', 1, 0),
(2, 2, 3, 'Officia delectus rerum omnis saepe beatae. Et dolorum dolor unde sunt voluptates.', '1976-05-18 23:55:57', 1, 1),
(3, 3, 2, 'Consequatur laborum assumenda soluta. Blanditiis facere est eius ut et quo et.', '1971-03-02 14:38:21', 1, 0),
(4, 2, 5, 'Fuga sit quo sit enim eaque. Rerum quaerat numquam quos aut. Nihil hic quidem id.', '2007-11-07 13:31:15', 1, 1),
(5, 3, 3, 'Quibusdam ut ut maiores quas delectus alias. Saepe alias magnam omnis. Eaque aliquid quia ut et ut ipsum.', '1981-03-24 16:40:54', 0, 0),
(6, 3, 8, 'Rajoutons un commentaire', '2018-11-05 17:35:38', 1, 0),
(7, 3, 8, 'encore un commentaire', '2018-11-05 17:35:42', 1, 1),
(8, 3, 8, 'test d\'un commentaire', '2018-11-05 17:54:26', 1, 0),
(10, 3, 9, 'test d\'un commentaire', '2018-11-05 20:54:52', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`) VALUES
('20181103135205');

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `question`
--

INSERT INTO `question` (`id`, `user_id`, `body`, `created_at`, `modified_at`, `is_active`, `title`, `slug`) VALUES
(1, 2, 'Fuga dolor quis impedit facilis laborum veritatis. Aut aspernatur dolore omnis ab rerum. Corporis impedit aperiam quia corporis non. Cum facere eos accusantium ex necessitatibus. Quis dolores recusandae laudantium asperiores ipsa ratione quam. Dolor quae minima odit iure ratione voluptate vel. Vero saepe voluptatem porro. Aut odio sed assumenda.', '1987-12-23 10:57:37', '1981-06-20 20:10:28', 1, 'Illum ea ex ad.', 'illum-ea-ex-ad-'),
(2, 2, 'Enim saepe dolorem et dolorum. At totam aliquid aut minima fuga facilis libero. Ut quia occaecati explicabo sapiente mollitia. Rerum inventore hic ipsa rerum sapiente. Recusandae enim non ullam voluptas dolorem quisquam. Ut sit quia sint totam soluta. A ut sequi dolorem qui. Occaecati voluptatem quas quaerat est amet. Ipsum delectus ut reprehenderit officia blanditiis.', '2008-09-25 04:15:58', '1992-11-28 11:16:30', 1, 'Sit maiores et consectetur.', 'sit-maiores-et-consectetur-'),
(3, 3, 'Repellendus ab in minus est aliquid architecto atque. Illo ut neque et quia cum quasi. Ipsum et quia non beatae. Ut asperiores necessitatibus eum ex sit ab omnis. Nobis odio maxime impedit veniam. Et autem debitis blanditiis. Amet officia hic facilis qui sed optio tempore odit.', '2006-08-21 08:58:34', '1980-03-19 21:09:20', 1, 'Veniam consequatur aut aut.', 'veniam-consequatur-aut-aut-'),
(4, 1, 'Rem dolorem a porro vel. Fugiat est et itaque aspernatur sit est. Ab sit ipsam fuga sequi et quo ut. Sit quisquam aliquam nesciunt et voluptas. Ab iste dignissimos dolor occaecati dolore quo maxime. Velit officia quia molestiae hic. Libero ipsa alias ut minima mollitia cum exercitationem. Ipsa eos a ratione sit rerum reprehenderit. Saepe quis qui aut corporis architecto nemo.', '1991-10-24 17:15:45', '2011-12-13 14:15:44', 1, 'Facilis voluptas ea omnis.', 'facilis-voluptas-ea-omnis-'),
(5, 3, 'Sint voluptatem delectus ut incidunt id. Aliquam optio qui mollitia sit qui blanditiis eligendi. Occaecati ducimus iste aut qui fugiat. Voluptatem est repudiandae distinctio numquam at eum consequuntur provident. Non natus laudantium sed veniam. Debitis aut aliquam et est quis fuga perferendis. Temporibus a numquam ea est sed dolor.', '2011-06-06 17:12:24', '1975-02-20 05:44:34', 1, 'Sit deleniti tempora et quo.', 'sit-deleniti-tempora-et-quo-'),
(6, 2, 'ceci est le test avec le tag', '2018-11-03 15:01:41', NULL, 1, 'test question avec tag', 'test-question-avec-tag'),
(7, 2, 'corps question voluptatem', '2018-11-03 15:05:07', NULL, 1, 'test avec volup', 'test-avec-volup'),
(8, 3, 'Ceci est une nouvelle question', '2018-11-05 17:35:28', NULL, 1, 'Nouvelle question', 'nouvelle-question'),
(9, 3, 'rrrr', '2018-11-05 17:47:15', NULL, 1, 'rrrrr', 'rrrrr'),
(10, NULL, 'zzz', '2018-11-05 18:46:52', NULL, 1, 'tttt', 'tttt'),
(11, 1, 'testeeee', '2018-11-05 20:51:42', NULL, 1, 'testeeee', 'testeeee');

-- --------------------------------------------------------

--
-- Structure de la table `question_tag`
--

CREATE TABLE `question_tag` (
  `question_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `question_tag`
--

INSERT INTO `question_tag` (`question_id`, `tag_id`) VALUES
(1, 10),
(1, 13),
(1, 15),
(2, 10),
(2, 14),
(3, 15),
(4, 3),
(5, 2),
(5, 5),
(6, 1),
(7, 2),
(8, 3),
(9, 2),
(10, 3),
(11, 3);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `code` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `role`
--

INSERT INTO `role` (`id`, `code`, `name`) VALUES
(1, 'ROLE_KRYPTON_ADMIN', 'Administrateur'),
(2, 'ROLE_KRYPTON_MODERATOR', 'Moderateur'),
(3, 'ROLE_KRYPTON_USER', 'Utilisateur');

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

CREATE TABLE `tag` (
  `id` int(11) NOT NULL,
  `tag_name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `tag`
--

INSERT INTO `tag` (`id`, `tag_name`) VALUES
(1, 'ipsad'),
(2, 'voluptatem'),
(3, 'dolor'),
(4, 'odio'),
(5, 'voluptas'),
(6, 'assumenda'),
(7, 'ut'),
(8, 'aperiam'),
(9, 'nam'),
(10, 'distinctio'),
(11, 'ut'),
(12, 'enim'),
(13, 'quos'),
(14, 'voluptatibus'),
(15, 'qui'),
(16, 'ullam'),
(17, 'asperiores'),
(18, 'nesciunt'),
(19, 'sed'),
(20, 'et'),
(22, 'dddddddd');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `app_user`
--
ALTER TABLE `app_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_88BDF3E9D60322AC` (`role_id`);

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9474526CA76ED395` (`user_id`),
  ADD KEY `IDX_9474526C1E27F6BF` (`question_id`);

--
-- Index pour la table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_B6F7494EA76ED395` (`user_id`);

--
-- Index pour la table `question_tag`
--
ALTER TABLE `question_tag`
  ADD PRIMARY KEY (`question_id`,`tag_id`),
  ADD KEY `IDX_339D56FB1E27F6BF` (`question_id`),
  ADD KEY `IDX_339D56FBBAD26311` (`tag_id`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `app_user`
--
ALTER TABLE `app_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `app_user`
--
ALTER TABLE `app_user`
  ADD CONSTRAINT `FK_88BDF3E9D60322AC` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_9474526C1E27F6BF` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`),
  ADD CONSTRAINT `FK_9474526CA76ED395` FOREIGN KEY (`user_id`) REFERENCES `app_user` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `FK_B6F7494EA76ED395` FOREIGN KEY (`user_id`) REFERENCES `app_user` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `question_tag`
--
ALTER TABLE `question_tag`
  ADD CONSTRAINT `FK_339D56FB1E27F6BF` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_339D56FBBAD26311` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
