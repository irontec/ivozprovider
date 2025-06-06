Feature: Specific Provision
  In order to provision a terminal with a specific provision config
  as a terminal
  I need to get my specific configuration based on the mac sent within the url

  @createSchema
  Scenario: Checking the service is serving specific provision with subpath
    When I go to "https://ivozprovider:1443/optional_subpath/0011223344bb"
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

    account.1.sip_server.2.host = survival1.test.com
    account.1.sip_server.2.port = 10081
    """

  Scenario: Specific provision without subpath
    When I go to "https://ivozprovider:1443/0011223344bb"
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

    account.1.sip_server.2.host = survival1.test.com
    account.1.sip_server.2.port = 10081
    """

  Scenario: Request unknown terminal MAC
    When I go to "https://ivozprovider:1443/optional_subpath/0011223344zz"
    Then the response status code should be 404
