Feature: Update brand services
  In order to manage brand services
  As an super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update an brand service
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/brand_services/2" with body:
    """
      {
        "code": "95",
        "brand": 1,
        "service": 2
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "code": "95",
          "id": 2,
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
          "service": {
              "iden": "GroupPickUp",
              "defaultCode": "95",
              "extraArgs": false,
              "id": 2,
              "name": {
                  "en": "en",
                  "es": "en"
              },
              "description": {
                  "en": "en",
                  "es": "en"
              }
          }
      }
    """
