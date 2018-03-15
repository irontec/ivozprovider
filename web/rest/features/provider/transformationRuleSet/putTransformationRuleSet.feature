Feature: Update transformation rule sets
  In order to manage transformation rule sets
  As an super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a transformation rule set
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/transformation_rule_sets/1" with body:
    """
      {
          "description": "Updated transformation for some country",
          "internationalCode": "00",
          "trunkPrefix": "",
          "areaCode": "",
          "nationalLen": 9,
          "generateRules": false,
          "id": 1,
          "name": {
              "en": "en1",
              "es": "es1"
          },
          "brand": 1,
          "country": 2
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "description": "Updated transformation for some country",
          "internationalCode": "00",
          "trunkPrefix": "",
          "areaCode": "",
          "nationalLen": 9,
          "generateRules": false,
          "id": 1,
          "name": {
              "en": "en1",
              "es": "es1"
          },
          "brand": {
              "name": "DemoBrand",
              "domainUsers": "",
              "recordingsLimitMB": null,
              "recordingsLimitEmail": "",
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
              "domain": 6,
              "language": 1,
              "defaultTimezone": 1
          },
          "country": {
              "code": "GB",
              "countryCode": "+44",
              "id": 2,
              "name": {
                  "en": "United Kingdom",
                  "es": "Reino Unido"
              },
              "zone": {
                  "en": "Europe",
                  "es": "Europa"
              }
          }
      }
    """
