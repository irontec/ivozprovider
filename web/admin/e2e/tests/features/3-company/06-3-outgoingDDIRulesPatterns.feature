@company
@outgoingDDIRulesPatterns
@company06
@company06-3

Feature: outgoingDDIRulesPatterns admin page
  As a main operator
  I want to be able to access outgoing DDI Rules admin page
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
    And I click on "OutgoingDDIRules" CTA
   Then I am on "OutgoingDDIRules" list
   When I click on "OutgoingDDIRules" first elements "outgoingDDIRulesPatterns" button
   Then I am on "OutgoingDDIRulesList_outgoingDDIRulesPatterns" subscreen list

Scenario: I create outgoing DDI Rules
  When I click on add button
   And I fill out the form with "company/outgoingDDIRulesPatterns/new" data fixture
   And I click on save button
  Then I can see confirmation dialog
  When I click on close dialog button
  Then I am on "OutgoingDDIRulesList_outgoingDDIRulesPatterns" subscreen list
  When I click on "outgoingDDIRulesPatterns" last elements edit button
  Then I compare the form data with "company/outgoingDDIRulesPatterns/new" data fixture

Scenario: I can save outgoing DDI Rules
  Given I can see at least one row
   When I click on "outgoingDDIRulesPatterns" first elements edit button
    And I click on save button
   Then I can see confirmation dialog
   When I click on close dialog button
  Then I am on "OutgoingDDIRulesList_outgoingDDIRulesPatterns" subscreen list

Scenario: I can click on delete outgoing DDI Rule button
  Given I can see at least one row
   When I select element at position "1"
    And I click on "outgoingDDIRulesPatterns" delete button in the footer
   Then I can see confirmation dialog
   When I click on close dialog button
  Then I am on "OutgoingDDIRulesList_outgoingDDIRulesPatterns" subscreen list
