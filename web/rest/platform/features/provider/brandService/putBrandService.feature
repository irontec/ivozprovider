Feature: Update brand services
  In order to manage brand services
  As an super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update an brand service
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/brand_services/1" with body:
    """
      {
        "code": "95",
        "brand": 2,
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
          "id": 1,
          "brand": {
              "name": "Irontec_e2e",
              "domainUsers": "sip.irontec.com",
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
              "language": 1,
              "defaultTimezone": 145
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
