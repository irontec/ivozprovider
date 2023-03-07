Feature: Create invoice templates
  In order to manage invoice templates
  as a super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create an invoice template
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/invoice_templates" with body:
      """
      {
        "name": "New Invoice",
        "description": "New Invoice Description",
        "template": "New Template",
        "templateHeader": "New Template Header",
        "templateFooter": "New Template Footer"
      }
      """
     Then the response status code should be 201
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "name": "New Invoice",
          "description": "New Invoice Description",
          "template": "New Template",
          "templateHeader": "New Template Header",
          "templateFooter": "New Template Footer",
          "id": 3,
          "brand": null
      }
      """

  Scenario: Retrieve created invoice template
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "invoice_templates/3"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "name": "New Invoice",
          "description": "New Invoice Description",
          "template": "New Template",
          "templateHeader": "New Template Header",
          "templateFooter": "New Template Footer",
          "id": 3,
          "brand": null
      }
      """
