@platform
@kamAccCdrs

Feature: Billable calls admin page
  As a main operator
  I want to be able to access billable calls admin page
  In order to check and manage them

Background:
  Given I go to the admin page
  And I send valid admin credentials
  Then I am logged in
  Given I click on "KamAccCdrs" CTA
  Then I am on "KamAccCdrs" list

Scenario: I can see billable calls
  Given I can see at least one row
  And I click on "KamAccCdrs" first elements view button
  And I click on close button
  Then I am on "KamAccCdrs" list
