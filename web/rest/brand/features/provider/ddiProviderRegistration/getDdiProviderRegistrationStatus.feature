Feature: Retrieve ddi provider registrations
  In order to manage ddi provider registrations
  As a brand admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve ddi provider address status json
    Given I add Brand Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "ddi_provider_registrations/1/status"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
        "username": "DDIRegistrationUsername",
        "domain": "DDIRegistrationDomain",
        "id": 1,
        "status": {
            "registered": false,
            "inProgress": false,
            "expires": null
        }
      }
    """