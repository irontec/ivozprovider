Feature: Retrieve invoice number sequences
  In order to manage invoice number sequences
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the invoice number sequences json list
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "invoice_number_sequences"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
          {
              "name": "GeneratorName",
              "latestValue": "auto0001",
              "id": 1
          }
      ]
    """

  Scenario: Retrieve certain invoice number sequences json
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "invoice_number_sequences/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be like:
    """
      {
          "name": "GeneratorName",
          "prefix": "auto",
          "sequenceLength": 4,
          "increment": 1,
          "latestValue": "auto0001",
          "iteration": 1,
          "version": 1,
          "id": 1,
          "brand": "~"
      }
    """
