Feature: Create invoice templates
  In order to manage invoice templates
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create an invoice template
    Given I add Brand Authorization header
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "POST" request to "/invoice_templates" with body:
    """
      {
          "name": "New",
          "description": "Description",
          "template": "body",
          "templateHeader": "header",
          "templateFooter": "footer"
      }
    """
    Then the response status code should be 201
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
          "name": "New",
          "description": "Description",
          "template": "body",
          "templateHeader": "header",
          "templateFooter": "footer",
          "id": 2,
          "brand": 1
      }
    """

  Scenario: Retrieve created invoice templates
    Given I add Brand Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "invoice_templates/2"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be like:
    """
      {
          "name": "New",
          "description": "Description",
          "template": "body",
          "templateHeader": "header",
          "templateFooter": "footer",
          "id": 2,
          "brand": "~"
      }
    """
