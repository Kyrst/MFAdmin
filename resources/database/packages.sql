SET FOREIGN_KEY_CHECKS=0;

INSERT INTO `packages` (`id`, `title`, `price`, `description`, `created_at`, `updated_at`) VALUES
(2, 'Skolpaket 1', '468.00', '', '2010-10-18 02:46:26', '2015-03-15 17:38:31'),
(3, 'Förskolepaket 1', '378.00', '', '2010-10-18 02:48:49', '2015-03-15 17:38:31'),
(4, 'Öppen Fsk utan grpbild', '378.00', '', '2010-10-18 02:49:50', '2015-03-15 17:38:31'),
(5, 'Endast Gruppbild', '149.00', '', '2010-11-01 02:54:42', '2015-03-15 17:38:31');
SET FOREIGN_KEY_CHECKS=1;