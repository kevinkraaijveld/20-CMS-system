-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Gegenereerd op: 19 jan 2019 om 14:49
-- Serverversie: 5.6.37
-- PHP-versie: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `cat_id` int(3) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'HTML'),
(2, 'Javascript'),
(3, 'PHP'),
(4, 'Wordpress');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_post_id` int(3) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(255) NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(1, 1, 'Admin ', 'admin@cms.com', 'Nice post!', 'Pending', '2019-01-12');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int(3) NOT NULL,
  `post_category_id` int(3) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_date` datetime NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_comment_count` int(11) NOT NULL,
  `post_status` varchar(255) NOT NULL DEFAULT 'draft',
  `post_views_count` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`, `post_views_count`) VALUES
(1, 4, 'Schema.org setup', '2', '2019-01-17 14:18:22', 'Magento-2-Schema.org-Integration.jpg', '<p>This is a Wordpress function to add markup to your website.</p>\r\n\r\n<p>Structured data, also called schema markup, is a type of code that makes it easier for search engines to crawl, organize, and display your content. Structured data communicates to search engines what your data means. Without schema markup, search engines can only tell what your data says, and they have to work harder to determine why it’s there.</p><pre>/**\r\n* @name("Google - Schema.org")\r\n* @description("Add schema.org json.")\r\n* @option("webprofit_enable_schema_org")\r\n**/\r\n\r\n<p>add_action(wp_footer, function () {</p><p>// Website variables\r\n	$url = "https://www.kevii.nl";\r\n    &nbsp;&nbsp;&nbsp;&nbsp;$site_name = "Kevii.nl";\r\n   &nbsp;&nbsp;&nbsp;&nbsp; $description = "Website van Kevin Kraaijveld";\r\n	$logo = "https://kevii.nl/wp-content/uploads/2018/08/DSCN1511.jpg";\r\n	\r\n// Person variables\r\n	$birthDate = "1993-02-25";\r\n	$contactPoint = "https://www.kevii.nl/contact";\r\n	$email = "mailto:kevinkraaijveld@hotmail.com";\r\n	$givenName = "Kevin";\r\n	$familyName = "Kraaijveld";\r\n	$nationality = "Dutch";\r\n	$jobTitle = "Web Developer";\r\n	$profileImage = "https://kevii.nl/wp-content/uploads/2018/10/2018-MBO-ICT-22_2-300x200.jpg";\r\n	\r\n// Social variables\r\n	$facebook = "https://www.facebook.com/kkraaijveld";\r\n	$twitter = "https://twitter.com/kevinkraaijveld";\r\n	$googleplus = "https://plus.google.com/+KevinKraaijveld";\r\n	$linkedin = "https://www.linkedin.com/in/kevinkraaijveld";\r\n	\r\n	$person = array(\r\n		"@content" =&gt; "http://schema.org/",\r\n		"@type" =&gt; "Person",\r\n		"url" =&gt; $url,\r\n		"givenName" =&gt; $givenName,\r\n		"familyName" =&gt; $familyName,\r\n		"birthDate" =&gt; $birthDate,\r\n		"nationality" =&gt; $nationality,\r\n		"image" =&gt; $profileImage,\r\n		"email" =&gt; $email,\r\n		"jobTitle" =&gt; $jobTitle,\r\n		"contactPoint" =&gt; $contactPoint\r\n	);<br></p><p>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$website = array(\r\n		"@content" =&gt; "http://schema.org/",\r\n		"@type" =&gt; "WebSite",\r\n		"url" =&gt; $url,\r\n		"name" =&gt; $site_name,\r\n		"alternateName" =&gt; $description,\r\n		"potentialAction" =&gt; array(\r\n			"@type" =&gt; "SearchAction",\r\n			"target" =&gt; $url . "?s={query}",\r\n			"query-input" =&gt; "required name=query"\r\n		),\r\n	);\r\n	</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if (!empty($logo)) {\r\n		list($width, $height) = getimagesize($logo);\r\n		$organization["logo"] = array(\r\n			"@type" =&gt; "ImageObject",\r\n			"url" =&gt; $logo,\r\n			"width" =&gt; $width,\r\n			"height" =&gt; $height,\r\n		);\r\n	}\r\n	\r\n	$person["sameAs"][] = $facebook;\r\n	$person["sameAs"][] = $twitter;\r\n	$person["sameAs"][] = $googleplus;\r\n	$person["sameAs"][] = $linkedin;\r\n\r\n?&gt;&lt;script id="kevii-json-website" type="application/ld+json"&gt;&lt;?php\r\n            echo json_encode($website, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?&gt;&lt;/script&gt;&lt;?php\r\n            ?&gt;&lt;script id="kevii-json-person" type="application/ld+json"&gt;&lt;?php\r\n            echo json_encode($person, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?&gt;&lt;/script&gt;&lt;?php\r\n});\r\n    <br><script id="kevii-json-website" type="application/ld+json"><?php\r\n            echo json_encode($website, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?></script><!--?php\r\n            ?--><script id="kevii-json-person" type="application/ld+json"><?php\r\n            echo json_encode($person, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?></script><!--?php\r\n});\r\n    <br--><script id="kevii-json-website" type="application/ld+json"><?php\r\n            echo json_encode($website, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?></script><!--?php\r\n            ?--><script id="kevii-json-person" type="application/ld+json"><?php\r\n            echo json_encode($person, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?></script><!--?php\r\n});<br--></p></pre><div><br></div><p><br></p>\r\n\r\n', 'Wordpress', 0, 'Published', 75),
(4, 1, 'Defeault table', '2', '2019-01-17 15:59:14', '', '<p>This is a defeault setupre for a simprele table</p><pre>&lt;table&gt;\r\n&nbsp;&nbsp;&nbsp;&nbsp;&lt;tbody&gt;\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;tr&gt;\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;th&gt;Table head 1&lt;/th&gt;\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;th&gt;Table head 2&lt;/th&gt;\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;th&gt;Table head 3&lt;/th&gt;\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/tr&gt;\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;tr&gt;\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;td&gt;Table column 1 cell 1&lt;/td&gt;\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;td&gt;Table column 1 cell 2&lt;/td&gt;\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;td&gt;Table column 1 cell 3&lt;/td&gt;\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/tr&gt;\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;tr&gt;\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;td&gt;Table column 2 cell 1&lt;/td&gt;\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;td&gt;Table column 2 cell 2&lt;/td&gt;\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;td&gt;Table column 2 cell 3&lt;/td&gt;\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/tr&gt;\r\n&nbsp;&nbsp;&nbsp;&nbsp;&lt;/tbody&gt;\r\n&lt;/table&gt;<br></pre>', 'Table', 0, 'Published', 1),
(9, 3, 'Set cookie', '2', '2019-01-17 16:08:11', '', '<p>This is how you set a cookie in php.</p><pre>// Set cookie\r\n&nbsp;&nbsp;&nbsp;&nbsp;$name = "Tracer";\r\n&nbsp;&nbsp;&nbsp;&nbsp;$value = "$2y$10$/JnzlEfgmGHll1kWIaKcxu135gN8VaarWP.eDGNz269y59MWAFLJC";\r\n&nbsp;&nbsp;&nbsp;&nbsp;$expiration = time() + (60*60*24*365);\r\n&nbsp;&nbsp;&nbsp;&nbsp;setcookie($name,$value,$expiration);<br></pre>', '', 0, 'Published', 1),
(12, 4, 'Wordpress debug mode', '2', '2019-01-17 16:41:04', '', '<p>This is how you turn on the debug mode in wordpress</p><pre>define( "WP_DEBUG", true );\r\ndefine( "WP_DEBUG_LOG", true );\r\ndefine( "WP_DEBUG_DISPLAY", false );<br></pre>', 'Wordpress, Debug', 0, 'Published', 20);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(3) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_image` text NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `randSalt` varchar(255) NOT NULL DEFAULT '$2y$10$iusesomecrazystrings22',
  `token` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`, `randSalt`, `token`) VALUES
(1, 'Admin', '$2y$10$QmvpdwwyG4kZrC4KpZzVq.tLPNGiD9Dbb/ql/g53U6PzdLgqbWpli', 'Admin', '', 'admin@cms.com', 'avatar.jpg', 'Admin', '$2y$10$iusesomecrazystrings22', ''),
(2, 'kevin', '$2y$10$LKxRK9eUmoQCITcxJtsFS.pvQsclkLx/ajZhpZnFEhMl5tcPXaD22', 'Kevin', 'Kraaijveld', 'kevinkraaijveld@gmail.com', 'DSC_0308.JPG', 'Admin', '$2y$10$iusesomecrazystrings22', '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users_online`
--

CREATE TABLE IF NOT EXISTS `users_online` (
  `id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `users_online`
--

INSERT INTO `users_online` (`id`, `session`, `time`) VALUES
(3, '90ao6m50gnc3mck85v5ehjos07', 1547714402),
(4, '4490u8b44fe1hrsmtd67drdhf0', 1547734397),
(5, '88qrm7i98ol444gi8bu7q32292', 1547742574),
(6, 'hg9b8ftdr1p0rka7ffs2o45rc6', 1547817842);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexen voor tabel `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexen voor tabel `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexen voor tabel `users_online`
--
ALTER TABLE `users_online`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT voor een tabel `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT voor een tabel `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT voor een tabel `users_online`
--
ALTER TABLE `users_online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
