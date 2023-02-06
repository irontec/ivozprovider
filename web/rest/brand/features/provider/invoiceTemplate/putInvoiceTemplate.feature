Feature: Update invoice templates
  In order to manage invoice templates
  As a brand admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update an invoice template
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/invoice_templates/1" with body:
    """
      {
          "name": "Updated",
          "description": "updated something",
          "template": "body v2",
          "templateHeader": "header v2",
          "templateFooter": "footer v2"
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be like:
    """
     {
          "name": "Updated",
          "description": "updated something",
          "template": "body v2",
          "templateHeader": "header v2",
          "templateFooter": "footer v2",
          "id": 1,
          "global": false
      }
    """

  Scenario: Can not update a global invoice template
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/invoice_templates/2" with body:
    """
      {
          "name": "Updated",
          "description": "updated global invoice template",
          "template": "global body updated",
          "templateHeader": "global header updated",
          "templateFooter": "global footer updated"
      }
    """
    Then the response status code should be 403
