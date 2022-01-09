-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 09 Sty 2022, 12:09
-- Wersja serwera: 10.4.14-MariaDB
-- Wersja PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `warzywniak`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `product` varchar(20) NOT NULL,
  `quantity` double NOT NULL,
  `total_price` double NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(17) NOT NULL DEFAULT 'nowe',
  `purchaser_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `orders`
--

INSERT INTO `orders` (`id`, `product`, `quantity`, `total_price`, `create_date`, `status`, `purchaser_id`) VALUES
(26, 'pomidory', 5, 25, '2022-01-09 10:42:47', 'Gotowe do odbioru', 1),
(27, 'pomidory', 10, 50, '2022-01-09 10:42:54', 'Zakończone', 1),
(28, 'pomidory', 2, 10, '2022-01-09 10:42:58', 'Anulowane', 1),
(29, 'ogórki', 100, 350, '2022-01-09 10:43:06', 'nowe', 1),
(30, 'Bakłażan', 50, 300, '2022-01-09 10:43:13', 'nowe', 1),
(31, 'ogórki', 35, 122.5, '2022-01-09 10:43:47', 'Gotowe do odbioru', 2),
(32, 'Ziemniaki', 55, 82.5, '2022-01-09 10:43:57', 'nowe', 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `quantity` double NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `products`
--

INSERT INTO `products` (`id`, `name`, `quantity`, `price`) VALUES
(1, 'pomidory', 0, 5),
(2, 'ogórki', 840, 3.5),
(3, 'papryka', 3, 300),
(4, 'cebula', 1, 8.5),
(5, 'Ziemniaki', 71, 1.5),
(6, 'Cukinia', 11, 15),
(7, 'Bakłażan', 50, 6);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `type` varchar(10) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `email`, `type`) VALUES
(1, 'user', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'user@gmail.com', 'user'),
(2, 'Adam', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'adam@gmail.com', 'user'),
(3, 'piotr12', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'piotr@gmaiodisnosd.pl', 'user'),
(4, 'admin', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'admin123@gmail.com', 'admin');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT dla tabeli `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
