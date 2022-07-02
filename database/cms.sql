-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 02, 2022 at 09:34 AM
-- Server version: 5.6.37
-- PHP Version: 7.1.8

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
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `cat_id` int(3) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'HTML'),
(2, 'Javascript'),
(3, 'PHP'),
(4, 'Wordpress');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_post_id` int(3) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(255) NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(1, 1, 'Admin ', 'admin@cms.com', 'Nice post!', 'Approved', '2019-01-12'),
(2, 13, 'Kevin', 'kevinkraaijveld@gmail.com', 'Very usefull!', 'Pending', '2022-06-13'),
(3, 14, 'Admin ', 'admin@cms.com', 'Edit this to span in pre', 'Pending', '2022-06-24'),
(6, 14, 'Admin ', 'admin@cms.com', 'post\r\n', 'Pending', '2022-06-24');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `message`) VALUES
(2, 'Kevin Kraaijveld', 'kevinkraaijveld@gmail.com', 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`, `post_views_count`) VALUES
(1, 4, 'Schema.org setup', '2', '2019-01-17 14:18:22', 'Magento-2-Schema.org-Integration.jpg', '<p>This is a Wordpress function to add markup to your website.</p>\r\n\r\n<p>Structured data, also called schema markup, is a type of code that makes it easier for search engines to crawl, organize, and display your content. Structured data communicates to search engines what your data means. Without schema markup, search engines can only tell what your data says, and they have to work harder to determine why it’s there.</p><pre>/**\r\n* @name("Google - Schema.org")\r\n* @description("Add schema.org json.")\r\n* @option("webprofit_enable_schema_org")\r\n**/\r\n\r\n<p>add_action(wp_footer, function () {</p><p>// Website variables\r\n	$url = "https://www.kevii.nl";\r\n    &nbsp;&nbsp;&nbsp;&nbsp;$site_name = "Kevii.nl";\r\n   &nbsp;&nbsp;&nbsp;&nbsp; $description = "Website van Kevin Kraaijveld";\r\n	$logo = "https://kevii.nl/wp-content/uploads/2018/08/DSCN1511.jpg";\r\n	\r\n// Person variables\r\n	$birthDate = "1993-02-25";\r\n	$contactPoint = "https://www.kevii.nl/contact";\r\n	$email = "mailto:kevinkraaijveld@hotmail.com";\r\n	$givenName = "Kevin";\r\n	$familyName = "Kraaijveld";\r\n	$nationality = "Dutch";\r\n	$jobTitle = "Web Developer";\r\n	$profileImage = "https://kevii.nl/wp-content/uploads/2018/10/2018-MBO-ICT-22_2-300x200.jpg";\r\n	\r\n// Social variables\r\n	$facebook = "https://www.facebook.com/kkraaijveld";\r\n	$twitter = "https://twitter.com/kevinkraaijveld";\r\n	$googleplus = "https://plus.google.com/+KevinKraaijveld";\r\n	$linkedin = "https://www.linkedin.com/in/kevinkraaijveld";\r\n	\r\n	$person = array(\r\n		"@content" =&gt; "http://schema.org/",\r\n		"@type" =&gt; "Person",\r\n		"url" =&gt; $url,\r\n		"givenName" =&gt; $givenName,\r\n		"familyName" =&gt; $familyName,\r\n		"birthDate" =&gt; $birthDate,\r\n		"nationality" =&gt; $nationality,\r\n		"image" =&gt; $profileImage,\r\n		"email" =&gt; $email,\r\n		"jobTitle" =&gt; $jobTitle,\r\n		"contactPoint" =&gt; $contactPoint\r\n	);<br></p><p>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$website = array(\r\n		"@content" =&gt; "http://schema.org/",\r\n		"@type" =&gt; "WebSite",\r\n		"url" =&gt; $url,\r\n		"name" =&gt; $site_name,\r\n		"alternateName" =&gt; $description,\r\n		"potentialAction" =&gt; array(\r\n			"@type" =&gt; "SearchAction",\r\n			"target" =&gt; $url . "?s={query}",\r\n			"query-input" =&gt; "required name=query"\r\n		),\r\n	);\r\n	</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if (!empty($logo)) {\r\n		list($width, $height) = getimagesize($logo);\r\n		$organization["logo"] = array(\r\n			"@type" =&gt; "ImageObject",\r\n			"url" =&gt; $logo,\r\n			"width" =&gt; $width,\r\n			"height" =&gt; $height,\r\n		);\r\n	}\r\n	\r\n	$person["sameAs"][] = $facebook;\r\n	$person["sameAs"][] = $twitter;\r\n	$person["sameAs"][] = $googleplus;\r\n	$person["sameAs"][] = $linkedin;\r\n\r\n?&gt;&lt;script id="kevii-json-website" type="application/ld+json"&gt;&lt;?php\r\n            echo json_encode($website, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?&gt;&lt;/script&gt;&lt;?php\r\n            ?&gt;&lt;script id="kevii-json-person" type="application/ld+json"&gt;&lt;?php\r\n            echo json_encode($person, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?&gt;&lt;/script&gt;&lt;?php\r\n});\r\n    <br><script id="kevii-json-website" type="application/ld+json"><?php\r\n            echo json_encode($website, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?></script><!--?php\r\n            ?--><script id="kevii-json-person" type="application/ld+json"><?php\r\n            echo json_encode($person, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?></script><!--?php\r\n});\r\n    <br--><script id="kevii-json-website" type="application/ld+json"><?php\r\n            echo json_encode($website, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?></script><!--?php\r\n            ?--><script id="kevii-json-person" type="application/ld+json"><?php\r\n            echo json_encode($person, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?></script><!--?php\r\n});<br--></p></pre><div><br></div><p><br></p>\r\n\r\n', 'Wordpress', 0, 'Published', 106),
(4, 1, 'Defeault table', '2', '2019-01-17 15:59:14', '', '<p>This is a defeault setup for a simple table</p><pre><span class="tagnamecolor" style="color:brown"><span class="tagcolor" style="color:mediumblue">&lt;</span>table<span class="tagcolor" style="color:mediumblue">&gt;</span></span>\r\n&nbsp;&nbsp;&nbsp;&nbsp;<span class="tagnamecolor" style="color:brown"><span class="tagcolor" style="color:mediumblue">&lt;</span>tr<span class="tagcolor" style="color:mediumblue">&gt;</span></span><br>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;<span class="tagnamecolor" style="color:brown"><span class="tagcolor" style="color:mediumblue">&lt;</span>th<span class="tagcolor" style="color:mediumblue">&gt;</span></span>Table head 1<span class="tagnamecolor" style="color:brown"><span class="tagcolor" style="color:mediumblue">&lt;</span>/th<span class="tagcolor" style="color:mediumblue">&gt;</span></span>\r\n&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;<span class="tagnamecolor" style="color:brown"><span class="tagcolor" style="color:mediumblue">&lt;</span>th<span class="tagcolor" style="color:mediumblue">&gt;</span></span>Table head 2<span class="tagnamecolor" style="color:brown"><span class="tagcolor" style="color:mediumblue">&lt;</span>/th<span class="tagcolor" style="color:mediumblue">&gt;</span></span><br>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;<span class="tagnamecolor" style="color:brown"><span class="tagcolor" style="color:mediumblue">&lt;</span>th<span class="tagcolor" style="color:mediumblue">&gt;</span></span>Table head 3<span class="tagnamecolor" style="color:brown"><span class="tagcolor" style="color:mediumblue">&lt;</span>/th<span class="tagcolor" style="color:mediumblue">&gt;</span></span>\r\n&nbsp;&nbsp;&nbsp;&nbsp;<span class="tagnamecolor" style="color:brown"><span class="tagcolor" style="color:mediumblue">&lt;</span>/tr<span class="tagcolor" style="color:mediumblue">&gt;</span></span>\r\n&nbsp;&nbsp;&nbsp;&nbsp;<span class="tagnamecolor" style="color:brown"><span class="tagcolor" style="color:mediumblue">&lt;</span>tr<span class="tagcolor" style="color:mediumblue">&gt;</span></span><br>&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;<span class="tagnamecolor" style="color:brown"><span class="tagcolor" style="color:mediumblue">&lt;</span>td<span class="tagcolor" style="color:mediumblue">&gt;</span></span>Table column 1 cell 1<span class="tagnamecolor" style="color:brown"><span class="tagcolor" style="color:mediumblue">&lt;</span>/td<span class="tagcolor" style="color:mediumblue">&gt;</span></span>\r\n&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;<span class="tagnamecolor" style="color:brown"><span class="tagcolor" style="color:mediumblue">&lt;</span>td<span class="tagcolor" style="color:mediumblue">&gt;</span></span>Table column 1 cell 2<span class="tagnamecolor" style="color:brown"><span class="tagcolor" style="color:mediumblue">&lt;</span>/td<span class="tagcolor" style="color:mediumblue">&gt;</span></span><br>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;<span class="tagnamecolor" style="color:brown"><span class="tagcolor" style="color:mediumblue">&lt;</span>td<span class="tagcolor" style="color:mediumblue">&gt;</span></span>Table column 1 cell 3<span class="tagnamecolor" style="color:brown"><span class="tagcolor" style="color:mediumblue">&lt;</span>/td<span class="tagcolor" style="color:mediumblue">&gt;</span></span>\r\n&nbsp;&nbsp;&nbsp;&nbsp;<span class="tagnamecolor" style="color:brown"><span class="tagcolor" style="color:mediumblue">&lt;</span>/tr<span class="tagcolor" style="color:mediumblue">&gt;</span></span><br>&nbsp; &nbsp;&nbsp;<span class="tagnamecolor" style="color:brown"><span class="tagcolor" style="color:mediumblue">&lt;</span>tr<span class="tagcolor" style="color:mediumblue">&gt;</span></span><br>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;<span class="tagnamecolor" style="color:brown"><span class="tagcolor" style="color:mediumblue">&lt;</span>td<span class="tagcolor" style="color:mediumblue">&gt;</span></span>Table column 2 cell 1<span class="tagnamecolor" style="color:brown"><span class="tagcolor" style="color:mediumblue">&lt;</span>/td<span class="tagcolor" style="color:mediumblue">&gt;</span></span>\r\n&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;<span class="tagnamecolor" style="color:brown"><span class="tagcolor" style="color:mediumblue">&lt;</span>td<span class="tagcolor" style="color:mediumblue">&gt;</span></span>Table column 2 cell 2<span class="tagnamecolor" style="color:brown"><span class="tagcolor" style="color:mediumblue">&lt;</span>/td<span class="tagcolor" style="color:mediumblue">&gt;</span></span><br>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;<span class="tagnamecolor" style="color:brown"><span class="tagcolor" style="color:mediumblue">&lt;</span>td<span class="tagcolor" style="color:mediumblue">&gt;</span></span>Table column 2 cell 3<span class="tagnamecolor" style="color:brown"><span class="tagcolor" style="color:mediumblue">&lt;</span>/td<span class="tagcolor" style="color:mediumblue">&gt;</span></span>\r\n&nbsp; &nbsp;&nbsp;<span class="tagnamecolor" style="color:brown"><span class="tagcolor" style="color:mediumblue">&lt;</span>/tr<span class="tagcolor" style="color:mediumblue">&gt;</span></span><br><span class="tagnamecolor" style="color:brown"><span class="tagcolor" style="color:mediumblue">&lt;</span>/table<span class="tagcolor" style="color:mediumblue">&gt;</span></span><br><table>\r\n     \r\n</table></pre>', 'Table', 0, 'Published', 44),
(9, 3, 'Set cookie', '2', '2019-01-17 16:08:11', '', '<p>This is how you set a cookie in php.</p><pre>// Set cookie\r\n&nbsp;&nbsp;&nbsp;&nbsp;$name = "Tracer";\r\n&nbsp;&nbsp;&nbsp;&nbsp;$value = "$2y$10$/JnzlEfgmGHll1kWIaKcxu135gN8VaarWP.eDGNz269y59MWAFLJC";\r\n&nbsp;&nbsp;&nbsp;&nbsp;$expiration = time() + (60*60*24*365);\r\n&nbsp;&nbsp;&nbsp;&nbsp;setcookie($name,$value,$expiration);<br></pre>', '', 0, 'Published', 6),
(12, 4, 'Wordpress debug mode', '2', '2019-01-17 16:41:04', '', '<p>This is how you turn on the debug mode in wordpress</p><pre>define( "WP_DEBUG", true );\r\ndefine( "WP_DEBUG_LOG", true );\r\ndefine( "WP_DEBUG_DISPLAY", false );<br></pre>', 'Wordpress, Debug', 0, 'Published', 46),
(13, 3, 'Database connection', '2', '2022-05-14 10:55:04', '', '<p>This is how you connect to a database.</p>\r\n<pre>// KK: database variables\r\n    $db[''db_host''] = "hostname";\r\n    $db[''db_user''] = "username";\r\n    $db[''db_pass''] = "password";\r\n    $db[''db_name''] = "databaseName";\r\n\r\n// KK: as constances\r\n    foreach($db as $key =&gt; $value){\r\n       define(strtoupper($key), $value);\r\n    }\r\n\r\n// KK: make the connection\r\n    $connection = mysqli_connect(DB_HOST, DB_USER,DB_PASS,DB_NAME);\r\n<br>\r\n</pre>', '', 1, 'Published', 131),
(14, 3, 'Javascipt alert PHP', '2', '2022-06-21 12:02:46', '', '<pre><span class="jscolor" style=""><span class="jskeywordcolor" style="color: rgb(0, 0, 0);">echo </span><span style="color: rgb(0, 0, 0);">"&lt;</span><span class="jskeywordcolor" style="color: rgb(255, 0, 0);">script</span><span style="color: rgb(0, 0, 0);">&gt; </span><span class="jsnumbercolor" style="color: rgb(0, 0, 255);">alert</span><span style="color: rgb(0, 0, 0);">( </span><span class="jsstringcolor" style="color: rgb(0, 0, 0);">''</span><span style="color: rgb(57, 123, 33);"><span class="jsstringcolor" style="">Type is </span><span class="jsstringcolor" style="">toegevoegd</span></span><span class="jsstringcolor" style="color: rgb(0, 0, 0);">''</span><span style="color: rgb(0, 0, 0);">); </span><span style="color: rgb(255, 0, 0);">window.location</span><span style="color: rgb(0, 0, 0);"> = ''</span><span style="color: rgb(57, 123, 33);">/index/</span><span style="color: rgb(0, 0, 0);">'';<!--</span--></span><span class="jscolor" style="color: rgb(255, 0, 0);">script</span><span style="color: rgb(0, 0, 0);">&gt;";</span></span></pre>', '', 2, 'Published', 93),
(15, 1, 'Default form', '2', '2022-06-24 16:11:52', '', '<pre><span class="tagnamecolor" style="color:brown"><span class="tagcolor" style="color:mediumblue">&lt;</span>form<span class="attributecolor" style="color:red"> action<span class="attributevaluecolor" style="color:mediumblue">="/action_page.php"</span></span><span class="tagcolor" style="color:mediumblue">&gt;</span></span><br>&nbsp; <span class="tagnamecolor" style="color:brown"><span class="tagcolor" style="color:mediumblue">&lt;</span>label<span class="attributecolor" style="color:red"> for<span class="attributevaluecolor" style="color:mediumblue">="fname"</span></span><span class="tagcolor" style="color:mediumblue">&gt;</span></span>First name:<span class="tagnamecolor" style="color:brown"><span class="tagcolor" style="color:mediumblue">&lt;</span>/label<span class="tagcolor" style="color:mediumblue">&gt;</span></span><span class="tagnamecolor" style="color:brown"><span class="tagcolor" style="color:mediumblue">&lt;</span>br<span class="tagcolor" style="color:mediumblue">&gt;</span></span><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span class="tagnamecolor" style="color:brown"><span class="tagcolor" style="color:mediumblue">&lt;</span>input<span class="attributecolor" style="color:red"> type<span class="attributevaluecolor" style="color:mediumblue">="text"</span> id<span class="attributevaluecolor" style="color:mediumblue">="fname"</span> name<span class="attributevaluecolor" style="color:mediumblue">="fname"</span> value<span class="attributevaluecolor" style="color:mediumblue">="John"</span></span><span class="tagcolor" style="color:mediumblue">&gt;</span></span><span class="tagnamecolor" style="color:brown"><span class="tagcolor" style="color:mediumblue">&lt;</span>br<span class="tagcolor" style="color:mediumblue">&gt;</span></span><br>&nbsp; <span class="tagnamecolor" style="color:brown"><span class="tagcolor" style="color:mediumblue">&lt;</span>label<span class="attributecolor" style="color:red"> for<span class="attributevaluecolor" style="color:mediumblue">="lname"</span></span><span class="tagcolor" style="color:mediumblue">&gt;</span></span>Last name:<span class="tagnamecolor" style="color:brown"><span class="tagcolor" style="color:mediumblue">&lt;</span>/label<span class="tagcolor" style="color:mediumblue">&gt;</span></span><span class="tagnamecolor" style="color:brown"><span class="tagcolor" style="color:mediumblue">&lt;</span>br<span class="tagcolor" style="color:mediumblue">&gt;</span></span><br>&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;<span class="tagnamecolor" style="color:brown"><span class="tagcolor" style="color:mediumblue">&lt;</span>input<span class="attributecolor" style="color:red"> type<span class="attributevaluecolor" style="color:mediumblue">="text"</span> id<span class="attributevaluecolor" style="color:mediumblue">="lname"</span> name<span class="attributevaluecolor" style="color:mediumblue">="lname"</span> value<span class="attributevaluecolor" style="color:mediumblue">="Doe"</span></span><span class="tagcolor" style="color:mediumblue">&gt;</span></span><span class="tagnamecolor" style="color:brown"><span class="tagcolor" style="color:mediumblue">&lt;</span>br<span class="tagcolor" style="color:mediumblue">&gt;</span></span><span class="tagnamecolor" style="color:brown"><span class="tagcolor" style="color:mediumblue">&lt;</span>br<span class="tagcolor" style="color:mediumblue">&gt;</span></span>\r\n  <span class="tagnamecolor" style="color:brown"><span class="tagcolor" style="color:mediumblue">&lt;</span>input<span class="attributecolor" style="color:red"> type<span class="attributevaluecolor" style="color:mediumblue">="submit"</span> value<span class="attributevaluecolor" style="color:mediumblue">="Submit"</span></span><span class="tagcolor" style="color:mediumblue">&gt;</span></span><br><span class="tagnamecolor" style="color:brown"><span class="tagcolor" style="color:mediumblue">&lt;</span>/form<span class="tagcolor" style="color:mediumblue">&gt;</span></span></pre>', 'HTML form', 0, 'Published', 3),
(17, 1, 'Youtube iframe', '2', '2022-06-24 16:16:50', '', '<pre><span class="tagnamecolor" style=""><span class="tagcolor" style="color: mediumblue;">&lt;</span><font color="#a52a2a">iframe</font><span class="attributecolor" style="color: red;"> width<span class="attributevaluecolor" style="color:mediumblue">="420"</span> height<span class="attributevaluecolor" style="color:mediumblue">="315"</span>src<span class="attributevaluecolor" style="color:mediumblue">="https://www.youtube.com/embed/tgbNymZ7vqY"</span></span><span class="tagcolor" style="color: mediumblue;">&gt;</span><span class="tagcolor" style=""> </span></span><span class="tagnamecolor" style="color:brown"><span class="tagcolor" style="color:mediumblue">&lt;</span>/iframe<span class="tagcolor" style="color:mediumblue">&gt;</span></span>\r\n</pre>', '', 0, 'Published', 10),
(20, 2, 'Javascript array', '2', '2022-06-24 16:46:21', '', '<pre><span class="jskeywordcolor" style="color:mediumblue">const</span><span class="jskeywordcolor" style="color:black"> cars = [</span><span class="jsnumbercolor" style="color:red">\r\n</span>&nbsp;&nbsp;<span class="jsstringcolor" style="color:brown">"Saab"</span>,<span class="jsnumbercolor" style="color:red">\r\n</span>  <span class="jsstringcolor" style="color:brown">"Volvo"</span>,<span class="jsnumbercolor" style="color:red">\r\n</span>  <span class="jsstringcolor" style="color:brown">"BMW"</span><span class="jsnumbercolor" style="color:red">\r\n</span><span class="jskeywordcolor" style="color:black">];</span></pre>', 'Javascript array', 0, 'Published', 13),
(21, 2, 'Javascript for loop', '2', '2022-06-24 16:48:11', '', '<pre><span class="jscolor" style="color:black"><span class="jskeywordcolor" style="color:mediumblue">for</span> (<span class="jskeywordcolor" style="color:mediumblue">let</span> i = <span class="jsnumbercolor" style="color:red">0</span>; i &lt; <span class="jsnumbercolor" style="color:red">5</span>; i++) {<br><span class="jsnumbercolor" style="color:red">\r\n</span> &nbsp; text += <span class="jsstringcolor" style="color:brown">"The number is "</span> + i + <span class="jsstringcolor" style="color:brown">"&lt;br&gt;"</span>;<br><span class="jsnumbercolor" style="color:red">\r\n</span>}<br><span class="jsnumbercolor" style="color:red">\r\n</span>  </span></pre>', 'Javascript for loop', 0, 'Published', 43);

-- --------------------------------------------------------

--
-- Table structure for table `users`
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`, `randSalt`, `token`) VALUES
(1, 'Admin', '$2y$10$5bWMyOVlXNTHeFKtAy34L.eUADTGI/S6BFq2HrbwKhIIAfa0JMOlG', 'Admin', '', 'admin@cms.com', 'avatar.jpg', 'Admin', '$2y$10$iusesomecrazystrings22', ''),
(2, 'kevin', '$2y$10$LKxRK9eUmoQCITcxJtsFS.pvQsclkLx/ajZhpZnFEhMl5tcPXaD22', 'Kevin', 'Kraaijveld', 'kevinkraaijveld@gmail.com', 'DSC_0308.JPG', 'Author', '$2y$10$iusesomecrazystrings22', ''),
(3, 'Administrator', '$2y$10$QmvpdwwyG4kZrC4KpZzVq.tLPNGiD9Dbb/ql/g53U6PzdLgqbWpli', 'Admin', '', 'admin@cms.com', 'avatar.jpg', 'Admin', '$2y$10$iusesomecrazystrings22', ''),
(4, 'Peter', '$2y$10$3oRyOU3rZe5jKwMNqPNsd.S6aGDOUxaulmlLQuRWSc1wV2YIMydhu', 'Peter', 'Snoek', 'petersnoek@gmail.com', 'avatar.jpg', 'Admin', '$2y$10$iusesomecrazystrings22', '');

-- --------------------------------------------------------

--
-- Table structure for table `users_online`
--

CREATE TABLE IF NOT EXISTS `users_online` (
  `id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_online`
--

INSERT INTO `users_online` (`id`, `session`, `time`) VALUES
(3, '90ao6m50gnc3mck85v5ehjos07', 1547714402),
(4, '4490u8b44fe1hrsmtd67drdhf0', 1547734397),
(5, '88qrm7i98ol444gi8bu7q32292', 1547742574),
(6, 'hg9b8ftdr1p0rka7ffs2o45rc6', 1547817842),
(7, '152c06e378bc21233aae5e00926ce575', 1547910505),
(8, 'ae0cdd8931b8777d424dbe67832daf31', 1652531669),
(9, 'f93c2bdb364fa051b829a68cf62b9498', 1652888672),
(10, '4fcada49cf6a744c413964d02450c0db', 1655112890),
(11, 'ec44866afda0984b8755b97f2a70ef01', 1655726112),
(12, '25feb05fa04b4333934dca5501ea7516', 1655807643),
(13, '2c0d3f2d3ce4b3dc88b115c12e6095c1', 1656006860),
(14, '655cbdd48f42d19c4471a3c688d78382', 1656101771),
(15, 'dc10eaf9a82af8235d74437a027d1c07', 1656178088),
(16, '09200c50aeadf8c6b79f5f7174ba5ab3', 1656163813),
(17, 'ddd05136dbc9c558f8b1be5c1b3665f8', 1656348133),
(18, 'e7c28f0ae7b840639c0658be2c23e93c', 1656587354),
(19, '2c1883d47c917cfd64c345d214b507c1', 1656754267);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `users_online`
--
ALTER TABLE `users_online`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users_online`
--
ALTER TABLE `users_online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
