# Changelog
## 3.1.0
* Endpoints:
  - Added _rmAlso parameter to [DELETE] methods to support multi-delete
  - /administrators/{id}:
    - Added endpoint: [POST] /administrators/{id}/grant_all
    - Added endpoint: [POST] /administrators/{id}/grant_read_only
    - Added endpoint: [POST] /administrators/{id}/revoke_all
  - /balance_movements:
    - Added [GET] endpoint
  - /balance_movements/{id}:
    - Added [GET] endpoint
  - /balance_notifications:
    - Added carrier, carrier[] and carrier[exists] filter parameters
    - Added lastSent[after|before|exists|neq|start|strictly_after|strictly_before] and exists[lastSent] filter parameters
    - Added exists[notificationTemplate] filter parameter
    - Added _order[lastSent] querystring argument
    - Added _timezone querystring arguments
  - /call_csv_schedulers:
    - Added exists[company] filter parameter
  - /carrier/{id}:
    - Added endpoint: [POST] /carrier/{id}/modify_balance
  - /carrier_servers:
    - Added outboundProxy[end|exact|neq|partial|start] and exists[outboundProxy] filter parameters
    - Added _order[outboundProxy] querystring argument
  - /carrier_servers/{id}:
    - Added endpoint: [GET] /carrier_servers/{id}/status
  - /carriers:
    - Added balance[exists|qt|qte|lt|lte|between|neq] and exists[balance] filter parameters
    - Added calculateCost, calculateCost[exists] and exists[calculateCost] filter parameters
    - Added status.registered filter parameter
    - Added _order[balance] querystring argument
    - Added _order[calculateCost] querystring argument
    - Removed externallyRated, externallyRated[exists] and exists[externallyRated] filter parameters
  - /codecs:
    - Added [GET] endpoint
  - /codecs/{id}:
    - Added [GET] endpoint
  - /companies:
    - Added balance[exists|qt|qte|lt|lte|between|neq] and exists[balance] filter parameters
    - Added billingMethod[end|exact|neq|partial|start] and exists[billingMethod] filter parameters
    - Added currentDayUsage[end|exact|neq|partial|start] and exists[currentDayUsage] filter parameters
    - Added domainName filter parameter
    - Added domainUsers[end|exact|neq|partial|start] and exists[domainUsers] filter parameters
    - Added invoicing.countryName[end|exact|neq|partial|start] filter parameters
    - Added invoicing.nif[end|exact|neq|partial|start] filter parameters
    - Added invoicing.postalAddress[end|exact|neq|partial|start] filter parameters
    - Added invoicing.postalCode[end|exact|neq|partial|start] filter parameters
    - Added invoicing.province[end|exact|neq|partial|start] filter parameters
    - Added invoicing.town[end|exact|neq|partial|start] filter parameters
    - Added maxDailyUsage[exists|qt|qte|lt|lte|between|neq] filter parameters
    - Added maxDailyUsageNotificationTemplate, maxDailyUsageNotificationTemplate[] and maxDailyUsageNotificationTemplate[exists] filter parameters
    - Added outgoingDdiRule, outgoingDdiRule[] and outgoingDdiRule[exists] filter parameters
    - Added _order[balance] querystring argument
    - Added _order[billingMethod] querystring argument
    - Added _order[currentDayUsage] querystring argument
    - Added _order[domainUsers] querystring argument
    - Added _order[invoicing.countryName] querystring argument
    - Added _order[invoicing.nif]] querystring argument
    - Added _order[invoicing.postalAddress] querystring argument
    - Added _order[invoicing.postalCode] querystring argument
    - Added _order[invoicing.province] querystring argument
    - Added _order[invoicing.town] querystring argument
    - Added _order[maxDailyUsage] querystring argument
  - /company/{id}:
    - Added endpoint: [POST] /company/{id}/modify_balance
  - /company_rel_codecs:
    - Added [GET] and [POST] endpoints
  - /company_rel_codecs/{id}:
    - Added [GET], [PUT] and [DELETE] endpoints
  - /ddi_provider_registrations/{id}:
    - Added endpoint: [GET] /ddi_provider_registrations/{id}/status
  - /ddi_providers:
    - Added exists[proxyTrunk] filter parameter
    - Added exists[transformationRuleSet] filter parameter
  - /ddi:
    - Added description[end|exact|neq|partial|start] and exists[description] filter parameters
    - Added _order[description] querystring arguments
  - /destination_rates:
    - Added currencySymbol filter parameter
  - /extensions:
    - Added [GET] endpoint
  - /extensions/{id}:
    - Added [GET] endpoint
  - /faxes:
    - Added name.ca[end|exact|neq|partial|start] filter parameters
    - Added name.en[end|exact|neq|partial|start] filter parameters
    - Added name.es[end|exact|neq|partial|start] filter parameters
    - Added name.it[end|exact|neq|partial|start] filter parameters
    - Added _order[name.ca], _order[name.en], _order[name.es] and _order[name.it] querystring arguments
  - /fixed_costs:
    - Added cost[exists|qt|qte|lt|lte|between|neq] and exists[cost] filter parameters
    - Added description[end|exact|neq|partial|start] and exists[description] filter parameters
    - Added _order[cost] querystring arguments
    - Added _order[description] querystring arguments
  - /fixed_costs_rel_invoices:
    - Added invoice.currency filter parameter
  - /friends/status:
    - Added company.allowRecordingRemoval filter parameter
    - Added _order[invoicing.countryName] querystring argument
    - Added _order[invoicing.nif]] querystring argument
    - Added _order[invoicing.postalAddress] querystring argument
    - Added _order[invoicing.postalCode] querystring argument
    - Added _order[invoicing.province] querystring argument
    - Added _order[invoicing.town] querystring argument
    - Added _order[maxDailyUsage] querystring argument
  - /invoice_templates:
    - Added description[end|exact|neq|partial|start] and exists[description] filter parameters
    - Added _order[description] querystring arguments
  - /invoices:
    - Added currency filter parameter
    - Added exists[scheduler] filter parameter
    - Added exists[taxRate] filter parameter
    - Added taxRate[exists|qt|qte|lt|lte|between|neq] filter parameters
    - Added _order[taxRate] querystring argument
  - /locations:
    - Added [GET] endpoint
  - /match_list_patterns:
    - Added [GET] and [POST] endpoints
  - /match_list_patterns/{id}:
    - Added [GET], [PUT] and [DELETE] endpoints
  - /match_lists:
    - Added [GET] and [POST] endpoints
  - /match_lists/{id}:
    - Added [GET], [PUT] and [DELETE] endpoints
  - /music_on_holds:
    - Added [GET] and [POST] endpoints
  - /music_on_holds/{id}:
    - Added [GET], [PUT] and [DELETE] endpoints
    - Added endpoint: [GET] /music_on_holds/{id}/encodedfile
    - Added endpoint: [GET] /music_on_holds/{id}/originalfile
  - /my/profile:
    - Added [GET] endpoint
  - /my/registration_summary:
    - Added exists[language] filter parameter
  - /outgoing_ddi_rules:
    - Added [GET] endpoint
  - /outgoing_ddi_rules/{id}:
    - Added [GET] endpoint
  - /outgoing_routings:
    - Added exists[carrier] filter parameter
    - Added exists[routingPatternGroup] filter parameter
    - Added exists[routingPattern] filter parameter
    - Added stopper filter parameter
    - Added _order[stopper] querystring argument
  - /rating_plan_groups:
    - Added description.ca[end|exact|neq|partial|start] filter parameters
    - Added description.en[end|exact|neq|partial|start] filter parameters
    - Added description.es[end|exact|neq|partial|start] filter parameters
    - Added description.it[end|exact|neq|partial|start] filter parameters
    - Added _order[description.ca], _order[description.en], _order[description.es] and _order[description.it] querystring arguments
  - /rating_plan_groups/{id}:
    - Added endpoint: [POST] /rating_plan_groups/{id}/simulate_call
  - /rating_profiles/{id}:
    - Added endpoint: [POST] /rating_profiles/{id}/simulate_call
  - /residential_devices:
    - Added description[end|exact|neq|partial|start] filter parameters
    - Added directConnectivity[end|exact|neq|partial|start] filter parameters
    - Added multiContact filter parameter
    - Added rtpEncryption filter parameter
    - Added _order[description]  querystring argument
    - Added _order[directConnectivity] querystring argument
    - Added _order[multiContact] querystring argument
    - Added _order[rtpEncryption] querystring argument
  - /residential_devices/status
    - Added company.allowRecordingRemoval filter parameter
    - Added company.currentDayUsage filter parameter
    - Added company.maxDailyUsageNotificationTemplate filter parameter
    - Added company.outgoingDdiRule filter parameter
    - Added directConnectivity filter parameter
    - Added invoicing.countryName filter parameters
    - Added invoicing.nif filter parameters
    - Added invoicing.postalAddress filter parameters
    - Added invoicing.postalCode filter parameters
    - Added invoicing.province filter parameters
    - Added invoicing.town filter parameters
    - Added _order[directConnectivity] querystring argument
  - /retail_accounts:
    - Added multiContact filter parameter
    - Added rtpEncryption filter parameter
    - Added _order[multiContact] querystring argument
    - Added _order[rtpEncryption] querystring argument
  - /retail_accounts/status:
    - Added company.allowRecordingRemoval filter parameter
    - Added company.currentDayUsage filter parameter
    - Added company.maxDailyUsageNotificationTemplate filter parameter
    - Added company.outgoingDdiRule filter parameter
    - Added invoicing.countryName filter parameters
    - Added invoicing.nif filter parameters
    - Added invoicing.postalAddress filter parameters
    - Added invoicing.postalCode filter parameters
    - Added invoicing.province filter parameters
    - Added invoicing.town filter parameters
    - Added multiContact filter parameter
    - Added rtpEncryption filter parameter- 
    - Added _order[multiContact] querystring argument
    - Added _order[rtpEncryption] querystring argument
  - /routing_patterns:
    - Added description.ca[end|exact|neq|partial|start] filter parameters
    - Added description.en[end|exact|neq|partial|start] filter parameters
    - Added description.es[end|exact|neq|partial|start] filter parameters
    - Added description.it[end|exact|neq|partial|start] filter parameters
    - Added _order[description.ca], _order[description.en], _order[description.es] and _order[description.it] querystring arguments
  - /services:
    - Added description.ca[end|exact|neq|partial|start] filter parameters
    - Added description.en[end|exact|neq|partial|start] filter parameters
    - Added description.es[end|exact|neq|partial|start] filter parameters
    - Added description.it[end|exact|neq|partial|start] filter parameters
    - Added _order[description.ca], _order[description.en], _order[description.es] and _order[description.it] querystring argument
  - /services/unassigned:
    - Added [GET] endpoint
  - /terminals:
    - Added [GET] endpoint
  - /terminals/status:
    - Added company.allowRecordingRemoval filter parameter
    - Added company.currentDayUsage filter parameter
    - Added company.maxDailyUsageNotificationTemplate filter parameter
    - Added company.outgoingDdiRule filter parameter
    - Added editable filter parameter
    - Added invoicing.countryName filter parameters
    - Added invoicing.nif filter parameters
    - Added invoicing.postalAddress filter parameters
    - Added invoicing.postalCode filter parameters
    - Added invoicing.province filter parameters
    - Added invoicing.town filter parameters
  - /trusteds:
    - Added [GET] and [POST] endpoints
  - /trusteds/{id}:
    - Added [GET], [PUT] and [DELETE] endpoints
  - /users:
    - Added bossAssistantWhiteList, bossAssistantWhiteList[] and bossAssistantWhiteList[exists] filter parameters
    - Added extension, extension[] and extension[exists] filter parameters
    - Added location, location[] and location[exists] filter parameters
    - Added email[end|exact|neq|partial|start] filter parameters
    - Added exists[email] filter parameter
    - Added exists[extension] filter parameter
    - Added exists[location] filter parameter
    - Added _order[email] querystring argument
  - /web_portals:
    - Added logo.baseName[end|exact|neq|partial|start] and exists[logo.baseName] filter parameters
    - Added logo.fileSize[exists|qt|qte|lt|lte|between|neq] and exists[logo.fileSize] filter parameters
    - Added logo.mimeType[end|exact|neq|partial|start] and exists[logo.mimeType] filter parameters
    - Added _order[logo.baseName], _order[logo.fileSize] and _order[logo.mimeType] querystring arguments
* Models:
  - BalanceMovement-collection:
    - Added model
  - BalanceMovement-detailed:
    - Added model
  - BalanceNotification:
    - Added carrier property
    - Added notificationTemplate property
    - Added lastSent property
  - BalanceNotification-detailed:
    - Added carrier property
  - BrandService-collection:
    - Added service required property
  - CallCsvScheduler-collection:
    - Added company property
  - Carrier-collection:
    - Removed externallyRated property
    - Added calculateCost property
    - Added transformationRuleSet property
    - Added balance property
    - Added proxyTrunk property
    - Added status property
  - Carrier-detailed:
    - Removed externallyRated property
    - Added outboundProxy property
    - Added status property
  - CarrierServer-status:
    - Added model
  - CarrierServerStatus:
    - Added model
  - CarrierStatus:
    - Added model
  - Codec:
    - Added model
  - Codec-collection:
    - Added model
  - Codec-detailed:
    - Added model
  - Company:
    - Removed nif property
    - Removed postalAddress property
    - Removed postalCode property
    - Removed town property
    - Removed province property
    - Removed countryName property
    - Added allowRecordingRemoval required property
    - Added currentDayUsage property
    - Added invoicing property
    - Added outgoingDdiRule property
    - Added maxDailyUsageNotificationTemplate property
    - Added featureIds property
    - Added geoIpAllowedCountries property
    - Added routingTagIds property
    - Added codecIds property
  - Company-collection:
    - Removed nif property
    - Added invoicing property
    - Added billingMethod property
    - Added currentDayUsage property
    - Added maxDailyUsage property
    - Added domainUsers property
    - Added balance property
    - Added outgoingDdi property
    - Added domainName property
    - Added featureIds property
    - Added geoIpAllowedCountries property
    - Added routingTagIds property
    - Added codecIds property
  - Company-detailed:
    - Removed nif property
    - Removed postalAddress property
    - Removed postalCode property
    - Removed town property
    - Removed province property
    - Removed countryName property
    - Added allowRecordingRemoval required property
    - Added currentDayUsage property
    - Added invoicing property
    - Added outgoingDdiRule property
    - Added maxDailyUsageNotificationTemplate property
    - Added domainName property
    - Added geoIpAllowedCountries property
    - Added routingTagIds property
    - Added codecIds property
  - Company-withFeatures:
    - Removed model
  - CompanyRelCodec:
    - Added model
  - CompanyRelCodec-collection:
    - Added model
  - CompanyRelCodec-detailed:
    - Added model
  - Company_Invoicing:
    - Added model
  - Ddi:
    - Added description property
    - Added type property
  - Ddi-collection:
    - Added company required property
    - Added description property
  - Ddi-detailed:
    - Added type required property
    - Added description property
  - DdiProvider-collection:
    - Added transformationRuleSet required property
    - Added proxyTrunk property
  - DdiProviderRegistration-status:
    - Added model
  - DdiProviderRegistrationStatus:
    - Added currencySymbol property
  - DestinationRate-detailed:
    - Added currencySymbol property
  - DestinationRateGroup:
    - Added importerArguments property
  - Extension:
    - Added model
  - Extension-collection:
    - Added model
  - Extension-detailed:
    - Added model
  - Fax:
    - Added name property
  - FileImporterArguments:
    - Added model
  - FixedCost-collection:
    - Added description property
    - Added cost property
  - Invoice:
    - Added currency property
  - Invoice-collection:
    - Added taxRate property
    - Added scheduler property
    - Added currency property
  - Invoice-detailed:
    - Added currency property
  - InvoiceTemplate-collection:
    - Added description property
  - Location:
    - Added model
  - Location-collection:
    - Added model
  - MatchList:
    - Added model
  - MatchList-collection:
    - Added model
  - MatchList-detailed:
    - Added model
  - MatchListPattern:
    - Added model
  - MatchListPattern-collection:
    - Added model
  - MatchListPattern-detailed:
    - Added model
  - MusicOnHold:
    - Added model
  - MusicOnHold-collection:
    - Added model
  - MusicOnHold-detailed:
    - Added model
  - MusicOnHold_EncodedFile:
    - Added model
  - MusicOnHold_OriginalFile:
    - Added model
  - NotificationTemplateContent-collection:
    - Added language property
  - OutgoingDdiRule:
    - Added model
  - OutgoingDdiRule-collection:
    - Added model
  - OutgoingRouting:
    - Added carrierIds property
  - OutgoingRouting-collection:
    - Add stopper required property
    - Add carrier property
    - Add routingPattern property
    - Add routingPatternGroup property
    - Add carrierIds property
  - OutgoingRouting-withCarriers:
    - Removed model
  - Profile:
    - Added model
  - RatingPlanGroup-collection:
    - Added description property
  - ResidentialDevice:
    - Added rtpEncryption required property
    - Added multiContact required property
  - ResidentialDevice-collection:
    - Added description required property
    - Added directConnectivity required property
    - Added company required property
    - Added rtpEncryption required property
    - Added multiContact required property
    - Added domainName property
    - Added status property
  - ResidentialDevice-detailed:
    - Added rtpEncryption required property
    - Added multiContact required property
  - ResidentialDevice-status:
    - Added directConnectivity required property
  - RetailAccount:
    - Added rtpEncryption required property
    - Added multiContact required property
  - RetailAccount-collection:
    - Added rtpEncryption required property
    - Added multiContact required property
  - RetailAccount-detailed:
    - Added rtpEncryption required property
    - Added multiContact required property
  - RetailAccount-status:
    - Added rtpEncryption required property
    - Added multiContact required property
  - RoutingPattern-collection:
    - Added description property
  - RoutingPatternGroup-collection:
    - Added patternIds property
  - Service-collection:
    - Added description property
  - TarificationInfo:
    - Added model
  - Terminal-collection:
    - Added model
  - TransformationRuleSet:
    - Added editable property
  - TransformationRuleSet-collection:
    - Added editable property
  - TransformationRuleSet-detailed:
    - Added editable property
  - Trusted:
    - Added model
  - Trusted-collection:
    - Added model
  - Trusted-detailed:
    - Added model
  - User:
    - Added bossAssistantWhiteList property
    - Added extension property
    - Added outgoingDdiRule property
    - Added location property
  - User-collection:
    - Added extension property
    - Added status property
    - Added email property
    - Added location property
  - WebPortal-collection:
    - Added logo property

## 3.0.0
* Disclaimer: The API schema will not be considered stable until version 3.1 and may receive new breaking changes
* Endpoints:
    - Added not equal [neq] filters
    - Added exists[fldName] filters
    - Fixed downloadable file spec
    - Fixed embeddable model spec
* Models:
    - Some properties added into response models (not listed below unless they involve a BC)
    - BillableCall:
      - Set direction as required
    - Brand:
      - Set language as required
      - Set currency as not required
    - Country_Name:
      - Set all properties as required
    - OutgoingRouting:
      - Set type property as enum
    - RetailAccount-collection:
      - Removed transport property
    - User:
      - Removed voicemailAttachSound property
      - Removed voicemailEnabled property
      - Removed voicemailSendMail property

## 2.21.0
* Models:
    - FixedCostsRelInvoiceScheduler, FixedCostsRelInvoiceScheduler-detailed and FixedCostsRelInvoiceScheduler-detailedCollection:
        - Added type required property
        - Added ddisCountryMatch property
        - Added ddisCountry property
    - ResidentialDevice:
        - Removed authNeeded required property

## 2.19.0
* Endpoints:
    - /brands:
        - Removed currency[exists] filter parameter

* Models:
    - Brand:
        - Set currency as required
    - Brand-detailed:
        - Set currency as required
    
## 2.18.1
* Endpoints:
    - /brands:
      - Added callCsvNotificationTemplate and callCsvNotificationTemplate[exists] filter parameters
      - Added faxNotificationTemplate and faxNotificationTemplate[exists] filter parameters
      - Added invoice.country[end|exact|exists|partial|start] filter parameters
      - Added invoice.nif[end|exact|exists|partial|start] filter parameters
      - Added invoice.postalAddress[end|exact|exists|partial|start] filter parameters
      - Added invoice.postalCode[end|exact|exists|partial|start] filter parameters
      - Added invoice.province[end|exact|exists|partial|start] filter parameters
      - Added invoice.registryData[end|exact|exists|partial|start] filter parameters
      - Added invoice.town[end|exact|exists|partial|start] filter parameters
      - Added invoiceNotificationTemplate and invoiceNotificationTemplate[exists] filter parameters
      - Added logo.baseName[end|exact|exists|partial|start] filter parameters
      - Added logo.fileSize[between|exists|gt|gte|lt|lte] filter parameters
      - Added logo.mimeType[end|exact|exists|partial|start] filter parameters
      - Added maxDailyUsageNotificationTemplate and maxDailyUsageNotificationTemplate[exists] filter parameters
      - Added voicemailNotificationTemplate and voicemailNotificationTemplate[exists] filter parameters
      - Added _order[invoice.country], _order[invoice.nif], _order[invoice.postalAddress], _order[invoice.postalCode], _order[invoice.province], _order[invoice.registryData], _order[invoice.town], _order[logo.baseName], _order[logo.fileSize] and _order[logo.mimeType] querystring arguments

    - /call_csv_schedulers:
      - Added lastExecutionError[end|exact|exists|partial|start] filter parameters
      - Added _order[lastExecutionError] querystring argument

    - /friends:
      - Added [POST] endpoint
      - Added directConnectivity[end|exact|exists|partial|start] filter parameters
      - Added _order[directConnectivity] querystring argument

    - /friends/{id}:
      - Added [GET], [PUT] and [DELETE] endpoints

    - /languages:
      - Added name.ca[end|exact|exists|partial|start] filter parameters
      - Added name.en[end|exact|exists|partial|start] filter parameters
      - Added name.es[end|exact|exists|partial|start] filter parameters
      - Added name.it[end|exact|exists|partial|start] filter parameters
      - Added _order[name.ca], _order[name.en], _order[name.es] and _order[name.it] querystring arguments

    - /routing_tags
      - Added tag[end|exact|exists|partial|start] filter parameters
      - Added _order[tag] querystring param

    - /services:
      - Added name.ca[end|exact|exists|partial|start] filter parameters
      - Added name.en[end|exact|exists|partial|start] filter parameters
      - Added name.es[end|exact|exists|partial|start] filter parameters
      - Added name.it[end|exact|exists|partial|start] filter parameters
      - Added _order[name.ca], _order[name.en], _order[name.es] and _order[name.it] querystring arguments

    - /transformation_rule_sets:
      - Added name.ca[end|exact|exists|partial|start] filter parameters
      - Added name.en[end|exact|exists|partial|start] filter parameters
      - Added name.es[end|exact|exists|partial|start] filter parameters
      - Added name.it[end|exact|exists|partial|start] filter parameters
      - Added _order[name.ca], _order[name.en], _order[name.es] and _order[name.it] querystring arguments

* Models:
    - Brand and Brand-detailed:
      - Removed logoPath property
      - Added voicemailNotificationTemplate property
      - Added faxNotificationTemplate property
      - Added invoiceNotificationTemplate property
      - Added callCsvNotificationTemplate property
      - Added maxDailyUsageNotificationTemplate property
    - Brand-collection:
      - Removed logoPath property
      - Added invoice property
      - Added logo property
    - CallCsvScheduler-collection:
      - Added lastExecutionError property
    - DestinationRateGroup, DestinationRateGroup-collection and DestinationRateGroup-detailed:
      - Removed filePath property
    - Friend:
      - Added fromUser property
    - Friend-collection:
      - Added directConnectivity property
    - Friend-detailed
      - Added model
    - Language-collection:
      - Added name property
    - RoutingTag-collection:
      - Added tag property
    - Service-collection:
      - Added name property
    - TransformationRuleSet-collection:
      - Added name property
    - WebPortal-detailed:
      - Removed logoPath property

## 2.18.0
* Endpoints:
    - Allow to filter collections by id
    - /destination_rate_groups
        - Removed unnecessary file filter parameter
    - /friends
        - Added description[end|exact|partial|start] filter parameter
        - Added domain filter parameter
        - Added priority[between|gt|gte|lt|lte] filter parameter
        - Added description and priority to order parameters
    - /invoices:
        - Added numberSequence filter parameter
        - Added scheduler filter parameter

* Model
    - Ddi-collection
        - Added country property
        - Added ddiProvider property
    - DestinationRateGroup and DestinationRateGroup-collection
        - Added file property
        - Added filePath readonly property
    - DestinationRateGroup_File:
        - Added model
    - Fax-collection:
        - Added outgoingDdi property
    - Friend-collection:
        - Added domain property
        - Added description property
        - Added priority property
    - User-collection:
        - Added terminal property
        - Added outgoingDdi property

## 2.17.2
* Endpoints:
    - /countries:
        - Added name.ca[end], name.ca[exact], name.ca[exists], name.ca[partial] and name.ca[start] filter parameters 
        - Added name.it[end], name.it[exact], name.it[exists], name.it[partial] and name.ca[start] filter parameters
        - Added _order[name.ca] and _order[name.it] querystring arguments
    - /currencies:
        - Added name.ca, name.ca[end], name.ca[exact], name.ca[partial] and name.ca[start] filter parameters
        - Added name.it, name.it[end], name.it[exact], name.it[partial] and name.it[start] filter parameters
        - Added _order[name.ca] and _order[name.it] querystring arguments
    - /destination_rate_groups:
        - Added name.ca[end], name.ca[exact], name.ca[partial] and name.ca[start] filter parameters
        - Added name.it[end], name.it[exact], name.it[partial] and name.it[start] filter parameters
        - Added _order[name.ca] and _order[name.it] querystring arguments
    - /destinations:
        - Added name.ca[end], name.ca[exact], name.ca[exists], name.ca[partial] and name.ca[start] filter parameters
        - Added name.it[end], name.it[exact], name.it[exists], name.it[partial] and name.ca[start] filter parameters
        - Added _order[name.ca] and _order[name.it] querystring arguments
    - /rating_plan_groups:
        - Added name.ca[end], name.ca[exact], name.ca[partial] and name.ca[start] filter parameters
        - Added name.it[end], name.it[exact], name.it[partial] and name.it[start] filter parameters
        - Added _order[name.ca] and _order[name.it] querystring arguments
    - /residential_devices:
        - Added authNeeded[end], authNeeded[exact], authNeeded[partial] and authNeeded[start] filter parameters
        - Added transport[end], transport[exact], transport[exists], transport[partial] and transport[start] filter parameters
        - Added _order[authNeeded] and _order[transport] querystring arguments
    - /retail_accounts:
        - Added transport[end], transport[exact], transport[exists], transport[partial] and transport[start] filter parameters
        - Added _order[transport] querystring arguments
    - /routing_patterns
        - Added name.ca[end], name.ca[exact], name.ca[partial] and name.ca[start] filter parameters
        - Added name.it[end], name.it[exact], name.it[partial] and name.it[start] filter parameters
        - Added _order[name.ca] and _order[name.it] querystring arguments

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
