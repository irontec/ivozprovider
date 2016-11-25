DROP VIEW ast_hints;
CREATE VIEW ast_hints AS SELECT e.number AS exten, CONCAT('company', e.companyId) AS context, concat('PJSIP/', a.sorcery_id) AS device FROM Extensions e INNER JOIN Users u ON u.id = e.userId INNER JOIN Terminals t ON t.id = u.terminalId INNER JOIN ast_ps_endpoints a ON a.terminalId = t.id;
