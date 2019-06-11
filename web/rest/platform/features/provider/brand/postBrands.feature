Feature: Manage brands
  In order to manage brands
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a brand
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/brands" with body:
    """
      {
        "name": "api_brand",
        "domainUsers": "sip-api.irontec.com",
        "invoice": {
          "nif": "123",
          "postalAddress": "",
          "postalCode": "48971",
          "town": "Bilbo",
          "province": "Bizkaia",
          "country": "Spain",
          "registryData": "registryData"
        },
        "defaultTimezone": 145
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "name": "api_brand",
          "domainUsers": "sip-api.irontec.com",
          "maxCalls": 0,
          "id": 3,
          "logo": {
              "fileSize": null,
              "mimeType": null,
              "baseName": null
          },
          "invoice": {
              "nif": "123",
              "postalAddress": "",
              "postalCode": "48971",
              "town": "Bilbo",
              "province": "Bizkaia",
              "country": "Spain",
              "registryData": "registryData"
          },
          "language": null,
          "defaultTimezone": 145
      }
    """

  Scenario: Retrieve created brand
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "brands/3"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      {
          "name": "api_brand",
          "domainUsers": "sip-api.irontec.com",
          "maxCalls": 0,
          "id": 3,
          "logo": {
              "fileSize": null,
              "mimeType": null,
              "baseName": null
          },
          "invoice": {
              "nif": "123",
              "postalAddress": "",
              "postalCode": "48971",
              "town": "Bilbo",
              "province": "Bizkaia",
              "country": "Spain",
              "registryData": "registryData"
          },
          "language": null,
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
