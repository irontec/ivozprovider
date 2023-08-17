Feature: Retrieve active calls

  @createSchema
  Scenario: Retrieve company admin profile json
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "my/profile"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "restricted": false,
          "acls": [],
          "features": [
              "queues",
              "recordings",
              "faxes",
              "friends",
              "conferences",
              "billing",
              "invoices"
          ]
      }
      """

  Scenario: Retrieve brand admin profile json
    Given I add restricted Brand Authorization header
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
                  "iden": "CallCsvSchedulers",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "CallCsvReports",
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
                  "iden": "DDIs",
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
                  "iden": "FeaturesRelCompanies",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "Friends",
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
                  "iden": "NotificationTemplates",
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
                  "iden": "RatingProfiles",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "ResidentialDevices",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "RetailAccounts",
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
                  "iden": "Terminals",
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
                  "iden": "TransformationRuleSets",
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
                  "iden": "_RegistrationSummary",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "_DdiProviderRegistrationStatus",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "_RegistrationStatus",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "kam_users_address",
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
                  "iden": "BalanceNotifications",
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
                  "iden": "Carriers",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "CarrierServers",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "Currencies",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "DDIProviderAddresses",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "DDIProviders",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "DDIProviderRegistrations",
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
                  "iden": "DestinationRates",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "DestinationRateGroups",
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
                  "iden": "FixedCosts",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "FixedCostsRelInvoices",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "FixedCostsRelInvoiceSchedulers",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "InvoiceNumberSequences",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "InvoiceSchedulers",
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
                  "iden": "NotificationTemplatesContents",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "OutgoingRouting",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "RatingPlans",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "RoutingPatternGroups",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "RoutingPatternGroupsRelPatterns",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "RoutingPatterns",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "RoutingTags",
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
                  "iden": "TransformationRules",
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
              }
          ],
          "features": [
              "queues",
              "recordings",
              "faxes",
              "friends",
              "conferences",
              "billing",
              "invoices"
          ]
      }
      """
