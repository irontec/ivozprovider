DROP VIEW `kam_users_authdb`;
CREATE VIEW `kam_users` AS SELECT id, name, domain, password, companyId FROM `Friends` UNION SELECT id, name, domain, password, companyId FROM `Terminals`;
