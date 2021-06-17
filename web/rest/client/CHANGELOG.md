# Changelog

## 2.17.2
* Endpoints:
    - /call_forward_settings:
        - Removed noAnswerTimeout, noAnswerTimeout[between], noAnswerTimeout[gt], noAnswerTimeout[gte], 
          noAnswerTimeout[lt] and noAnswerTimeout[lte] filter parameters
        - Removed numberValue, numberValue[end], numberValue[exact], numberValue[exists], numberValue[partial] 
          and numberValue[start] filter parameters
        - Removed _order[noAnswerTimeout] and _order[numberValue] querystring arguments
    - /countries:
        - Added name.ca[end], name.ca[exact], name.ca[exists], name.ca[partial] and name.ca[start] filter parameters
        - Added name.it[end], name.it[exact], name.it[exists], name.it[partial] and name.ca[start] filter parameters
        - Added _order[name.ca] and _order[name.it] querystring arguments
    - /my/call_history:
        - Added callidHash[end], callidHash[exact], callidHash[exists], callidHash[partial] and callidHash[start] filter parameters
        - Added callid[end], callid[exact], callid[exists], callid[partial] and callid[start] filter parameters
        - Added diversion[end], diversion[exact], diversion[exists], diversion[partial] and diversion[start] filter parameters
        - Added referee[end], referee[exact], referee[exists], referee[partial] and referee[start] filter parameters
        - Added referrer[end], referrer[exact], referrer[exists], referrer[partial], referrer[start] filter parameters
        - Added xcallid[end], xcallid[exact], xcallid[exists], xcallid[partial] and xcallid[start] filter parameters
        - Added _order[callidHash], _order[callid], _order[diversion], _order[referee], _order[referrer] and _order[xcallid] querystring arguments
    - /residential_devices:
        - Added transport[end], transport[exact], transport[exists], transport[partial] and transport[start] filter parameters
        - Added _order[transport] querystring arguments
    - /retail_accounts:
        - Added transport[end], transport[exact], transport[exists], transport[partial] and transport[start] filter parameters
        - Added _order[transport] querystring arguments
    - /terminals:
        - Added lastProvisionDate[after], lastProvisionDate[before], lastProvisionDate[exists], lastProvisionDate[start],
          lastProvisionDate[strictly_after] and lastProvisionDate[strictly_before] filter parameters
        - Added mac[end], mac[exact], mac[exists], mac[partial] and mac[start] filter parameters
        - Added _order[lastProvisionDate] and _order[mac] querystring arguments

## 2.17.0
* Models:
    - Company
        - Set country as required property
    - DDI
        - Set recordCalls as required property
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
    - "user[]=1&user[]=2": user equals 1 or 2

## 2.16
* Endpoints:
    - Added /my/active_calls
    - Added [DELETE] /recordings/{id}
* Models:
    - BillableCall:
        - Added endpointName property
    - Friend:
        - Removed authNeeded property
    - Terminal:
        - Added rtpEncryption property

## 2.15.2
* Endpoints:
    - Added /my/registration_summary

## 2.15.1
* Models:
    - Friend:
        - Set transport property as nullable
    - HuntGroup:
        - Set ringAllTimeout property as nullable
    - ResidentialDevice:
        - Set transport property as nullable
    - RetailAccount:
        - Set transport property as nullable

## 2.15
* Endpoints:
    - Removed [PUT] /call_csv_reports
* Models:
    - BillableCall:
        - Restricted endpointType possible values
        - Added ddi property
    - CallCsvReport:
        - Removed model
    - CallCsvScheduler:
        - Added ddi, retailAccount, residentialDevice, user, fax and friend properties
    - CallCsvScheduler-collection:
        - Added frequency, unit, callDirection, email, lastExecution and nextExecution properties
    - HuntGroup:
        - Added allowCallForwards required property
    - HuntGroupsRelUser:
        - Added required property
        - Added numberValue and numberCountry properties
    - Queue:
        - Added preventMissedCalls required property

## 2.14
* Endpoints:
    - Added type filter parameter on /companies
* Models:
    - Removed not nullable company attributes as they can be auto resolved (deprecated since 2.12)
    - Company:
        - Removed almost every property from Company models

## 2.13.2
* Endpoints:
    - Added [Exists] filter parameter for nullable fields (Only possible on foreign keys before)

## 2.13.1
* Endpoints:
    - Added /calendar_periods endpoints
        - [GET], [POST], [PUT] and [DELETE] methods

* Models:
    - CalendarPeriod
        - Added CalendarPeriod, CalendarPeriod-collection and CalendarPeriod-detailed models

## 2.13
* Endpoints:
    - /my/call_history
        - Removed company and company[exists] filter properties
    - /users_cdrs
        - Removed company and company[exists] filter properties

## 2.12.1
* Models:
    - ConditionalRoutesCondition:
        - Added ConditionalRoutesCondition-withInverseRelationships model for [PUT] and [POST] operations which exposes matchListIds, scheduleIds, calendarIds and routeLockIds array properties
        - Added matchListIds, scheduleIds, calendarIds and routeLockIds array properties to ConditionalRoutesCondition-detailed model 
    - ExternalCallFilter:
        - Added ExternalCallFilter-withInverseRelationships model for [PUT] and [POST] operations which exposes scheduleIds, calendarIds, whiteListIds and blackListIds array properties
        - Added scheduleIds, calendarIds, whiteListIds and blackListIds array properties to ExternalCallFilter-detailed model 
    - RegistrationStatus:
        - Renamed to RegistrationStatus-status in order to avoid name collisions
    - ExternalCallFilter:
        - Added Ivr-withExcludedExtensions model for [PUT] and [POST] operations which exposes excludedExtensionIds array property
        - Added excludedExtensionIds array property to Ivr-detailed model
    - PickUpGroup:
        - Added PickUpGroup-withUsers model for [PUT] and [POST] operations which exposes userIds array property
        - Added userIds array property to PickUpGroup-detailed model
    - User:
        - Added pickupGroupIds array property to User-detailed model

## 2.12
* Endpoints:
    - Removed filter parameters not present on response models (except for foreign keys) 
    - Added [exists] filter modificator (company[exists] for instance) on nullable foreign keys. This allows to filter by IS NULL / IS NOT NULL conditions 
  - Removed endpoints:
    - /residential_devices [POST]
    - /residential_devices/{id} [DELETE]
    - /retail_accounts [POST]
    - /retail_accounts/{id} [DELETE]
    
* Models:
    - Not nullable company attributes have been deprecated, will be removed in 2.13, as they can be resolved automatically. Value will be automatically set if the attribute is not found in the payload, otherwise, will maintain the user's value.
    - Added Catalan and Italian to each multi language field group
    - User:
        - Removed tokenKey attribute

## 2.11.2
* Endpoints:
  - Added endpoints:
    - /rating_plan_groups/{id}/prices
  - /rating_profiles
    - Added param [GET]: ratingPlanGroup

* Models:
    - RatingProfile:
        - Added required attribute: ratingPlanGroup
    - User:
        - Marked tokenKey attribute as deprecated (will be removed in 2.12)   

## 2.11.1
* Endpoints:
  - /conditional_routes_conditions_rel_calendars:
    - Removed method: PUT
  - /conditional_routes_conditions_rel_matchlists:
    - Removed method: PUT
  - /conditional_routes_conditions_rel_route_locks:
    - Removed method: PUT
  - /conditional_routes_conditions_rel_schedules:
    - Removed method: PUT
  - /rating_profiles:
    - Removed methods: POST, PUT and DELETE
  - /call_csv_reports:
    - Removed param [PUT]: Csv
    - Removed content-type [PUT]: multipart/form-data
  - /invoices/{id}/pdf has being removed
  - /locutions:
    - removed param [POST and PUT]: EncodedFile
  - /music_on_holds:
    - removed param [POST and PUT]: EncodedFile
    
* Models:
  - BillableCall:
    - added attribute on collection model: id
  - RouteLock:
    - added attributes on collection model: name and open

## 2.11.0

* Endpoints:
    - billable_calls:
      - Removed filter attributes: carrierName, company, invoice and cost
      - Removed methods: POST, PUT and DELETE
    - call_csv_reports:
      - Added method: GET
      - Added endpoint: [GET] /call_csv_reports/{id}/csv
    - call_csv_schedulers:
      - Added methods: GET, POST, PUT and DELETE
    - companies:
      - Added methods: GET
    - ddis:
      - Removed filter parameter: ddie164 and billInboundCalls
      - Removed methods: POST and DELETE
    - faxes_in_outs:
      - Added endpoint: [GET] /faxes_in_outs/{id}/file
    - features_rel_companies:
      - Removed methods: POST, PUT and DELETE
    - friends:
      - Removed filter parameters: disallow, directMediaMethod, calleridUpdateHeader, updateCallerid and interCompany
      - Added filter attribute: transformationRuleSet
      - Added endpoint: [GET] /friends/status
      - Added endpoint: [GET] /friends/{id}/status
    - hunt_groups_rel_users:
      - Added filter parameter: user.transformationRuleSet
    - locutions:
      - Added file upload handler: POST and PUT
      - Set multipart/form-data as default content type [POST and PUT]
      - Added endpoint: [GET] /locutions/{id}/encodedfile
      - Added endpoint: [GET] /locutions/{id}/originalfile
    - music_on_holds:
      - Added file upload handler [POST & PUT]
      - multipart/form-data as default content type [POST & PUT]
      - Added endpoint: [GET] /music_on_holds/{id}/encodedfile
      - Added endpoint: [GET] /music_on_holds/{id}/originalfile
    - my/call_forward_settings:
      - Removed filter parameters: callTypeFilter, callForwardType, targetType, numberValue, noAnswerTimeout, enabled, user.[name,|lastname|email...], extension.[number|routeType|numberValue...], voiceMailUser.[name|email|...], numberCountry.[code|countryCode], name.[en\es] and zone.[en|es]
    - my/company_extensions:
      - Removed filter parameters: number, routeType, numberValue, friendValue, company, ivr, huntGroup, conferenceRoom, user, queue, conditionalRoute and numberCountry
    - my/company_voicemails:
      - Removed filter parameters: name, lastname, email, pass, doNotDisturb, isBoss, active, maxCalls, externalIpCalls, voicemailEnabled, voicemailSendMail, voicemailAttachSound, tokenKey, gsQRCode, company, callAcl, bossAssistant, bossAssistantWhiteList, language, terminal, extension, timezone, outgoingDdi, outgoingDdiRule and voicemailLocution
    - outgoing_ddi_rules_patterns:
      - Added filter parameters: type and prefix
      - Removed filter parameters: forcedDdi.ddie164 and forcedDdi.billInboundCalls
    - pick_up_rel_users:
      - Added filter parameter: user.transformationRuleSet
    - queue_members:
      - Added filter parameter: user.transformationRuleSet
    - rating_profiles:
      - removed filter parameter: routingTag
    - recordings:
      - Added endpoint: [GET] recordings/{id}/recordedfile
    - residential_devices:
      - Added filter parameters: company, transformationRuleSet, outgoingDdi, language
      - removed filter parameters: ip, authNeeded, password, disallow, allow, directMediaMethod, calleridUpdateHeader, updateCallerid, fromDomain, directConnectivity, ddiIn, t38Passthrough, company, outgoingDdi, language, port and maxCalls
      - Added endpoint: [GET] residential_devices/status
      - Added endpoint: [GET] residential_devices/{id}/status
    - retail_accounts:
      - Added filter parameters: company, transformationRuleSet and outgoingDdi
      - Removed filter parameters: ip, password, fromDomain, directConnectivity, t38Passthrough, company, outgoingDdi and port
      - Added endpoint: [GET] retail_accounts/status
      - Added endpoint: /retail_accounts/{id}/status
    - routing_tags:
      - Removed endpoints
    - terminals:
      - Added endpoint: [GET] terminals/status
      - Added endpoint: terminals/{id}/status
    - transformation_rule_sets:
      - Added method: GET
    - users:
      - Added filter parameter: transformationRuleSet

* Models:
    - BillableCall:
      - Removed attributes: cost, company, invoice, carrierName and invoice
    - CallForwardSetting:
      - Removed required flag: targetType, extension and voiceMailUser
    - Company:
      - Removed required flag: name, nif, distributeMethod, maxCalls, postalAddress, postalCode, town, province, countryName, billingMethod, country
      - Added readOnly flag: name, domainUsers, nif, onDemandRecordCode and balance
      - Removed fields: distributeMethod, maxCalls, postalAddress, postalCode, town, province, countryName, ipfilter, onDemandRecord, externallyextraopts, recordingsLimitMB, recordingsLimitEmail, billingMethod and showInvoices
      - Added fields: transformationRuleSet
    - Ddi:
      - Removed required flag: ddi, billInboundCalls and country
      - Added readOnly flag: ddi and country
      - Removed fields: billInboundCalls and ddie164
    - Friend:
      - Removed required flag: disallow, directMediaMethod, calleridUpdateHeader and updateCallerid
      - Removed attributes: disallow, directMediaMethod, calleridUpdateHeader, updateCallerid and interCompany
      - Added attributes: transformationRuleSet
    - HolidayDate:
      - Removed required flag: voiceMailUser
    - IvrEntry:
      - Removed required flag: extension, voiceMailUser and conditionalRoute
    - OutgoingDdiRulesPattern:
      - Removed required flag: matchList
      - Added attributes: type, prefix and outgoingDdiRule
    - RatingProfile:
      - Removed attributes: routingTag
    - ResidentialDevice:
      - Removed required flag: authNeeded, disallow, allow, directMediaMethod, calleridUpdateHeader, updateCallerid, directConnectivity, ddiIn, maxCalls, t38Passthrough and transport
      - Removed attributes: ip, port, authNeeded, password, disallow, allow, directMediaMethod, calleridUpdateHeader, updateCallerid, fromDomain, directConnectivity, ddiIn, maxCalls, t38Passthrough
      - Added attributes: transformationRuleSet
    - RetailAccount:
      - Removed required flag: directConnectivity, ddiIn and t38Passthrough
      - Removed attributes: ip, port, password, fromDomain, directConnectivity, ddiIn and t38Passthrough
      - Added attributes: transformationRuleSet
    - User:
      - Added attributes: transformationRuleSet
