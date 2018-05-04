@login
@platform

Feature: Login
  As an admin user
  I want to ensure that login error
  messages are properly shown

Scenario: Login error message
  Given I go to the admin page
  And I send invalid admin credentials
  Then I see a login error message
