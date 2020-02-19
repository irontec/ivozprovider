Feature: Retrieve public entities
  In order to manage public entities
  as a super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the public entities json list
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "public_entities"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      [
          {
              "iden": "PublicEntitys",
              "id": 2,
              "name": {
                  "en": "PublicEntitys",
                  "es": "PublicEntitys",
                  "ca": "PublicEntitys",
                  "it": "PublicEntitys"
              }
          },
          {
              "iden": "CallCsvSchedulers",
              "id": 8,
              "name": {
                  "en": "CallCsvSchedulers",
                  "es": "CallCsvSchedulers",
                  "ca": "CallCsvSchedulers",
                  "it": "CallCsvSchedulers"
              }
          },
          {
              "iden": "CallCsvReports",
              "id": 9,
              "name": {
                  "en": "CallCsvReports",
                  "es": "CallCsvReports",
                  "ca": "CallCsvReports",
                  "it": "CallCsvReports"
              }
          },
          {
              "iden": "Companies",
              "id": 11,
              "name": {
                  "en": "Companies",
                  "es": "Companies",
                  "ca": "Companies",
                  "it": "Companies"
              }
          },
          {
              "iden": "Countries",
              "id": 20,
              "name": {
                  "en": "Countries",
                  "es": "Countries",
                  "ca": "Countries",
                  "it": "Countries"
              }
          },
          {
              "iden": "DDIs",
              "id": 21,
              "name": {
                  "en": "DDIs",
                  "es": "DDIs",
                  "ca": "DDIs",
                  "it": "DDIs"
              }
          },
          {
              "iden": "Features",
              "id": 30,
              "name": {
                  "en": "Features",
                  "es": "Features",
                  "ca": "Features",
                  "it": "Features"
              }
          },
          {
              "iden": "FeaturesRelCompanies",
              "id": 31,
              "name": {
                  "en": "FeaturesRelCompanies",
                  "es": "FeaturesRelCompanies",
                  "ca": "FeaturesRelCompanies",
                  "it": "FeaturesRelCompanies"
              }
          },
          {
              "iden": "Friends",
              "id": 32,
              "name": {
                  "en": "Friends",
                  "es": "Friends",
                  "ca": "Friends",
                  "it": "Friends"
              }
          },
          {
              "iden": "Invoices",
              "id": 37,
              "name": {
                  "en": "Invoices",
                  "es": "Invoices",
                  "ca": "Invoices",
                  "it": "Invoices"
              }
          },
          {
              "iden": "Languages",
              "id": 41,
              "name": {
                  "en": "Languages",
                  "es": "Languages",
                  "ca": "Languages",
                  "it": "Languages"
              }
          },
          {
              "iden": "NotificationTemplates",
              "id": 43,
              "name": {
                  "en": "NotificationTemplates",
                  "es": "NotificationTemplates",
                  "ca": "NotificationTemplates",
                  "it": "NotificationTemplates"
              }
          },
          {
              "iden": "RatingPlanGroups",
              "id": 53,
              "name": {
                  "en": "RatingPlanGroups",
                  "es": "RatingPlanGroups",
                  "ca": "RatingPlanGroups",
                  "it": "RatingPlanGroups"
              }
          },
          {
              "iden": "RatingProfiles",
              "id": 54,
              "name": {
                  "en": "RatingProfiles",
                  "es": "RatingProfiles",
                  "ca": "RatingProfiles",
                  "it": "RatingProfiles"
              }
          },
          {
              "iden": "ResidentialDevices",
              "id": 56,
              "name": {
                  "en": "ResidentialDevices",
                  "es": "ResidentialDevices",
                  "ca": "ResidentialDevices",
                  "it": "ResidentialDevices"
              }
          },
          {
              "iden": "RetailAccounts",
              "id": 57,
              "name": {
                  "en": "RetailAccounts",
                  "es": "RetailAccounts",
                  "ca": "RetailAccounts",
                  "it": "RetailAccounts"
              }
          },
          {
              "iden": "Services",
              "id": 60,
              "name": {
                  "en": "Services",
                  "es": "Services",
                  "ca": "Services",
                  "it": "Services"
              }
          },
          {
              "iden": "Terminals",
              "id": 61,
              "name": {
                  "en": "Terminals",
                  "es": "Terminals",
                  "ca": "Terminals",
                  "it": "Terminals"
              }
          },
          {
              "iden": "Timezones",
              "id": 63,
              "name": {
                  "en": "Timezones",
                  "es": "Timezones",
                  "ca": "Timezones",
                  "it": "Timezones"
              }
          },
          {
              "iden": "TransformationRuleSets",
              "id": 64,
              "name": {
                  "en": "TransformationRuleSets",
                  "es": "TransformationRuleSets",
                  "ca": "TransformationRuleSets",
                  "it": "TransformationRuleSets"
              }
          },
          {
              "iden": "_ActiveCalls",
              "id": 66,
              "name": {
                  "en": "_ActiveCalls",
                  "es": "_ActiveCalls",
                  "ca": "_ActiveCalls",
                  "it": "_ActiveCalls"
              }
          },
          {
              "iden": "_DdiProviderRegistrationStatus",
              "id": 67,
              "name": {
                  "en": "_DdiProviderRegistrationStatus",
                  "es": "_DdiProviderRegistrationStatus",
                  "ca": "_DdiProviderRegistrationStatus",
                  "it": "_DdiProviderRegistrationStatus"
              }
          },
          {
              "iden": "_RegistrationStatus",
              "id": 68,
              "name": {
                  "en": "_RegistrationStatus",
                  "es": "_RegistrationStatus",
                  "ca": "_RegistrationStatus",
                  "it": "_RegistrationStatus"
              }
          },
          {
              "iden": "kam_users_address",
              "id": 69,
              "name": {
                  "en": "kam_users_address",
                  "es": "kam_users_address",
                  "ca": "kam_users_address",
                  "it": "kam_users_address"
              }
          },
          {
              "iden": "Administrators",
              "id": 70,
              "name": {
                  "en": "Administrators",
                  "es": "Administrators",
                  "ca": "Administrators",
                  "it": "Administrators"
              }
          },
          {
              "iden": "BalanceNotifications",
              "id": 71,
              "name": {
                  "en": "BalanceNotifications",
                  "es": "BalanceNotifications",
                  "ca": "BalanceNotifications",
                  "it": "BalanceNotifications"
              }
          },
          {
              "iden": "Brands",
              "id": 72,
              "name": {
                  "en": "Brands",
                  "es": "Brands",
                  "ca": "Brands",
                  "it": "Brands"
              }
          },
          {
              "iden": "BrandServices",
              "id": 73,
              "name": {
                  "en": "BrandServices",
                  "es": "BrandServices",
                  "ca": "BrandServices",
                  "it": "BrandServices"
              }
          },
          {
              "iden": "Carriers",
              "id": 74,
              "name": {
                  "en": "Carriers",
                  "es": "Carriers",
                  "ca": "Carriers",
                  "it": "Carriers"
              }
          },
          {
              "iden": "CarrierServers",
              "id": 75,
              "name": {
                  "en": "CarrierServers",
                  "es": "CarrierServers",
                  "ca": "CarrierServers",
                  "it": "CarrierServers"
              }
          }
      ]
    """

  Scenario: Retrieve certain feature json
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "public_entities/80"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      {
          "iden": "Destinations",
          "fqdn": "Ivoz\\Provider\\Domain\\Model\\Destination\\Destination",
          "platform": true,
          "brand": true,
          "client": false,
          "id": 80,
          "name": {
              "en": "Destinations",
              "es": "Destinations",
              "ca": "Destinations",
              "it": "Destinations"
          }
      }
    """
