-- Add extra service to record company locutions from terminal
INSERT INTO `Services` VALUES (4,'RecordLocution','', 'Record Locution','Grabar Locucion','', 'Add the locution code after the service code','Añada el código de locución tras el código de servicio','00', 1);

-- Enable Service for all Brands
INSERT INTO BrandServices (serviceId, brandId, code) SELECT 4, id, '00' FROM Brands;

-- Enable Service for all Companies
INSERT INTO CompanyServices (serviceId, companyId, code) SELECT 4, id, '00' FROM Companies;
