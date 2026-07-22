-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 22 juil. 2026 à 15:46
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tomtroc`
--

-- --------------------------------------------------------

--
-- Structure de la table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `resume` text NOT NULL,
  `date_create` datetime NOT NULL,
  `date_update` datetime NOT NULL,
  `is_enable` tinyint(4) NOT NULL DEFAULT 1,
  `url_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `books`
--

INSERT INTO `books` (`id`, `id_user`, `title`, `author`, `resume`, `date_create`, `date_update`, `is_enable`, `url_img`) VALUES
(1, 1, 'Ready Player One', 'Ernest Cline', 'Wade Watts est un adolescent qui, comme la majorité du monde vit à travers le jeux : OASIS. Au fil des années, grâce au travail acharné de ses deux créateurs James Halliday et Og Morrow, le jeu est devenu une addiction, il est un moyen de s\'évader, de vivre dans un monde sans misère et où la nourriture est abondante.', '2026-07-04 16:45:55', '2026-07-21 14:11:48', 0, 'src/img/ready-player-one.jpg'),
(2, 2, 'Dune tome 1', 'Franck Herbert', 'Il n\'y a pas, dans tout l\'Empire, de planète plus inhospitalière que Dune.\r\nPartout du sable, à perte de vue.\r\nUne seule richesse : l\'épice de longue vie, née du désert et que l\'univers tout entier convoite.', '2026-07-04 00:00:00', '2026-07-06 16:04:01', 1, 'src/img/dune-tome1.jpg'),
(3, 2, 'L\'assassin Royal Epoque 1', 'Robin Hobb', 'Les 3 premiers tomes de la saga l\'assassin royal', '2026-07-06 00:00:00', '2026-07-06 00:00:00', 1, 'src/img/assassin-royal-epoque-1.jpg'),
(4, 3, 'Dungeon Crawler Carl  Tome 1', 'Matt Dinniman', 'Un homme. Le chat de son ex. Un jeu télévisé sadique où leur survie dépend de leur capacité à tuer avec style. En un éclair, chaque construction humaine érigée sur Terre s\'effondre, créant un gigantesque donjon : un labyrinthe infernal de 18 niveaux remplis de pièges, de monstres et de butins.', '2026-07-06 01:00:00', '2026-07-06 01:00:00', 1, 'src/img/Dungeon-Crawler-Carl-Tome-1.jpg'),
(5, 4, 'Misery', 'Stephen King', 'un écrivain est recueilli après un grave accident par l\'une de ses admiratrices, qui découvre que l\'auteur a tué son personnage favori dans son nouveau livre et décide de le pousser à le ressusciter en employant des moyens extrêmes.', '2026-07-06 01:03:30', '2026-07-06 01:03:30', 1, 'src/img/misery.jpg'),
(6, 1, 'La Maison des Feuilles', 'Mark Z. Danielewski', 'Johnny a trouvé un mystérieux manuscrit à la mort d\'un vieil homme aveugle. Il décide de le mettre en forme et de l\'annoter de façon très personnelle. Le texte se présente comme un essai sur un film, le Navidson Record, réalisé par Will Navidson, un photoreporter, lauréat du prix Pulitzer.', '2026-07-06 04:03:30', '2026-07-06 04:03:30', 1, 'src/img/maison-des-feuilles.jpg'),
(7, 3, 'Primal Hunter - Tome 1', 'Zogarth', 'Au moment de prendre leur pause déjeuner, Jake et ses collègues basculent dans une forêt qui fait rimer danger avec opportunité. D\'abord confrontés à une interface qui les invite à choisir une classe, ils découvrent enfin leur objectif : survivre 63 jours au cœur de ce Tutoriel.', '2026-07-06 09:03:30', '2026-07-06 09:03:30', 1, 'src/img/primal-hunter-tome-1.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `conversations`
--

CREATE TABLE `conversations` (
  `id` int(11) NOT NULL,
  `id_user1` int(11) NOT NULL,
  `id_user2` int(11) NOT NULL,
  `date_create` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `conversations`
--

INSERT INTO `conversations` (`id`, `id_user1`, `id_user2`, `date_create`) VALUES
(1, 1, 3, '2026-07-06 00:00:00'),
(2, 1, 4, '2026-07-13 12:19:42'),
(3, 1, 2, '2026-07-13 12:47:16');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `id_conversation` int(11) NOT NULL,
  `id_sender` int(11) NOT NULL,
  `message` text NOT NULL,
  `date_create` datetime NOT NULL,
  `is_read` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `id_conversation`, `id_sender`, `message`, `date_create`, `is_read`) VALUES
(1, 1, 1, 'J\'adore Dungeon Crawler Carl,t\'en as pensé quoi ?', '2026-07-06 17:58:58', 0),
(2, 1, 3, 'Il était vraiment top ! trop hâte de lire la suite !', '2026-07-06 18:00:20', 0),
(3, 1, 1, 'Est-ce que tu serais d\'accord pour me le prêter ?', '2026-07-06 18:01:05', 0),
(4, 1, 3, 'Oui bien sûr !', '2026-07-06 18:01:37', 0),
(5, 2, 1, 'test', '2026-07-13 12:19:48', 1),
(6, 1, 1, 'test', '2026-07-13 14:01:01', 0),
(7, 2, 4, 'ok ça marche bien', '2026-07-22 12:34:09', 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_img` varchar(256) NOT NULL DEFAULT 'src/img/config/user-default.svg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `mail`, `password`, `username`, `user_img`) VALUES
(1, 'eriktheroude@hotmail.fr', '$2y$10$UpH1zxE5aIolWLqA0ZA5LuIMjnmXBFEv4dyYrz5ewo24hGJ5W3G26', 'TestErik', 'src/img/1/Icon_messagerie.png'),
(2, 'toto@test.com', '$2y$10$0N5lXN/F7WZx9.RwGLyJnOc4qgl2.MApzQmexsvR0oYYC6/HYSERe', 'toto', 'src/img/config/user-default.svg'),
(3, 'john.doe@test.com', '$2y$10$3mbs8o0xjV3.9ed652ILCuMB.UUkMvXXmYX6yam5kI4CegRUWFoCe', 'JohnDoe', 'src/img/config/user-default.svg'),
(4, 'janedoe@test.com', '$2y$10$Z0OO1lRZCxt8Xx0n/MABfOtEikqqvZ18bJf2YcLl8oifyuW1l.6y.', 'JaneDoe', 'src/img/config/user-default.svg');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user1` (`id_user1`,`id_user2`),
  ADD KEY `id_user2` (`id_user2`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_sender` (`id_sender`),
  ADD KEY `id_conversation` (`id_conversation`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `conversations`
--
ALTER TABLE `conversations`
  ADD CONSTRAINT `conversations_ibfk_1` FOREIGN KEY (`id_user1`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `conversations_ibfk_2` FOREIGN KEY (`id_user2`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`id_sender`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`id_conversation`) REFERENCES `conversations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
