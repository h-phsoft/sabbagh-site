ALTER TABLE `ecom_product` DROP INDEX `mnum`;
ALTER TABLE `ecom_product` ADD  UNIQUE(`cat_id`, `mnum`);
