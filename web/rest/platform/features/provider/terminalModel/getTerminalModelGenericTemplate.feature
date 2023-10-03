Feature: Test terminal generic template
  In order to test terminal models generic templates
  as a super admin
  I need to be able to run them through the API.

  @createSchema
  Scenario: Test terminal generic template
    Given I add Authorization header
      And "/tmp/storage_path/Provision_template/2/generic.phtml" exists with the content of "/opt/irontec/ivozprovider/microservices/provision/templates/provisioning/YealinkT21P_E2/generic.cfg"
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "terminal_models/2/test_generic_template"
     Then the response status code should be 200
      And the response should be equal to:
      """
      #!version:1.0.0.1
      account.1.enable = 1
      account.1.label = Line

      auto_provision.mode = 6
      auto_provision.schedule.periodic_minute = 1
      auto_provision.server.url = https://unknown.server.name:1443/provision/t21E2
      auto_provision.dhcp_option.enable = 0
      auto_provision.pnp_enable = 0

      local_time.time_zone = +1
      local_time.ntp_server1 = es.pool.ntp.org
      local_time.ntp_server2 =
      local_time.interval = 1000
      local_time.summer_time = 2
      local_time.start_time = 1/1/0
      local_time.end_time = 12/31/23

      security.trust_certificates = 0
      """
