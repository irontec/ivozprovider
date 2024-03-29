Feature: Update invoice templates
  In order to manage invoice templates
  as a super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update an invoice template
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/invoice_templates/2" with body:
      """
      {
        "name": "Updated Invoice",
        "description": "Updated Invoice Description",
        "template": "Updated Template",
        "templateHeader": "Updated Template Header",
        "templateFooter": "Updated Template Footer"
      }
      """
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "name": "Updated Invoice",
          "description": "Updated Invoice Description",
          "template": "Updated Template",
          "templateHeader": "Updated Template Header",
          "templateFooter": "Updated Template Footer",
          "id": 2,
          "brand": null
      }
      """
