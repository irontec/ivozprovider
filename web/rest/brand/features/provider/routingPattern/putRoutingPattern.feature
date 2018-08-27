Feature: Update routing patterns
  In order to manage routing patterns
  As an super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a routing pattern
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/routing_patterns/1" with body:
    """
      {
          "prefix": "+349",
          "name": {
              "en": "englishName",
              "es": "nombreEspañol"
          },
          "description": {
              "en": "en",
              "es": "es"
          },
          "brand": 2
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "prefix": "+349",
          "id": 1,
          "name": {
              "en": "englishName",
              "es": "nombreEspañol"
          },
          "description": {
              "en": "en",
              "es": "es"
          },
          "brand": {
              "name": "Irontec_e2e",
              "domainUsers": "sip.irontec.com",
              "recordingsLimitMB": null,
              "recordingsLimitEmail": null,
              "maxCalls": 0,
              "id": 2,
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
              "domain": 4,
              "language": 1,
              "defaultTimezone": 1
          }
      }
    """
