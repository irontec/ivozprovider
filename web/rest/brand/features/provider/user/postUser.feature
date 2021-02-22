Feature: Create users
  In order to manage users
  As a brand admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Can not create an user
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/users" with body:
    """
      {
      }
    """
    Then the response status code should be 405

  @createSchema
  Scenario: Users mass import
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" multipart request to "/users/mass_import" with body:
        """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="company"

1
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="csv"; filename="massImport.csv"
Content-Type: text/csv

Name,Lastname,name@irontec.com,terminalName,Z7+KJn8m3k,YealinkT21P_E2,a00000000052,2002,ES,946002050,DDIProviderName
John,Doe,jon@irontec.com,terminalName2,Z7+KJn8m3k,YealinkT21P_E2,a00000000053,2003,ES,946002051,DDIProviderName
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
    Then the response status code should be 201
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
          "success": true,
          "errorMsg": "",
          "failed": 0
      }
    """
