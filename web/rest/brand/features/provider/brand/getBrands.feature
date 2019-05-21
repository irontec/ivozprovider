Feature: Manage brands
  In order to manage brands
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Cannot retrieve the brand json list
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "brands"
     Then the response status code should be 404

  Scenario: Retrieve certain brand json
    Given I add Brand Authorization header
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
          "domain": {
              "domain": "retail.irontec.com",
              "pointsTo": "proxyusers",
              "description": "Irontec Test Company retail domain",
              "id": 6
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
          },
          "currency": {
              "iden": "USD",
              "symbol": "$",
              "id": 2,
              "name": {
                  "en": "Dollar",
                  "es": "Dóllar"
              }
          }
      }
    """
