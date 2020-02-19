Feature: Manage administrator rel public entities
  In order to manage administrator rel public entities
  as a super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the administrator rel public entities json list
    Given I add Authorization header
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
              "id": 66,
              "administrator": {
                  "username": "test_brand_admin",
                  "pass": "****",
                  "email": "nightwatch@irontec.com",
                  "active": true,
                  "restricted": false,
                  "name": "night",
                  "lastname": "watch",
                  "id": 2,
                  "brand": 1,
                  "company": null,
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
              "id": 69,
              "administrator": {
                  "username": "test_brand_admin",
                  "pass": "****",
                  "email": "nightwatch@irontec.com",
                  "active": true,
                  "restricted": false,
                  "name": "night",
                  "lastname": "watch",
                  "id": 2,
                  "brand": 1,
                  "company": null,
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
              "id": 70,
              "administrator": {
                  "username": "test_brand_admin",
                  "pass": "****",
                  "email": "nightwatch@irontec.com",
                  "active": true,
                  "restricted": false,
                  "name": "night",
                  "lastname": "watch",
                  "id": 2,
                  "brand": 1,
                  "company": null,
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
              "id": 72,
              "administrator": {
                  "username": "test_brand_admin",
                  "pass": "****",
                  "email": "nightwatch@irontec.com",
                  "active": true,
                  "restricted": false,
                  "name": "night",
                  "lastname": "watch",
                  "id": 2,
                  "brand": 1,
                  "company": null,
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
              "id": 75,
              "administrator": {
                  "username": "test_brand_admin",
                  "pass": "****",
                  "email": "nightwatch@irontec.com",
                  "active": true,
                  "restricted": false,
                  "name": "night",
                  "lastname": "watch",
                  "id": 2,
                  "brand": 1,
                  "company": null,
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
              "id": 76,
              "administrator": {
                  "username": "test_brand_admin",
                  "pass": "****",
                  "email": "nightwatch@irontec.com",
                  "active": true,
                  "restricted": false,
                  "name": "night",
                  "lastname": "watch",
                  "id": 2,
                  "brand": 1,
                  "company": null,
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
              "id": 78,
              "administrator": {
                  "username": "test_brand_admin",
                  "pass": "****",
                  "email": "nightwatch@irontec.com",
                  "active": true,
                  "restricted": false,
                  "name": "night",
                  "lastname": "watch",
                  "id": 2,
                  "brand": 1,
                  "company": null,
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
              "id": 82,
              "administrator": {
                  "username": "test_brand_admin",
                  "pass": "****",
                  "email": "nightwatch@irontec.com",
                  "active": true,
                  "restricted": false,
                  "name": "night",
                  "lastname": "watch",
                  "id": 2,
                  "brand": 1,
                  "company": null,
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
              "id": 84,
              "administrator": {
                  "username": "test_brand_admin",
                  "pass": "****",
                  "email": "nightwatch@irontec.com",
                  "active": true,
                  "restricted": false,
                  "name": "night",
                  "lastname": "watch",
                  "id": 2,
                  "brand": 1,
                  "company": null,
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
              "id": 86,
              "administrator": {
                  "username": "test_brand_admin",
                  "pass": "****",
                  "email": "nightwatch@irontec.com",
                  "active": true,
                  "restricted": false,
                  "name": "night",
                  "lastname": "watch",
                  "id": 2,
                  "brand": 1,
                  "company": null,
                  "timezone": 145
              },
              "publicEntity": {
                  "iden": "_ActiveCalls",
                  "fqdn": "Model\\ActiveCalls",
                  "platform": true,
                  "brand": true,
                  "client": false,
                  "id": 66,
                  "name": {
                      "en": "_ActiveCalls",
                      "es": "_ActiveCalls",
                      "ca": "_ActiveCalls",
                      "it": "_ActiveCalls"
                  }
              }
          },
          {
              "create": true,
              "read": true,
              "update": true,
              "delete": true,
              "id": 90,
              "administrator": {
                  "username": "test_brand_admin",
                  "pass": "****",
                  "email": "nightwatch@irontec.com",
                  "active": true,
                  "restricted": false,
                  "name": "night",
                  "lastname": "watch",
                  "id": 2,
                  "brand": 1,
                  "company": null,
                  "timezone": 145
              },
              "publicEntity": {
                  "iden": "Administrators",
                  "fqdn": "Ivoz\\Provider\\Domain\\Model\\Administrator\\Administrator",
                  "platform": true,
                  "brand": true,
                  "client": false,
                  "id": 70,
                  "name": {
                      "en": "Administrators",
                      "es": "Administrators",
                      "ca": "Administrators",
                      "it": "Administrators"
                  }
              }
          },
          {
              "create": true,
              "read": true,
              "update": true,
              "delete": true,
              "id": 92,
              "administrator": {
                  "username": "test_brand_admin",
                  "pass": "****",
                  "email": "nightwatch@irontec.com",
                  "active": true,
                  "restricted": false,
                  "name": "night",
                  "lastname": "watch",
                  "id": 2,
                  "brand": 1,
                  "company": null,
                  "timezone": 145
              },
              "publicEntity": {
                  "iden": "Brands",
                  "fqdn": "Ivoz\\Provider\\Domain\\Model\\Brand\\Brand",
                  "platform": true,
                  "brand": true,
                  "client": false,
                  "id": 72,
                  "name": {
                      "en": "Brands",
                      "es": "Brands",
                      "ca": "Brands",
                      "it": "Brands"
                  }
              }
          },
          {
              "create": true,
              "read": true,
              "update": true,
              "delete": true,
              "id": 93,
              "administrator": {
                  "username": "test_brand_admin",
                  "pass": "****",
                  "email": "nightwatch@irontec.com",
                  "active": true,
                  "restricted": false,
                  "name": "night",
                  "lastname": "watch",
                  "id": 2,
                  "brand": 1,
                  "company": null,
                  "timezone": 145
              },
              "publicEntity": {
                  "iden": "BrandServices",
                  "fqdn": "Ivoz\\Provider\\Domain\\Model\\BrandService\\BrandService",
                  "platform": true,
                  "brand": true,
                  "client": false,
                  "id": 73,
                  "name": {
                      "en": "BrandServices",
                      "es": "BrandServices",
                      "ca": "BrandServices",
                      "it": "BrandServices"
                  }
              }
          },
          {
              "create": true,
              "read": true,
              "update": true,
              "delete": true,
              "id": 100,
              "administrator": {
                  "username": "test_brand_admin",
                  "pass": "****",
                  "email": "nightwatch@irontec.com",
                  "active": true,
                  "restricted": false,
                  "name": "night",
                  "lastname": "watch",
                  "id": 2,
                  "brand": 1,
                  "company": null,
                  "timezone": 145
              },
              "publicEntity": {
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
          },
          {
              "create": true,
              "read": true,
              "update": true,
              "delete": true,
              "id": 103,
              "administrator": {
                  "username": "test_brand_admin",
                  "pass": "****",
                  "email": "nightwatch@irontec.com",
                  "active": true,
                  "restricted": false,
                  "name": "night",
                  "lastname": "watch",
                  "id": 2,
                  "brand": 1,
                  "company": null,
                  "timezone": 145
              },
              "publicEntity": {
                  "iden": "Domains",
                  "fqdn": "Ivoz\\Provider\\Domain\\Model\\Domain\\Domain",
                  "platform": true,
                  "brand": true,
                  "client": false,
                  "id": 83,
                  "name": {
                      "en": "Domains",
                      "es": "Domains",
                      "ca": "Domains",
                      "it": "Domains"
                  }
              }
          },
          {
              "create": true,
              "read": true,
              "update": true,
              "delete": true,
              "id": 104,
              "administrator": {
                  "username": "test_brand_admin",
                  "pass": "****",
                  "email": "nightwatch@irontec.com",
                  "active": true,
                  "restricted": false,
                  "name": "night",
                  "lastname": "watch",
                  "id": 2,
                  "brand": 1,
                  "company": null,
                  "timezone": 145
              },
              "publicEntity": {
                  "iden": "FeaturesRelBrands",
                  "fqdn": "Ivoz\\Provider\\Domain\\Model\\FeaturesRelBrand\\FeaturesRelBrand",
                  "platform": true,
                  "brand": true,
                  "client": false,
                  "id": 84,
                  "name": {
                      "en": "FeaturesRelBrands",
                      "es": "FeaturesRelBrands",
                      "ca": "FeaturesRelBrands",
                      "it": "FeaturesRelBrands"
                  }
              }
          },
          {
              "create": true,
              "read": true,
              "update": true,
              "delete": true,
              "id": 110,
              "administrator": {
                  "username": "test_brand_admin",
                  "pass": "****",
                  "email": "nightwatch@irontec.com",
                  "active": true,
                  "restricted": false,
                  "name": "night",
                  "lastname": "watch",
                  "id": 2,
                  "brand": 1,
                  "company": null,
                  "timezone": 145
              },
              "publicEntity": {
                  "iden": "InvoiceTemplates",
                  "fqdn": "Ivoz\\Provider\\Domain\\Model\\InvoiceTemplate\\InvoiceTemplate",
                  "platform": true,
                  "brand": true,
                  "client": false,
                  "id": 90,
                  "name": {
                      "en": "InvoiceTemplates",
                      "es": "InvoiceTemplates",
                      "ca": "InvoiceTemplates",
                      "it": "InvoiceTemplates"
                  }
              }
          },
          {
              "create": true,
              "read": true,
              "update": true,
              "delete": true,
              "id": 118,
              "administrator": {
                  "username": "test_brand_admin",
                  "pass": "****",
                  "email": "nightwatch@irontec.com",
                  "active": true,
                  "restricted": false,
                  "name": "night",
                  "lastname": "watch",
                  "id": 2,
                  "brand": 1,
                  "company": null,
                  "timezone": 145
              },
              "publicEntity": {
                  "iden": "SpecialNumbers",
                  "fqdn": "Ivoz\\Provider\\Domain\\Model\\SpecialNumber\\SpecialNumber",
                  "platform": true,
                  "brand": true,
                  "client": false,
                  "id": 98,
                  "name": {
                      "en": "SpecialNumbers",
                      "es": "SpecialNumbers",
                      "ca": "SpecialNumbers",
                      "it": "SpecialNumbers"
                  }
              }
          },
          {
              "create": true,
              "read": true,
              "update": true,
              "delete": true,
              "id": 120,
              "administrator": {
                  "username": "test_brand_admin",
                  "pass": "****",
                  "email": "nightwatch@irontec.com",
                  "active": true,
                  "restricted": false,
                  "name": "night",
                  "lastname": "watch",
                  "id": 2,
                  "brand": 1,
                  "company": null,
                  "timezone": 145
              },
              "publicEntity": {
                  "iden": "WebPortals",
                  "fqdn": "Ivoz\\Provider\\Domain\\Model\\WebPortal\\WebPortal",
                  "platform": true,
                  "brand": true,
                  "client": false,
                  "id": 100,
                  "name": {
                      "en": "WebPortals",
                      "es": "WebPortals",
                      "ca": "WebPortals",
                      "it": "WebPortals"
                  }
              }
          },
          {
              "create": true,
              "read": true,
              "update": true,
              "delete": true,
              "id": 121,
              "administrator": {
                  "username": "restrictedBrandAdmin",
                  "pass": "****",
                  "email": "restrictedAdmin@irontec.com",
                  "active": true,
                  "restricted": true,
                  "name": "RestrictedAdmin",
                  "lastname": "Lastname",
                  "id": 6,
                  "brand": 1,
                  "company": null,
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
              "id": 124,
              "administrator": {
                  "username": "restrictedBrandAdmin",
                  "pass": "****",
                  "email": "restrictedAdmin@irontec.com",
                  "active": true,
                  "restricted": true,
                  "name": "RestrictedAdmin",
                  "lastname": "Lastname",
                  "id": 6,
                  "brand": 1,
                  "company": null,
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
              "id": 125,
              "administrator": {
                  "username": "restrictedBrandAdmin",
                  "pass": "****",
                  "email": "restrictedAdmin@irontec.com",
                  "active": true,
                  "restricted": true,
                  "name": "RestrictedAdmin",
                  "lastname": "Lastname",
                  "id": 6,
                  "brand": 1,
                  "company": null,
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
              "id": 127,
              "administrator": {
                  "username": "restrictedBrandAdmin",
                  "pass": "****",
                  "email": "restrictedAdmin@irontec.com",
                  "active": true,
                  "restricted": true,
                  "name": "RestrictedAdmin",
                  "lastname": "Lastname",
                  "id": 6,
                  "brand": 1,
                  "company": null,
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
              "id": 130,
              "administrator": {
                  "username": "restrictedBrandAdmin",
                  "pass": "****",
                  "email": "restrictedAdmin@irontec.com",
                  "active": true,
                  "restricted": true,
                  "name": "RestrictedAdmin",
                  "lastname": "Lastname",
                  "id": 6,
                  "brand": 1,
                  "company": null,
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
              "id": 131,
              "administrator": {
                  "username": "restrictedBrandAdmin",
                  "pass": "****",
                  "email": "restrictedAdmin@irontec.com",
                  "active": true,
                  "restricted": true,
                  "name": "RestrictedAdmin",
                  "lastname": "Lastname",
                  "id": 6,
                  "brand": 1,
                  "company": null,
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
              "id": 133,
              "administrator": {
                  "username": "restrictedBrandAdmin",
                  "pass": "****",
                  "email": "restrictedAdmin@irontec.com",
                  "active": true,
                  "restricted": true,
                  "name": "RestrictedAdmin",
                  "lastname": "Lastname",
                  "id": 6,
                  "brand": 1,
                  "company": null,
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
              "id": 137,
              "administrator": {
                  "username": "restrictedBrandAdmin",
                  "pass": "****",
                  "email": "restrictedAdmin@irontec.com",
                  "active": true,
                  "restricted": true,
                  "name": "RestrictedAdmin",
                  "lastname": "Lastname",
                  "id": 6,
                  "brand": 1,
                  "company": null,
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
              "id": 139,
              "administrator": {
                  "username": "restrictedBrandAdmin",
                  "pass": "****",
                  "email": "restrictedAdmin@irontec.com",
                  "active": true,
                  "restricted": true,
                  "name": "RestrictedAdmin",
                  "lastname": "Lastname",
                  "id": 6,
                  "brand": 1,
                  "company": null,
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
              "id": 141,
              "administrator": {
                  "username": "restrictedBrandAdmin",
                  "pass": "****",
                  "email": "restrictedAdmin@irontec.com",
                  "active": true,
                  "restricted": true,
                  "name": "RestrictedAdmin",
                  "lastname": "Lastname",
                  "id": 6,
                  "brand": 1,
                  "company": null,
                  "timezone": 145
              },
              "publicEntity": {
                  "iden": "_ActiveCalls",
                  "fqdn": "Model\\ActiveCalls",
                  "platform": true,
                  "brand": true,
                  "client": false,
                  "id": 66,
                  "name": {
                      "en": "_ActiveCalls",
                      "es": "_ActiveCalls",
                      "ca": "_ActiveCalls",
                      "it": "_ActiveCalls"
                  }
              }
          },
          {
              "create": true,
              "read": true,
              "update": true,
              "delete": true,
              "id": 145,
              "administrator": {
                  "username": "restrictedBrandAdmin",
                  "pass": "****",
                  "email": "restrictedAdmin@irontec.com",
                  "active": true,
                  "restricted": true,
                  "name": "RestrictedAdmin",
                  "lastname": "Lastname",
                  "id": 6,
                  "brand": 1,
                  "company": null,
                  "timezone": 145
              },
              "publicEntity": {
                  "iden": "Administrators",
                  "fqdn": "Ivoz\\Provider\\Domain\\Model\\Administrator\\Administrator",
                  "platform": true,
                  "brand": true,
                  "client": false,
                  "id": 70,
                  "name": {
                      "en": "Administrators",
                      "es": "Administrators",
                      "ca": "Administrators",
                      "it": "Administrators"
                  }
              }
          }
      ]
    """

  Scenario: Retrieve certain administrator rel public entities json
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "administrator_rel_public_entities/230"
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
          "id": 230,
          "administrator": {
              "username": "irontec",
              "pass": "****",
              "email": "vozip@irontec.com",
              "active": true,
              "restricted": false,
              "name": "irontec",
              "lastname": "ivozprovider",
              "id": 3,
              "brand": null,
              "company": null,
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
      }
    """
