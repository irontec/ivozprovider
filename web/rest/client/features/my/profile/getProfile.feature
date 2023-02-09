Feature: Retrieve active calls

  @createSchema
  Scenario: Retrieve company admin profile json
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "my/profile"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      {
          "restricted": false,
          "vpbx": true,
          "residential": false,
          "retail": false,
          "wholesale": false,
          "wholesale": false,
          "billingInfo": true,
          "acls": [],
          "features": [
              "queues",
              "recordings",
              "faxes",
              "friends",
              "conferences"
          ]
      }
    """

  Scenario: Retrieve company admin profile json
    Given I add Residential Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "my/profile"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      {
          "restricted": false,
          "vpbx": false,
          "residential": true,
          "retail": false,
          "wholesale": false,
          "billingInfo": false,
          "acls": [],
          "features": []
      }
    """

  Scenario: Retrieve company admin profile json
    Given I add Retail Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "my/profile"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      {
          "restricted": false,
          "vpbx": false,
          "residential": false,
          "retail": true,
          "wholesale": false,
          "billingInfo": true,
          "acls": [],
          "features": []
      }
    """

  Scenario: Retrieve company admin profile json
    Given I add restricted Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "my/profile"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      {
          "restricted": true,
          "vpbx": true,
          "residential": false,
          "retail": false,
          "wholesale": false,
          "billingInfo": true,
          "acls": [
              {
                  "iden": "_RatingPlanPrices",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "BillableCalls",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "Calendars",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "CalendarPeriods",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "CalendarPeriodsRelSchedules",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "CallACL",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "CallAclRelMatchLists",
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
                  "iden": "CallForwardSettings",
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
                  "iden": "CompanyServices",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "ConditionalRoutes",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "ConditionalRoutesConditions",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "ConditionalRoutesConditionsRelMatchLists",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "ConditionalRoutesConditionsRelSchedules",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "ConditionalRoutesConditionsRelCalendars",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "ConditionalRoutesConditionsRelRouteLocks",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "ConferenceRooms",
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
                  "iden": "Extensions",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "ExternalCallFilters",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "ExternalCallFilterBlackLists",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "ExternalCallFilterRelCalendars",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "ExternalCallFilterRelSchedules",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "ExternalCallFilterWhiteLists",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "FaxesInOut",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "Faxes",
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
                  "iden": "FriendsPatterns",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "HolidayDates",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "HuntGroups",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "HuntGroupMembers",
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
                  "iden": "IVREntries",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "IVRs",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "IVRExcludedExtensions",
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
                  "iden": "Locutions",
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
                  "iden": "MatchLists",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "MatchListPatterns",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "MusicOnHold",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "OutgoingDDIRules",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "OutgoingDDIRulesPatterns",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "PickUpGroups",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "PickUpRelUsers",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "QueueMembers",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "Queues",
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
                  "iden": "Recordings",
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
                  "iden": "RouteLocks",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "Schedules",
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
                  "iden": "TransformationRuleSets",
                  "create": false,
                  "read": true,
                  "update": false,
                  "delete": false
              },
              {
                  "iden": "Users",
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
              }
          ],
          "features": [
              "queues",
              "recordings",
              "faxes",
              "friends",
              "conferences"
          ]
      }
    """
