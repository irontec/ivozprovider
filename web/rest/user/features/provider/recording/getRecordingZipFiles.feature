Feature: Retrieve recordings zip file
  In order to manage recordings multi download
  As a user
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve certain recording json
    Given I add User Authorization header
      And storage file exists "ivozprovider_model_recordings.recordedfile/0/2.mp3"
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "recordings/recorded_files_zip?_recordingIds=2"
      And the response status code should be 200
      And the header "Content-Type" should be equal to "application/zip"
