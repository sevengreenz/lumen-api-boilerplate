CREATE DATABASE IF NOT EXISTS `sample`;
CREATE DATABASE IF NOT EXISTS `sample_test`;

GRANT ALL ON `sample`.* TO `sample`@`%`;
GRANT ALL ON `sample_test`.* TO `sample`@`%`;
