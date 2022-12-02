Feature: Using SymfonyExtension

  Scenario: Checking the service is serving provision
    When I go to "/y000000000052.cfg"
    Then the response status code should be 200