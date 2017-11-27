@company
@holidayDates
@company10

Feature: Calendar holiday dates admin page
  As a main operator
  I want to be able to access calendars admin page
  emulating brand operator
  emulating company operator
  In order to check and manage them

Background:
  Given I go to the admin page
   When I send valid admin credentials
   Then I am logged in
   When I click on brand emulation button
    And I emulate the brand at position "1"
    And I click on company emulation button
    And I emulate the company at position "1"
    And I click on "Calendars" CTA
   Then I am on "Calendars" list
   When I click on "Calendars" first elements "holidayDates" button
   Then I am on "CalendarsList_holidayDates" subscreen list

Scenario: I create calendar holiday dates
  When I click on add button
   And I fill out the form with "company/holidayDates/new" data fixture
   And I click on save button
  Then I can see confirmation dialog
  When I click on close dialog button
  Then I am on "CalendarsList_holidayDates" subscreen list

Scenario: I can save calendar holiday dates
  Given I can see at least one row
   When I click on "holidayDates" first elements edit button
    And I click on save button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "CalendarsList_holidayDates" subscreen list

Scenario: I can click on delete calendar holiday dates button
  Given I can see at least one row
   When I select element at position "1"
    And I click on "holidayDates" delete button in the footer
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "CalendarsList_holidayDates" subscreen list
