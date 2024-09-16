# Changelog
## 4.2.0
* Endpoints
 - /recordings:
    - Added [GET] endpoint
 - /recordings/recorded_files_zip:
    - Added [GET] endpoint
 - /recordings/{id}:
    - Added [GET] and [DELETE] endpoints
 - /recordings/{id}/recordedfile:
    - Added [GET] endpoint
* Models
  - Recording:
    - Added model
  - Recording-collection:
    - Added model
  - Recording-detailed:
    - Added model
  - Recording_RecordedFile:
    - Added model
  - UsersCdr:
    - Set startTime as required
  - UsersCdr-collection:
    - Set startTime as required
  - UsersCdr-detailed:
    - Set startTime as required

## 4.1.0
* Endpoints
  - /faxes/{id}:
    - Added [GET] endpoint
  - /faxes_in_outs:
    - Added [GET] and [POST] endpoints
  - /faxes_in_outs/{id}:
    - Added [GET] and [DELETE] endpoints
  - /faxes_in_outs/{id}/file:
    - Added [GET] endpoint
  - /faxes_in_outs/{id}/resend:
    - Added [POST] endpoint
  - /my/faxes:
    - Added [GET] endpoint
* Models:
  - Fax:
    - Added model
  - Fax-collection:
    - Added model
  - Fax-detailed:
    - Added model
  - FaxesInOut-detailed:
    - Added model
  - FaxesInOut-collection:
    - Added model
  - FaxesInOut-detailed:
    - Added model
  - FaxesInOut_File:
    - Added model
  - UserStatus:
    - Added features property
  - Voicemail-detailed:
    - Added relUserIds property
  - WebTheme:
    - Removed theme property

## 4.0.4
* Models
    - RecordingFile:
      - Added model
    - VoicemailMessage-detailed:
      - Updated recordingFile property
    - VoicemailMessage_RecordingFile:
      - Added model
## 4.0.3
* Endpoints
    - /my/voicemails:
        - Added [GET] endpoint
    - /voicemail_messages
        - Added [GET] endpoint
    - /voicemails/{id}
        - Added [GET] and [PUT] endpoints
    - /voicemail_messages/{id}
        - Added [GET] and [DELETE] endpoints
    - /voicemail_messages/{id}/metadatafile
        - Added [GET] endpoint
    - /voicemail_messages/{id}/recordingfile
        - Added [GET] endpoint
* Models
    - MetadataFile:
        - Added Model
    - RecordingFile:
        - Added Model
    - Voicemail:
        - Set name as readonly property
        - Set email as readonly property
    - Voicemail-detailed:
        - Added Model
    - VoicemailMessage-collection:
        - Added Model
    - VoicemailMessage-detailed:
        - Added Model

## 4.0.0
* Endpoints
    - /domains:
        - Added [GET] endpoint
    - /proxy_users
        - Added extension, extension[] and extension[exists] filter parameters
        - Added disposition[end|exact|neq|partial|start] filter parameters
        - Added owner[end|exact|neq|partial|start] filter parameters
* Models:
    - UsersCdr:
        - Added owner property
        - Added extension property
        - Added disposition property
        - Removed endTime property
        - Removed callidHash property
        - Removed diversion property
        - Removed referee property
        - Removed referrer property
        - Removed xcallid property
    - UsersCdr-collection:
        - Added disposition property
        - Added owner property
        - Removed endTime property
    - UsersCdr-detailed:
        - Added owner property
        - Added extension property
        - Added disposition property
        - Removed endTime property
        - Removed callidHash property
        - Removed diversion property
        - Removed referee property
        - Removed referrer property
        - Removed xcallid property

## 3.2.0
* Endpoints:
    - /my/call_forward_settings:
        - Added filter properties
    - /my/dashboard:
        - Added [GET] endpoint
    - /my/logo/{id}/{name}:
        - Added [GET] endpoint
    - /my/web_theme:
        - Renamed to /my/theme [BREAKING CHANGE]
    - /my/last_month_calls:
      - Added [GET] endpoint

## 3.0.0
* Disclaimer: The API schema will not be considered stable until version 3.1 and may receive new breaking changes
* These methods and models have been extracted from the client API 
