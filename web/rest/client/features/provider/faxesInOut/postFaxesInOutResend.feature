Feature: Resend failed faxes
  In order to manage faxes in out
  As a client admin
  I need to be able to resend them through the API.

  @createSchema
  Scenario: Resend failed fax
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/faxes_in_outs/3/resend" with body:
      """
      {}
      """
     Then the response status code should be 200

  @createSchema
  Scenario: Resend fax must fail if status not failed
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/faxes_in_outs/2/resend" with body:
      """
      {}
      """
     Then the response status code should be 400

  @createSchema
  Scenario: Resend fax must fail if type is In
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/faxes_in_outs/1/resend" with body:
      """
      {}
      """
     Then the response status code should be 400
