Feature: Manage brands
  In order to manage brands
  as a super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the brand json list
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "brands"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      [
          {
              "name": "DemoBrand",
              "domainUsers": "",
              "id": 1,
              "logo": {
                  "fileSize": null,
                  "mimeType": null,
                  "baseName": null
              },
              "invoice": {
                  "nif": "",
                  "postalCode": ""
              },
              "features": [
                  1,
                  2,
                  3,
                  4,
                  5,
                  6,
                  7
              ],
              "proxyTrunks": [
                  1
              ]
          },
          {
              "name": "Irontec_e2e",
              "domainUsers": "sip.irontec.com",
              "id": 2,
              "logo": {
                  "fileSize": null,
                  "mimeType": null,
                  "baseName": null
              },
              "invoice": {
                  "nif": "",
                  "postalCode": ""
              },
              "features": [],
              "proxyTrunks": []
          }
      ]
    """

  Scenario: Retrieve certain brand json
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "brands/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      {
          "name": "DemoBrand",
          "domainUsers": "",
          "maxCalls": 0,
          "id": 1,
          "logo": {
              "fileSize": null,
              "mimeType": null,
              "baseName": null
          },
          "invoice": {
              "nif": "",
              "postalAddress": "",
              "postalCode": "",
              "town": "",
              "province": "",
              "country": "",
              "registryData": ""
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
              "tz": "Europe/Madrid",
              "comment": "mainland",
              "id": 145,
              "label": {
                  "en": "en",
                  "es": "es",
                  "ca": "ca",
                  "it": "it"
              },
              "country": 68
          },
          "currency": {
              "iden": "EUR",
              "symbol": "€",
              "id": 1,
              "name": {
                  "en": "Euro",
                  "es": "Euro",
                  "ca": "Euro",
                  "it": "Euro"
              }
          },
          "voicemailNotificationTemplate": null,
          "faxNotificationTemplate": null,
          "invoiceNotificationTemplate": null,
          "callCsvNotificationTemplate": null,
          "maxDailyUsageNotificationTemplate": null,
          "features": [
              1,
              2,
              3,
              4,
              5,
              6,
              7
          ]
      }
    """
