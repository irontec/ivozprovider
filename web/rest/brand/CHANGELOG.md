# Changelog

## 2.17.0
* Endpoints:
    - Added [POST] /users/mass_import
* Models:
    - Company
        - Set country as required property
        - Added maxDailyUsageEmail property
    - DDI
        - Removed country from required properties
        - Added ddie164 property
    - Terminal
        - Set name as required property
    - User
        - Added rejectCallMethod required property
        - Added multiContact required property

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
    - "company[]=1&company[]=2": company equals 1 or 2

* Endpoints:
    - Added [DELETE] /banned_addresses/antibruteforce/{id} 

* Models:
    - BannedAddress-collection
        - Added blocker and aor properties

## 2.16.0
* Endpoints:
    - /my/registration_summary
        - Added company parameter
* Models:
    - ActiveCalls:
        - Added inbound and outbound properties
    - BannedAddress:
        - Added aor property into BannedAddress-detailed model
    - BillableCall:
        - Added endpointName property
    - CallCsvScheduler:
        - Added ddiProvider property
    - DestinationRateGroup:
        - Added lastExecutionError and deductibleConnectionFee properties
    - Friend:
        - Removed authNeeded property
    - Terminal:
        - Added rtpEncryption property

## 2.15.2
* Endpoints:
    - Added /my/registration_summary

## 2.15.1
* Endpoints:
    - Added [GET] /proxy_trunks
* Models:
    - Friend:
        - Set transport property as nullable
    - ProxyTrunk
        - Added entity
    - ResidentialDevice:
        - Set transport property as nullable
    - RetailAccount:
        - Set transport property as nullable
 
## 2.15
* Endpoints:
    - Added [GET] /administrator_rel_public_entities
    - Added [GET] and [PUT] /administrator_rel_public_entities/{id}
    - Added [GET] /banned_addresses
    - Added [GET] /banned_addresses/{id}
    - Added [GET] /faxes
    - Added [GET] and [POST] /fixed_costs_rel_invoice_schedulers
    - Added [GET], [PUT] and [DELETE] /fixed_costs_rel_invoice_schedulers/{id}
    - Added [GET] /friends
    - Added [GET] and [POST] /invoice_schedulers
    - Added [GET], [PUT] and [DELETE] /invoice_schedulers/{id}
    - Added [GET] /public_entities
    - Added [GET] /public_entities/{id}
    - Added [GET] /users
    - Removed [GET] /users_cdrs
* Models:
    - Administrators:
        - Added restricted and company required properties
    - AdministratorRelPublicEntity:
        - Added entity
    - BannedAddress:
        - Added entity
    - BillableCall:
        - Restricted endpointType possible values
        - Added ddi and ddiProvider properties
    - CallCsvReport-detailed:
        - Added brand property
    - CallCsvScheduler:
        - Added ddi, carrier, retailAccount, residentialDevice, user, fax and friend properties
    - CallCsvScheduler-collection:
        - Added frequency, unit, callDirection, email, lastExecution and nextExecution properties
    - Carrier:
        - Set transformationRuleSet property as required
        - Added proxyTrunk property
    - Company:
        - Set transformationRuleSet property as required
        - Added maxDailyUsage property 
    - DdiProvider:
        - Set transformationRuleSet property as required
        - Added proxyTrunk property
    - Fax:
        - Added entity
    - FixedCostsRelInvoiceScheduler:
        - Added entity
    - Friend:
        - Added Friend-collection model
    - Invoice:
        - Set invoiceTemplate property as required
        - Added scheduler property
    - InvoiceScheduler:
        - Added entity
    - InvoiceTemplate:
        - Added global property
    - ProxyTrunk:
        - Added entity
    - PublicEntity:
        - Added entity
    - SpecialNumber:
        - Added global property
    - Terminal:
        - Added entity
    - TransformationRule:
        - Set transformationRuleSet property as required
    - User:
        - Added entity

## 2.14.1
* Endpoints:
    - /users_cdrs [GET] has been deprecated and it will be removed in 2.15
    - /users_cdrs/{id} [GET] has been deprecated and it will be removed in 2.15

## 2.14
* Endpoints:
    - Added [Exists] filter parameter for company field on /billable_calls
    - Added type filter parameter on /companies
    - Added urlType filter parameter on /web_portals
* Models:
    - Administrators:
        - Added username property into Administrator-collection model
    - SpecialNumber:
        - Added entity
    - WebPortal:
        - Added urlType property into WebPortal-collection model
    - Company:
        - Added type property into Company-collection model
    - OutgoingRouting:
        - Added stopper property into OutgoingRouting, OutgoingRouting-detailed and OutgoingRouting-withCarriers models
    - UsersAddress:
        - Added entity

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
    - Removed not nullable brand attributes as they can be auto resolved (deprecated since 2.12)
    - BillableCalls:
        - Added BillableCall and BillableCall-rating models
    - OutgoingRouting:
        - Added "block" to routingMode accepted values
        - Added DdiProviderRegistrationStatus and DdiProviderRegistration-detailedCollection models
   
## 2.12.1
* Endpoints:
    - /ddi_provider_registrations
        - Added new filter attributes
* Models:
    - Company:
        - Added Company-withFeatures model for [PUT] and [POST] operations which exposes featureIds array property
        - Added featureIds array property to Company-detailed model 
    - DdiProviderRegistration:
        - Removed DdiProviderRegistration-detailed model
        - Added DdiProviderRegistrationStatus and DdiProviderRegistration-detailedCollection models
    - RegistrationStatus:
        - Renamed to RegistrationStatus-status in order to avoid name collisions
    - OutgoingRouting:
        - Added carrierIds property to OutgoingRouting-detailed model
        - Added OutgoingRouting-withCarriers model for [PUT] and [POST] operations which exposes carrierIds array property
    - RoutingPatternGroup:
        - Added patternIds property to RoutingPatternGroup-detailed model
        - Added RoutingPatternGroup-withPatterns model for [PUT] and [POST] operations which exposes patternIds array property

## 2.12
* Endpoints:
    - Removed filter parameters not present on response models (except for foreign keys) 
    - Added [exists] filter modificator (brand[exists] for instance) on nullable foreign keys. This allows to filter by IS NULL / IS NOT NULL conditions 
* Models:
    - Not nullable brand attributes have been deprecated, will be removed in 2.13, as they can be resolved automatically. Value will be automatically set if the attribute is not found in the payload, otherwise, will maintain the user's value.
    - Added Catalan and Italian to each multi language field group

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
