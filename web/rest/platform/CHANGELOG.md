# Changelog
## 3.0.0
* Disclaimer: The API schema will not be considered stable until version 3.1 and may receive new breaking changes
* Endpoints:
    - Added not equal [neq] filters
    - Added exits[fldName] filters
    - Fixed downloadable file spec
    - Fixed embeddable model spec
* Models:
    - Some properties added into response models (not listed below unless they involve a BC)
    - ApplicationServer:
      - Set name as required
    - BillableCall:
      - Set direction as required
    - Brand:
        - Set language as required
        - Set currency as not required
    - Country_Name:
        - Set all properties as required
    - Domain:
      - Set pointsTo as enum and required
    - Feature_Name:
        - Set all properties as required
    - MediaRelaySet-collection:
      - Removed type property

## 2.18.1
* Endpoints:
    - /brands:
      - Added domainUsers[end|exact|exists|partial|start] filter parameters
      - Added invoice.country[end|exact|exists|partial|start] filter parameters
      - Added invoice.nif[end|exact|exists|partial|start] filter parameters
      - Added invoice.postalAddress[end|exact|exists|partial|start] filter parameters
      - Added invoice.postalCode[end|exact|exists|partial|start] filter parameters
      - Added invoice.province[end|exact|exists|partial|start] filter parameters
      - Added invoice.registryData[end|exact|exists|partial|start] filter parameters
      - Added invoice.town[end|exact|exists|partial|start] filter parameters
      - Added logo.baseName[end|exact|exists|partial|start] filter parameters
      - Added logo.fileSize[between|exists|gt|gte|lt|lte] filter parameters
      - Added logo.mimeType[end|exact|exists|partial|start] filter parameters
      - Added _order[domainUsers], _order[invoice.country], _order[invoice.nif], _order[invoice.postalAddress], _order[invoice.postalCode], _order[invoice.province], _order[invoice.registryData], _order[invoice.town], _order[logo.baseName], _order[logo.fileSize] and _order[logo.mimeType] querystring arguments

    - /languages:
      - Added name.ca[end|exact|exists|partial|start] filter parameters
      - Added name.en[end|exact|exists|partial|start] filter parameters
      - Added name.es[end|exact|exists|partial|start] filter parameters
      - Added name.it[end|exact|exists|partial|start] filter parameters
      - Added _order[name.ca], _order[name.en], _order[name.es] and _order[name.it] querystring arguments

    - /services:
      - Added name.ca[end|exact|exists|partial|start] filter parameters
      - Added name.en[end|exact|exists|partial|start] filter parameters
      - Added name.es[end|exact|exists|partial|start] filter parameters
      - Added name.it[end|exact|exists|partial|start] filter parameters
      - Added _order[name.ca], _order[name.en], _order[name.es] and _order[name.it] querystring arguments

* Models:
    - Brand:
      - Removed logoPath property
    - Brand-collection:
      - Removed logoPath property
      - Added invoice property
      - Added logo property
      - Added domainUsers property
    - Brand-detailed:
      - Removed logoPath property
    - Brand-withFeatures:
      - Removed logoPath property
    - Language-collection:
      - Added name property
    - Service-collection:
      - Added name property

## 2.18.0
* Endpoints:
    - Allow to filter collections by id

* Models:
    - Carrier
        - Added mediaRelaySets property
    - DdiProvider
        - Added mediaRelaySets property

## 2.17.2
* Endpoints:
    - Added name.ca[end], name.ca[exact], name.ca[exists], name.ca[partial], name.ca[start] filter parameter for on /countries
    - Added name.it[end], name.it[exact], name.it[exists], name.it[partial], name.ca[start] filter parameter for on /countries
    - Added _order[name.ca] and _order[name.it] querystring arguments on /countries

## 2.17.0
* Models:
    - Company
        - Set country as required property
    - DDI
        - Removed country from required properties

## 2.16.3
* Added new string search filter modifiers:
    - start: Starts with
    - end: Ends with
    - exact: Exact match
    - partial: Contains

These modifiers are incompatible with modifierless search parameters. For instance,
if you are using "email=partial_domain" (partial search) and you want to append some [starts] filter
you'll need to replace the former criteria by "email[partial]=partial_domain&email[start]=abc". Modifierless
string search parameters are now deprecated and they'll be removed on next major relesase.

* Added OR foreign key search filter modifiers:
    - "brand[]=1&brand[]=2": brand equals 1 or 2

* Models:
    - BannedAddress-collection
        - Added blocker and aor properties

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
