# Changelog

## 2.12
* Endpoints:
    - Removed filter parameters not present on response models (except for foreign keys) 
    - Added [exists] filter modificator (brand[exists] for instance) on nullable foreign keys. This allows to filter by IS NULL / IS NOT NULL conditions 

* Models:
    -  Added Catalan and Italian to each multi language field group

## 2.11.1
* Endpoints:
    - /invoices and invoices/{id} have being removed
    - /invoices/{id}\/pdf has being removed
* Models:
  - BillableCall:
    - added attribute on collection model: id
  - FeaturesRelBrand:
    - added attributes on collection model: brand and feature

## 2.11.0

* Bugfixes:
    - Fixed roles on refreshed token
* Endpoints:
    - /brands: 
      - Added file upload handler: POST and PUT
      - Set multipart/form-data as default content type: POST and PUT
      - Added endpoint: [GET] /brands/{id}/logo
    - /invoices: 
      - Added endpoint: [GET] /invoices/{id}/pdf
    - /web_portals: 
      - Added file upload handler: POST and PUT
      - Set multipart/form-data as default content type: POST and PUT
      - Added endpoint: [GET] /web_portals/{id}/logo
* Models:
  - Brand
      - Removed attributes: recordingsLimitMB, recordingsLimitEmail, domain
  - Company
      - Removed required flag: country
      - Removed attribute: domain
