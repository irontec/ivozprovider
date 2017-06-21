/** kam_users: Update view **/
DROP VIEW IF EXISTS `kam_users`;

CREATE VIEW `kam_users` AS
SELECT 'friend' AS type, name, domain, password, companyId FROM Friends
UNION
SELECT 'terminal' AS type, name, domain, password, companyId FROM Terminals
UNION
SELECT 'retail' AS type, name, domain, password, companyId FROM RetailAccounts;
