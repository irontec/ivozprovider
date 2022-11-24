Feature: Retrieve features rel brand
  In order to manage features rel brand
  as a super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the features rel brand json list
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "features_rel_brands"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      [
          {
              "id": 1,
              "brand": 1,
              "feature": 1
          },
          {
              "id": 2,
              "brand": 1,
              "feature": 2
          },
          {
              "id": 3,
              "brand": 1,
              "feature": 3
          },
          {
              "id": 4,
              "brand": 1,
              "feature": 4
          },
          {
              "id": 5,
              "brand": 1,
              "feature": 5
          },
          {
              "id": 6,
              "brand": 1,
              "feature": 6
          },
          {
              "id": 7,
              "brand": 1,
              "feature": 7
          }
      ]
    """

  Scenario: Retrieve certain feature rel brand json
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "features_rel_brands/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      {
          "id": 1,
          "brand": {
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
              "language": 1,
              "defaultTimezone": 145,
              "currency": 1,
              "voicemailNotificationTemplate": null,
              "faxNotificationTemplate": null,
              "invoiceNotificationTemplate": null,
              "callCsvNotificationTemplate": null,
              "maxDailyUsageNotificationTemplate": null
          },
          "feature": {
              "iden": "queues",
              "id": 1,
              "name": {
                  "en": "en",
                  "es": "es",
                  "ca": "ca",
                  "it": "it"
              }
          }
      }
    """

