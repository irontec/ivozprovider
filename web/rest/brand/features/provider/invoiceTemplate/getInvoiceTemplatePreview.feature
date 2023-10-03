Feature: Preview invoice templates
  In order to preview invoice templates
  As a brand admin
  I need to be able to preview them through the API.

  @createSchema
  Scenario: Preview the invoice templates
    Given I add Brand Authorization header
      And I send a "GET" request to "invoice_templates/2/preview"
     Then the response status code should be 200
      And the header "Content-Type" should be equal to "application/pdf"
