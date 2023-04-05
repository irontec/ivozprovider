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
                  "iden": "BillableCalls"
              },
              {
                  "iden": "Companies"
              },
              {
                  "iden": "Countries"
              },
              {
                  "iden": "Features"
              },
              {
                  "iden": "Invoices"
              },
              {
                  "iden": "Languages"
              },
              {
                  "iden": "RatingPlanGroups"
              },
              {
                  "iden": "Services"
              },
              {
                  "iden": "TerminalModels"
              },
              {
                  "iden": "Timezones"
              },
              {
                  "iden": "_ActiveCalls"
              },
              {
                  "iden": "Administrators"
              },
              {
                  "iden": "Brands"
              },
              {
                  "iden": "BrandServices"
              },
              {
                  "iden": "Destinations"
              },
              {
                  "iden": "Domains"
              },
              {
                  "iden": "FeaturesRelBrands"
              },
              {
                  "iden": "InvoiceTemplates"
              },
              {
                  "iden": "SpecialNumbers"
              },
              {
                  "iden": "WebPortals"
              },
              {
                  "iden": "kam_rtpengine"
              },
              {
                  "iden": "ApplicationServers"
              },
              {
                  "iden": "MediaRelaySets"
              },
              {
                  "iden": "ProxyTrunks"
              },
              {
                  "iden": "ProxyUsers"
              },
              {
                  "iden": "TerminalManufacturers"
              }
          ]
      }
      """
