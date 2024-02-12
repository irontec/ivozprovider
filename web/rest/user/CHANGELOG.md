# Changelog
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
