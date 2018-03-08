Feature: Retrieve routing patterns
  In order to manage routing patterns
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the routing patterns json list
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "routing_patterns"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
          {
              "regExp": "+34",
              "id": 1,
              "name": {
                  "en": "en",
                  "es": "es"
              }
          }
      ]
    """

  Scenario: Retrieve certain routing pattern json
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "routing_patterns/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
          "regExp": "+34",
          "id": 1,
          "name": {
              "en": "en",
              "es": "es"
          },
          "description": {
              "en": "en",
              "es": "es"
          },
          "brand": {
              "name": "DemoBrand",
              "domainUsers": "",
              "fromName": "",
              "fromAddress": "",
              "recordingsLimitMB": null,
              "recordingsLimitEmail": "",
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
          }
      }
    """
