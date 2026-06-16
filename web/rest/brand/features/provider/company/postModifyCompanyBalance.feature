Feature: Modify company balances
  In order to manage company balances
  As a brand admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Increment a company balance
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/x-www-form-urlencoded"
      And I add "Accept" header equal to "application/json"
     When I send a "POST" request to "/companies/1/modify_balance" with parameters:
      | key       | value     |
      | operation | increment |
      | amount    | 10        |
     Then the response status code should be 201
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "type": "vpbx",
          "name": "DemoCompany",
          "domainUsers": "127.0.0.1",
          "maxCalls": 0,
          "maxDailyUsage": 2,
          "currentDayUsage": 1,
          "maxDailyUsageEmail": "no-replay@domain.net",
          "ipfilter": false,
          "onDemandRecord": 0,
          "onDemandRecordEmail": "disabled",
          "onDemandRecordEmailAddress": null,
          "allowRecordingRemoval": true,
          "onDemandRecordCode": "",
          "externallyextraopts": "",
          "billingMethod": "prepaid",
          "balance": 11.2,
          "showInvoices": true,
          "id": 1,
          "invoicing": {
              "nif": "12345678A",
              "postalAddress": "Company Address",
              "postalCode": "54321",
              "town": "Company Town",
              "province": "Company Province",
              "countryName": "Company Country"
          },
          "language": {
              "iden": "es",
              "id": 1,
              "name": {
                  "en": "es",
                  "es": "es",
                  "ca": "es",
                  "it": "es",
                  "eu": "es"
              }
          },
          "defaultTimezone": {
              "country": 68,
              "tz": "Europe/Madrid",
              "comment": "mainland",
              "id": 145,
              "label": {
                  "en": "en",
                  "es": "es",
                  "ca": "ca",
                  "it": "it",
                  "eu": "eu"
              }
          },
          "country": {
              "countryCode": "+34",
              "code": "ES",
              "id": 68,
              "name": {
                  "en": "Spain",
                  "es": "España",
                  "ca": "España",
                  "it": "Spagna",
                  "eu": "Spagna"
              },
              "zone": {
                  "en": "Europe",
                  "es": "Europa",
                  "ca": "Europa",
                  "it": "Europe",
                  "eu": "Europa"
              }
          },
          "currency": null,
          "transformationRuleSet": {
              "country": 68,
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
                  "it": "Brand 1 transformation for Spain",
                  "eu": "Brand 1 transformation for Spain"
              },
              "editable": true
          },
          "outgoingDdi": null,
          "outgoingDdiRule": null,
          "voicemailNotificationTemplate": {
              "type": "voicemail",
              "name": "Voicemail notification",
              "id": 1
          },
          "onDemandRecordNotificationTemplate": null,
          "faxNotificationTemplate": null,
          "invoiceNotificationTemplate": null,
          "callCsvNotificationTemplate": null,
          "maxDailyUsageNotificationTemplate": {
              "type": "callCsv",
              "name": "CallCsv notification",
              "id": 2
          },
          "accessCredentialNotificationTemplate": {
              "type": "accessCredentials",
              "name": "Access Credentials",
              "id": 5
          },
          "corporation": {
              "id": 1,
              "name": "Irontec Test Corporation",
              "description": "Irontec Test Desc Corporation"
          },
          "applicationServerSet": {
              "id": 1,
              "name": "BlueApSet",
              "distributeMethod": "hash",
              "description": "An Application Server Set",
              "applicationServers": null
          },
          "mediaRelaySet": {
              "id": 0,
              "name": "Default",
              "description": "Default media relay set"
          },
          "location": {
              "id": 1,
              "name": "testLocation",
              "description": "Test Location description",
              "company": 1
          },
          "featureIds": [
              1,
              2,
              3,
              4,
              5,
              10
          ],
          "geoIpAllowedCountries": [],
          "routingTagIds": [],
          "codecIds": []
      }
      """

  @createSchema
  Scenario: Decrement a company balance
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/x-www-form-urlencoded"
      And I add "Accept" header equal to "application/json"
     When I send a "POST" request to "/companies/1/modify_balance" with parameters:
      | key       | value     |
      | operation | decrement |
      | amount    | 1         |
     Then the response status code should be 201
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "type": "vpbx",
          "name": "DemoCompany",
          "domainUsers": "127.0.0.1",
          "maxCalls": 0,
          "maxDailyUsage": 2,
          "currentDayUsage": 1,
          "maxDailyUsageEmail": "no-replay@domain.net",
          "ipfilter": false,
          "onDemandRecord": 0,
          "allowRecordingRemoval": true,
          "onDemandRecordCode": "",
          "onDemandRecordEmail": "disabled",
          "onDemandRecordEmailAddress": null,
          "externallyextraopts": "",
          "billingMethod": "prepaid",
          "balance": 0.2,
          "showInvoices": true,
          "id": 1,
          "invoicing": {
              "countryName": "Company Country",
              "nif": "12345678A",
              "postalAddress": "Company Address",
              "postalCode": "54321",
              "town": "Company Town",
              "province": "Company Province"
          },
          "language": {
              "iden": "es",
              "id": 1,
              "name": {
                  "en": "es",
                  "es": "es",
                  "ca": "es",
                  "it": "es",
                  "eu": "es"
              }
          },
          "defaultTimezone": {
              "country": 68,
              "tz": "Europe/Madrid",
              "comment": "mainland",
              "id": 145,
              "label": {
                  "en": "en",
                  "es": "es",
                  "ca": "ca",
                  "it": "it",
                  "eu": "eu"
              }
          },
          "country": {
              "countryCode": "+34",
              "code": "ES",
              "id": 68,
              "name": {
                  "en": "Spain",
                  "es": "España",
                  "ca": "España",
                  "it": "Spagna",
                  "eu": "Spagna"
              },
              "zone": {
                  "en": "Europe",
                  "es": "Europa",
                  "ca": "Europa",
                  "it": "Europe",
                  "eu": "Europa"
              }
          },
          "currency": null,
          "transformationRuleSet": {
              "country": 68,
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
                  "it": "Brand 1 transformation for Spain",
                  "eu": "Brand 1 transformation for Spain"
              },
              "editable": true
          },
          "outgoingDdi": null,
          "outgoingDdiRule": null,
          "voicemailNotificationTemplate": {
              "type": "voicemail",
              "name": "Voicemail notification",
              "id": 1
          },
          "onDemandRecordNotificationTemplate": null,
          "faxNotificationTemplate": null,
          "invoiceNotificationTemplate": null,
          "callCsvNotificationTemplate": null,
          "maxDailyUsageNotificationTemplate": {
              "type": "callCsv",
              "name": "CallCsv notification",
              "id": 2
          },
          "accessCredentialNotificationTemplate": {
              "type": "accessCredentials",
              "name": "Access Credentials",
              "id": 5
          },
          "corporation": {
              "name": "Irontec Test Corporation",
              "description": "Irontec Test Desc Corporation",
              "id": 1
          },
          "applicationServerSet": {
              "name": "BlueApSet",
              "distributeMethod": "hash",
              "description": "An Application Server Set",
              "id": 1,
              "applicationServers": null
          },
          "mediaRelaySet": {
              "name": "Default",
              "description": "Default media relay set",
              "id": 0
          },
          "location": {
              "name": "testLocation",
              "description": "Test Location description",
              "id": 1,
              "company": 1
          },
          "featureIds": [
              1,
              2,
              3,
              4,
              5,
              10
          ],
          "geoIpAllowedCountries": [],
          "routingTagIds": [],
          "codecIds": []
      }
      """
