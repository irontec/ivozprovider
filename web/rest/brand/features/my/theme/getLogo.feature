Feature: Retrieve active calls

  @createSchema
  Scenario: Retrieve my domain logo
    Given storage file exists "ivozprovider_model_brandurls.logo/0/2"
      And I send a "GET" request to "/my/logo/2/brand-logo.jpeg"
     Then the response status code should be 200
