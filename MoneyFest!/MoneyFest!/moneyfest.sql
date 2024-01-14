-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Jan 2024 pada 03.09
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

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

CREATE DEFINER=`root`@`localhost` PROCEDURE `input_income` (IN `p_id_user` INT, IN `p_income_name` VARCHAR(200), IN `p_category_income` INT, IN `p_total_income` BIGINT(20), IN `p_date_income` DATE, IN `p_image_income` BLOB)   BEGIN
    INSERT INTO income (id_user, income_name, id_category_income, total_income, date_income, image_income)
    VALUES (p_id_user, p_income_name, p_category_income, p_total_income, p_date_income, p_image_income);

    UPDATE user
    SET balance = balance + p_total_income
    WHERE id_user = p_id_user;
END$$

--
-- Fungsi
--
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
  `image_expense` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `date_income` date NOT NULL,
  `image_income` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 'Khairunnisa', 'khairunnisa123@gmail.com', 'Female', '2004-07-13', 'Student', 0, 'iniiunii', 'abcdefgh');

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
  MODIFY `id_expense` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `income`
--
ALTER TABLE `income`
  MODIFY `id_income` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
