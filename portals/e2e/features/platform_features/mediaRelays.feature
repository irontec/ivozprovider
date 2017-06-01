@platform
@mediaRelays

Feature: Media relays admin page
  As a main operator
  I want to be able to access media relays admin page
  In order to check and manage them

Background:
  Given I go to the admin page
  And I send valid admin credentials
  Then I am logged in
  Given I click on "MediaRelaySets" CTA
  And I am on "MediaRelaySets" list
  Then I can see at least one row
  Given I click on "MediaRelaySets" first elements "kamRtpproxy" button
  Then I am on "MediaRelaySetsList_kamRtpproxy" subscreen list

Scenario: I can save media relay
  Given I can see at least one row
  And I click on "kamRtpproxy" first elements edit button
  And I click on save button
  Then I can see save confirmation dialog
  Given I click on close dialog button
  Then I am on "MediaRelaySetsList_kamRtpproxy" subscreen list

Scenario: I see new media relay admin page
  Given I click on add button
  And I click on close button
  Then I am on "MediaRelaySetsList_kamRtpproxy" subscreen list

Scenario: I can click on delete media relay button
  Given I can see at least one row
  And I click on "kamRtpproxy" first elements delete button
  Then I can see save confirmation dialog
  Given I click on close dialog button
  Then I am on "MediaRelaySetsList_kamRtpproxy" subscreen list
