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
                  "iden": "BillableCalls"
              },
              {
                  "iden": "CallCsvSchedulers"
              },
              {
                  "iden": "CallCsvReports"
              },
              {
                  "iden": "Companies"
              },
              {
                  "iden": "Countries"
              },
              {
                  "iden": "DDIs"
              },
              {
                  "iden": "Features"
              },
              {
                  "iden": "FeaturesRelCompanies"
              },
              {
                  "iden": "Friends"
              },
              {
                  "iden": "Invoices"
              },
              {
                  "iden": "Languages"
              },
              {
                  "iden": "NotificationTemplates"
              },
              {
                  "iden": "RatingPlanGroups"
              },
              {
                  "iden": "RatingProfiles"
              },
              {
                  "iden": "ResidentialDevices"
              },
              {
                  "iden": "RetailAccounts"
              },
              {
                  "iden": "Services"
              },
              {
                  "iden": "Terminals"
              },
              {
                  "iden": "Timezones"
              },
              {
                  "iden": "TransformationRuleSets"
              },
              {
                  "iden": "_ActiveCalls"
              },
              {
                  "iden": "_RegistrationSummary"
              },
              {
                  "iden": "_DdiProviderRegistrationStatus"
              },
              {
                  "iden": "_RegistrationStatus"
              },
              {
                  "iden": "kam_users_address"
              },
              {
                  "iden": "Administrators"
              },
              {
                  "iden": "BalanceNotifications"
              },
              {
                  "iden": "Brands"
              },
              {
                  "iden": "BrandServices"
              },
              {
                  "iden": "Carriers"
              },
              {
                  "iden": "CarrierServers"
              },
              {
                  "iden": "Currencies"
              },
              {
                  "iden": "DDIProviderAddresses"
              },
              {
                  "iden": "DDIProviders"
              },
              {
                  "iden": "DDIProviderRegistrations"
              },
              {
                  "iden": "Destinations"
              },
              {
                  "iden": "DestinationRates"
              },
              {
                  "iden": "DestinationRateGroups"
              },
              {
                  "iden": "Domains"
              },
              {
                  "iden": "FeaturesRelBrands"
              },
              {
                  "iden": "FixedCosts"
              },
              {
                  "iden": "FixedCostsRelInvoices"
              },
              {
                  "iden": "FixedCostsRelInvoiceSchedulers"
              },
              {
                  "iden": "InvoiceNumberSequences"
              },
              {
                  "iden": "InvoiceSchedulers"
              },
              {
                  "iden": "InvoiceTemplates"
              },
              {
                  "iden": "NotificationTemplatesContents"
              },
              {
                  "iden": "OutgoingRouting"
              },
              {
                  "iden": "RatingPlans"
              },
              {
                  "iden": "RoutingPatternGroups"
              },
              {
                  "iden": "RoutingPatternGroupsRelPatterns"
              },
              {
                  "iden": "RoutingPatterns"
              },
              {
                  "iden": "RoutingTags"
              },
              {
                  "iden": "SpecialNumbers"
              },
              {
                  "iden": "TransformationRules"
              },
              {
                  "iden": "WebPortals"
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
