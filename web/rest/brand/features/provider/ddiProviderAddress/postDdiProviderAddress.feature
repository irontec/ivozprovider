Feature: Create ddi provider addresses
  In order to manage ddi provider addresses
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a ddi provider addresses
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/ddi_provider_addresses" with body:
    """
      {
          "ip": "1.1.1.1",
          "description": "NewDDIProviderAddress",
          "ddiProvider": 1
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "ip": "1.1.1.1",
          "description": "NewDDIProviderAddress",
          "id": 2,
          "ddiProvider": 1
      }
    """

  Scenario: Retrieve created ddi provider address
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "/ddi_provider_addresses/2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "ip": "1.1.1.1",
          "description": "NewDDIProviderAddress",
          "id": 2,
          "ddiProvider": {
              "description": "DDIProviderDescription",
              "name": "DDIProviderName",
              "id": 1,
              "brand": 1,
              "transformationRuleSet": 1
          }
      }
    """
