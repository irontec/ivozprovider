Feature: Create domains
  In order to manage domains
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a domain
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/domains" with body:
    """
      {
          "domain": "test.ivozprovider.local",
          "pointsTo": "proxyusers",
          "description": "description"
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "domain": "test.ivozprovider.local",
          "pointsTo": "proxyusers",
          "id": 7
      }
    """

  Scenario: Retrieve created domain
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "domains/4"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      {
          "domain": "sip.irontec.com",
          "pointsTo": "proxyusers",
          "description": "Irontec_e2e proxyusers domain",
          "id": 4
      }
    """
