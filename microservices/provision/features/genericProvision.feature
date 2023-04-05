Feature: Generic Provision
  In order to provision a terminal with a generic provision config
  as a terminal
  I need to get my terminal model generic configuration based on requested url

  @createSchema
  Scenario: Get generic provision
    When I go to "/y000000000052.cfg"
    Then the response status code should be 200
    And the response should be equal to:
    """
    account.1.enable = 1
    account.1.label = Line

    auto_provision.mode = 6
    auto_provision.schedule.periodic_minute = 1
    auto_provision.server.url = https://domain:1443/provision/t21E2
    auto_provision.dhcp_option.enable = 0
    auto_provision.pnp_enable = 0

    security.trust_certificates = 0
    """

  Scenario: Request unknown terminal model path
    When I go to "/y000000000053.cfg"
    Then the response status code should be 404