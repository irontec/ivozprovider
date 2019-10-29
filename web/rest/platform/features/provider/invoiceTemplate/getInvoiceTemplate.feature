Feature: Retrieve invoice templates
  In order to manage invoice templates
  As a super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the invoice templates json list
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "invoice_templates"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
          {
              "name": "Generic",
              "id": 2
          }
      ]
    """

  Scenario: Retrieve certain invoice templates json
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "invoice_templates/2"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be like:
    """
      {
          "name": "Generic",
          "description": "Generic invoice template",
          "template": "Generic Template body",
          "templateHeader": "Generic Template header",
          "templateFooter": "Generic Template footer",
          "id": 2,
          "brand": null
      }
    """
