Feature: Manage brands
  In order to manage brands
  As an super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a brand
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/brands/2" with body:
    """
      {
        "name": "api_brand_modified",
        "domainUsers": "sip-api.irontec.com",
        "recordingsLimitMB": 0,
        "recordingsLimitEmail": "",
        "invoice": {
          "nif": "1234",
          "postalAddress": "",
          "postalCode": "48960",
          "town": "",
          "province": "",
          "country": "",
          "registryData": ""
        },
        "language": 1,
        "defaultTimezone": 145
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "name": "api_brand_modified",
          "domainUsers": "sip-api.irontec.com",
          "maxCalls": 0,
          "id": 2,
          "logo": {
              "fileSize": null,
              "mimeType": null,
              "baseName": null
          },
          "invoice": {
              "nif": "1234",
              "postalAddress": "",
              "postalCode": "48960",
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
                  "es": "es"
              }
          },
          "defaultTimezone": {
              "tz": "Europe/Madrid",
              "comment": "mainland",
              "id": 145,
              "label": {
                  "en": "en",
                  "es": "es"
              },
              "country": 68
          }
      }
    """
