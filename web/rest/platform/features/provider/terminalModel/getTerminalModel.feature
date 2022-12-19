Feature: Retrieve terminal models
  In order to manage terminal models
  as a super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the terminal models json list
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "terminal_models"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
          {
              "iden": "Generic",
              "name": "Generic SIP Model",
              "description": "Generic SIP Model",
              "genericTemplate": "",
              "specificTemplate": "",
              "id": 1
          },
          {
              "iden": "YealinkT21P_E2",
              "name": "YealinkT21P_E2",
              "description": "",
              "genericTemplate": "#!version:1.0.0.1\naccount.1.enable = 1\naccount.1.label = Line\n\nauto_provision.mode = 6\nauto_provision.schedule.periodic_minute = 1\nauto_provision.server.url = https://domain:1443/provision/t21E2\nauto_provision.dhcp_option.enable = 0\nauto_provision.pnp_enable = 0\n\nsecurity.trust_certificates = 0",
              "specificTemplate": "#!version:1.0.0.1\naccount.1.user_name = <?php echo $this->terminal->getName(); ?> \naccount.1.auth_name = <?php echo $this->terminal->getName(); ?> \naccount.1.password = <?php echo $this->terminal->getPassword(); ?> \naccount.1.display_name = <?php echo $this->user->getName(); ?> \naccount.1.label = <?php echo $this->user->getName(); ?> \naccount.1.sip_server_host = <?php echo $this->company->getDomainUsers(); ?> \naccount.1.sip_server_port = 5060 \n\nlang.gui = <?php echo $this->language->getNameEn(); ?>\nlang.wui = <?php echo $this->language->getNameEn(); ?>\n",
              "id": 2
          }
      ]
    """

  Scenario: Retrieve certain terminal model json
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "terminal_models/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
          "iden": "Generic",
          "name": "Generic SIP Model",
          "description": "Generic SIP Model",
          "genericTemplate": "",
          "specificTemplate": "",
          "genericUrlPattern": "",
          "specificUrlPattern": "",
          "id": 1,
          "terminalManufacturer": {
              "iden": "Generic",
              "name": "Generic SIP Manufacturer",
              "description": "Generic SIP Manufacturer",
              "id": 1
          }
      }
    """
