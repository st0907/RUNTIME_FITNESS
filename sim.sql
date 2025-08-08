-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2025 at 06:00 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sim`
--

-- --------------------------------------------------------

--
-- Table structure for table `body_measurements`
--

CREATE TABLE `body_measurements` (
  `bdm_measurement_ID` int(11) NOT NULL,
  `bdm_member_ID` int(11) NOT NULL,
  `bdm_waist` decimal(5,2) DEFAULT NULL,
  `bdm_hip` decimal(5,2) DEFAULT NULL,
  `bdm_thigh` decimal(5,2) DEFAULT NULL,
  `bdm_entry_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `daily_logs`
--

CREATE TABLE `daily_logs` (
  `dll_log_ID` int(11) NOT NULL,
  `dll_member_ID` int(11) NOT NULL,
  `dll_water_cups` int(11) DEFAULT NULL,
  `dll_sleep_hours` decimal(4,2) DEFAULT NULL,
  `dll_entry_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `journal_meals`
--

CREATE TABLE `journal_meals` (
  `jnm_meal_id` int(11) NOT NULL,
  `jnm_journal_id` int(11) NOT NULL,
  `jnm_meal_type` enum('breakfast','lunch','dinner','snack') NOT NULL,
  `jnm_food_name` varchar(100) NOT NULL,
  `jnm_portion_size` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `journal_meals`
--

INSERT INTO `journal_meals` (`jnm_meal_id`, `jnm_journal_id`, `jnm_meal_type`, `jnm_food_name`, `jnm_portion_size`) VALUES
(196, 15, 'breakfast', 'Oatmeal', '2 cup'),
(197, 15, 'lunch', 'Caesar Salad', '1 set'),
(198, 15, 'dinner', 'Burger', '1 set'),
(199, 15, 'snack', 'Super Ring', '1 pack'),
(200, 16, 'breakfast', 'Sesame', '1 cup'),
(201, 16, 'lunch', 'Pasta', '1 set'),
(202, 16, 'dinner', 'Poke Bowl', '1 set'),
(203, 16, 'snack', 'Super Ring', '1 pack');

-- --------------------------------------------------------

--
-- Table structure for table `meal_plans`
--

CREATE TABLE `meal_plans` (
  `mpl_id` int(11) NOT NULL,
  `mpl_user_id` int(11) NOT NULL,
  `mpl_title` varchar(255) DEFAULT NULL,
  `mpl_plan_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`mpl_plan_data`)),
  `mpl_created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meal_plans`
--

INSERT INTO `meal_plans` (`mpl_id`, `mpl_user_id`, `mpl_title`, `mpl_plan_data`, `mpl_created_at`) VALUES
(3, 36, 'Weekly Diet Plan', '[{\"breakfast\":{\"name\":\"Overnight Oats\",\"calories\":320,\"protein\":12,\"carbs\":50,\"fat\":8,\"price\":3.2,\"groceryList\":[{\"item\":\"Oats\",\"quantity\":\"1\\/2 cup\",\"notes\":\"Rolled oats, gluten-free if needed\"},{\"item\":\"Plant Milk\",\"quantity\":\"1\\/2 cup\",\"notes\":\"Almond, soy, or oat milk\"},{\"item\":\"Chia Seeds\",\"quantity\":\"1 tbsp\",\"notes\":\"For added nutrition\"},{\"item\":\"Fresh Fruits\",\"quantity\":\"1\\/4 cup\",\"notes\":\"Berries, banana, or other fruits\"},{\"item\":\"Honey or Maple Syrup\",\"quantity\":\"1 tsp\",\"notes\":\"Optional sweetener\"}],\"cookingInstructions\":[\"Combine oats, milk, and chia seeds in a jar\",\"Stir well to mix ingredients\",\"Refrigerate overnight or at least 4 hours\",\"In the morning, top with fresh fruits and honey or maple syrup if desired\"]},\"lunch\":{\"name\":\"Keto Chicken Caesar Salad\",\"calories\":390,\"protein\":32,\"carbs\":6,\"fat\":25,\"price\":8.9,\"groceryList\":[{\"item\":\"Chicken Breast\",\"quantity\":\"120g\",\"notes\":\"Grilled\"},{\"item\":\"Romaine Lettuce\",\"quantity\":\"2 cups\",\"notes\":\"Chopped\"},{\"item\":\"Parmesan Cheese\",\"quantity\":\"2 tbsp\",\"notes\":\"Shredded\"},{\"item\":\"Caesar Dressing\",\"quantity\":\"2 tbsp\",\"notes\":\"Low-carb\"}],\"cookingInstructions\":[\"Toss lettuce with dressing\",\"Top with grilled chicken and parmesan\"]},\"dinner\":{\"name\":\"Regular Beef Stew\",\"calories\":520,\"protein\":32,\"carbs\":40,\"fat\":22,\"price\":10.5,\"groceryList\":[{\"item\":\"Beef\",\"quantity\":\"120g\",\"notes\":\"Cubed\"},{\"item\":\"Potato\",\"quantity\":\"1\\/2 cup\",\"notes\":\"Diced\"},{\"item\":\"Carrot\",\"quantity\":\"1\\/2 cup\",\"notes\":\"Diced\"},{\"item\":\"Onion\",\"quantity\":\"1\\/4 cup\",\"notes\":\"Diced\"}],\"cookingInstructions\":[\"Simmer beef and vegetables until tender\",\"Serve hot\"]},\"snack\":{\"name\":\"Vegetarian Fruit Parfait\",\"calories\":180,\"protein\":6,\"carbs\":32,\"fat\":4,\"price\":3,\"groceryList\":[{\"item\":\"Yogurt\",\"quantity\":\"1\\/2 cup\",\"notes\":\"\"},{\"item\":\"Mixed Fruit\",\"quantity\":\"1\\/2 cup\",\"notes\":\"\"},{\"item\":\"Granola\",\"quantity\":\"2 tbsp\",\"notes\":\"Gluten-free if needed\"}],\"cookingInstructions\":[\"Layer yogurt, fruit, and granola in a cup\"]},\"totalCalories\":1410,\"totalPrice\":25.6},{\"breakfast\":{\"name\":\"Vegetarian Breakfast Burrito\",\"calories\":400,\"protein\":16,\"carbs\":55,\"fat\":12,\"price\":4.8,\"groceryList\":[{\"item\":\"Tortilla\",\"quantity\":\"1\",\"notes\":\"Whole wheat\"},{\"item\":\"Eggs\",\"quantity\":\"2\",\"notes\":\"Scrambled\"},{\"item\":\"Bell Pepper\",\"quantity\":\"1\\/4 cup\",\"notes\":\"Diced\"},{\"item\":\"Cheese\",\"quantity\":\"2 tbsp\",\"notes\":\"Shredded\"}],\"cookingInstructions\":[\"Scramble eggs with bell pepper\",\"Fill tortilla with eggs and cheese\",\"Roll up and serve\"]},\"lunch\":{\"name\":\"Regular Chicken Rice Bowl\",\"calories\":480,\"protein\":28,\"carbs\":60,\"fat\":12,\"price\":8.2,\"groceryList\":[{\"item\":\"Rice\",\"quantity\":\"1 cup\",\"notes\":\"Cooked\"},{\"item\":\"Chicken Breast\",\"quantity\":\"100g\",\"notes\":\"Grilled\"},{\"item\":\"Broccoli\",\"quantity\":\"1\\/2 cup\",\"notes\":\"Steamed\"},{\"item\":\"Soy Sauce\",\"quantity\":\"1 tbsp\",\"notes\":\"\"}],\"cookingInstructions\":[\"Arrange rice, chicken, and broccoli in a bowl\",\"Drizzle with soy sauce and serve\"]},\"dinner\":{\"name\":\"Vegetable Pasta\",\"calories\":450,\"protein\":14,\"carbs\":65,\"fat\":15,\"price\":7.5,\"groceryList\":[{\"item\":\"Pasta\",\"quantity\":\"80g\",\"notes\":\"Dry weight\"},{\"item\":\"Zucchini\",\"quantity\":\"1\\/2\",\"notes\":\"Sliced\"},{\"item\":\"Bell Peppers\",\"quantity\":\"1\\/2\",\"notes\":\"Diced\"},{\"item\":\"Cherry Tomatoes\",\"quantity\":\"10\",\"notes\":\"Halved\"},{\"item\":\"Garlic\",\"quantity\":\"2 cloves\",\"notes\":\"Minced\"},{\"item\":\"Olive Oil\",\"quantity\":\"2 tbsp\",\"notes\":\"For cooking and dressing\"},{\"item\":\"Basil\",\"quantity\":\"2 tbsp\",\"notes\":\"Fresh, torn\"}],\"cookingInstructions\":[\"Cook pasta according to package instructions\",\"Heat olive oil in a pan over medium heat\",\"Saut\\u00e9 garlic until fragrant\",\"Add zucchini and bell peppers, cook until softened\",\"Add cherry tomatoes and cook for 2 minutes\",\"Drain pasta and add to the pan with vegetables\",\"Toss everything together with additional olive oil if needed\",\"Garnish with fresh basil before serving\"]},\"snack\":{\"name\":\"Apple with Almond Butter\",\"calories\":200,\"protein\":5,\"carbs\":25,\"fat\":10,\"price\":2.8,\"groceryList\":[{\"item\":\"Apple\",\"quantity\":\"1 medium\",\"notes\":\"Any variety\"},{\"item\":\"Almond Butter\",\"quantity\":\"1 tbsp\",\"notes\":\"No added sugar\"}],\"cookingInstructions\":[\"Wash and slice the apple\",\"Serve with almond butter for dipping\"]},\"totalCalories\":1530,\"totalPrice\":23.3},{\"breakfast\":{\"name\":\"Vegetarian Breakfast Burrito\",\"calories\":400,\"protein\":16,\"carbs\":55,\"fat\":12,\"price\":4.8,\"groceryList\":[{\"item\":\"Tortilla\",\"quantity\":\"1\",\"notes\":\"Whole wheat\"},{\"item\":\"Eggs\",\"quantity\":\"2\",\"notes\":\"Scrambled\"},{\"item\":\"Bell Pepper\",\"quantity\":\"1\\/4 cup\",\"notes\":\"Diced\"},{\"item\":\"Cheese\",\"quantity\":\"2 tbsp\",\"notes\":\"Shredded\"}],\"cookingInstructions\":[\"Scramble eggs with bell pepper\",\"Fill tortilla with eggs and cheese\",\"Roll up and serve\"]},\"lunch\":{\"name\":\"Mediterranean Lentil Bowl\",\"calories\":400,\"protein\":18,\"carbs\":60,\"fat\":10,\"price\":5.9,\"groceryList\":[{\"item\":\"Green or Brown Lentils\",\"quantity\":\"1\\/2 cup\",\"notes\":\"Uncooked\"},{\"item\":\"Cucumber\",\"quantity\":\"1\\/4\",\"notes\":\"Diced\"},{\"item\":\"Cherry Tomatoes\",\"quantity\":\"5-6\",\"notes\":\"Halved\"},{\"item\":\"Red Onion\",\"quantity\":\"2 tbsp\",\"notes\":\"Finely chopped\"},{\"item\":\"Parsley\",\"quantity\":\"2 tbsp\",\"notes\":\"Chopped\"},{\"item\":\"Olive Oil\",\"quantity\":\"1 tbsp\",\"notes\":\"For dressing\"},{\"item\":\"Lemon\",\"quantity\":\"1\\/4\",\"notes\":\"For juice\"}],\"cookingInstructions\":[\"Cook lentils according to package instructions\",\"Combine cooked lentils, cucumber, tomatoes, red onion, and parsley\",\"Whisk together olive oil, lemon juice, salt, and pepper\",\"Drizzle dressing over lentil mixture and toss gently\",\"Serve at room temperature or chilled\"]},\"dinner\":{\"name\":\"Regular Beef Stew\",\"calories\":520,\"protein\":32,\"carbs\":40,\"fat\":22,\"price\":10.5,\"groceryList\":[{\"item\":\"Beef\",\"quantity\":\"120g\",\"notes\":\"Cubed\"},{\"item\":\"Potato\",\"quantity\":\"1\\/2 cup\",\"notes\":\"Diced\"},{\"item\":\"Carrot\",\"quantity\":\"1\\/2 cup\",\"notes\":\"Diced\"},{\"item\":\"Onion\",\"quantity\":\"1\\/4 cup\",\"notes\":\"Diced\"}],\"cookingInstructions\":[\"Simmer beef and vegetables until tender\",\"Serve hot\"]},\"snack\":{\"name\":\"Vegetarian Fruit Parfait\",\"calories\":180,\"protein\":6,\"carbs\":32,\"fat\":4,\"price\":3,\"groceryList\":[{\"item\":\"Yogurt\",\"quantity\":\"1\\/2 cup\",\"notes\":\"\"},{\"item\":\"Mixed Fruit\",\"quantity\":\"1\\/2 cup\",\"notes\":\"\"},{\"item\":\"Granola\",\"quantity\":\"2 tbsp\",\"notes\":\"Gluten-free if needed\"}],\"cookingInstructions\":[\"Layer yogurt, fruit, and granola in a cup\"]},\"totalCalories\":1500,\"totalPrice\":24.2},{\"breakfast\":{\"name\":\"Regular French Toast\",\"calories\":330,\"protein\":10,\"carbs\":45,\"fat\":12,\"price\":3.9,\"groceryList\":[{\"item\":\"Bread\",\"quantity\":\"2 slices\",\"notes\":\"\"},{\"item\":\"Egg\",\"quantity\":\"1\",\"notes\":\"Beaten\"},{\"item\":\"Milk\",\"quantity\":\"1\\/4 cup\",\"notes\":\"\"},{\"item\":\"Cinnamon\",\"quantity\":\"1\\/2 tsp\",\"notes\":\"\"}],\"cookingInstructions\":[\"Dip bread in egg and milk mixture\",\"Cook on skillet until golden brown\",\"Sprinkle with cinnamon\"]},\"lunch\":{\"name\":\"Vegetarian Caprese Sandwich\",\"calories\":410,\"protein\":15,\"carbs\":48,\"fat\":16,\"price\":6.1,\"groceryList\":[{\"item\":\"Ciabatta Bread\",\"quantity\":\"1 roll\",\"notes\":\"\"},{\"item\":\"Mozzarella\",\"quantity\":\"2 slices\",\"notes\":\"Fresh\"},{\"item\":\"Tomato\",\"quantity\":\"2 slices\",\"notes\":\"\"},{\"item\":\"Basil\",\"quantity\":\"4 leaves\",\"notes\":\"Fresh\"},{\"item\":\"Olive Oil\",\"quantity\":\"1 tsp\",\"notes\":\"\"}],\"cookingInstructions\":[\"Layer mozzarella, tomato, and basil on bread\",\"Drizzle with olive oil and serve\"]},\"dinner\":{\"name\":\"Gluten-Free Chicken Stir Fry\",\"calories\":410,\"protein\":28,\"carbs\":35,\"fat\":14,\"price\":8.8,\"groceryList\":[{\"item\":\"Chicken Breast\",\"quantity\":\"100g\",\"notes\":\"Sliced\"},{\"item\":\"Bell Pepper\",\"quantity\":\"1\\/2 cup\",\"notes\":\"Sliced\"},{\"item\":\"Broccoli\",\"quantity\":\"1\\/2 cup\",\"notes\":\"Florets\"},{\"item\":\"Gluten-Free Soy Sauce\",\"quantity\":\"1 tbsp\",\"notes\":\"\"}],\"cookingInstructions\":[\"Stir fry chicken and vegetables\",\"Add soy sauce and serve\"]},\"snack\":{\"name\":\"Greek Yogurt with Honey\",\"calories\":150,\"protein\":15,\"carbs\":12,\"fat\":3,\"price\":2.5,\"groceryList\":[{\"item\":\"Greek Yogurt\",\"quantity\":\"150g\",\"notes\":\"Plain, unflavored\"},{\"item\":\"Honey\",\"quantity\":\"1 tsp\",\"notes\":\"Raw honey if possible\"}],\"cookingInstructions\":[\"Place Greek yogurt in a bowl\",\"Drizzle with honey\",\"Optional: add a sprinkle of cinnamon or a few berries\"]},\"totalCalories\":1300,\"totalPrice\":21.3},{\"breakfast\":{\"name\":\"Vegetarian Breakfast Burrito\",\"calories\":400,\"protein\":16,\"carbs\":55,\"fat\":12,\"price\":4.8,\"groceryList\":[{\"item\":\"Tortilla\",\"quantity\":\"1\",\"notes\":\"Whole wheat\"},{\"item\":\"Eggs\",\"quantity\":\"2\",\"notes\":\"Scrambled\"},{\"item\":\"Bell Pepper\",\"quantity\":\"1\\/4 cup\",\"notes\":\"Diced\"},{\"item\":\"Cheese\",\"quantity\":\"2 tbsp\",\"notes\":\"Shredded\"}],\"cookingInstructions\":[\"Scramble eggs with bell pepper\",\"Fill tortilla with eggs and cheese\",\"Roll up and serve\"]},\"lunch\":{\"name\":\"Vegan Buddha Bowl\",\"calories\":420,\"protein\":14,\"carbs\":65,\"fat\":12,\"price\":7.2,\"groceryList\":[{\"item\":\"Brown Rice\",\"quantity\":\"1\\/2 cup\",\"notes\":\"Cooked\"},{\"item\":\"Chickpeas\",\"quantity\":\"1\\/2 cup\",\"notes\":\"Canned, drained\"},{\"item\":\"Roasted Sweet Potato\",\"quantity\":\"1\\/2 cup\",\"notes\":\"Cubed\"},{\"item\":\"Spinach\",\"quantity\":\"1 cup\",\"notes\":\"Fresh\"},{\"item\":\"Tahini\",\"quantity\":\"1 tbsp\",\"notes\":\"For dressing\"}],\"cookingInstructions\":[\"Arrange rice, chickpeas, sweet potato, and spinach in a bowl\",\"Drizzle with tahini and serve\"]},\"dinner\":{\"name\":\"Gluten-Free Chicken Stir Fry\",\"calories\":410,\"protein\":28,\"carbs\":35,\"fat\":14,\"price\":8.8,\"groceryList\":[{\"item\":\"Chicken Breast\",\"quantity\":\"100g\",\"notes\":\"Sliced\"},{\"item\":\"Bell Pepper\",\"quantity\":\"1\\/2 cup\",\"notes\":\"Sliced\"},{\"item\":\"Broccoli\",\"quantity\":\"1\\/2 cup\",\"notes\":\"Florets\"},{\"item\":\"Gluten-Free Soy Sauce\",\"quantity\":\"1 tbsp\",\"notes\":\"\"}],\"cookingInstructions\":[\"Stir fry chicken and vegetables\",\"Add soy sauce and serve\"]},\"snack\":{\"name\":\"Regular Crackers & Cheese\",\"calories\":210,\"protein\":7,\"carbs\":24,\"fat\":10,\"price\":3.2,\"groceryList\":[{\"item\":\"Crackers\",\"quantity\":\"6\",\"notes\":\"\"},{\"item\":\"Cheese\",\"quantity\":\"2 slices\",\"notes\":\"\"}],\"cookingInstructions\":[\"Serve crackers with cheese\"]},\"totalCalories\":1440,\"totalPrice\":24},{\"breakfast\":{\"name\":\"Regular French Toast\",\"calories\":330,\"protein\":10,\"carbs\":45,\"fat\":12,\"price\":3.9,\"groceryList\":[{\"item\":\"Bread\",\"quantity\":\"2 slices\",\"notes\":\"\"},{\"item\":\"Egg\",\"quantity\":\"1\",\"notes\":\"Beaten\"},{\"item\":\"Milk\",\"quantity\":\"1\\/4 cup\",\"notes\":\"\"},{\"item\":\"Cinnamon\",\"quantity\":\"1\\/2 tsp\",\"notes\":\"\"}],\"cookingInstructions\":[\"Dip bread in egg and milk mixture\",\"Cook on skillet until golden brown\",\"Sprinkle with cinnamon\"]},\"lunch\":{\"name\":\"Regular Chicken Rice Bowl\",\"calories\":480,\"protein\":28,\"carbs\":60,\"fat\":12,\"price\":8.2,\"groceryList\":[{\"item\":\"Rice\",\"quantity\":\"1 cup\",\"notes\":\"Cooked\"},{\"item\":\"Chicken Breast\",\"quantity\":\"100g\",\"notes\":\"Grilled\"},{\"item\":\"Broccoli\",\"quantity\":\"1\\/2 cup\",\"notes\":\"Steamed\"},{\"item\":\"Soy Sauce\",\"quantity\":\"1 tbsp\",\"notes\":\"\"}],\"cookingInstructions\":[\"Arrange rice, chicken, and broccoli in a bowl\",\"Drizzle with soy sauce and serve\"]},\"dinner\":{\"name\":\"Vegetarian Lasagna\",\"calories\":480,\"protein\":18,\"carbs\":65,\"fat\":16,\"price\":9.2,\"groceryList\":[{\"item\":\"Lasagna Noodles\",\"quantity\":\"2 sheets\",\"notes\":\"\"},{\"item\":\"Ricotta Cheese\",\"quantity\":\"1\\/4 cup\",\"notes\":\"\"},{\"item\":\"Spinach\",\"quantity\":\"1\\/2 cup\",\"notes\":\"\"},{\"item\":\"Tomato Sauce\",\"quantity\":\"1\\/4 cup\",\"notes\":\"\"}],\"cookingInstructions\":[\"Layer noodles, cheese, spinach, and sauce\",\"Bake until bubbly\"]},\"snack\":{\"name\":\"Hummus with Veggie Sticks\",\"calories\":180,\"protein\":6,\"carbs\":20,\"fat\":8,\"price\":3.2,\"groceryList\":[{\"item\":\"Hummus\",\"quantity\":\"3 tbsp\",\"notes\":\"Store-bought or homemade\"},{\"item\":\"Carrot\",\"quantity\":\"1 medium\",\"notes\":\"Cut into sticks\"},{\"item\":\"Celery\",\"quantity\":\"2 stalks\",\"notes\":\"Cut into sticks\"},{\"item\":\"Bell Pepper\",\"quantity\":\"1\\/4\",\"notes\":\"Cut into strips\"}],\"cookingInstructions\":[\"Wash and cut vegetables into sticks\\/strips\",\"Serve with hummus for dipping\"]},\"totalCalories\":1470,\"totalPrice\":24.499999999999996},{\"breakfast\":{\"name\":\"Vegan Pancakes\",\"calories\":310,\"protein\":9,\"carbs\":58,\"fat\":7,\"price\":4.2,\"groceryList\":[{\"item\":\"Flour\",\"quantity\":\"1 cup\",\"notes\":\"All-purpose or gluten-free\"},{\"item\":\"Plant Milk\",\"quantity\":\"1 cup\",\"notes\":\"Almond, soy, or oat\"},{\"item\":\"Baking Powder\",\"quantity\":\"1 tsp\",\"notes\":\"\"},{\"item\":\"Maple Syrup\",\"quantity\":\"1 tbsp\",\"notes\":\"For serving\"}],\"cookingInstructions\":[\"Mix flour, baking powder, and plant milk to form batter\",\"Cook pancakes on a non-stick pan until golden\",\"Serve with maple syrup\"]},\"lunch\":{\"name\":\"Keto Chicken Caesar Salad\",\"calories\":390,\"protein\":32,\"carbs\":6,\"fat\":25,\"price\":8.9,\"groceryList\":[{\"item\":\"Chicken Breast\",\"quantity\":\"120g\",\"notes\":\"Grilled\"},{\"item\":\"Romaine Lettuce\",\"quantity\":\"2 cups\",\"notes\":\"Chopped\"},{\"item\":\"Parmesan Cheese\",\"quantity\":\"2 tbsp\",\"notes\":\"Shredded\"},{\"item\":\"Caesar Dressing\",\"quantity\":\"2 tbsp\",\"notes\":\"Low-carb\"}],\"cookingInstructions\":[\"Toss lettuce with dressing\",\"Top with grilled chicken and parmesan\"]},\"dinner\":{\"name\":\"Beef Stir Fry\",\"calories\":420,\"protein\":30,\"carbs\":25,\"fat\":20,\"price\":9.8,\"groceryList\":[{\"item\":\"Beef Sirloin\",\"quantity\":\"150g\",\"notes\":\"Thinly sliced\"},{\"item\":\"Bell Peppers\",\"quantity\":\"1\",\"notes\":\"Sliced\"},{\"item\":\"Broccoli\",\"quantity\":\"1 cup\",\"notes\":\"Florets\"},{\"item\":\"Carrots\",\"quantity\":\"1\",\"notes\":\"Julienned\"},{\"item\":\"Soy Sauce\",\"quantity\":\"2 tbsp\",\"notes\":\"Low-sodium\"},{\"item\":\"Garlic\",\"quantity\":\"2 cloves\",\"notes\":\"Minced\"},{\"item\":\"Ginger\",\"quantity\":\"1 tsp\",\"notes\":\"Grated\"},{\"item\":\"Sesame Oil\",\"quantity\":\"1 tsp\",\"notes\":\"For flavor\"}],\"cookingInstructions\":[\"Marinate beef slices in half of the soy sauce for 15 minutes\",\"Heat oil in a wok or large pan over high heat\",\"Cook beef until browned, then remove from pan\",\"In the same pan, stir-fry garlic and ginger for 30 seconds\",\"Add vegetables and stir-fry until crisp-tender\",\"Return beef to the pan\",\"Add remaining soy sauce and sesame oil\",\"Stir to combine and cook for another minute\",\"Serve hot, optionally over rice\"]},\"snack\":{\"name\":\"Regular Crackers & Cheese\",\"calories\":210,\"protein\":7,\"carbs\":24,\"fat\":10,\"price\":3.2,\"groceryList\":[{\"item\":\"Crackers\",\"quantity\":\"6\",\"notes\":\"\"},{\"item\":\"Cheese\",\"quantity\":\"2 slices\",\"notes\":\"\"}],\"cookingInstructions\":[\"Serve crackers with cheese\"]},\"totalCalories\":1330,\"totalPrice\":26.1}]', '2025-06-24 10:20:17');

-- --------------------------------------------------------

--
-- Table structure for table `member_profiles`
--

CREATE TABLE `member_profiles` (
  `mbp_user_ID` int(11) DEFAULT NULL,
  `mbp_dob` date DEFAULT NULL,
  `mbp_gender` varchar(10) DEFAULT NULL,
  `mbp_height` float DEFAULT NULL,
  `mbp_weight` float DEFAULT NULL,
  `mbp_goal` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `member_profiles`
--

INSERT INTO `member_profiles` (`mbp_user_ID`, `mbp_dob`, `mbp_gender`, `mbp_height`, `mbp_weight`, `mbp_goal`) VALUES
(15, '0000-00-00', 'female', 168, 45, 'Skinny'),
(19, '0000-00-00', 'male', 183, 70, 'Muscle'),
(20, '1970-01-01', 'male', 170, 60, 'Skinny'),
(22, '1970-01-01', 'male', 180, 80, 'Muscle'),
(23, '2025-05-18', 'male', 170, 45, 'Skinny'),
(26, '2025-05-14', 'female', 180, 65, 'Skinny'),
(27, '2025-06-01', 'female', 180, 100, 'Skinny'),
(28, '2025-06-01', 'female', 160, 50, 'Skinny'),
(29, '2025-06-01', 'female', 0, 65, 'Muscle'),
(30, '2025-06-01', 'male', 180, 65, 'Muscle'),
(36, '2025-06-02', 'female', 160, 45, 'Skinny'),
(41, '2002-06-03', 'female', 170, 50, 'Skinny'),
(42, '1997-05-13', 'female', 170, 50, 'Skinny'),
(44, '2006-01-09', 'female', 165, 65, 'Lose Weight'),
(47, '2000-02-15', 'male', 182, 77, 'Gain Weight'),
(49, '1980-10-21', 'female', 157, 52, 'Maintain Weight');

-- --------------------------------------------------------

--
-- Table structure for table `nutrition_journal`
--

CREATE TABLE `nutrition_journal` (
  `ntj_journal_id` int(11) NOT NULL,
  `ntj_user_id` int(11) NOT NULL,
  `ntj_entry_date` date NOT NULL,
  `ntj_breakfast_calories` int(11) DEFAULT NULL,
  `ntj_lunch_calories` int(11) DEFAULT NULL,
  `ntj_dinner_calories` int(11) DEFAULT NULL,
  `ntj_snacks_calories` int(11) DEFAULT NULL,
  `ntj_water_intake` varchar(20) DEFAULT NULL,
  `ntj_supplements` text DEFAULT NULL,
  `ntj_notes` text DEFAULT NULL,
  `ntj_mood` varchar(20) DEFAULT NULL,
  `ntj_created_at` datetime DEFAULT current_timestamp(),
  `ntj_updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nutrition_journal`
--

INSERT INTO `nutrition_journal` (`ntj_journal_id`, `ntj_user_id`, `ntj_entry_date`, `ntj_breakfast_calories`, `ntj_lunch_calories`, `ntj_dinner_calories`, `ntj_snacks_calories`, `ntj_water_intake`, `ntj_supplements`, `ntj_notes`, `ntj_mood`, `ntj_created_at`, `ntj_updated_at`) VALUES
(15, 44, '2025-06-11', 280, 100, 500, 100, '', '', '', 'happy', '2025-06-30 11:11:04', '2025-06-30 11:11:31'),
(16, 42, '2025-06-25', 50, 280, 300, 100, '', '', '', 'energetic', '2025-07-01 06:23:21', '2025-07-01 06:23:21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `usr_user_id` int(11) NOT NULL,
  `usr_username` varchar(50) DEFAULT NULL,
  `usr_full_name` varchar(100) DEFAULT NULL,
  `usr_email` varchar(100) DEFAULT NULL,
  `usr_phone` varchar(15) DEFAULT NULL,
  `usr_password` varchar(255) DEFAULT NULL,
  `usr_security_keyword` varchar(100) DEFAULT NULL,
  `usr_role` enum('member','coach','nutritionist') DEFAULT NULL,
  `usr_reg_date` datetime NOT NULL DEFAULT current_timestamp(),
  `usr_last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`usr_user_id`, `usr_username`, `usr_full_name`, `usr_email`, `usr_phone`, `usr_password`, `usr_security_keyword`, `usr_role`, `usr_reg_date`, `usr_last_login`) VALUES
(15, 'tzuyu', 'TZUYU ZHOU', 'tzu@gmail.com', '0123456789', 'tzu123', 'twice', 'member', '2024-05-22 11:41:22', '2024-11-15 10:34:24'),
(17, 'JOSHUA', 'Kim Joshua', 'joshua@gmail.com', '0123456789', 'jos123', 'meiguomengnan', 'member', '2024-07-30 16:13:35', '2025-07-02 08:07:51'),
(18, 'HOSHI', 'HOORANGHAE', 'hoshi@gmail.com', '0123456789', 'hoshi123', 'TIGER', 'member', '2024-08-19 10:38:22', '2024-08-22 11:11:17'),
(19, 'mingyu', 'Kim Min Gyu', 'mingyu@gmail.com', '0123456789', 'ming123', 'Korea Mengnan', 'member', '2024-08-27 15:17:39', '2024-10-30 18:16:37'),
(20, 'leeknow', 'Lee Know', 'lee@gmail.com', '0123456789', 'lee@123', 'STAY', 'member', '2024-09-02 14:16:08', '2024-11-10 12:20:10'),
(21, 'Youngk', 'YOUNG K', 'k@gmail.com', '0123456789', 'y@123', 'day6', 'member', '2024-09-02 19:49:45', '2025-02-28 07:26:37'),
(22, 'Sungjin', 'SUNG JIN', 'sung@gmail.com', '0123456789', 'sungsung', 'DAY6-power of love', 'member', '2024-11-12 06:14:47', '2025-03-24 14:23:11'),
(23, 'Jihyo', 'Ji Hyo', 'jihyo@gmail.com', '0123456789', 'jh123', 'TWICE LEADER', 'member', '2024-11-16 12:48:22', '2025-07-08 08:13:27'),
(26, 'aeri', 'Giselle', 'gis@gmail.com', '0123456789', 'GIS@1234', 'AESPA', 'member', '2024-12-09 14:13:13', '2025-04-15 19:58:40'),
(27, 'simsim', 'Sim Tian', 'simtian0907@gmail.com', '0123456789', 'sim123', 'SIMM', 'member', '2024-12-27 08:45:59', '2025-01-20 14:36:01'),
(28, 'Meimei', 'Tan Mei Mei', 'mei@gmail.com', '0123456789', 'meimei1234', 'prettymeimei', 'member', '2025-01-14 16:12:24', '2025-07-06 08:19:44'),
(29, 'HAHAHAHAH', 'hahah', 'junhui@gmail.com', '0123456789', '123', 'asd', 'member', '2025-01-29 09:45:22', '2025-07-09 08:03:32'),
(30, 'DINO', 'LEE CHAN', 'dino@gmail.com', '012-3456789', 'dino@123', 'SEVENTEEN', 'member', '2025-02-03 09:47:23', '2025-04-04 17:32:27'),
(36, 'lingling', 'LING LING', 'ling2@gmail.com', '012-3456789', 'LING2@123', 'KIIRAS', 'member', '2025-03-06 12:20:22', '2025-03-24 08:33:05'),
(41, 'Kelly', 'Tan Kelly', 'kelly@123', '012-3456789', 'Kelly@123', 'Trying123', 'member', '2025-04-29 21:47:06', '2025-06-09 19:50:19'),
(42, 'Barbie', 'Barbie Doll', 'barbie@gmail.com', '012-3456789', 'Barbie@123', 'Barbie Girl', 'member', '2025-05-13 11:01:13', '2025-07-13 07:15:37'),
(44, 'Layla', 'Layla Tan', 'layla@gmail.com', '012-3456789', 'layla@1234', 'iamlayla', 'member', '2025-06-25 08:35:40', '2025-07-05 11:15:49'),
(47, 'Johnny', 'John Doe', 'johndoe@gmail.com', '012-3456789', 'johndoe@123', 'johnny', 'member', '2025-07-12 18:10:43', '2025-07-13 09:06:09'),
(49, 'Kimmy', 'Kim Kardashian', 'kimkardashian@gmail.com', '013-4567892', 'kimmy@123', 'KIMMY', 'member', '2025-07-13 09:15:58', '2025-07-13 09:17:19');

-- --------------------------------------------------------

--
-- Table structure for table `weight_logs`
--

CREATE TABLE `weight_logs` (
  `wgl_weight_id` int(11) NOT NULL,
  `wgl_member_ID` int(11) DEFAULT NULL,
  `wgl_entry_date` date DEFAULT NULL,
  `wgl_weight` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `workout_plan`
--

CREATE TABLE `workout_plan` (
  `wop_id` int(11) NOT NULL,
  `wop_user_id` varchar(50) DEFAULT NULL,
  `wop_height` decimal(5,2) DEFAULT NULL,
  `wop_weight` decimal(5,2) DEFAULT NULL,
  `wop_bmi` decimal(5,2) DEFAULT NULL,
  `wop_category` varchar(20) DEFAULT NULL,
  `wop_plan` mediumtext DEFAULT NULL,
  `wop_created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workout_plan`
--

INSERT INTO `workout_plan` (`wop_id`, `wop_user_id`, `wop_height`, `wop_weight`, `wop_bmi`, `wop_category`, `wop_plan`, `wop_created_at`) VALUES
(8, '44', 165.00, 65.00, 23.90, 'Normal Weight', '[[\"Cardio: Jog (30 mins)\",\"Strength Builder (30 mins)\",\"Plank + Russian Twists (3x20)\"],[\"HIIT (20 mins)\",\"Stretch (15 mins)\"],[\"Leg Strength (30 mins)\",\"Plank Variations (3x30s)\"],[\"Cycling (40 mins)\",\"Abs: Leg Raises + Flutter Kicks (3x20)\"],[\"Full Body Strength (30 mins)\",\"Leg HIIT (20 mins)\"],[\"Walk or Jog (45 mins)\",\"Flexibility Stretch (20 mins)\"],[\"Active Rest: Light yoga (15 mins)\"]]', '2025-06-29 10:39:36'),
(9, '46', 176.00, 60.00, 19.40, 'Normal Weight', '[[\"Cardio: Jog (30 mins)\",\"Strength Builder (30 mins)\",\"Plank + Russian Twists (3x20)\"],[\"HIIT (20 mins)\",\"Stretch (15 mins)\"],[\"Leg Strength (30 mins)\",\"Plank Variations (3x30s)\"],[\"Cycling (40 mins)\",\"Abs: Leg Raises + Flutter Kicks (3x20)\"],[\"Full Body Strength (30 mins)\",\"Leg HIIT (20 mins)\"],[\"Walk or Jog (45 mins)\",\"Flexibility Stretch (20 mins)\"],[\"Active Rest: Light yoga (15 mins)\"]]', '2025-07-10 11:09:09');

-- --------------------------------------------------------

--
-- Table structure for table `workout_status`
--

CREATE TABLE `workout_status` (
  `wos_user_id` varchar(50) NOT NULL,
  `wos_day` varchar(20) NOT NULL,
  `wos_item` varchar(255) NOT NULL,
  `wos_checked` tinyint(1) DEFAULT NULL,
  `wos_date` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workout_status`
--

INSERT INTO `workout_status` (`wos_user_id`, `wos_day`, `wos_item`, `wos_checked`, `wos_date`) VALUES
('44', 'Monday', 'Cardio: Jog (30 mins)', 1, '2025-06-30'),
('44', 'Monday', 'Plank + Russian Twists (3x20)', 1, '2025-06-30'),
('44', 'Monday', 'Strength Builder (30 mins)', 1, '2025-06-30'),
('44', 'Sunday', 'Active Rest: Light yoga (15 mins)', 1, '2025-06-29'),
('44', 'Thursday', 'Abs: Leg Raises + Flutter Kicks (3x20)', 1, '2025-06-26'),
('44', 'Thursday', 'Cycling (40 mins)', 0, '2025-06-29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `body_measurements`
--
ALTER TABLE `body_measurements`
  ADD PRIMARY KEY (`bdm_measurement_ID`),
  ADD KEY `memberID` (`bdm_member_ID`);

--
-- Indexes for table `daily_logs`
--
ALTER TABLE `daily_logs`
  ADD PRIMARY KEY (`dll_log_ID`),
  ADD KEY `memberID` (`dll_member_ID`);

--
-- Indexes for table `journal_meals`
--
ALTER TABLE `journal_meals`
  ADD PRIMARY KEY (`jnm_meal_id`),
  ADD KEY `fk_jnm_journal` (`jnm_journal_id`);

--
-- Indexes for table `meal_plans`
--
ALTER TABLE `meal_plans`
  ADD PRIMARY KEY (`mpl_id`);

--
-- Indexes for table `member_profiles`
--
ALTER TABLE `member_profiles`
  ADD KEY `userID` (`mbp_user_ID`);

--
-- Indexes for table `nutrition_journal`
--
ALTER TABLE `nutrition_journal`
  ADD PRIMARY KEY (`ntj_journal_id`),
  ADD UNIQUE KEY `unique_user_date` (`ntj_user_id`,`ntj_entry_date`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usr_user_id`),
  ADD UNIQUE KEY `username` (`usr_username`);

--
-- Indexes for table `weight_logs`
--
ALTER TABLE `weight_logs`
  ADD PRIMARY KEY (`wgl_weight_id`),
  ADD KEY `memberID` (`wgl_member_ID`);

--
-- Indexes for table `workout_plan`
--
ALTER TABLE `workout_plan`
  ADD PRIMARY KEY (`wop_id`);

--
-- Indexes for table `workout_status`
--
ALTER TABLE `workout_status`
  ADD PRIMARY KEY (`wos_user_id`,`wos_day`,`wos_item`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `body_measurements`
--
ALTER TABLE `body_measurements`
  MODIFY `bdm_measurement_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `daily_logs`
--
ALTER TABLE `daily_logs`
  MODIFY `dll_log_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `journal_meals`
--
ALTER TABLE `journal_meals`
  MODIFY `jnm_meal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=204;

--
-- AUTO_INCREMENT for table `meal_plans`
--
ALTER TABLE `meal_plans`
  MODIFY `mpl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `nutrition_journal`
--
ALTER TABLE `nutrition_journal`
  MODIFY `ntj_journal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `usr_user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `weight_logs`
--
ALTER TABLE `weight_logs`
  MODIFY `wgl_weight_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `workout_plan`
--
ALTER TABLE `workout_plan`
  MODIFY `wop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `body_measurements`
--
ALTER TABLE `body_measurements`
  ADD CONSTRAINT `body_measurements_ibfk_1` FOREIGN KEY (`bdm_member_ID`) REFERENCES `member_profiles` (`mbp_user_ID`);

--
-- Constraints for table `daily_logs`
--
ALTER TABLE `daily_logs`
  ADD CONSTRAINT `daily_logs_ibfk_1` FOREIGN KEY (`dll_member_ID`) REFERENCES `member_profiles` (`mbp_user_ID`);

--
-- Constraints for table `journal_meals`
--
ALTER TABLE `journal_meals`
  ADD CONSTRAINT `fk_jnm_journal` FOREIGN KEY (`jnm_journal_id`) REFERENCES `nutrition_journal` (`ntj_journal_id`) ON DELETE CASCADE;

--
-- Constraints for table `member_profiles`
--
ALTER TABLE `member_profiles`
  ADD CONSTRAINT `member_profiles_ibfk_1` FOREIGN KEY (`mbp_user_ID`) REFERENCES `users` (`usr_user_id`);

--
-- Constraints for table `nutrition_journal`
--
ALTER TABLE `nutrition_journal`
  ADD CONSTRAINT `fk_ntj_user` FOREIGN KEY (`ntj_user_id`) REFERENCES `users` (`usr_user_id`) ON DELETE CASCADE;

--
-- Constraints for table `weight_logs`
--
ALTER TABLE `weight_logs`
  ADD CONSTRAINT `weight_logs_ibfk_1` FOREIGN KEY (`wgl_member_ID`) REFERENCES `member_profiles` (`mbp_user_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
