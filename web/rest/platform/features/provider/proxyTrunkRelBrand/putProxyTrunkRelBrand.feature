Feature: Update proxy trunks rel brands
  In order to manage proxy trunks rel brands
  as a super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a proxy trunk rel brand
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/proxy_trunks_rel_brands/1" with body:
    """
      {
          "brand": 1,
          "proxyTrunk": 2
      }
    """
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
  """
     {
          "id": 1,
          "brand": 1,
          "proxyTrunk": 2
      }
    """
