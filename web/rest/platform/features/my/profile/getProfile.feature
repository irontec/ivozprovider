Feature: Retrieve active calls

  @createSchema
  Scenario: Retrieve platform admin profile json
    Given I add Platform Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "my/profile"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "restricted": false,
          "acls": []
      }
      """

  Scenario: Retrieve platform admin profile json
    Given I add restricted Platform Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "my/profile"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "restricted": true,
          "acls": [
              {
                  "iden": "BillableCalls",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "Companies",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "Countries",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "Features",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "Invoices",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "Languages",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "RatingPlanGroups",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "Services",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "TerminalModels",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "Timezones",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "_ActiveCalls",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "Administrators",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "Brands",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "BrandServices",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "Destinations",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "Domains",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "FeaturesRelBrands",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "InvoiceTemplates",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "SpecialNumbers",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "WebPortals",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "kam_rtpengine",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "ApplicationServers",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "MediaRelaySets",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "ProxyTrunks",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "ProxyUsers",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "TerminalManufacturers",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              }
          ]
      }
      """
