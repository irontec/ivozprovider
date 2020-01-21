@login
@company

Feature: Login
  As an admin user I want to login
  in my admin portal

Scenario: Login error message
  Given I go to the admin page
  And I send invalid admin credentials
  Then I see a login error message

Scenario: Brand admin Login
  Given I go to the brand admin page
  When I send valid brand admin credentials
  Then I am on the Dashboard

Scenario: Brand admin Login error
  Given I go to the admin page
  When I send valid brand admin credentials
  Then I see a login error message

#Scenario: Client admin Login
#  Given I go to the client admin page
#  When I send valid client admin credentials
#  Then I am on the Dashboard

Scenario: Brand admin Login
  Given I go to the admin page
  When I send valid client admin credentials
  Then I see a login error message
