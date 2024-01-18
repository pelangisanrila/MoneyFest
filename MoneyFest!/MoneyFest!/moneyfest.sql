-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Jan 2024 pada 10.02
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moneyfest`
--

DELIMITER $$
--
-- Prosedur
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `input_expenses` (IN `p_id_user` INT, IN `p_expense_name` VARCHAR(200), IN `p_category_expense` INT, IN `p_total_expense` BIGINT(20), IN `p_date_expense` DATE, IN `p_image_expense` BLOB)   BEGIN
    INSERT INTO expense (id_user, expense_name, id_category_expense, total_expense, date_expense, image_expense)
    VALUES (p_id_user, p_expense_name, p_category_expense, p_total_expense, p_date_expense, p_image_expense);

    UPDATE user
    SET balance = balance - p_total_expense
    WHERE id_user = p_id_user;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `input_income` (IN `p_id_user` INT, IN `p_income_name` VARCHAR(200), IN `p_category_income` INT, IN `p_total_income` BIGINT(20), IN `p_date_income` DATETIME, IN `p_image_income` BLOB)   BEGIN
    INSERT INTO income (id_user, income_name, id_category_income, total_income, date_income, image_income)
    VALUES (p_id_user, p_income_name, p_category_income, p_total_income, p_date_income, p_image_income);

    UPDATE user
    SET balance = balance + p_total_income
    WHERE id_user = p_id_user;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `input_income2` (IN `p_id_user` INT, IN `p_income_name` VARCHAR(200), IN `p_category_income` INT, IN `p_total_income` BIGINT(20), IN `p_date_income` DATE, IN `p_image_income` BLOB)   BEGIN
    
    INSERT INTO income (id_user, income_name, id_category_income, total_income, date_income, image_income)
    VALUES (p_id_user, p_income_name, p_category_income, p_total_income, p_date_income, p_image_income);

    
    SET @last_id = LAST_INSERT_ID();

    
    UPDATE income
    SET id_income = @last_id
    WHERE id_income IS NULL AND id_user = p_id_user;

    
    UPDATE user
    SET balance = balance + p_total_income
    WHERE id_user = p_id_user;
END$$

--
-- Fungsi
--
CREATE DEFINER=`root`@`localhost` FUNCTION `balance` (`user_id` INT) RETURNS BIGINT(20)  BEGIN
    DECLARE total_income_val BIGINT(20);
    DECLARE total_expense_val BIGINT(20);

    SELECT COALESCE(SUM(total_income), 0) INTO total_income_val FROM income WHERE id_user = user_id;
    SELECT COALESCE(SUM(total_expense), 0) INTO total_expense_val FROM expense WHERE id_user = user_id;

    RETURN total_income_val - total_expense_val;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `total_expenses` (`user_id` INT) RETURNS BIGINT(20)  BEGIN
    RETURN (
        SELECT COALESCE(SUM(total_expense), 0)
        FROM expense
        WHERE id_user = user_id
    );
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `total_income` (`user_id` INT) RETURNS BIGINT(20)  BEGIN
    RETURN (
        SELECT COALESCE(SUM(total_income), 0)
        FROM income
        WHERE id_user = user_id
    );
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `category_expense`
--

CREATE TABLE `category_expense` (
  `id_category_expense` int(11) NOT NULL,
  `expense_category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `category_expense`
--

INSERT INTO `category_expense` (`id_category_expense`, `expense_category`) VALUES
(1, 'Diet'),
(2, 'Transportation'),
(3, 'Social'),
(4, 'Residential'),
(5, 'Gift'),
(6, 'Communication'),
(7, 'Clothing'),
(8, 'Recreation'),
(9, 'Beautify'),
(10, 'Medical'),
(11, 'Baby'),
(12, 'Pet'),
(13, 'Travel'),
(14, 'Education'),
(15, 'Home Appliances'),
(16, 'Daily');

-- --------------------------------------------------------

--
-- Struktur dari tabel `category_income`
--

CREATE TABLE `category_income` (
  `id_category_income` int(11) NOT NULL,
  `income_category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `category_income`
--

INSERT INTO `category_income` (`id_category_income`, `income_category`) VALUES
(1, 'Wage'),
(2, 'Bonus'),
(3, 'Investment'),
(4, 'Part time');

-- --------------------------------------------------------

--
-- Struktur dari tabel `expense`
--

CREATE TABLE `expense` (
  `id_expense` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `expense_name` varchar(200) NOT NULL,
  `id_category_expense` int(11) NOT NULL,
  `total_expense` bigint(20) NOT NULL,
  `date_expense` date NOT NULL,
  `image_expense` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `expense`
--

INSERT INTO `expense` (`id_expense`, `id_user`, `expense_name`, `id_category_expense`, `total_expense`, `date_expense`, `image_expense`) VALUES
(1, 1, 'jajan', 1, 100000, '2024-01-16', NULL),
(5, 1, 'Transport GOJEK', 2, 50000, '2024-01-15', '2024-01-16-65a6ade8e25ce.png'),
(6, 1, 'PAKET DATA', 6, 50000, '2024-01-15', '2024-01-16-65a6ae5854945.'),
(7, 1, 'SKINCARE', 9, 200000, '2024-01-14', '2024-01-16-65a6b006dfded.png'),
(8, 1, 'beli obat', 10, 100000, '2024-01-17', '2024-01-16-65a6b35dc8c7f.jpg');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `history_expenses`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `history_expenses` (
`date_expense` date
,`expense_name` varchar(200)
,`id_user` int(11)
,`id_category_expense` int(11)
,`expense_category` varchar(50)
,`total_expense` bigint(20)
,`image_expense` varchar(255)
,`user_total_expenses` bigint(20)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `history_income`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `history_income` (
`date_income` timestamp
,`income_name` varchar(200)
,`id_user` int(11)
,`id_category_income` int(11)
,`income_category` varchar(50)
,`total_income` bigint(20)
,`image_income` varchar(255)
,`total_user_income` bigint(20)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `income`
--

CREATE TABLE `income` (
  `id_income` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `income_name` varchar(200) NOT NULL,
  `id_category_income` int(11) NOT NULL,
  `total_income` bigint(20) NOT NULL,
  `date_income` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `image_income` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `income`
--

INSERT INTO `income` (`id_income`, `id_user`, `income_name`, `id_category_income`, `total_income`, `date_income`, `image_income`) VALUES
(1, 1, 'gaji ITLG', 1, 2000000, '2024-01-15 17:00:00', ''),
(2, 1, 'THR', 1, 100000, '2024-01-15 17:00:00', '2024-01-16-65a6408c66481.jpeg'),
(3, 1, 'part time', 4, 2000000, '2024-01-14 17:00:00', '2024-01-16-65a641380a9cd.'),
(4, 1, 'HADIAH', 2, 100000, '2024-01-15 17:00:00', '2024-01-16-65a6b0572f4b6.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `user_name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `gender` enum('Female','Male','Prefer not to say','') NOT NULL,
  `birthday` date NOT NULL,
  `profession` varchar(100) NOT NULL,
  `balance` bigint(20) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `user_name`, `email`, `gender`, `birthday`, `profession`, `balance`, `username`, `password`) VALUES
(1, 'Khairunnisa', 'khairunnisa123@gmail.com', 'Female', '2004-07-13', 'Student', 64737821, 'iniiunii', 'abcdefgh');

-- --------------------------------------------------------

--
-- Struktur untuk view `history_expenses`
--
DROP TABLE IF EXISTS `history_expenses`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `history_expenses`  AS SELECT `e`.`date_expense` AS `date_expense`, `e`.`expense_name` AS `expense_name`, `u`.`id_user` AS `id_user`, `c`.`id_category_expense` AS `id_category_expense`, `c`.`expense_category` AS `expense_category`, `e`.`total_expense` AS `total_expense`, `e`.`image_expense` AS `image_expense`, `total_expenses`(`u`.`id_user`) AS `user_total_expenses` FROM ((`expense` `e` join `user` `u` on(`e`.`id_user` = `u`.`id_user`)) join `category_expense` `c` on(`e`.`id_category_expense` = `c`.`id_category_expense`)) ORDER BY `e`.`date_expense` AS `DESCdesc` ASC  ;

-- --------------------------------------------------------

--
-- Struktur untuk view `history_income`
--
DROP TABLE IF EXISTS `history_income`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `history_income`  AS SELECT `i`.`date_income` AS `date_income`, `i`.`income_name` AS `income_name`, `u`.`id_user` AS `id_user`, `ci`.`id_category_income` AS `id_category_income`, `ci`.`income_category` AS `income_category`, `i`.`total_income` AS `total_income`, `i`.`image_income` AS `image_income`, `total_income`(`i`.`id_user`) AS `total_user_income` FROM ((`income` `i` join `category_income` `ci` on(`i`.`id_category_income` = `ci`.`id_category_income`)) join `user` `u` on(`i`.`id_user` = `u`.`id_user`)) ORDER BY `i`.`date_income` AS `DESCdesc` ASC  ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `category_expense`
--
ALTER TABLE `category_expense`
  ADD PRIMARY KEY (`id_category_expense`);

--
-- Indeks untuk tabel `category_income`
--
ALTER TABLE `category_income`
  ADD PRIMARY KEY (`id_category_income`);

--
-- Indeks untuk tabel `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`id_expense`),
  ADD KEY `fk_ex_user` (`id_user`),
  ADD KEY `fk_ex_category` (`id_category_expense`);

--
-- Indeks untuk tabel `income`
--
ALTER TABLE `income`
  ADD PRIMARY KEY (`id_income`),
  ADD KEY `fk_inc_user` (`id_user`),
  ADD KEY `fk_inc_category` (`id_category_income`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `category_expense`
--
ALTER TABLE `category_expense`
  MODIFY `id_category_expense` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `category_income`
--
ALTER TABLE `category_income`
  MODIFY `id_category_income` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `expense`
--
ALTER TABLE `expense`
  MODIFY `id_expense` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `income`
--
ALTER TABLE `income`
  MODIFY `id_income` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `expense`
--
ALTER TABLE `expense`
  ADD CONSTRAINT `fk_ex_category` FOREIGN KEY (`id_category_expense`) REFERENCES `category_expense` (`id_category_expense`),
  ADD CONSTRAINT `fk_ex_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `income`
--
ALTER TABLE `income`
  ADD CONSTRAINT `fk_inc_category` FOREIGN KEY (`id_category_income`) REFERENCES `category_income` (`id_category_income`),
  ADD CONSTRAINT `fk_inc_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
