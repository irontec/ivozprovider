Feature: Test terminal specific template
  In order to test terminal models specific templates
  as a super admin
  I need to be able to run them through the API.

  @createSchema
  Scenario: Test terminal generic template
    Given I add Authorization header
      And "/tmp/storage_path/Provision_template/2/specific.phtml" exists with the content of "/opt/irontec/ivozprovider/microservices/provision/templates/provisioning/YealinkT21P_E2/specific.cfg"
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "terminal_models/2/test_specific_template?mac=0011223344bb"
     Then the response status code should be 200
      And the response should be equal to:
      """
      #!version:1.0.0.1
      account.1.user_name = testTerminal4
      account.1.auth_name = testTerminal4
      account.1.password = fLgQYa6-57
      account.1.display_name = Joe
      account.1.label = Joe
      account.1.sip_server_host = 127.0.0.1
      account.1.sip_server_port = 5060

      lang.gui = es
      lang.wui = es
      """
