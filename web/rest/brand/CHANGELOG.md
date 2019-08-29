# Changelog
## 2.12
* Endpoints:
    - Removed filter parameters not present on response models (except for foreign keys) 
    - Added [exists] filter modificator (brand[exists] for instance) on nullable foreign keys. This allows to filter by IS NULL / IS NOT NULL conditions 
* Models:
    - Not nullable brand attributes have been deprecated, will be removed in 2.13, as they can be resolved automatically. Value will be automatically set if the attribute is not found in the payload, otherwise, will maintain the user's value.
    
## 2.11.2
* Endpoints:
  - Added endpoints:
    - /friends/status
    - /residential_devices/status
    - /retail_accounts/status
    - /terminals/status
  - Removed endpoints:
    - /my/rating_plan_prices 
  - /residential_devices
    - Added param [GET]: _pagination
  - /retail_accounts
    - Added param [GET]: _pagination
  - /users_cdrs
    - Added param [GET]: friend
* Models:
    - UsersCdr:
        - added attributes: friend  

## 2.11.1
* Endpoints:
  - /invoices:
    - Removed param [PUT]: pdf
    - Removed content-type [PUT]: multipart/form-data
* Models:
  - BillableCall:
    - added attribute on collection model: id
  - FeaturesRelBrand:
    - added attributes on collection model: brand and feature

## 2.11.0

* Endpoints:
    * Pagination toggle restricted to: BillableCall, Country and Timezone
    - /brands:
        - Added file upload handler: PUT
        - Set multipart/form-data as default content type [PUT]
        - Added endpoint: [GET] /brands/{id}/logo
    - /call_csv_reports:
        - Added method: GET
        - Added endpoint: [GET] /call_csv_reports/{id}/csv
    - /call_csv_schedulers:
        - Added methods: GET, POST, PUT and DELETE
    - /companies:
        - Removed filter parameters: distributeMethod, recordingsLimitEmail domain, recordingsLimitMB
        - Added filter parameter: outgoingDdi
    - /ddis:
        - added methods: GET, POST, PUT and DELETE
    - /destination_rate_groups
        - Added endpoint: /destination_rate_groups/{id}/file
    - /domains:
        - Removed endpoints
    - /features_rel_brands:
        - Removed methods: POST, PUT and DELETE
    - /features_rel_companies:
        - Removed method: PUT
    - /invoices:
        - Added endpoint: [GET] /invoices/{id}/pdf
    - /outgoing_routings:
        - Added filter parameter: routingTag
    - /rating_profiles:
        - Added filter parameter: routingTag
    - /residential_devices:
        - Added methods: GET, POST, PUT, DELETE
    - /retail_accounts:
        - Added methods: GET, POST, PUT, DELETE
    - /routing_tags:
        - Added methods: GET, POST, PUT, DELETE
    - /users_cdrs:
        - Added filter parameters: residentialDevice and retailAccount
    - /web_portals:
        - Added file upload handler: PUT
        - Set multipart/form-data as default content type: PUT
        - Added endpoint: /web_portals/{id}/logo

* Models:
    - BillableCall:
        - Removed attribute: brand
    - Company:
        - Removed required flag: distributeMethod and country
        - Added readOnly flag: balance
        - Removed attributes: distributeMethod, recordingsLimitMB, recordingsLimitEmail and domain
        - Added attribute: outgoingDdi
    - OutgoingRouting:
        - Added attribute: routingTag
        - Removed required flag: company, routingPattern and routingPatternGroup
    - RatingProfile:
        - Added attribute: routingTag
    - UsersCdr:
        - Added attributes: residentialDevice and retailAccount
