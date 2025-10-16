Feature: Create companies
  In order to manage companies
  As a brand admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a company
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/companies" with body:
      """
      {
        "type": "vpbx",
        "name": "API company",
        "domainUsers": "api.irontec.com",
        "invoicing": {
          "nif": "1234",
          "postalAddress": "abc",
          "postalCode": "4848",
          "town": "Usansolocity",
          "province": "some",
          "countryName": "country"
        },
        "distributeMethod": "hash",
        "maxCalls": 0,
        "maxDailyUsage": 100,
        "ipfilter": true,
        "onDemandRecord": 0,
        "onDemandRecordCode": "",
        "externallyextraopts": "",
        "recordingsLimitMB": 0,
        "recordingsLimitEmail": "",
        "language": 1,
        "mediaRelaySets": 1,
        "defaultTimezone": 1,
        "applicationServer": 1,
        "country": 1,
        "transformationRuleSet": 1,
        "outgoingDdi": 1,
        "outgoingDdiRule": 1,
        "voicemailNotificationTemplate": 1,
        "faxNotificationTemplate": null,
        "featureIds": [1],
        "geoIpAllowedCountries": [
          1
        ],
        "applicationServerSet": 0,
        "mediaRelaySet": 0
      }
      """
     Then the response status code should be 201
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "type": "vpbx",
          "name": "API company",
          "domainUsers": "api.irontec.com",
          "maxCalls": 0,
          "maxDailyUsage": 100,
          "currentDayUsage": 0,
          "maxDailyUsageEmail": null,
          "ipfilter": true,
          "onDemandRecord": 0,
          "allowRecordingRemoval": true,
          "onDemandRecordCode": "",
          "externallyextraopts": "",
          "billingMethod": "postpaid",
          "balance": 0,
          "showInvoices": false,
          "id": 7,
          "invoicing": {
              "nif": "1234",
              "postalAddress": "abc",
              "postalCode": "4848",
              "town": "Usansolocity",
              "province": "some",
              "countryName": "country"
          },
          "language": 1,
          "defaultTimezone": 1,
          "country": 1,
          "currency": null,
          "transformationRuleSet": 1,
          "outgoingDdi": 1,
          "outgoingDdiRule": 1,
          "voicemailNotificationTemplate": 1,
          "faxNotificationTemplate": null,
          "invoiceNotificationTemplate": null,
          "callCsvNotificationTemplate": null,
          "maxDailyUsageNotificationTemplate": null,
          "accessCredentialNotificationTemplate": null,
          "corporation": null,
          "applicationServerSet": 0,
          "mediaRelaySet": 0,
          "location": null,
          "featureIds": [
              1
          ],
          "geoIpAllowedCountries": [
              1
          ],
          "routingTagIds": [],
          "codecIds": []
      }
      """

  Scenario: Retrieve created company
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "companies/7"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "type": "vpbx",
          "name": "API company",
          "domainUsers": "api.irontec.com",
          "maxCalls": 0,
          "maxDailyUsage": 100,
          "currentDayUsage": 0,
          "maxDailyUsageEmail": null,
          "ipfilter": true,
          "onDemandRecord": 0,
          "allowRecordingRemoval": true,
          "onDemandRecordCode": "",
          "externallyextraopts": "",
          "billingMethod": "postpaid",
          "balance": 0,
          "showInvoices": false,
          "id": 7,
          "invoicing": {
              "nif": "1234",
              "postalAddress": "abc",
              "postalCode": "4848",
              "town": "Usansolocity",
              "province": "some",
              "countryName": "country"
          },
          "language": {
              "iden": "es",
              "id": 1,
              "name": {
                  "en": "es",
                  "es": "es",
                  "ca": "es",
                  "it": "es"
              }
          },
          "defaultTimezone": {
              "tz": "Europe/Andorra",
              "comment": "",
              "id": 1,
              "label": {
                  "en": "",
                  "es": "",
                  "ca": "",
                  "it": ""
              },
              "country": 1
          },
          "country": {
              "code": "AD",
              "countryCode": "+376",
              "id": 1,
              "name": {
                  "en": "Andorra",
                  "es": "Andorra",
                  "ca": "Andorra",
                  "it": "Andorra"
              },
              "zone": {
                  "en": "Europe",
                  "es": "Europa",
                  "ca": "Europa",
                  "it": "Europe"
              }
          },
          "currency": null,
          "transformationRuleSet": {
              "description": "Brand 1 transformation for Spain",
              "internationalCode": "00",
              "trunkPrefix": "",
              "areaCode": "",
              "nationalLen": 9,
              "generateRules": false,
              "id": 1,
              "name": {
                  "en": "Brand 1 transformation for Spain",
                  "es": "Marca 1 tansformacion para España",
                  "ca": "Marca 1 tansformacion para España",
                  "it": "Brand 1 transformation for Spain"
              },
              "country": 68,
              "editable": true
          },
          "outgoingDdi": {
              "ddi": "123",
              "ddie164": "+34123",
              "description": "Description for DDI 123",
              "type": "inout",
              "useDdiProviderRoutingTag": true,
              "id": 1,
              "company": 1,
              "ddiProvider": 1,
              "country": 68,
              "routingTag": null
          },
          "outgoingDdiRule": {
              "name": "testRule",
              "defaultAction": "keep",
              "id": 1,
              "company": 1,
              "forcedDdi": null
          },
          "voicemailNotificationTemplate": {
              "name": "Voicemail notification",
              "type": "voicemail",
              "id": 1
          },
          "faxNotificationTemplate": null,
          "invoiceNotificationTemplate": null,
          "callCsvNotificationTemplate": null,
          "maxDailyUsageNotificationTemplate": null,
          "accessCredentialNotificationTemplate": null,
          "corporation": null,
          "applicationServerSet": {
              "name": "default",
              "distributeMethod": "hash",
              "description": "Default application server set",
              "id": 0,
              "applicationServers": null
          },
          "mediaRelaySet": {
              "name": "Default",
              "description": "Default media relay set",
              "id": 0
          },
          "location": null,
          "domainName": "api.irontec.com",
          "featureIds": [
              1
          ],
          "geoIpAllowedCountries": [
              1
          ],
          "routingTagIds": [],
          "codecIds": []
      }
      """

  @createSchema
  Scenario: Create a retail company
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/companies" with body:
      """
      {
        "type": "retail",
        "name": "API retail",
        "domainUsers": "api.irontec.com",
        "invoicing": {
          "nif": "1234",
          "postalAddress": "abc",
          "postalCode": "4848",
          "town": "Usansolocity",
          "province": "some",
          "countryName": "country"
        },
        "distributeMethod": "hash",
        "maxCalls": 0,
        "maxDailyUsage": 100,
        "postalAddress": "",
        "postalCode": "",
        "town": "",
        "province": "",
        "countryName": "",
        "ipfilter": true,
        "onDemandRecord": 0,
        "onDemandRecordCode": "",
        "externallyextraopts": "",
        "recordingsLimitMB": 0,
        "recordingsLimitEmail": "",
        "language": 1,
        "mediaRelaySets": 1,
        "defaultTimezone": 1,
        "applicationServer": 1,
        "country": 1,
        "transformationRuleSet": 1,
        "outgoingDdi": 1,
        "outgoingDdiRule": 1,
        "voicemailNotificationTemplate": 1,
        "faxNotificationTemplate": null,
        "featureIds": [1],
        "geoIpAllowedCountries": [
          1
        ],
        "routingTagIds": [
          1
        ],
        "codecIds": [],
        "applicationServerSet": 1,
        "mediaRelaySet": 1
      }
      """
     Then the response status code should be 201
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "type": "retail",
          "name": "API retail",
          "domainUsers": "api.irontec.com",
          "maxCalls": 0,
          "maxDailyUsage": 100,
          "currentDayUsage": 0,
          "maxDailyUsageEmail": null,
          "ipfilter": true,
          "onDemandRecord": 0,
          "allowRecordingRemoval": true,
          "onDemandRecordCode": "",
          "externallyextraopts": "",
          "billingMethod": "postpaid",
          "balance": 0,
          "showInvoices": false,
          "id": 7,
          "invoicing": {
              "nif": "1234",
              "postalAddress": "abc",
              "postalCode": "4848",
              "town": "Usansolocity",
              "province": "some",
              "countryName": "country"
          },
          "language": 1,
          "defaultTimezone": 1,
          "country": 1,
          "currency": null,
          "transformationRuleSet": 1,
          "outgoingDdi": 1,
          "outgoingDdiRule": 1,
          "voicemailNotificationTemplate": 1,
          "faxNotificationTemplate": null,
          "invoiceNotificationTemplate": null,
          "callCsvNotificationTemplate": null,
          "maxDailyUsageNotificationTemplate": null,
          "accessCredentialNotificationTemplate": null,
          "corporation": null,
          "applicationServerSet": 1,
          "mediaRelaySet": 1
      }
      """
