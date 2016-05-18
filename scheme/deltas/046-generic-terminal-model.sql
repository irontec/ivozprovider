INSERT INTO TerminalManufacturers (iden, name, description) VALUES ('Generic', 'Generic SIP Manufacturer', 'Generic SIP Manufacturer');
INSERT INTO TerminalModels (iden, name, description, TerminalManufacturerId) VALUES ('Generic', 'Generic SIP Model', 'Generic SIP Model', (SELECT id from TerminalManufacturers WHERE iden = 'Generic'));
