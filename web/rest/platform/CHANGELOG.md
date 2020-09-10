# Changelog

## 2.16.0
* Models:
    - ActiveCalls:
        - Added inbound and outbound properties
    - BannedAddress:
        - Added aor property into BannedAddress-detailed model
    - BillableCall:
        - Added endpointName property
    - Company:
        - Added currentDayUsage and maxDailyUsageEmail properties

## 2.15.1
* Endpoints:
    - Added /proxy_trunks_rel_brands
* Models:
    - ProxyTrunksRelBrand:
        - Added entity

## 2.15
* Endpoints:
    - Added [GET] /administrator_rel_public_entities
    - Added [GET] and [PUT] /administrator_rel_public_entities/{id}
    - Added [GET] /banned_addresses
    - Added [GET] /banned_addresses/{id}
    - Added [GET] /public_entities
    - Added [GET] /public_entities/{id}
    - Added [GET] and [POST] /rtpengines
    - Added [GET], [PUT] and [DELETE] /rtpengines/{id}
* Models:
    - Administrators:
        - Added restricted required property
    - AdministratorRelPublicEntity:
        - Added entity
    - BannedAddress:
        - Added entity
    - BillableCall:
        - Restricted endpointType possible values
        - Added carrier, ddi and ddiProvider properties
    - Carrier:
        - Added entity
    - Ddi:
        - Added entity
    - DdiProvider:
        - Added entity
    - PublicEntity:
        - Added entity
    - Rtpengine:
        - Added entity

## 2.14
* Endpoints:
    - Added [Exists] filter parameter for brand and company fields on /billable_calls
    - Added urlType filter parameter on /web_portals
* Models:
    - Administrators:
        - Added username property into Administrator-collection model
    - SpecialNumber:
        - Added entity
    - WebPortal:
        - Added urlType property into WebPortal-collection model

## 2.13.2
* Endpoints:
    - Added [Exists] filter parameter for nullable fields (Only possible on foreign keys before)
* Models:
    - WebPortal:
        - Added urlType property into WebPortal-collection model

## 2.13.1
* Models:
    - BillableCalls:
        - Added cost property into BillableCall-rating model

## 2.13
* Endpoints:
    - /billable_calls/{callid}/rate has being added

* Models:
    - BillableCalls:
        - Added BillableCall and BillableCall-rating models
    - InvoiceTemplates:
        - Added entity
    - Companies:
        - Added maxDailyUsage and allowRecordingRemoval properties to Company model
    - Invoices:
        - Added invoiceTemplate property

## 2.12.1
* Models:
    - BillableCall:
        - Added priceDetails array property to BillableCall-detailed model
    - Brand:
        - Added Brand-withFeatures model for [PUT] and [POST] operations which exposes features array property
        - Added features array property to Brand-detailed model 

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
