-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 06 juil. 2024 à 01:56
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `food_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`) VALUES
(1, 'admin', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2');

-- --------------------------------------------------------

--
-- Structure de la table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(1, 1, 's', 'zlayji29@gmail.com', '21', 'ZAZAZA');

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` date NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(4, 2, 'A', '1', 'zl@gmail.com', 'cash on delivery', '1, 1, 1, fnideq, fnideq, Khmisset, Maroc - 93102', 'Coco Mango (6 x 1) - ', 6, '2024-06-28', 'pending'),
(5, 2, 'A', '1', 'zl@gmail.com', 'cash on delivery', '1, 1, 1, fnideq, fnideq, Khmisset, Maroc - 93102', 'Pepperoni Pizza (9 x 1) - ', 9, '2024-07-04', 'completed'),
(6, 2, 'A', '1', 'zl@gmail.com', 'paypal', '1, 1, 1, fnideq, fnideq, Khmisset, Maroc - 93102', 'Whopper (6 x 1) - ', 6, '2024-07-04', 'pending'),
(7, 2, 'A', '1', 'zl@gmail.com', 'paypal', '1, 1, 1, fnideq, fnideq, Khmisset, Maroc - 93102', 'Whopper (6 x 1) - ', 6, '2024-07-04', 'pending'),
(8, 2, 'A', '1', 'zl@gmail.com', 'paypal', '1, 1, 1, fnideq, fnideq, Khmisset, Maroc - 93102', '', 0, '2024-07-04', 'pending');

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `price`, `image`) VALUES
(1, 'Big Mac', 'Burger', 6, 'big_mac.jpg'),
(2, 'Whopper', 'Burger', 6, 'whopper.jpg'),
(3, 'Cheeseburger', 'Burger', 4, 'cheeseburger.jpg'),
(4, 'Chicken Cheeseburger', 'Burger', 5, 'chicken_cheeseburger.jpg'),
(5, 'Double Cheeseburger', 'Burger', 5, 'double_cheeseburger.jpg'),
(6, 'Mushroom Swiss Burger', 'Burger', 6, 'mushroom_swiss_burger.jpg'),
(7, 'BBQ Burger', 'Burger', 6, 'bbq_burger.jpg'),
(8, 'Veggie Burger', 'Burger', 5, 'veggie_burger.jpg'),
(9, 'Turkey Burger', 'Burger', 5, 'turkey_burger.jpg'),
(10, 'Jalapeno Burger', 'Burger', 6, 'jalapeno_burger.jpg'),
(11, 'Guacamole Burger', 'Burger', 6, 'guacamole_burger.jpg'),
(12, 'Fish Burger', 'Burger', 6, 'fish_burger.jpg'),
(14, 'Black Bean Burger', 'Burger', 5, 'black_bean_burger.jpg'),
(15, 'Hawaiian Burger', 'Burger', 7, 'hawaiian_burger.jpg'),
(16, 'Breakfast Burger', 'Burger', 6, 'breakfast_burger.jpg'),
(17, 'Buffalo Burger', 'Burger', 7, 'buffalo_burger.jpg'),
(18, 'Truffle Burger', 'Burger', 8, 'truffle_burger.jpg'),
(19, 'Kimchi Burger', 'Burger', 7, 'kimchi_burger.jpg'),
(20, 'Teriyaki Burger', 'Burger', 6, 'teriyaki_burger.jpg'),
(22, 'Ice Cream Sundae', 'desserts', 4, 'ice_cream_sundae.jpg'),
(23, 'Apple Pie', 'desserts', 3, 'apple_pie.jpg'),
(24, 'Brownie', 'desserts', 3, 'brownie.jpg'),
(25, 'Cheesecake', 'desserts', 4, 'cheesecake.jpg'),
(26, 'Donut', 'desserts', 2, 'donut.jpg'),
(27, 'Cupcake', 'desserts', 2, 'cupcake.jpg'),
(28, 'Fruit Salad', 'desserts', 4, 'fruit_salad.jpg'),
(29, 'Tiramisu', 'desserts', 5, 'tiramisu.jpg'),
(30, 'Chocolate Chip Cookie', 'desserts', 1, 'chocolate_chip_cookie.jpg'),
(31, 'Margherita Pizza', 'Pizza', 8, 'margherita_pizza.jpg'),
(32, 'Pepperoni Pizza', 'Pizza', 9, 'pepperoni.jpg'),
(33, 'BBQ Chicken Pizza', 'Pizza', 9, 'bbq_chicken.jpg'),
(34, 'Hawaiian Pizza', 'Pizza', 8, 'hawaiian.jpg'),
(35, 'Veggie Pizza', 'Pizza', 8, 'veggie.jpg'),
(36, 'Meat Lover\'s Pizza', 'Pizza', 10, 'meat_lovers.jpg'),
(37, 'Supreme Pizza', 'Pizza', 10, 'supreme.jpg'),
(38, 'Four Cheese Pizza', 'Pizza', 9, 'four_cheese.jpg'),
(39, 'Buffalo Chicken Pizza', 'Pizza', 9, 'buffalo_chicken.jpg'),
(40, 'Mushroom Pizza', 'Pizza', 8, 'mushroom.jpg'),
(41, 'Spaghetti Carbonara', 'Pasta', 9, 'spaghetti.jpg'),
(42, 'Fettuccine Alfredo', 'Pasta', 8, 'fettuccine.jpg'),
(43, 'Lasagna', 'Pasta', 9, 'lasagna.jpg'),
(44, 'Penne Arrabbiata', 'Pasta', 8, 'penne_arrabbiata.jpg'),
(45, 'Bolognese', 'Pasta', 9, 'bolognese.jpg'),
(46, 'Pesto Pasta', 'Pasta', 8, 'pesto_pasta.jpg'),
(47, 'Seafood Linguine', 'Pasta', 10, 'seafood_linguine.jpg'),
(48, 'Ravioli', 'Pasta', 8, 'ravioli.jpg'),
(49, 'Mac and Cheese', 'Pasta', 7, 'mac_and_cheese.jpg'),
(50, 'Gnocchi', 'Pasta', 8, 'gnocchi.jpg'),
(51, 'Chicken Tagine', 'Traditional Moroccan', 11, '58146_Moroccan Chicken Tagine.jpeg'),
(52, 'Bissara', 'Traditional Moroccan', 12, '61959_Bissara.jpg'),
(53, 'Vegetable Couscous', 'Traditional Moroccan', 9, '68526_57738_w1024h768c1cx256cy192.jpg'),
(54, 'lambs-head', 'Traditional Moroccan', 13, 'lambs-head.jpg'),
(55, 'Harira Soup', 'Traditional Moroccan', 6, 'harira_soup.jpg'),
(56, 'Pastilla', 'Traditional Moroccan', 10, 'pastilla.jpg'),
(57, 'Mechoui', 'Traditional Moroccan', 15, 'mechoui.jpg'),
(58, 'seffa', 'Traditional Moroccan', 12, 'seffa.jpg'),
(59, 'Zaalouk', 'Traditional Moroccan', 7, 'moroccan-food-zaalouk-edited.jpeg'),
(60, 'Mint Tea', 'Traditional Moroccan', 3, 'Mint-tea-300x178.png'),
(85, 'Cocktail exotique', 'drinks', 9, '1-Cocktail-exotique-400x400.jpg'),
(86, 'Coco Mango', 'drinks', 6, '1-Coco-Mango-400x400.jpg'),
(87, 'Espresso', 'drinks', 5, '1-Espresso-400x400.jpg'),
(88, 'Jus d\'orange', 'drinks', 4, '1-Jus-dorange-400x400.jpg'),
(89, 'Mojito blueberry', 'drinks', 7, '1-Mojito-blueberry-400x400.jpg'),
(90, 'Latte Caramel', 'drinks', 6, '10-Latté-Caramel-400x400.jpg'),
(91, 'Chocolat Chaud', 'drinks', 7, '12-Chocolat-Chaud-400x400.jpg'),
(92, 'Chocolat blanc', 'drinks', 5, '13-Chocolat-blanc-400x400.jpg'),
(93, 'Chocolat KitKat', 'drinks', 8, '14-Chocolat-KitKat-400x400.jpg'),
(94, 'Chocolat a l\'ancienne', 'drinks', 8, '15-Chocolat-a-lancienne-400x400.jpg'),
(95, 'Americano', 'drinks', 4, '2-Americano-400x400.jpg'),
(96, 'Carottes melon', 'drinks', 4, '2-Carottes-melon-400x400.jpg'),
(97, 'Cocktail tropical', 'drinks', 7, '2-Cocktail-tropical-400x400.jpg'),
(98, 'Jus de citron', 'drinks', 3, '2-Jus-de-citron-400x400.jpg'),
(99, 'Mojito virgin', 'drinks', 9, '2-Mojito-virgin-400x400.jpg'),
(100, 'Milkshake solero', 'drinks', 10, '28-Milkshake-solero-400x400.jpg'),
(101, 'Milkshake oreo', 'drinks', 11, '29-Milkshake-oreo-400x400.jpg'),
(102, 'Cocktail Red boost', 'drinks', 8, '3-Cocktail-Red-boost-400x400.jpg'),
(103, 'Double espresso', 'drinks', 5, '3-Double-espresso-400x400.jpg'),
(104, 'Jus de carotte', 'drinks', 4, '3-Jus-de-carotte-400x400.jpg'),
(105, 'Mojito Passion', 'drinks', 8, '3-Mojito-Passion-400x400.jpg'),
(106, 'Milkshake KitKat', 'drinks', 10, '30-Milkshake-KitKat-400x400.jpg'),
(107, 'Milkshake fruits rouges', 'drinks', 9, '31-Milkshake-fruits-rouges-400x400.jpg'),
(108, 'Mocha frappé', 'drinks', 7, '36-Mocha-frappé_35-400x400.jpg'),
(109, 'Mocha Caramel', 'drinks', 7, '37-Mocha-Caramel_36_11zon-400x400.jpg'),
(110, 'Mocha Vanille', 'drinks', 6, '38-Mocha-Vanille_37_11zon-400x400.jpg'),
(111, 'Cocktail green detox', 'drinks', 7, '4-Cocktail-green-detox-400x400.jpg'),
(112, 'Jus de kiwi', 'drinks', 5, '4-Jus-de-kiwi-400x400.jpg'),
(113, 'Nespresso', 'drinks', 6, '4-Nespresso-400x400.jpg'),
(114, 'Ice Tea passion mangue', 'drinks', 4, '40-Ice-Tea-passion-mangue-400x400.jpg'),
(115, 'Ice Tea hibiscus', 'drinks', 4, '41-Ice-Tea-hibiscus-400x400.jpg'),
(116, 'Ice Tea Kiwi', 'drinks', 4, '42-Ice-Tea-Kiwi-400x400.jpg'),
(117, 'Espresso Macchiato', 'drinks', 6, '5-Espresso-Macchiato-400x400.jpg'),
(118, 'Jus d\'ananas', 'drinks', 3, '5-Jus-dananas-400x400.jpg'),
(119, 'Mojito fruit rouges', 'drinks', 8, '5-Mojito-fruit-rouges-1-400x400.jpg'),
(120, 'Café crème', 'drinks', 5, '6-Café-crème-400x400.jpg'),
(121, 'Jus de mangue', 'drinks', 5, '6-Jus-de-mangue-400x400.jpg'),
(122, 'Mocca', 'drinks', 6, '7-Mocca-400x400.jpg'),
(123, 'Café latté', 'drinks', 6, '8-Café-latté-400x400.jpg'),
(124, 'Latté vanille', 'drinks', 6, '9-Latté-vanille-400x400.jpg'),
(125, 'Blue cocktail with lemon slice', 'drinks', 10, 'blue-cocktail-with-lemon-slice_140725-4467.jpg'),
(126, 'Cappuccino', 'drinks', 6, 'capuccino-400x400.jpg'),
(127, 'Chocolat Cannelle', 'drinks', 7, 'Chocolat-Cannelle-400x400.jpg'),
(128, 'Chocolat Ginger', 'drinks', 7, 'Chocolat-Ginger-400x400.jpg'),
(129, 'Chocolat Kinder', 'drinks', 7, 'chocolat-kinder-3-400x400.jpg'),
(130, 'Chocolat Marshmallow', 'drinks', 7, 'Chocolat-Marshmallow-400x400.jpg'),
(131, 'Chocolat Vanilla', 'drinks', 7, 'Chocolat-Vanilla-4-400x400.jpg'),
(132, 'Classic cooling mojito', 'drinks', 8, 'classic-cooling-mojito_140725-77.jpg'),
(133, 'Cocktail with fruits and ice cubes', 'drinks', 8, 'cocktail-drink-with-fruits-ice-cubes-black-background_175086-1328.jpg'),
(134, 'Cocktail with cherry and ice', 'drinks', 9, 'cocktail-with-cherry-ice-mint-glass-dark-background_890887-12466.jpg'),
(135, 'Eau Oulmès 25cl', 'drinks', 2, 'Eau-Oulmès-25cl-400x400.jpeg'),
(136, 'Eau Oulmès 75cl', 'drinks', 2, 'Eau-Oulmès-75cl-400x400.jpeg'),
(137, 'Eau Plate 33cl', 'drinks', 1, 'Eau-Plate-33cl-400x400.jpeg'),
(138, 'Eau Plate 50cl', 'drinks', 2, 'Eau-Plate-50cl--400x400.jpeg'),
(139, 'Eau plate 75cl', 'drinks', 2, 'Eau-plate-75cl-400x400.jpeg'),
(140, 'Frappe drink with caramel and nuts', 'drinks', 9, 'frappe-drink-with-caramel-nuts-isolated-white-background-ai-generative_123827-24936.jpg'),
(141, 'Fresh grapefruit cocktail', 'drinks', 7, 'fresh-grapefruit-cocktail-with-ice-cubes-fruit-slices-glass_114579-2949.jpg'),
(142, 'Fresh orange smoothie', 'drinks', 7, 'front-view-assortment-with-fresh-orange-smoothie_23-2148545373.jpg'),
(143, 'Cup of cappuccino with cookies', 'drinks', 7, 'front-view-cup-cappuccino-with-cookies-book-table_141793-2825.jpg'),
(144, 'Orange juice with slice', 'drinks', 6, 'front-view-orange-juice-with-slice-orange_141793-4649.jpg'),
(145, 'Frozen strawberry cocktail', 'drinks', 7, 'frozen-strawberry-cocktail-glass-black-background_502065-106.jpg'),
(146, 'Fruit iced cocktail', 'drinks', 10, 'fruit-iced-cocktail-table_141793-281.jpg'),
(147, 'Gingembre', 'drinks', 8, 'Gingembre-2-400x400.jpg'),
(148, 'Green cocktail with mint and ice', 'drinks', 8, 'green-cocktail-with-mint-ice-cubes-lemon-slice_114579-3402.jpg'),
(149, 'Ice Tea Fruits rouges', 'drinks', 5, 'Ice-Tea-Fruits-rouges-400x400.jpg'),
(150, 'Pomegranate juice', 'drinks', 6, 'pomegranate-by-hand-into-glass-glass-whole-sliced-ripe-pomegranate-isolated-red-background_360281-85'),
(151, 'Red Bull', 'drinks', 4, 'Red-Bull-400x400.jpeg'),
(152, 'Refreshing cocktail', 'drinks', 7, 'refreshing-cocktail-glass-ready-be-served_23-2148617623.jpg'),
(153, 'Sodas', 'drinks', 3, 'Sodas2-400x400.jpeg'),
(154, 'Tea with delights', 'drinks', 8, 'tea-with-delights-colorful-surface_114579-61553.jpg'),
(155, 'Thé a La Menthe', 'drinks', 8, 'The-a-La-Menthe-400x400.jpg'),
(156, 'Tisane Moods', 'drinks', 10, 'Tisane-Moods-400x400.jpg'),
(157, 'Cocktail Margarita', 'drinks', 9, 'vertical-shot-cocktail-margarita-wooden-table-restaurant_665346-5531.jpg'),
(178, 'Grilled Salmon with Asparagus', 'main dish', 20, 'grilled-salmon-with-asparagus.jpg'),
(179, 'Beef Tenderloin with Roasted Potatoes', 'main dish', 25, 'beef-tenderloin-with-roasted-potatoes.jpg'),
(180, 'Chicken Alfredo Pasta', 'main dish', 15, 'chicken-alfredo-pasta.jpg'),
(181, 'Vegetable Stir Fry with Tofu', 'main dish', 13, 'vegetable-stir-fry-with-tofu.jpg'),
(182, 'Shrimp Scampi with Linguine', 'main dish', 19, 'shrimp-scampi-with-linguine.jpg'),
(183, 'Beef Stroganoff', 'main dish', 18, 'beef-stroganoff.jpg'),
(184, 'Vegetarian Lasagna', 'main dish', 16, 'vegetarian-lasagna.jpg'),
(185, 'Pork Chops with Mashed Potatoes', 'main dish', 17, 'pork-chops-with-mashed-potatoes.jpg'),
(186, 'Grilled Chicken Caesar Salad', 'main dish', 14, 'grilled-chicken-caesar-salad.jpg'),
(187, 'Lamb Kebabs with Rice Pilaf', 'main dish', 22, 'lamb-kebabs-with-rice-pilaf.jpg'),
(188, 'Spaghetti Carbonara', 'main dish', 13, 'spaghetti-carbonara.jpg'),
(189, 'Eggplant Parmesan', 'main dish', 15, 'eggplant-parmesan.jpg'),
(190, 'Seafood Paella', 'main dish', 23, 'seafood-paella.jpg'),
(191, 'Beef Bourguignon', 'main dish', 20, 'beef-bourguignon.jpg'),
(192, 'Stuffed Bell Peppers', 'main dish', 14, 'stuffed-bell-peppers.jpg'),
(193, 'Tandoori Chicken with Naan Bread', 'main dish', 17, 'tandoori-chicken-with-naan-bread.jpg'),
(194, 'Beef Tacos with Guacamole', 'main dish', 13, 'beef-tacos-with-guacamole.jpg'),
(195, 'Mushroom Risotto', 'main dish', 16, 'mushroom-risotto.jpg'),
(196, 'Chicken Teriyaki with Steamed Vegetables', 'main dish', 15, 'chicken-teriyaki-with-steamed-vegetables.jpg'),
(197, 'Pasta Primavera', 'main dish', 13, 'pasta-primavera.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `number`, `password`, `address`) VALUES
(1, 'a', 'z@gmail.com', '2', '356a192b7913b04c54574d18c28d46e6395428ab', '1, 1, 1, Casablanca, Casablanca, Casablanca, Maroc - 20192'),
(2, 'A', 'zl@gmail.com', '1', '356a192b7913b04c54574d18c28d46e6395428ab', '1, 1, 1, fnideq, fnideq, Khmisset, Maroc - 93102');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
