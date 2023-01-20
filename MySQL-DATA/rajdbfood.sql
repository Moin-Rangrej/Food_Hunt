-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2022 at 10:30 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbfood`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbadmin`
--

CREATE TABLE `tbadmin` (
  `fld_id` int(10) NOT NULL,
  `fld_name` varchar(30) NOT NULL,
  `fld_email` varchar(30) NOT NULL,
  `fld_password` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbadmin`
--

INSERT INTO `tbadmin` (`fld_id`, `fld_name`, `fld_email`, `fld_password`) VALUES
(3, 'Admin', 'admin@gmail.com', '$2y$10$YXl7mm.SUIleMmegftagUuCb70HnRKeFXRb6AGi6jse1wX45OKWjW');

-- --------------------------------------------------------

--
-- Table structure for table `tbfood`
--

CREATE TABLE `tbfood` (
  `food_id` int(11) NOT NULL,
  `foodname` varchar(500) NOT NULL,
  `cost` bigint(15) NOT NULL,
  `fooddetails` varchar(1000) NOT NULL,
  `fldvendor_id` int(11) NOT NULL,
  `foodcategory` int(10) NOT NULL,
  `cuisines` int(10) NOT NULL,
  `status` int(10) NOT NULL,
  `paymentmode` varchar(50) NOT NULL,
  `fldimage` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbfood`
--

INSERT INTO `tbfood` (`food_id`, `foodname`, `cost`, `fooddetails`, `fldvendor_id`, `foodcategory`, `cuisines`, `status`, `paymentmode`, `fldimage`) VALUES
(2, 'malai Kofta', 50, 'Kofta made of potato and paneer are deep fried and served with a creamy and spiced tomato based curry.', 22, 1, 20, 1, 'COD', '1469258122-malai-kofta.jpg'),
(3, 'shahi panner', 20, 'Quantity - 500 gm', 22, 1, 13, 1, 'COD', 'Shahi-Paneer-Recipe.jpg'),
(4, 'chola kulcha', 100, '350 Gms. Punjabi Style Chhole Served With Our 100% Whole Wheat Kulchas.', 22, 1, 13, 1, 'COD', 'maxresdefault.jpg'),
(5, 'Pizza', 100, 'Onion, Sweet Corns, Paneer, Jalapenos in Korma Dip', 23, 1, 10, 1, 'COD', 'phut_0.jpg'),
(7, 'burger ', 50, 'Garden Fresh Veg Patty Classic Burger.', 23, 1, 12, 1, 'COD', 'photo-1534790566855-4cb788d389ec.jpg'),
(9, 'Gujarati Thali', 220, 'Sweet + Roti (4 Pcs) ( Butter ) + Sabji (2) + Papad + Dal - Rice + Salad + Buttermilk', 23, 1, 21, 1, 'COD', 'Gujarati_Thali.png'),
(10, 'Garden Delight Pizza', 190, 'A Classic Veg Pizza That Combines The Zing And Freshness Of Onions, Tomatoes And Capsicum', 23, 2, 10, 2, 'Online Payment', 'Garden_Delight_Pizza.png'),
(12, 'Punjabi Food Pack / Thali', 235, '1 Paneer + Veg Biryani + Raita + Achar + Salad + Mukhwas (Choice Of 4 Big Size Wheat Roti Or 3 Whole Wheat Paratha Or 3 Tandoori Roti)', 25, 1, 24, 1, 'COD', 'fimv6xw8sy58jz1nzjwf.webp'),
(13, 'Punjabi Food Pack / Thali Large', 255, '1 Paneer + Veg Biryani + Raita + Large + Achar + Salad + Sweet Of The Day + Mukhwas (Choice Of 4 Big Size Wheat Roti Or 3 Whole Wheat Paratha Or 3 Tandoori Roti', 25, 1, 24, 1, 'COD', 'emjnqaubxoxyb1pwxfry.webp'),
(14, 'Executive Meal / Thali', 275, 'Executive Meal / Thali', 25, 1, 24, 1, 'COD', 'dop4ojfwyza5go9oh0r8.webp'),
(15, 'Gujarati Large Thali', 230, '1 Sweet + Any 2 Sabzi (Aloo/Veg Sabzi/Kathol/Paneer) + Any 1 (4 Big Wheat Roti/6 Poori) + Any 1 Dal (Gujarati Dal/Punjabi Dal) + Rice + Green Salad + Achar +Mukhwas', 25, 1, 25, 1, 'COD', 'f0qlaph3deofce6zgzot.webp'),
(16, 'Gujarati Executive Thali', 265, '1 Farsan + 1 Sweet + Any 2 Sabzi (Aloo/Veg Sabzi/Kathol/Paneer) + Any 1 (4 Big Wheat Roti/6 Poori) + Any 1 Dal (Gujarati Dal/Punjabi Dal) + Rice + Green Salad + Buttermilk + 1 Papad + Chutney +Mukhwas', 25, 1, 25, 1, 'COD', 'eq2qwmyisuo6gub1xyzh.webp'),
(17, 'Paneer Kadai Combo', 300, 'Paneer Kadhai + Achar + Salad + Green Chilly + Choice Of 4 Big Wheat Roti Or 3 Whole Wheat Paratha Or 2 Tandoori Naan + Mukhwas', 25, 1, 27, 1, 'COD', 'ejgvbsqa79ntoecuzezp.webp'),
(18, 'Paneer Butter Masala Combo', 300, 'Paneer Butter Masala + Achar + Salad + Green Chilli + Choice Of 4 Big Wheat Roti Or 3 Whole Whear Paratha Or 2 Tandoori Naan + Mukhwas', 25, 1, 27, 1, 'COD', 'rhfjdberlk5dher0emkq.webp'),
(19, 'Manchurian Dry Noodles Combo', 235, 'Manchurian Dry + Hakka Noodles. + Salad.', 25, 1, 29, 1, 'COD', 'yzmgxssiglyabg5yiwn1.webp'),
(21, ' Paneer Chilli Gravy Fried Rice Combo', 260, 'Paneer Chilli Gravy + Fried Rice + Salad', 25, 1, 29, 1, 'COD', 'lcdl8eo8lsue5jai3vph.webp'),
(24, 'Set Dosa (3 Pc)', 110, ' Serves 1 , 3 Pcs | | Medium spicy | | A set of 3 soft dosas, the perfect start to any day | | Pan Fried |', 26, 1, 31, 1, 'COD', 'to4awvwklybapdyyqbs4.webp'),
(25, 'Mysore Plain Dosa', 90, '| Serves 1 , 1 Pc | | Medium Spicy | | A semi-spicy, crispy and delicious dosa with masala folded into it; paired with sambhar and chutney |', 26, 1, 31, 1, 'COD', 'ka6iqvcvrdlrroo6obhm.webp'),
(26, 'Masala Dosa', 110, '| Serves 1 | Tawa- toasted, crispy and delicious dosa, folded in with masala.', 26, 1, 31, 1, 'COD', 'stqjcaosikgxiwks0ygs.webp'),
(27, 'Mysore Masala Dosa [served with chutney and sambhar.]', 150, '| serve 1 , 1pc | | Medium spicy | | pan Fried | | stuffing |', 26, 1, 31, 1, 'COD', 'ka6iqvcvrdlrroo6obhm.webp'),
(28, 'Mix Uttapam (Served with Sambhar & Chutney)', 100, '| Serve 1 , 1 Pc | | medium Spicy | | A wholesome meal with flavor-packed soft uttapam topped with assorted veggies; served along with subtly spiced chutney and sambar | | Pan Fried |', 26, 1, 32, 1, 'COD', 'mwkz5gmynu4xndampuuc.webp'),
(29, 'Onion Uttapam', 120, '| Serves 1, 1 Pc | | Medium Spicy | Soft and spongy dosa stuffed with onions. | Pan Fried | | Stuffing |', 26, 1, 32, 1, 'COD', 'wwe70ptocgratrzux7q9.webp'),
(30, 'Idli (4 Pcs) And Vada Mix', 50, 'Soft idli and crispy vada | Served with 2 types of chutney and sambhar. |', 26, 1, 33, 1, 'COD', 'oz3k0lgmxltknz0segtb.webp'),
(31, 'Idli (2 Pcs)', 40, 'Idli (2 Pcs)', 26, 1, 33, 1, 'COD', 'zuhv2fmdv0qjikjveq51.webp'),
(32, 'Bhajipav Butter', 160, 'A spicy curry of mixed vegetables (bhaji) cooked in a special blend of spices and served with soft buns.', 27, 1, 35, 1, 'COD', 'ymnlapcyau3ce8nckzgp.webp'),
(33, 'Only Bhaji', 140, 'Only Bhaji', 27, 1, 35, 1, 'COD', 'sa640qi5rrjqd7bsimjh.jpg'),
(34, 'Masala Pav with Bhaji', 170, 'Masala Pav with Bhaji', 27, 1, 35, 1, 'COD', 'udnojmzpariisqg8ea0h.webp'),
(35, 'Veg Pulao', 140, ' Appx. 500 gms | Served with onion and lemon |', 27, 1, 36, 1, 'COD', 'hwss2hggu67zyunv3bsy.webp'),
(36, 'Pineapple Sandwich', 150, 'A Sandwich With The Filling Of Pineapple Slices To Give You A Sweet Tooth', 27, 1, 37, 1, 'COD', 'r4cubjvzurikcidcw09u.webp'),
(37, 'Jain Pizza', 160, 'Jain Pizza', 27, 1, 37, 1, 'COD', 'mufvpggtss2ju7bbole9.webp'),
(38, 'Veg Pizza', 180, '[6 Inch]', 27, 1, 37, 1, 'COD', 'moqgnxfhb7ok7tuntwgd.webp'),
(39, 'Pulav Butter', 180, 'Pulav Butter', 27, 1, 36, 1, 'COD', 'inkwzntzlqvg0vqnq1qq.webp'),
(40, 'Parotha Oil', 25, 'Super soft roti that is usually paired with a gravy based dish.', 28, 1, 39, 1, 'COD', 'qou7tvy7sarvvdhkvgca.webp'),
(41, 'Parotha Butter', 30, 'Super soft roti that is usually paired with a gravy based dish', 28, 1, 39, 1, 'COD', 'igcixvujfovzwxftkemc.webp'),
(42, 'Plain Roti', 8, 'Plain Roti', 28, 1, 39, 1, 'COD', 'gmelsxr3yrotpawmxzxy.webp'),
(43, 'Aloo Matar Special Jalaram', 60, 'Aloo Matar Special Jalaram', 28, 1, 40, 1, 'COD', 'finysw9gbufm0xy2gmrb.jpg'),
(44, 'Sev Tameta', 60, 'Sev Tameta', 28, 1, 40, 1, 'COD', 'lc42gtg8oe5kwyk9hivi.webp'),
(45, 'Paneer Kaju Masala', 160, 'Rich and creamy dish made of Cottage Panner made with kaju,tomato gravy and traditional spices.', 28, 1, 41, 1, 'COD', 'x9d043koxebwtecxqolu.jpg'),
(46, 'Paneer Tikka Masala', 170, 'Paneer tikka is an Indian dish made from chunks of paneer marinated in spices and rolled over skewers or grilled in a tandoor and tossed in masala.', 28, 1, 41, 1, 'COD', 'jrux3llir2ydb36gflvu.webp'),
(49, 'Masala Paneer Tikka Wrap', 170, 'We dont have any pun for paneer, but we do have a lot of surprises in this exciting snack that we roll into this wrap. Fresh paneer is smoked to perfection & drizzled with minty, spicy mayonnaise & wrapped in soft roti.', 29, 1, 44, 1, 'COD', 'qllow5si7zavoekx2np3.webp'),
(50, 'Cheese Melt Paneer Wrap', 189, 'Let the good times roll with surprises & flavour with this exciting snack! Cottage cheese is seasoned with select spices, slathered with creamy, gooey cheese & snuggly wrapped in soft roti.', 29, 1, 44, 1, 'COD', 'dah8wmie8std8usetwlx.jpg'),
(51, 'Veg Falafel Wrap', 200, 'Get wrapped in this Mediterranean surprise! We roll up crispy falafel, made from the finest chickpeas, with classic mayo and crunchy onions in soft roti for an experience unlike ever before!', 29, 1, 44, 1, 'COD', 'gsyizzdx7oyvacwuuv8c.webp'),
(52, 'Baked Pizza Wrap (Veg)', 209, 'Is it a pizza or a wrap? Let your tastebuds decide. A medley of flavours with fresh bell peppers, corn, olives & jalapenos draped in pizza sauce & mozzarella cheese, all wrapped in a crispy baked paratha', 29, 1, 45, 1, 'COD', 'qllow5si7zavoekx2np3.webp'),
(53, 'Jumbo Falafel-Salsa Wrap', 199, 'A jumbo wrap with a jumbo surprise it is! Crispy Mediterranean falafels, generous drizzle of cheesy corn salsa, crunchy onions all wrapped in flaky paratha. It sounds, tastes and feels extraordinary.', 29, 1, 45, 1, 'COD', 'vzx3kiuiue9k4jnyb9gk.jpg'),
(54, '[Chef Recommended] Makhani-Falafel Wrap', 199, '[Chef Recommended] Makhani-Falafel Wrap', 29, 1, 45, 1, 'COD', 'evuvkt92r3hmlfhln3bk.jpg'),
(55, '2 Classic Veg Rolls starting', 130, 'Double surprises and amazing SAVINGS of Rs. 51 await you with this veg classic wraps. Choose 2 of your favourite now!', 29, 1, 46, 1, 'COD', 'aaem8gja8bno0mfqqqgg.jpg'),
(56, '2 Classic Non-Veg Rolls starting', 289, '51 is your lucky number and thats exactly what youll SAVE by choosing any 2 of your favourite classic non-veg wraps.', 29, 2, 46, 1, 'COD', 'g1n81xzx30gccwjbxekb.webp'),
(57, '2 Classic Rolls (1 Veg + 1 Non-Veg) starting', 256, 'SAVE up to Rs. 55 and surprise your tastebuds with any 1 each of your favourite - veg and non-veg classic wraps. There’s no reason to delay here.', 29, 2, 46, 1, 'COD', 'g1n81xzx30gccwjbxekb.webp'),
(58, 'Margherita Pizza', 139, '(simply Cheesy)', 30, 1, 48, 1, 'COD', 'd1tu9l9mmvxust0d4fey.webp'),
(59, 'Classic Veggie Pizza', 180, '(tomato, Capsicum, Onion)', 30, 1, 49, 1, 'COD', 'hezefosi1gtobnehhoau.webp'),
(60, 'Crazy Delight Pizza', 190, '(golden Corn, Mushroom,black Olives)', 30, 1, 49, 1, 'COD', 'nh5tkxw0yhqnjhyjnxo4.webp'),
(61, 'Achari Paneer Pizza', 210, '(onion,jalepano,double Achari Paneer With Achari Sauce)', 30, 1, 50, 1, 'COD', 'tvvjjqjrmqvcm9cavyo5.webp'),
(62, 'Garden Fling Pizza', 230, '[tomato,capsicum,paneer ,golden Corn)', 30, 1, 50, 1, 'COD', 'xjzl47hnwy4svl2c7fjn.webp'),
(63, 'Authentic Veggie', 250, '(capsicum, Onion, Paneer In Jalapeno Sauce', 30, 1, 51, 1, 'COD', 'fhyd7uw8mveomxuqkdec.webp'),
(64, 'Achari Special', 270, 'Achari Special', 30, 1, 52, 1, 'COD', 'tvvjjqjrmqvcm9cavyo5.webp'),
(65, '7 Cheese', 290, '(combination Of Orange Cream Cheese, Mozzarella, Cheddar, Monterey Jack, Colby, Orange Cheddar, White Cream Cheese)', 30, 1, 52, 1, 'COD', 'uzqiavgtjb1pw0lqgltt.webp'),
(66, 'La Milano Paneer', 280, '[capsicum, Onion, Paneer, Golden Corn, Black Olives In Cheese Sauce]', 30, 1, 52, 1, 'COD', 'osvybfbl44bgcg6jdmoi.webp'),
(67, 'Black Forest Ice Cream Cake (1 Litre)', 500, 'An all-time favourite, this is the go-to flavour for the perfect balance of chocolate and raspberry, heartily topped with chocolate shaving for the perfect treat', 31, 1, 54, 1, 'COD', 'vuxmrj7hnsi0rmxcxsjq.webp'),
(68, ' Chocolate Overload Ice Cream Cake (500 Ml)', 350, 'An irresistible dessert overloaded with rich cocoa and layers of delicious cake to create a dance of flavours in your mouth.', 31, 1, 54, 1, 'COD', 'tqf1u1hpiovo0sdcmvsv.webp'),
(69, 'Cookie Biscoff Ice Cream Cake (500 Ml)', 400, 'A pure slice of heaven for all the cookie butter fans. Bite into the creamy dessert filled with generous layers of cookie biscoff and cake.', 31, 1, 54, 1, 'COD', 'odasckxgm9f8fpo7cgr1.webp'),
(70, 'Black Forest Ice Cream Cake (1 Litre)', 500, 'An all-time favourite, this is the go-to flavour for the perfect balance of chocolate and raspberry, heartily topped with chocolate shaving for the perfect treat', 31, 1, 54, 1, 'COD', 'vuxmrj7hnsi0rmxcxsjq.webp'),
(71, 'Black Forest Ice Cream Cake (1 Litre)', 500, 'An all-time favourite, this is the go-to flavour for the perfect balance of chocolate and raspberry, heartily topped with chocolate shaving for the perfect treat', 31, 1, 54, 1, 'COD', 'vuxmrj7hnsi0rmxcxsjq.webp'),
(72, 'Black Forest Ice Cream Cake (1 Litre)', 500, 'An all-time favourite, this is the go-to flavour for the perfect balance of chocolate and raspberry, heartily topped with chocolate shaving for the perfect treat', 31, 1, 54, 1, 'COD', 'vuxmrj7hnsi0rmxcxsjq.webp'),
(73, 'Black Forest Ice Cream Cake (1 Litre)', 500, 'An all-time favourite, this is the go-to flavour for the perfect balance of chocolate and raspberry, heartily topped with chocolate shaving for the perfect treat', 31, 1, 54, 1, 'COD', 'vuxmrj7hnsi0rmxcxsjq.webp'),
(74, 'Chicken Fighter', 200, 'Tawa mughlai serves 3', 32, 2, 59, 1, 'COD', 'images.jpg'),
(75, 'Chicken Hongong Boneless', 230, 'The veriety is from surats delicious taste.mughlai from live tawa.serves-3', 32, 2, 61, 1, 'COD', 'download.jpg'),
(76, 'Chicken Sitara', 499, 'Tawa mughlai with lollipop and tanduri chicken', 32, 2, 59, 1, 'COD', 'download (1).jpg'),
(77, 'Chicken Chilli', 299, 'Chicken Chilli', 32, 2, 61, 1, 'COD', 'udipyqhioi12c51pzw5l.webp'),
(78, 'Chicken 65', 278, 'Chicken 65', 32, 2, 61, 1, 'COD', 'iqt38rnzdqdjvk0pcaha.webp'),
(79, 'Butter Chicken Boneless', 219, 'Butter Chicken Boneless', 32, 2, 63, 1, 'COD', 'dyfcehzgx2olswhjo8iv (1).webp'),
(80, 'Mutton Handi', 245, 'Mutton Handi', 32, 2, 64, 1, 'COD', 'y6lulzffk1thfwqtxb1q.webp'),
(81, 'Mutton Angara', 299, 'Mutton Angara', 32, 2, 64, 1, 'COD', 'ppvhetsxrisdmwgrefja.webp'),
(82, 'Masala Penne Pasta', 80, 'Masala Penne Pasta', 33, 1, 66, 1, 'COD', 'puspjzszg78fjwd03jac.webp'),
(83, 'Cheese Penne Pasta', 120, 'Cheese Penne Pasta', 33, 1, 66, 1, 'COD', 'download.jpg'),
(84, ' Butter Penne Pasta', 100, '\r\nButter Penne Pasta', 33, 1, 66, 1, 'COD', 'download (1).jpg'),
(85, 'Masala Maggi', 70, 'Masala Maggi', 33, 1, 67, 1, 'COD', 'cszo9orsd5l4ien9rflg.webp'),
(86, 'Cheese Maggi', 90, 'Cheese Maggi', 33, 1, 67, 1, 'COD', 'fqrquoz81utrdlmx5rty.webp'),
(87, 'Veg Cheese Butter Maggi', 130, 'Veg Cheese Butter Maggi', 33, 1, 67, 1, 'COD', 'download (2).jpg'),
(88, 'Maggi Pasta Mix', 160, 'Maggi Pasta Mix', 33, 1, 68, 1, 'COD', 'mirl8z64ltb1s8hclrne.webp'),
(89, 'Cheese Butter Maggi Pasta Mix', 170, 'Cheese Butter Maggi Pasta Mix', 33, 1, 68, 1, 'COD', 'download (3).jpg'),
(90, 'Butter Tadka Maggi Pasta Mix', 180, 'Butter Tadka Maggi Pasta Mix', 33, 1, 68, 1, 'COD', 'download (4).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tblcart`
--

CREATE TABLE `tblcart` (
  `fld_cart_id` int(11) NOT NULL,
  `fld_product_id` bigint(11) NOT NULL,
  `fld_customer_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblcart`
--

INSERT INTO `tblcart` (`fld_cart_id`, `fld_product_id`, `fld_customer_id`) VALUES
(17, 7, 'abc123@gmail.com'),
(35, 4, 'raj@gmail.com'),
(37, 3, 'priya@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tblcuisine`
--

CREATE TABLE `tblcuisine` (
  `cuisine_id` int(11) NOT NULL,
  `Cuisine_name` varchar(255) NOT NULL,
  `fldvendor_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblcuisine`
--

INSERT INTO `tblcuisine` (`cuisine_id`, `Cuisine_name`, `fldvendor_id`) VALUES
(9, 'Junk-food', 22),
(10, 'Pizza', 23),
(12, 'Burger', 23),
(13, 'North Indian', 22),
(20, 'South Indian', 22),
(21, 'Thali', 23),
(22, 'Rice Combo', 25),
(23, 'Rice Combo', 25),
(24, 'Fixed Meals', 25),
(25, 'Gujarati Fix Thali', 25),
(26, 'Gujarati Fix Thali', 25),
(27, 'Paneer Combos', 25),
(28, 'Paneer Combos', 25),
(29, 'Chinese Combos', 25),
(30, 'Chinese Combos', 25),
(31, 'Dosa', 26),
(32, 'Uttapam', 26),
(33, 'Regular South Indian Items', 26),
(35, 'Bhajipav', 27),
(36, 'Pulav', 27),
(37, 'Mahalaxmi Special', 27),
(38, 'Mahalaxmi Special', 27),
(39, 'Lotni Kamal', 28),
(40, 'Regular Shaak', 28),
(41, 'Punjabi Sabji', 28),
(42, 'Kathiyawadi Sabji', 28),
(43, 'Kathiyawadi Sabji', 28),
(44, 'Classic Wraps', 29),
(45, 'Signature Wraps', 29),
(46, 'Pocket Friendly Rolls', 29),
(47, 'Pocket Friendly Rolls', 29),
(48, 'Simple Pizza', 30),
(49, 'Classic Pizza', 30),
(50, 'Premium Pizza', 30),
(51, 'Exotic Pizza', 30),
(52, 'Special Pizza', 30),
(53, 'Special Pizza', 30),
(54, 'Ice Cream Cakes', 31),
(55, 'Flingo Cone', 31),
(56, 'Badabite[vd]', 31),
(57, 'Kulfies', 31),
(58, 'Kulfies', 31),
(59, 'Tawa Mughlai From Surat', 32),
(60, 'Tawa Mughlai From Surat', 32),
(61, 'Chicken Dry', 32),
(62, 'Chicken Dry', 32),
(63, 'Mughlai Gravy', 32),
(64, 'Mutton (goat Meat)', 32),
(65, 'Mutton (goat Meat)', 32),
(66, 'Pasta', 33),
(67, 'Maggi', 33),
(68, 'Maggi Pasta Mix', 33),
(69, 'Maggi Pasta Mix', 33);

-- --------------------------------------------------------

--
-- Table structure for table `tblcustomer`
--

CREATE TABLE `tblcustomer` (
  `fld_cust_id` int(10) NOT NULL,
  `fld_name` varchar(30) NOT NULL,
  `fld_mobile` bigint(10) NOT NULL,
  `fld_address` varchar(255) NOT NULL,
  `fld_email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblcustomer`
--

INSERT INTO `tblcustomer` (`fld_cust_id`, `fld_name`, `fld_mobile`, `fld_address`, `fld_email`, `password`) VALUES
(3, 'Sana Khan', 6663545893, 'Ahemdabad2,Gujarat2,India2', 'Sanakhan@gmail.com', 'customer3'),
(4, 'Rajesh Sharma', 8080804455, '32, Sun Real Home, opp. D-mart, new ranip, gandhinagar, gujarat.', 'rajesh@gmail.com', 'rajesh@123'),
(5, 'Nilesh shah', 6384785431, 'B34/shivam society, Nr pink rode, navrangpura, ahmedabad, gujarat. ', 'nilesh@gmail.com', 'nilesh@123'),
(7, 'Moin Rangrej', 6354446037, 'abc,Ahemdabad,India', 'abc123@gmail.com', '12345'),
(9, 'Priya Pandey', 7300056455, '356, Maruti Complex, ghatlodiya, ahmedabad, Gujarat', 'priya@gmail.com', 'priya@123'),
(10, 'Raj Shukla', 8453122220, '61, Maruti Complex, ghatlodiya, ahmedabad, Gujarat', 'raj@gmail.com', 'raj'),
(11, 'hardik', 9456378351, 'GAYTRINAGAR4/5, MATHUKIYA HOSPITAL PASE,', 'satanihardik003434@gmail.com', 'hardik123');

-- --------------------------------------------------------

--
-- Table structure for table `tblfoodcategory`
--

CREATE TABLE `tblfoodcategory` (
  `Foodcategory_Id` int(11) NOT NULL,
  `Foodcategory_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblfoodcategory`
--

INSERT INTO `tblfoodcategory` (`Foodcategory_Id`, `Foodcategory_name`) VALUES
(1, 'Veg'),
(2, 'Non-veg');

-- --------------------------------------------------------

--
-- Table structure for table `tblmessage`
--

CREATE TABLE `tblmessage` (
  `fld_msg_id` int(10) NOT NULL,
  `fld_name` varchar(50) NOT NULL,
  `fld_email` varchar(50) NOT NULL,
  `fld_phone` bigint(10) DEFAULT NULL,
  `fld_msg` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblmessage`
--

INSERT INTO `tblmessage` (`fld_msg_id`, `fld_name`, `fld_email`, `fld_phone`, `fld_msg`) VALUES
(1, '', '', 0, ''),
(2, 'Moin Rangrej', 'abc123@gmail.com', 6354446039, 'hoiiiiiii'),
(3, '', '', 0, ''),
(4, 'Ajay', 'ajay@gmail.com', 6354446039, 'bdsdfjds jc');

-- --------------------------------------------------------

--
-- Table structure for table `tblorder`
--

CREATE TABLE `tblorder` (
  `fld_order_id` int(10) NOT NULL,
  `fld_cart_id` bigint(10) NOT NULL,
  `fldvendor_id` bigint(10) DEFAULT NULL,
  `fld_food_id` bigint(10) DEFAULT NULL,
  `fld_email_id` varchar(50) DEFAULT NULL,
  `fld_payment` int(20) DEFAULT NULL,
  `fldstatus` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblorder`
--

INSERT INTO `tblorder` (`fld_order_id`, `fld_cart_id`, `fldvendor_id`, `fld_food_id`, `fld_email_id`, `fld_payment`, `fldstatus`) VALUES
(1, 1, 21, 1, 'customer3@gmail.com', 50, 'Delivered'),
(2, 2, 22, 3, 'customer3@gmail.com', 20, 'Delivered'),
(3, 3, 23, 7, 'rajesh@gmail.com', 50, 'In Process'),
(4, 4, 22, 3, 'rajesh@gmail.com', 20, 'In Process'),
(5, 5, 22, 2, 'rajesh@gmail.com', 50, 'In Process'),
(6, 6, 22, 2, 'rajesh@gmail.com', 50, 'In Process'),
(7, 8, 22, 2, 'rajesh@gmail.com', 50, 'In Process'),
(8, 9, 23, 5, 'rajesh@gmail.com', 100, 'In Process'),
(9, 10, 23, 7, 'rajesh@gmail.com', 50, 'In Process'),
(10, 11, 23, 5, 'rajesh@gmail.com', 100, 'cancelled'),
(11, 12, 22, 4, 'rajesh@gmail.com', 100, 'In Process'),
(12, 13, 22, 3, 'nilesh@gmail.com', 20, 'Delivered'),
(13, 16, 22, 8, 'rajesh@gmail.com', 275, 'Delivered'),
(14, 18, 23, 5, 'rajesh@gmail.com', 100, 'In Process'),
(15, 24, 23, 7, 'priya@gmail.com', 50, 'cancelled'),
(16, 34, 23, 9, 'raj@gmail.com', 220, 'In Process'),
(17, 30, 23, 7, 'priya@gmail.com', 50, 'In Process'),
(18, 32, 22, 3, 'priya@gmail.com', 20, 'cancelled'),
(19, 33, 22, 2, 'priya@gmail.com', 50, 'cancelled'),
(20, 38, 25, 11, 'satanihardik003434@gmail.com', 254, 'Delivered'),
(21, 39, 22, 3, 'satanihardik003434@gmail.com', 20, 'In Process'),
(22, 40, 22, 4, 'satanihardik003434@gmail.com', 100, 'In Process'),
(23, 41, 23, 5, 'satanihardik003434@gmail.com', 100, 'In Process');

-- --------------------------------------------------------

--
-- Table structure for table `tblstatus`
--

CREATE TABLE `tblstatus` (
  `status_id` int(10) NOT NULL,
  `foodstatus` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblstatus`
--

INSERT INTO `tblstatus` (`status_id`, `foodstatus`) VALUES
(1, 'In Stock'),
(2, 'Out of Stock');

-- --------------------------------------------------------

--
-- Table structure for table `tblvendor`
--

CREATE TABLE `tblvendor` (
  `fldvendor_id` int(10) NOT NULL,
  `fld_email` varchar(50) NOT NULL,
  `fld_password` varchar(50) NOT NULL,
  `vendorMobile` bigint(10) NOT NULL,
  `restaurantName` varchar(30) NOT NULL,
  `restaurantMobile` bigint(10) NOT NULL,
  `restaurantAddress` varchar(255) NOT NULL,
  `restaurant_Image` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblvendor`
--

INSERT INTO `tblvendor` (`fldvendor_id`, `fld_email`, `fld_password`, `vendorMobile`, `restaurantName`, `restaurantMobile`, `restaurantAddress`, `restaurant_Image`) VALUES
(22, 'vendor1@gmail.com', 'vendor1', 7503515386, 'Om Food Center', 6354446039, 'C-33, SWARN PARK, MUNDKA', 'food5.jpg'),
(23, 'vendor2@gmail.com', 'vendor2', 7503515385, 'Shree Marutinandan', 114565457, 'C-33, SWARN PARK, MUNDKA', 'shree_marutinandan.jpeg'),
(24, 'prince@gmail.com', '12345', 0, 'Prince Corner', 114565475, 'Isanpur,Ahemdabad,India', 'prince_corner.jpg'),
(25, 'foodway23@gmail.com', 'foodway', 0, 'Food On Way', 8756783458, 'Opp. Kamnath Mahadev Mandir, Vastrapur ', 'foodway.jpg'),
(26, 'chan123@gmail.com', 'chan123', 0, 'Chennai Express', 9567387223, 'Near Dhananjay Tower, Shyamal', 'oz3k0lgmxltknz0segtb.webp'),
(27, 'mh123@gmail.com', 'ml123', 0, 'Mahalaxmi Pav Bhaji', 9786567895, 'C G Road, Ellisbridge', 'lqap5wai1lwnk86iwtci.webp'),
(28, 'paratha123@gmail.com', 'para123', 0, 'Jalaram Parotha House', 9563556865, 'Jalaram Parotha House', 'aiuthteovowtvs7tkhrb.webp'),
(29, 'fass123@gmail.com', 'fass123', 0, 'Faasos - Wraps & Rolls', 9676524678, 'Reliance Lane, Vastrapur', 'ddfimgjeaos4s6s43mbb.webp'),
(30, 'la123@gmail.com', 'la123', 0, 'La Milano Pizzeria', 9675456754, 'Satellite, Manekbaugh', 'b8for8unewii8kr0lz8q.webp'),
(31, 'vadi123@gmail.com', 'vad123', 0, 'Vadilal Ice Creams', 9876534678, 'Sudha Kalash, Prahlad Nagar', 'hv3npiizmksf14lhoi36.webp'),
(32, 'nisr123@gmail.com', 'nisar123', 0, 'Nisar Hotel', 9786545341, 'Sarkhej, Juhapura', 'vyba6leelnfvb7pymrzl.webp'),
(33, 'rk23@gmail.com', 'rk123', 0, 'R.K. Maggi Pasta And Coffee Ba', 9876785631, 'R.K. Maggi Pasta And Coffee Bar', 'puspjzszg78fjwd03jac.webp');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbadmin`
--
ALTER TABLE `tbadmin`
  ADD PRIMARY KEY (`fld_id`);

--
-- Indexes for table `tbfood`
--
ALTER TABLE `tbfood`
  ADD PRIMARY KEY (`food_id`),
  ADD KEY `fldvendor_id` (`fldvendor_id`);

--
-- Indexes for table `tblcart`
--
ALTER TABLE `tblcart`
  ADD PRIMARY KEY (`fld_cart_id`);

--
-- Indexes for table `tblcuisine`
--
ALTER TABLE `tblcuisine`
  ADD PRIMARY KEY (`cuisine_id`);

--
-- Indexes for table `tblcustomer`
--
ALTER TABLE `tblcustomer`
  ADD PRIMARY KEY (`fld_cust_id`);

--
-- Indexes for table `tblfoodcategory`
--
ALTER TABLE `tblfoodcategory`
  ADD PRIMARY KEY (`Foodcategory_Id`);

--
-- Indexes for table `tblmessage`
--
ALTER TABLE `tblmessage`
  ADD PRIMARY KEY (`fld_msg_id`);

--
-- Indexes for table `tblorder`
--
ALTER TABLE `tblorder`
  ADD PRIMARY KEY (`fld_order_id`);

--
-- Indexes for table `tblstatus`
--
ALTER TABLE `tblstatus`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `tblvendor`
--
ALTER TABLE `tblvendor`
  ADD PRIMARY KEY (`fldvendor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbadmin`
--
ALTER TABLE `tbadmin`
  MODIFY `fld_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbfood`
--
ALTER TABLE `tbfood`
  MODIFY `food_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `tblcart`
--
ALTER TABLE `tblcart`
  MODIFY `fld_cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `tblcuisine`
--
ALTER TABLE `tblcuisine`
  MODIFY `cuisine_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `tblcustomer`
--
ALTER TABLE `tblcustomer`
  MODIFY `fld_cust_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tblmessage`
--
ALTER TABLE `tblmessage`
  MODIFY `fld_msg_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblorder`
--
ALTER TABLE `tblorder`
  MODIFY `fld_order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tblstatus`
--
ALTER TABLE `tblstatus`
  MODIFY `status_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblvendor`
--
ALTER TABLE `tblvendor`
  MODIFY `fldvendor_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbfood`
--
ALTER TABLE `tbfood`
  ADD CONSTRAINT `tbfood_ibfk_1` FOREIGN KEY (`fldvendor_id`) REFERENCES `tblvendor` (`fldvendor_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
