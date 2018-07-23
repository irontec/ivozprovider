  Feature: Create invoice number sequences
  In order to manage invoice number sequences
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create an invoice number sequence
    Given I add Authorization header
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "POST" request to "/invoice_number_sequences" with body:
    """
      {
          "name": "Identifier",
          "prefix": "test",
          "sequenceLength": 4,
          "increment": 1,
          "version": 0,
          "brand": "1"
      }
    """
    Then the response status code should be 201
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
          "name": "Identifier",
          "latestValue": "",
          "id": 2
      }
    """

  Scenario: Retrieve created invoice number sequences
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "invoice_number_sequences/2"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be like:
    """
      {
          "name": "Identifier",
          "prefix": "test",
          "sequenceLength": 4,
          "increment": 1,
          "latestValue": "",
          "iteration": 0,
          "version": 1,
          "id": 2,
          "brand": "~"
      }
    """
