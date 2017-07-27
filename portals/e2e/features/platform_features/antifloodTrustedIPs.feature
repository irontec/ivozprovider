@platform
@antifloodTrustedIPs
@kamPikeTrusted

Feature: Brand admin page
  As a main operator
  I want to be able to access kam pike trusted admin page
  In order to check and manage them

Background:
  Given I go to the admin page
  And I send valid admin credentials
  Then I am logged in
  Given I click on "KamPikeTrusted" CTA
  Then I am on "KamPikeTrusted" list

Scenario: I can save brands
  Given I can see at least one row
  And I click on "KamPikeTrusted" first elements edit button
  And I click on save button
  Then I can see confirmation dialog
  Given I click on close dialog button
  Then I am on "KamPikeTrusted" list

Scenario: I see new brand admin page
  Given I click on add button
  And I click on close button
  Then I am on "KamPikeTrusted" list

Scenario: I can click on delete brand button
  Given I can see at least one row
  And I click on "KamPikeTrusted" first elements delete button
  Then I can see confirmation dialog
  Given I click on close dialog button
  Then I am on "KamPikeTrusted" list
