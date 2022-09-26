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
        "nif": "",
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
        ]
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
          "nif": "",
          "maxCalls": 0,
          "maxDailyUsage": 100,
          "currentDayUsage": 0,
          "maxDailyUsageEmail": null,
          "postalAddress": "",
          "postalCode": "",
          "town": "",
          "province": "",
          "countryName": "",
          "ipfilter": true,
          "onDemandRecord": 0,
          "allowRecordingRemoval": true,
          "onDemandRecordCode": "",
          "externallyextraopts": "",
          "billingMethod": "postpaid",
          "balance": 0,
          "showInvoices": false,
          "id": 6,
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
      And I send a "GET" request to "companies/6"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "type": "vpbx",
          "name": "API company",
          "domainUsers": "api.irontec.com",
          "nif": "",
          "maxCalls": 0,
          "postalAddress": "",
          "postalCode": "",
          "town": "",
          "province": "",
          "countryName": "",
          "ipfilter": true,
          "onDemandRecord": 0,
          "onDemandRecordCode": "",
          "externallyextraopts": "",
          "billingMethod": "postpaid",
          "balance": 0,
          "showInvoices": false,
          "id": 6,
          "language": {
              "iden": "es",
              "id": 1,
              "name": "~"
          },
          "defaultTimezone": {
              "tz": "Europe/Andorra",
              "comment": "",
              "id": 1,
              "label": "~",
              "country": 1
          },
          "country": {
              "code": "AD",
              "countryCode": "+376",
              "id": 1,
              "name": "~",
              "zone": "~"
          },
          "currency": null,
          "transformationRuleSet": {
              "description": "Generic transformation for Spain",
              "internationalCode": "00",
              "trunkPrefix": "",
              "areaCode": "",
              "nationalLen": 9,
              "generateRules": false,
              "id": 1,
              "name": "~",
              "country": 68
          },
          "outgoingDdi": {
              "ddi": "123",
              "id": 1,
              "company": 1,
              "ddiProvider": 1,
              "country": 68
          },
          "voicemailNotificationTemplate": {
              "name": "Voicemail notification",
              "type": "voicemail",
              "id": 1
          },
          "faxNotificationTemplate": null,
          "invoiceNotificationTemplate": null,
          "callCsvNotificationTemplate": null,
          "featureIds": [1],
          "geoIpAllowedCountries": [
            1
          ],
          "routingTagIds": [],
          "codecIds": []
      }
    """
