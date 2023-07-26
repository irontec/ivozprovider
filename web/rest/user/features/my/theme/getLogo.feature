Feature: Retrieve active calls

  @createSchema
  Scenario: Retrieve my domain logo
    Given storage file exists "ivozprovider_model_brandurls.logo/0/4"
      And I send a "GET" request to "/my/logo/4/user-logo.jpeg"
     Then the response status code should be 200
