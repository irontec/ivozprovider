Feature: Manage brands
  In order to manage brands
  As a brand admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a brand
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/brands/1" with body:
    """
      {
          "name": "UpdatedDemoBrand",
          "domainUsers": "",
          "recordingsLimitMB": null,
          "recordingsLimitEmail": "",
          "maxCalls": 1,
          "id": 1,
          "logo": {
              "fileSize": null,
              "mimeType": null,
              "baseName": null
          },
          "invoice": {
              "nif": "",
              "postalAddress": "",
              "postalCode": "48960",
              "town": "",
              "province": "",
              "country": "",
              "registryData": ""
          },
          "domain": 1,
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
          "name": "UpdatedDemoBrand",
          "id": 1,
          "logo": {
              "fileSize": null,
              "mimeType": null,
              "baseName": null
          },
          "invoice": {
              "nif": "",
              "postalAddress": "",
              "postalCode": "48960",
              "town": "",
              "province": "",
              "country": "",
              "registryData": ""
          },
          "language": 1,
          "defaultTimezone": 145,
          "currency": 1
      }
    """

  @createSchema
  Scenario: Cannot update unmamaged brands
    Given I add Brand Authorization header
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "PUT" request to "/brands/2" with body:
    """
      {}
    """
    Then the response status code should be 404
