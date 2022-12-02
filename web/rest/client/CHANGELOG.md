# Changelog

## 3.0.0
* Disclaimer: The API schema will not be considered stable until version 3.1 and may receive new breaking changes
* Endpoints:
  - Extracted every user endpoint to it's own API 
  - Added not equal [neq] filters
  - Added exits[fldName] filters
  - Fixed downloadable file spec
  - Fixed embeddable model spec
  - /calendar_periods:
    - Renamed voiceMailUser filter parameter to voicemail
  - /call_forward_settings:
    - Renamed voiceMailUser filter parameter to voicemail
  - /conditional_routes
    - Renamed voiceMailUser filter parameter to voicemail
  - /conditional_routes_conditions:
    - Renamed voiceMailUser filter parameter to voicemail
  - /extensions/unassigned
    - Added [GET] endpoint
  - /external_call_filters:
    - Renamed outOfScheduleVoiceMailUser filter parameter to outOfScheduleVoicemail
  - /external_call_filter_rel_calendars:
    - Renamed holidayVoiceMailUser filter parameter to outOfScheduleVoicemail
  - /external_call_filter_rel_schedules:
    - Renamed holidayVoiceMailUser filter parameter to holidayVoicemail
    - Renamed outOfScheduleVoiceMailUser filter parameter to outOfScheduleVoicemail
  - /external_call_filter_white_lists:
    - Renamed holidayVoiceMailUser filter parameter to holidayVoicemail
  - /external_call_filters:
    - Renamed holidayVoiceMailUser filter parameter to holidayVoicemail
    - Renamed outOfScheduleVoiceMailUser filter parameter to outOfScheduleVoicemail
  - /faxes_in_outs/{id}:
    - Added [DELETE] endpoint
  - /features_rel_companies:
    - Changed [GET] response model from FeaturesRelCompany-collection to FeaturesRelCompany-detailedCollection
  - /holiday_dates:
    - Renamed voiceMailUser filter parameter to voicemail
  - /hunt_group_members:
    - Added endpoint 
  - /hunt_groups:
    - Renamed noAnswerVoiceMailUser filter parameter to noAnswerVoicemail
  - /hunt_groups/{id}/users_available:
    - Added endpoint
  - /hunt_groups_rel_users
    - Removed method (replaced by /hunt_group_members)
  - /invoices:
    - Added [GET] endpoint
  - /ivr_entries:
    - Renamed voiceMailUser filter parameter to voicemail
  - /ivrs:
    - Renamed errorVoiceMailUser filter parameter to errorVoicemail
    - Renamed noInputVoiceMailUser filter parameter to noInputVoicemail
  - /locations:
    - Added endpoint
  - /queues:
    - Renamed fullVoiceMailUser filter parameter to fullVoicemail
    - Renamed timeoutVoiceMailUser filter parameter to timeoutVoicemail
  - /terminals/unassigned:
    - Added [GET] endpoint
  - /users:
    - Removed voicemailLocution filter parameter
  - /voicemail_messages
    - Added [GET|DELETE] endpoint
  - /voicemail_messages/{id}/metadatafile: 
    - Added [GET] method
  - /voicemail_messages/{id}/recordingfile:
    - Added [GET] method
* Models:
    - Many properties added into collection response (not listed below unless they involve a BC)
    - BillableCall-, BillableCall-collection:
      - Set direction as required property
    - CalendarPeriod, CalendarPeriod-detailed:
      - Added scheduleIds property
      - Removed voiceMailUser property
      - Added voicemail property
      - Set calendar as required property
    - CallForwardSetting:
      - Removed voiceMailUser property
      - Added voicemail property
    - CallForwardSetting-detailed:
      - Added friend property
      - Added voicemail property
      - Removed voiceMailUser property
    - CallForwardSetting-detailedCollection:
      - Removed model
    - ConditionalRoute, ConditionalRoute-detailed:
      - Removed voicemailUser property
      - Added voicemail property
    - ConditionalRoutesCondition, ConditionalRoutesCondition-detailed, ConditionalRoutesCondition-withInverseRelationships:
      - Removed voicemailUser property
      - Added voicemail property
    - Extension, Extension-collection:
      - Added voicemail choice into routeType property
      - Added voicemail property
    - ExternalCallFilter, ExternalCallFilter-collection, ExternalCallFilter-detailed, ExternalCallFilter-withInverseRelationships:
      - Added holidayEnabled required property
      - Removed holidayVoiceMailUser property
      - Added holidayVoicemail property
      - Added outOfScheduleEnabled required property
      - Removed outOfScheduleVoiceMailUser property
      - Added outOfScheduleVoicemail property
    - FaxesInOut, FaxesInOut-detailed:
      - Set status property as enum
    - FeaturesRelCompany:
      - Replaced FeaturesRelCompany-collection model by FeaturesRelCompany-detailedCollection model
    - HolidayDate, HolidayDate-detailed:
      - Removed voiceMailUser property
      - Added voicemail property
    - HuntGroup, HuntGroup-detailed:
      - Removed noAnswerVoicemail property
      - Added noAnswerVoiceMailUser property
    - HuntGroupsRelUser:
      - Removed model
    - HuntGroupMember:
      - Added model
    - Invoice-collection:
      - Added model
    - Ivr, Ivr-collection, Ivr-detailed, Ivr-withExcludedExtensions:
      - Removed errorVoiceMailUser property
      - Added errorVoicemail property
      - Removed noInputVoiceMailUser property
      - Added noInputVoicemail property
    - IvrEntry, IvrEntry-detailed:
      - Removed voiceMailUser property
      - Added voicemail property
    - Location:
      - Added model
    - Profile:
      - Added model
    - ProfileAcl:
      - Added model
    - Queue, Queue-collection, Queue-detailed:
      - Removed fullVoiceMailUser property
      - Added fullVoicemail property
      - Set strategy as enum
      - Removed timeoutVoiceMailUser
      - Added timeoutVoicemail property
    - RegistrationSummary:
      - Removed model
    - RetailAccount:
      - Set name as read only
    - RouteLock:
      - Changed open property default value from 0 to 1
    - User, User-detailed:
      - Removed voicemailAttachSound property
      - Removed voicemailEnabled property
      - Removed voicemailLocution property
      - Removed voicemailSendMail property
      - Added voicemail property
    - Voicemail:
      - Added model
    - VoicemailMessage:
      - Added model

## 2.22.0
* Endpoints:
    - /billable_calls:
        - Added destinationName[start|end|exact|exists|partial] filter parameters
        - Added _order[destinationName] querystring argument
        - Added ratingPlanName[start|end|exact|exists|partial] filter parameters
        - Added _order[ratingPlanName] querystring argument
    - /ddis:
        - Added description[start|end|exact|exists|partial] filter parameters
        - Added _order[description] querystring argument
* Models:
    - DDI:
        - Added description property
    - Queue:
        - Added announceFrequency property
        - Added announcePosition property
        - Added displayName property

## 2.21.1
* Models:
    - Company:
        - Added domainName property

## 2.20.1
* Models:
    - ResidentialDevice:
        - Name property is readonly now

## 2.20.0
* Endpoints:
    - /call_forward_settings:
        - Added friend[] and friend[exists] filter parameters
        - Added numberValue[start|end|exact|exists|partial] filter parameters
        - Added _order[numberValue] querystring argument

    - /conditional_routes_conditions:
        - Added friendValue[start|end|exact|exists|partial] filter parameters
        - Added numberValue[start|end|exact|exists|partial] filter parameters
        - Added _order[friendValue] querystring argument
        - Added _order[numberValue] querystring argument

    - /hunt_groups_rel_users:
        - Added user.location filter parameters

    - /ivr_entries:
        - Added numberValue[start|end|exact|exists|partial] filter parameters
        - Added _order[numberValue] querystring argument

    - /locations:
        - Added [GET|POST|PUT|DELETE] endpoints

    - /pick_up_rel_users:
        - Added user.location filter parameters

    - /queue_members:
        - Added user.location filter parameters

    - /users:
        - Added location[] and location[exists] filter parameters

* Models:
    - CallForwardSetting:
        - Added friend property
    - CallForwardSetting-collection:
        - Added numberValue property
        - Added numberCountry property
        - Added user property
        - Added voiceMailUser property
        - Added extension property
        - Added residentialDevice property
        - Added retailAccount property
        - Added cfwToRetailAccount property
        - Added ddi property
    - CallForwardSetting-detailed:
        - Added friend property
    - ConditionalRoutesCondition-collection:
        - Added locution property
        - Added numberCountry property
        - Added numberValue property
        - Added ivr property
        - Added user property
        - Added huntGroup property
        - Added voicemailUser property
        - Added friendValue property
        - Added queue property
        - Added conferenceRoom property
        - Added extension property
    - IvrEntry-collection:
        - Added ivr property
        - Added welcomeLocution property
        - Added numberCountry property
        - Added numberValue property
        - Added extension property
        - Added voiceMailUser property
        - Added conditionalRoute property
    - Location:
        - Added model
    - Location-collection:
        - Added model
    - Location-detailed:
        - Added model
    - RetailAccount:
        - Name property is readonly now
    - RetailAccount-collection:
        - Name property is readonly now
    - RetailAccount-detailed:
        - Name property is readonly now
    - RetailAccount-status:
        - Name property is readonly now
    - User:
        - Added location property
    - User-detailed:
        - Added location property

## 2.18.1
* Endpoints:
  - /call_csv_schedulers:
    - Added lastExecutionError[start|end|exact|exists|partial] filter parameters
    - Added _order[lastExecutionError] querystring argument

  - /conditional_routes_conditions_rel_route_lock:
    - Added routeLock.closeExtension, routeLock.openExtension and routeLock.toggleExtension filter parameters

  - /friends:
    - Added directConnectivity[end|exact|exists|partial|start] filter parameters
    - Added _order[directConnectivity] querystring argument

  - /languages:
    - Added name.ca[end|exact|exists|partial|start] filter parameters
    - Added name.en[end|exact|exists|partial|start] filter parameters
    - Added name.es[end|exact|exists|partial|start] filter parameters
    - Added name.it[end|exact|exists|partial|start] filter parameters
    - Added _order[name.ca], _order[name.en], _order[name.es] and _order[name.it] querystring arguments 

  - /music_on_holds:
    - Removed originalFile filter parameter

  - /rating_plan_groups:
    - Added [GET] endpoint

  - /rating_plan_groups/{id}:
    - Added [GET] endpoint

  - /rating_profiles:
    - Added routingTag and routingTag[exists] filter parameters

  - /recordings:
    - Added recorder[end|exact|exists|partial|start] filter parameters
    - Added _order[recorder] querystring argument

  - /route_locks:
    - Added closeExtension filter parameter
    - Added openExtension filter parameter
    - Added toggleExtension filter parameter

  - /routing_tags:
    - Added [GET] endpoint

  - /routing_tags/{id}:
    - Added [GET] endpoint

  - /services:
    - Added name.ca[end|exact|exists|partial|start] filter parameters
    - Added name.en[end|exact|exists|partial|start] filter parameters
    - Added name.es[end|exact|exists|partial|start] filter parameters
    - Added name.it[end|exact|exists|partial|start] filter parameters
    - Added _order[name.ca], _order[name.en], _order[name.es] and _order[name.it] querystring arguments

  - /services/unassigned:
    - Added [GET] endpoint

  - /transformation_rule_sets:
    - Added name.ca[end|exact|exists|partial|start] filter parameters
    - Added name.en[end|exact|exists|partial|start] filter parameters
    - Added name.es[end|exact|exists|partial|start] filter parameters
    - Added name.it[end|exact|exists|partial|start] filter parameters
    - Added _order[name.ca], _order[name.en], _order[name.es] and _order[name.it] querystring arguments

* Models:
    - CallCsvScheduler-collection:
      - Added lastExecutionError property
    - CompanyService-collection:
      - Added service property
    - Friend:
      - Added fromUser property
      - Added alwaysApplyTransformations property
      - Added rtpEncryption property
      - Added multiContact property
    - Friend-collection:
      - Added directConnectivity property
    - Friend-detailed:
      - Added fromUser property
      - Added alwaysApplyTransformations property
      - Added rtpEncryption property
      - Added multiContact property
    - Language-collection:
      - Added name property
    - Locution and Locution-detailed:
      - Removed originalFilePath property
    - MusicOnHold:
      - Removed originalFilePath property
      - Added originalFile property
      - Added encodedFile property
    - MusicOnHold-collection:
      - Changed originalFile definition from string to #/definitions/MusicOnHold_OriginalFile
      - Changed encodedFile definition from string to #/definitions/MusicOnHold_EncodedFile
    - PickUpGroup-collection:
      - Added userIds property
    - RatingProfile-collection and RatingProfile-detailed:
      - Added routingTag property
    - Recording-collection:
      - Added recorder property
    - RouteLock, RouteLock-collection and RouteLock-detailed:
      - Added closeExtension property
      - Added openExtension property
      - Added toggleExtension property
    - Service-collection:
      - Added name property
    - Terminal, Terminal-collection and Terminal-detailed:
      - Set as readonly lastProvisionDate property
    - TerminalModel and TerminalModel-detailed:
      - **Removed** genericTemplate property
      - **Removed** specificTemplate property
      - **Removed** genericUrlPattern property
      - **Removed** specificUrlPattern property
    - TransformationRuleSet-collection:
      - Added name property

## 2.18.0
* Endpoints:
    - Allow to filter collections by id
    - /call_forward_settings
        - Added cfwToRetailAccount filter parameter
        - Added ddi filter parameter
    - /conditional_routes
        - Added friendvalue[start|end|exact|exists|partial] filter parameter
        - Added numbervalue[start|end|exact|exists|partial] filter parameter
        - Added friendvalue and numbervalue sort options
    - /conference_rooms:
        - Added pinCode[start|end|exact|exists|partial] filter parameter
        - Added pinCode sort option
    - /ddis:
        - Added friendvalue[start|end|exact|exists|partial] filter parameter
        - Added friendvalue sort option
    - /extensions:
        - Added friendvalue[start|end|exact|exists|partial] filter parameter
        - Added numbervalue[start|end|exact|exists|partial] filter parameter
        - Added routeType[start|end|exact|exists|partial] filter parameter
        - Added friendvalue, numbervalue and routeType sort options
    - /external_call_filters:
        - Added holidayNumberValue[start|end|exact|exists|partial] filter parameter
        - Added holidayTargetType[start|end|exact|exists|partial] filter parameter
        - Added outOfScheduleNumberValue[start|end|exact|exists|partial] filter parameter
        - Added outOfScheduleTargetType[start|end|exact|exists|partial] filter parameter
        - Added holidayNumberValue, holidayTargetType, outOfScheduleNumberValue, outOfScheduleTargetType sort options
    - /friends:
        - Added description[start|end|exact|exists|partial] filter parameter
        - Added domain filter parameter
        - Added priority[start|end|exact|exists|partial] filter parameter
        - Added description and priority sort options
    - /hunt_groups:
        - Added description[start|end|exact|exists|partial] filter parameter
        - Added description sort option
    - /ivrs:
        - Added allowExtensions filter parameter
        - Added errorNumberValue[start|end|exact|exists|partial] filter parameter
        - Added errorRouteType filter parameter
        - Added noInputNumberValue[start|end|exact|exists|partial] filter parameter
        - Added noInputRouteType[start|end|exact|exists|partial] filter parameter
        - Added timeout[between|gt|gte|lt|lte] filter parameter
        - Added allowExtensions, errorNumberValue, errorRouteType, noInputNumberValue, noInputRouteType and timeout sort options
    - /locutions:
        - Added originalFile.baseName[start|end|exact|exists|partial] filter parameter
        - Added originalFile.fileSize[between|gt|gte|lt|lte|exists] filter parameter
        - Added originalFile.mimeType[start|end|exact|exists|partial] filter parameter
        - Added originalFile.baseName, originalFile.fileSize and originalFile.mimeType sort options
    - /music_on_holds:
        - Added originalFile.baseName[start|end|exact|exists|partial] filter parameter
        - Added originalFile.fileSize[between|gt|gte|lt|lte|exists] filter parameter
        - Added originalFile.mimeType[start|end|exact|exists|partial] filter parameter
        - Added originalFile.baseName, originalFile.fileSize and originalFile.mimeType sort options
    - /queues:
        - Added maxWaitTime[between|gt|gte|lt|lte|exists] filter parameter
        - Added maxlen[between|gt|gte|lt|lte|exists] filter parameter
        - Added memberCallRest[between|gt|gte|lt|lte|exists] filter parameter
        - Added memberCallTimeout[between|gt|gte|lt|lte|exists] filter parameter
        - Added strategy[start|end|exact|exists|partial] filter parameter
        - Added maxWaitTime, maxlen, memberCallRest, memberCallTimeout and strategy sort options
    - /route_locks:
        - Added description[start|end|exact|exists|partial] filter parameter
        - Added description sort option
    - /terminals:
        - Added domain filter parameter

* Model
    - CallForwardSetting, CallForwardSetting-detailed
        - Added "retail" value into targetType enum options
        - Added cfwToRetailAccount property
        - Added ddi property
    - CallForwardSetting-detailedCollection
        - Added "retail" value into targetType enum options
    - ConditionalRoute-collection:
        - Added locution property
        - Added numbervalue property
        - Added friendvalue property
        - Added ivr property
        - Added huntGroup property
        - Added voicemailUser property
        - Added user property
        - Added queue property
        - Added conferenceRoom property
        - Added extension property
        - Added numberCountry property
    - ConferenceRoom-collection:
        - Added maxMembers property
        - Added pinCode property
    - Ddi-collection:
        - Added country property
        - Added externalCallFilter property
        - Added friendValue property
        - Added conferenceRoom property
        - Added language property
        - Added queue property
        - Added user property
        - Added ivr property
        - Added huntGroup property
        - Added fax property
        - Added residentialDevice property
        - Added conditionalRoute property
        - Added retailAccount property
    - Extension-collection:
        - Added routeType property
        - Added numberValue property
        - Added friendValue property
        - Added ivr property
        - Added huntGroup property
        - Added conferenceRoom property
        - Added user property
        - Added queue property
        - Added conditionalRoute property
        - Added numberCountry property
    - ExternalCallFilter-collection:
        - Added holidayTargetType property
        - Added holidayNumberValue property
        - Added holidayLocution property
        - Added holidayExtension property
        - Added holidayVoiceMailUser property
        - Added holidayNumberCountry property
        - Added outOfScheduleTargetType property
        - Added outOfScheduleNumberValue property
        - Added outOfScheduleLocution property
        - Added outOfScheduleExtension property
        - Added outOfScheduleVoiceMailUser property
        - Added outOfScheduleNumberCountry property
    - Fax-collection:
        - Added outgoingDdi property
    - Friend-collection:
        - Added domain property
        - Added description property
        - Added priority property
    - HuntGroup-collection:
        - Added description property
    - Ivr-collection:
        - Added timeout property
        - Added allowExtensions property
        - Added noInputRouteType property
        - Added noInputNumberValue property
        - Added errorRouteType property
        - Added errorNumberValue property
        - Added noInputLocution property
        - Added errorLocution property
        - Added successLocution property
        - Added noInputExtension property
        - Added errorExtension property
        - Added noInputVoiceMailUser property
        - Added errorVoiceMailUser property
        - Added noInputNumberCountry property
        - Added errorNumberCountry property
    - Locution-collection:
        - Added originalFile property
    - MusicOnHold-collection:
        - Added originalFile property
    - OutgoingDdiRule-collection:
        - Added forcedDdi property
    - Queue-collection:
        - Added strategy property
        - Added memberCallTimeout property
        - Added memberCallRest property
        - Added maxWaitTime property
        - Added maxlen property
    - RouteLock-collection:
        - Added description property
    - Terminal-collection:
        - Added domain property
        - Added terminalModel property
    - User-collection:
        - Added terminal property
        - Added extension property
        - Added outgoingDdi property
    - UsersCdr-collection:
        - Added user property
        - Added friend property
        - Added residentialDevice property
        - Added retailAccount property

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
