Feature: Manage administrator rel public entities
  In order to manage administrator rel public entities
  as a super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the administrator rel public entities json list
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "administrator_rel_public_entities"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      [
          {
              "create": true,
              "read": true,
              "update": true,
              "delete": true,
              "id": 2,
              "administrator": {
                  "username": "test_company_admin",
                  "pass": "****",
                  "email": "test@irontec.com",
                  "active": true,
                  "restricted": false,
                  "name": "Admin Name",
                  "lastname": "Admin Lastname",
                  "id": 4,
                  "company": 1,
                  "timezone": 145
              },
              "publicEntity": {
                  "iden": "PublicEntitys",
                  "fqdn": "Ivoz\\Provider\\Domain\\Model\\PublicEntity\\PublicEntity",
                  "platform": true,
                  "brand": true,
                  "client": true,
                  "id": 2,
                  "name": {
                      "en": "PublicEntitys",
                      "es": "PublicEntitys",
                      "ca": "PublicEntitys",
                      "it": "PublicEntitys"
                  }
              }
          },
          {
              "create": true,
              "read": true,
              "update": true,
              "delete": true,
              "id": 8,
              "administrator": {
                  "username": "test_company_admin",
                  "pass": "****",
                  "email": "test@irontec.com",
                  "active": true,
                  "restricted": false,
                  "name": "Admin Name",
                  "lastname": "Admin Lastname",
                  "id": 4,
                  "company": 1,
                  "timezone": 145
              },
              "publicEntity": {
                  "iden": "CallCsvSchedulers",
                  "fqdn": "Ivoz\\Provider\\Domain\\Model\\CallCsvScheduler\\CallCsvScheduler",
                  "platform": false,
                  "brand": true,
                  "client": true,
                  "id": 8,
                  "name": {
                      "en": "CallCsvSchedulers",
                      "es": "CallCsvSchedulers",
                      "ca": "CallCsvSchedulers",
                      "it": "CallCsvSchedulers"
                  }
              }
          },
          {
              "create": true,
              "read": true,
              "update": true,
              "delete": true,
              "id": 9,
              "administrator": {
                  "username": "test_company_admin",
                  "pass": "****",
                  "email": "test@irontec.com",
                  "active": true,
                  "restricted": false,
                  "name": "Admin Name",
                  "lastname": "Admin Lastname",
                  "id": 4,
                  "company": 1,
                  "timezone": 145
              },
              "publicEntity": {
                  "iden": "CallCsvReports",
                  "fqdn": "Ivoz\\Provider\\Domain\\Model\\CallCsvReport\\CallCsvReport",
                  "platform": false,
                  "brand": true,
                  "client": true,
                  "id": 9,
                  "name": {
                      "en": "CallCsvReports",
                      "es": "CallCsvReports",
                      "ca": "CallCsvReports",
                      "it": "CallCsvReports"
                  }
              }
          },
          {
              "create": true,
              "read": true,
              "update": true,
              "delete": true,
              "id": 11,
              "administrator": {
                  "username": "test_company_admin",
                  "pass": "****",
                  "email": "test@irontec.com",
                  "active": true,
                  "restricted": false,
                  "name": "Admin Name",
                  "lastname": "Admin Lastname",
                  "id": 4,
                  "company": 1,
                  "timezone": 145
              },
              "publicEntity": {
                  "iden": "Companies",
                  "fqdn": "Ivoz\\Provider\\Domain\\Model\\Company\\Company",
                  "platform": true,
                  "brand": true,
                  "client": true,
                  "id": 11,
                  "name": {
                      "en": "Companies",
                      "es": "Companies",
                      "ca": "Companies",
                      "it": "Companies"
                  }
              }
          },
          {
              "create": true,
              "read": true,
              "update": true,
              "delete": true,
              "id": 20,
              "administrator": {
                  "username": "test_company_admin",
                  "pass": "****",
                  "email": "test@irontec.com",
                  "active": true,
                  "restricted": false,
                  "name": "Admin Name",
                  "lastname": "Admin Lastname",
                  "id": 4,
                  "company": 1,
                  "timezone": 145
              },
              "publicEntity": {
                  "iden": "Countries",
                  "fqdn": "Ivoz\\Provider\\Domain\\Model\\Country\\Country",
                  "platform": true,
                  "brand": true,
                  "client": true,
                  "id": 20,
                  "name": {
                      "en": "Countries",
                      "es": "Countries",
                      "ca": "Countries",
                      "it": "Countries"
                  }
              }
          },
          {
              "create": true,
              "read": true,
              "update": true,
              "delete": true,
              "id": 21,
              "administrator": {
                  "username": "test_company_admin",
                  "pass": "****",
                  "email": "test@irontec.com",
                  "active": true,
                  "restricted": false,
                  "name": "Admin Name",
                  "lastname": "Admin Lastname",
                  "id": 4,
                  "company": 1,
                  "timezone": 145
              },
              "publicEntity": {
                  "iden": "DDIs",
                  "fqdn": "Ivoz\\Provider\\Domain\\Model\\Ddi\\Ddi",
                  "platform": false,
                  "brand": true,
                  "client": true,
                  "id": 21,
                  "name": {
                      "en": "DDIs",
                      "es": "DDIs",
                      "ca": "DDIs",
                      "it": "DDIs"
                  }
              }
          },
          {
              "create": true,
              "read": true,
              "update": true,
              "delete": true,
              "id": 30,
              "administrator": {
                  "username": "test_company_admin",
                  "pass": "****",
                  "email": "test@irontec.com",
                  "active": true,
                  "restricted": false,
                  "name": "Admin Name",
                  "lastname": "Admin Lastname",
                  "id": 4,
                  "company": 1,
                  "timezone": 145
              },
              "publicEntity": {
                  "iden": "Features",
                  "fqdn": "Ivoz\\Provider\\Domain\\Model\\Feature\\Feature",
                  "platform": true,
                  "brand": true,
                  "client": true,
                  "id": 30,
                  "name": {
                      "en": "Features",
                      "es": "Features",
                      "ca": "Features",
                      "it": "Features"
                  }
              }
          },
          {
              "create": true,
              "read": true,
              "update": true,
              "delete": true,
              "id": 31,
              "administrator": {
                  "username": "test_company_admin",
                  "pass": "****",
                  "email": "test@irontec.com",
                  "active": true,
                  "restricted": false,
                  "name": "Admin Name",
                  "lastname": "Admin Lastname",
                  "id": 4,
                  "company": 1,
                  "timezone": 145
              },
              "publicEntity": {
                  "iden": "FeaturesRelCompanies",
                  "fqdn": "Ivoz\\Provider\\Domain\\Model\\FeaturesRelCompany\\FeaturesRelCompany",
                  "platform": false,
                  "brand": true,
                  "client": true,
                  "id": 31,
                  "name": {
                      "en": "FeaturesRelCompanies",
                      "es": "FeaturesRelCompanies",
                      "ca": "FeaturesRelCompanies",
                      "it": "FeaturesRelCompanies"
                  }
              }
          },
          {
              "create": true,
              "read": true,
              "update": true,
              "delete": true,
              "id": 32,
              "administrator": {
                  "username": "test_company_admin",
                  "pass": "****",
                  "email": "test@irontec.com",
                  "active": true,
                  "restricted": false,
                  "name": "Admin Name",
                  "lastname": "Admin Lastname",
                  "id": 4,
                  "company": 1,
                  "timezone": 145
              },
              "publicEntity": {
                  "iden": "Friends",
                  "fqdn": "Ivoz\\Provider\\Domain\\Model\\Friend\\Friend",
                  "platform": false,
                  "brand": true,
                  "client": true,
                  "id": 32,
                  "name": {
                      "en": "Friends",
                      "es": "Friends",
                      "ca": "Friends",
                      "it": "Friends"
                  }
              }
          },
          {
              "create": true,
              "read": true,
              "update": true,
              "delete": true,
              "id": 37,
              "administrator": {
                  "username": "test_company_admin",
                  "pass": "****",
                  "email": "test@irontec.com",
                  "active": true,
                  "restricted": false,
                  "name": "Admin Name",
                  "lastname": "Admin Lastname",
                  "id": 4,
                  "company": 1,
                  "timezone": 145
              },
              "publicEntity": {
                  "iden": "Invoices",
                  "fqdn": "Ivoz\\Provider\\Domain\\Model\\Invoice\\Invoice",
                  "platform": true,
                  "brand": true,
                  "client": true,
                  "id": 37,
                  "name": {
                      "en": "Invoices",
                      "es": "Invoices",
                      "ca": "Invoices",
                      "it": "Invoices"
                  }
              }
          },
          {
              "create": true,
              "read": true,
              "update": true,
              "delete": true,
              "id": 41,
              "administrator": {
                  "username": "test_company_admin",
                  "pass": "****",
                  "email": "test@irontec.com",
                  "active": true,
                  "restricted": false,
                  "name": "Admin Name",
                  "lastname": "Admin Lastname",
                  "id": 4,
                  "company": 1,
                  "timezone": 145
              },
              "publicEntity": {
                  "iden": "Languages",
                  "fqdn": "Ivoz\\Provider\\Domain\\Model\\Language\\Language",
                  "platform": true,
                  "brand": true,
                  "client": true,
                  "id": 41,
                  "name": {
                      "en": "Languages",
                      "es": "Languages",
                      "ca": "Languages",
                      "it": "Languages"
                  }
              }
          },
          {
              "create": true,
              "read": true,
              "update": true,
              "delete": true,
              "id": 43,
              "administrator": {
                  "username": "test_company_admin",
                  "pass": "****",
                  "email": "test@irontec.com",
                  "active": true,
                  "restricted": false,
                  "name": "Admin Name",
                  "lastname": "Admin Lastname",
                  "id": 4,
                  "company": 1,
                  "timezone": 145
              },
              "publicEntity": {
                  "iden": "NotificationTemplates",
                  "fqdn": "Ivoz\\Provider\\Domain\\Model\\NotificationTemplate\\NotificationTemplate",
                  "platform": false,
                  "brand": true,
                  "client": true,
                  "id": 43,
                  "name": {
                      "en": "NotificationTemplates",
                      "es": "NotificationTemplates",
                      "ca": "NotificationTemplates",
                      "it": "NotificationTemplates"
                  }
              }
          },
          {
              "create": true,
              "read": true,
              "update": true,
              "delete": true,
              "id": 53,
              "administrator": {
                  "username": "test_company_admin",
                  "pass": "****",
                  "email": "test@irontec.com",
                  "active": true,
                  "restricted": false,
                  "name": "Admin Name",
                  "lastname": "Admin Lastname",
                  "id": 4,
                  "company": 1,
                  "timezone": 145
              },
              "publicEntity": {
                  "iden": "RatingPlanGroups",
                  "fqdn": "Ivoz\\Provider\\Domain\\Model\\RatingPlanGroup\\RatingPlanGroup",
                  "platform": true,
                  "brand": true,
                  "client": true,
                  "id": 53,
                  "name": {
                      "en": "RatingPlanGroups",
                      "es": "RatingPlanGroups",
                      "ca": "RatingPlanGroups",
                      "it": "RatingPlanGroups"
                  }
              }
          },
          {
              "create": true,
              "read": true,
              "update": true,
              "delete": true,
              "id": 54,
              "administrator": {
                  "username": "test_company_admin",
                  "pass": "****",
                  "email": "test@irontec.com",
                  "active": true,
                  "restricted": false,
                  "name": "Admin Name",
                  "lastname": "Admin Lastname",
                  "id": 4,
                  "company": 1,
                  "timezone": 145
              },
              "publicEntity": {
                  "iden": "RatingProfiles",
                  "fqdn": "Ivoz\\Provider\\Domain\\Model\\RatingProfile\\RatingProfile",
                  "platform": false,
                  "brand": true,
                  "client": true,
                  "id": 54,
                  "name": {
                      "en": "RatingProfiles",
                      "es": "RatingProfiles",
                      "ca": "RatingProfiles",
                      "it": "RatingProfiles"
                  }
              }
          },
          {
              "create": true,
              "read": true,
              "update": true,
              "delete": true,
              "id": 56,
              "administrator": {
                  "username": "test_company_admin",
                  "pass": "****",
                  "email": "test@irontec.com",
                  "active": true,
                  "restricted": false,
                  "name": "Admin Name",
                  "lastname": "Admin Lastname",
                  "id": 4,
                  "company": 1,
                  "timezone": 145
              },
              "publicEntity": {
                  "iden": "ResidentialDevices",
                  "fqdn": "Ivoz\\Provider\\Domain\\Model\\ResidentialDevice\\ResidentialDevice",
                  "platform": false,
                  "brand": true,
                  "client": true,
                  "id": 56,
                  "name": {
                      "en": "ResidentialDevices",
                      "es": "ResidentialDevices",
                      "ca": "ResidentialDevices",
                      "it": "ResidentialDevices"
                  }
              }
          },
          {
              "create": true,
              "read": true,
              "update": true,
              "delete": true,
              "id": 57,
              "administrator": {
                  "username": "test_company_admin",
                  "pass": "****",
                  "email": "test@irontec.com",
                  "active": true,
                  "restricted": false,
                  "name": "Admin Name",
                  "lastname": "Admin Lastname",
                  "id": 4,
                  "company": 1,
                  "timezone": 145
              },
              "publicEntity": {
                  "iden": "RetailAccounts",
                  "fqdn": "Ivoz\\Provider\\Domain\\Model\\RetailAccount\\RetailAccount",
                  "platform": false,
                  "brand": true,
                  "client": true,
                  "id": 57,
                  "name": {
                      "en": "RetailAccounts",
                      "es": "RetailAccounts",
                      "ca": "RetailAccounts",
                      "it": "RetailAccounts"
                  }
              }
          },
          {
              "create": true,
              "read": true,
              "update": true,
              "delete": true,
              "id": 60,
              "administrator": {
                  "username": "test_company_admin",
                  "pass": "****",
                  "email": "test@irontec.com",
                  "active": true,
                  "restricted": false,
                  "name": "Admin Name",
                  "lastname": "Admin Lastname",
                  "id": 4,
                  "company": 1,
                  "timezone": 145
              },
              "publicEntity": {
                  "iden": "Services",
                  "fqdn": "Ivoz\\Provider\\Domain\\Model\\Service\\Service",
                  "platform": true,
                  "brand": true,
                  "client": true,
                  "id": 60,
                  "name": {
                      "en": "Services",
                      "es": "Services",
                      "ca": "Services",
                      "it": "Services"
                  }
              }
          },
          {
              "create": true,
              "read": true,
              "update": true,
              "delete": true,
              "id": 61,
              "administrator": {
                  "username": "test_company_admin",
                  "pass": "****",
                  "email": "test@irontec.com",
                  "active": true,
                  "restricted": false,
                  "name": "Admin Name",
                  "lastname": "Admin Lastname",
                  "id": 4,
                  "company": 1,
                  "timezone": 145
              },
              "publicEntity": {
                  "iden": "Terminals",
                  "fqdn": "Ivoz\\Provider\\Domain\\Model\\Terminal\\Terminal",
                  "platform": false,
                  "brand": true,
                  "client": true,
                  "id": 61,
                  "name": {
                      "en": "Terminals",
                      "es": "Terminals",
                      "ca": "Terminals",
                      "it": "Terminals"
                  }
              }
          },
          {
              "create": true,
              "read": true,
              "update": true,
              "delete": true,
              "id": 63,
              "administrator": {
                  "username": "test_company_admin",
                  "pass": "****",
                  "email": "test@irontec.com",
                  "active": true,
                  "restricted": false,
                  "name": "Admin Name",
                  "lastname": "Admin Lastname",
                  "id": 4,
                  "company": 1,
                  "timezone": 145
              },
              "publicEntity": {
                  "iden": "Timezones",
                  "fqdn": "Ivoz\\Provider\\Domain\\Model\\Timezone\\Timezone",
                  "platform": true,
                  "brand": true,
                  "client": true,
                  "id": 63,
                  "name": {
                      "en": "Timezones",
                      "es": "Timezones",
                      "ca": "Timezones",
                      "it": "Timezones"
                  }
              }
          },
          {
              "create": true,
              "read": true,
              "update": true,
              "delete": true,
              "id": 64,
              "administrator": {
                  "username": "test_company_admin",
                  "pass": "****",
                  "email": "test@irontec.com",
                  "active": true,
                  "restricted": false,
                  "name": "Admin Name",
                  "lastname": "Admin Lastname",
                  "id": 4,
                  "company": 1,
                  "timezone": 145
              },
              "publicEntity": {
                  "iden": "TransformationRuleSets",
                  "fqdn": "Ivoz\\Provider\\Domain\\Model\\TransformationRuleSet\\TransformationRuleSet",
                  "platform": false,
                  "brand": true,
                  "client": true,
                  "id": 64,
                  "name": {
                      "en": "TransformationRuleSets",
                      "es": "TransformationRuleSets",
                      "ca": "TransformationRuleSets",
                      "it": "TransformationRuleSets"
                  }
              }
          }
      ]
    """

  Scenario: Retrieve certain administrator rel public entities json
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "administrator_rel_public_entities/64"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      {
          "create": true,
          "read": true,
          "update": true,
          "delete": true,
          "id": 64,
          "administrator": {
              "username": "test_company_admin",
              "pass": "****",
              "email": "test@irontec.com",
              "active": true,
              "restricted": false,
              "name": "Admin Name",
              "lastname": "Admin Lastname",
              "id": 4,
              "company": 1,
              "timezone": 145
          },
          "publicEntity": {
              "iden": "TransformationRuleSets",
              "fqdn": "Ivoz\\Provider\\Domain\\Model\\TransformationRuleSet\\TransformationRuleSet",
              "platform": false,
              "brand": true,
              "client": true,
              "id": 64,
              "name": {
                  "en": "TransformationRuleSets",
                  "es": "TransformationRuleSets",
                  "ca": "TransformationRuleSets",
                  "it": "TransformationRuleSets"
              }
          }
      }
    """
