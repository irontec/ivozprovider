Feature: Update company
  In order to manage call forward settings
  As an super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a company
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/companies/1" with body:
    """
      {
          "type": "vpbx",
          "name": "DemoCompanyUpdated",
          "domainUsers": "127.0.0.1",
          "nif": "12345678B",
          "distributeMethod": "hash",
          "maxCalls": 0,
          "postalAddress": "Company Address",
          "postalCode": "54321",
          "town": "Company Town",
          "province": "Company Province",
          "countryName": "Company Country",
          "ipfilter": false,
          "onDemandRecord": 0,
          "onDemandRecordCode": "",
          "externallyextraopts": "",
          "recordingsLimitMB": null,
          "recordingsLimitEmail": "",
          "billingMethod": "postpaid",
          "balance": 0,
          "id": 1,
          "language": 1,
          "mediaRelaySets": 1,
          "defaultTimezone": 1,
          "brand": 1,
          "domain": 3,
          "applicationServer": null,
          "country": 1,
          "transformationRuleSet": 1,
          "outgoingDdi": null,
          "outgoingDdiRule": null,
          "voicemailNotificationTemplate": 1,
          "faxNotificationTemplate": null
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "type": "vpbx",
          "name": "DemoCompanyUpdated",
          "domainUsers": "127.0.0.1",
          "nif": "12345678B",
          "distributeMethod": "hash",
          "maxCalls": 0,
          "postalAddress": "Company Address",
          "postalCode": "54321",
          "town": "Company Town",
          "province": "Company Province",
          "countryName": "Company Country",
          "ipfilter": false,
          "onDemandRecord": 0,
          "onDemandRecordCode": "",
          "externallyextraopts": "",
          "recordingsLimitMB": null,
          "recordingsLimitEmail": "",
          "billingMethod": "postpaid",
          "balance": 0,
          "id": 1,
          "language": {
              "iden": "es",
              "id": 1,
              "name": {
                  "en": "es",
                  "es": "es"
              }
          },
          "defaultTimezone": {
              "tz": "Europe/Madrid",
              "comment": "mainland",
              "id": 1,
              "label": {
                  "en": "en",
                  "es": "es"
              },
              "country": 1
          },
          "applicationServer": null,
          "country": {
              "code": "ES",
              "countryCode": "+34",
              "id": 1,
              "name": {
                  "en": "Spain",
                  "es": "España"
              },
              "zone": {
                  "en": "Europe",
                  "es": "Europa"
              }
          },
          "outgoingDdi": null,
          "outgoingDdiRule": null,
          "faxNotificationTemplate": null,
          "invoiceNotificationTemplate": null
      }
    """
