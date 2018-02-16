Feature: Manage brands
  In order to manage brands
  As an admin
  I need to be able to retrieve, create, update and delete them through the API.

  @createSchema
  Scenario: Retrieve the brand json list
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "brands"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      [
        {
            "name": "DemoBrand",
            "id": 1
        },
        {
            "name": "Irontec_e2e",
            "id": 2
        }
      ]
    """

  Scenario: Retrieve certain brand json
    Given I add Authorization header
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
          "fromName": "",
          "fromAddress": "",
          "recordingsLimitMB": null,
          "recordingsLimitEmail": "",
          "id": 1,
          "domain": null,
          "language": {
              "iden": "es",
              "id": 1
          },
          "defaultTimezone": {
              "tz": "Europe\/Madrid",
              "comment": "mainland",
              "id": 1
          }
      }
    """

  Scenario: Create a brand
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/brands" with body:
    """
      {
        "name": "api_brand",
        "domainUsers": "sip-api.irontec.com",
        "fromName": "",
        "fromAddress": "",
        "recordingsLimitMB": 0,
        "recordingsLimitEmail": "",
        "invoice": {
          "nif": "123",
          "postalAddress": "",
          "postalCode": "",
          "town": "",
          "province": "",
          "country": "",
          "registryData": ""
        }
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
        "name": "api_brand",
        "recordingsLimitMB": 0,
        "id": 3
      }
    """

  @dropSchema
  Scenario: Update a brand
    Given I add Authorization header
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "PUT" request to "/brands/3" with body:
    """
      {
        "name": "api_brand_modified",
        "domainUsers": "sip-api.irontec.com",
        "fromName": "",
        "fromAddress": "",
        "recordingsLimitMB": 0,
        "recordingsLimitEmail": "",
        "invoice": {
          "nif": "123",
          "postalAddress": "",
          "postalCode": "",
          "town": "",
          "province": "",
          "country": "",
          "registryData": ""
        },
        "domain": 1,
        "language": 1,
        "defaultTimezone": 1
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
          "fromName": "",
          "fromAddress": "",
          "recordingsLimitMB": 0,
          "recordingsLimitEmail": "",
          "id": 3,
          "domain": {
              "domain": "users.ivozprovider.local",
              "pointsTo": "proxyusers",
              "description": "Minimal proxyusers global domain",
              "id": 1
          },
          "language": {
              "iden": "es",
              "id": 1
          },
          "defaultTimezone": {
              "tz": "Europe\/Madrid",
              "comment": "mainland",
              "id": 1
          }
      }
    """
