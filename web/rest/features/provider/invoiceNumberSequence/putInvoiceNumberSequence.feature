Feature: Update invoice number sequences
  In order to manage invoice number sequences
  As an super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update an invoice number sequence
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/invoice_number_sequences/1" with body:
    """
            {
          "name": "GeneratorNameEdited",
          "prefix": "auto",
          "sequenceLength": 4,
          "increment": 1,
          "latestValue": "auto0001",
          "iteration": 1,
          "version": 1,
          "brand": "1"
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be like:
    """
        {
          "name": "GeneratorNameEdited",
          "prefix": "auto",
          "sequenceLength": 4,
          "increment": 1,
          "latestValue": "auto0001",
          "iteration": 1,
          "version": 2,
          "id": 1,
          "brand": "~"
      }
    """
