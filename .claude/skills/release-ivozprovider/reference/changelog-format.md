# Changelog formats

Exact formats of the three documents written during a release, with real
examples taken from previous ones.

## ChangeLog

A new entry goes on top of `ChangeLog`, separated from the previous one by two
blank lines.

```
Tue, 16 Jun 2026 10:00:00 +0200 IvozProvider Team <vozip+ivozprovider@irontec.com>

    * IvozProvider 4.7.0 released

    * Portals:
        - Added webhook management to brand and client portals
        - Added per-DDI webhook configuration to brand portal
        - Added on-demand recording email and notification template
          configuration
        - Fixed brand invoice select options showing id instead of number

    * Core:
        - Added webhooks (entity, access control and dispatcher microservice)
        - Added DDI and user webhook events (call start, ring, answer, end and
          updateClid)
        - Removed PDF basename sanitization

    * Misc:
        - Updated ivoz-api to 5.6 and ivoz-ui to 1.8.2
        - Several dependency updates
```

- Header: `date -R` style timestamp, then always
  `IvozProvider Team <vozip+ivozprovider@irontec.com>`.
- Sections are indented four spaces, entries eight, and continuation lines ten.
  Lines wrap at 76 columns.
- Section order: `Portals`, `Core`, `Kamailio`, `Asterisk`, `Provisioning`,
  `Schema`, `Misc`. Only the ones with entries.
- Entries start with a verb in past tense: `Added`, `Fixed`, `Improved`,
  `Removed`, `Updated`.
- Pull request references go at the end of the entry, `(#3082)`, listing all of
  them when the entry merges several: `(#3074, #3070, #3114)`.

### Mapping commit tags to sections

| Commit tags | Section |
| --- | --- |
| `portal`, `portal/*` | Portals |
| `core`, `rest`, `rest/*` | Core |
| `kamailio`, `kamusers`, `kamtrunks`, `proxy` | Kamailio |
| `asterisk`, `agi`, `as` | Asterisk |
| `microservices/provision` | Provisioning |
| `schema`, `data` | Schema |
| anything else | Misc |

The mapping is a hint, not a rule: a change that users experience in the portal
belongs in `Portals` even if it also touched schema and core.

### What is left out

CI, packaging plumbing, tests, fixtures, refactors, static analysis baselines,
local development environment, documentation of internals. Dependency updates
collapse into a single `Several dependency updates` entry; library upgrades
that matter to users are named, as in `Updated ivoz-api to 5.6 and ivoz-ui to
1.8.2`.

### Patch releases

Same format, usually a single section:

```
Tue, 14 Nov 2025 10:37:00 +0200 IvozProvider Team <vozip+ivozprovider@irontec.com>

    * IvozProvider 4.5.1 released

    * Portals:
        - Fixed AccountStatus display in Daily Usage screen (#3036)

    * Core:
        - Added dedicated endpoints for balances and dailyUsage for better performance (#3030)
```

## API changelog

One `web/rest/<app>/CHANGELOG.md` per REST application, newest version first,
right below the `# Changelog` header.

```
## 4.7.0
* Endpoints:
    - /webhooks:
      - Added [GET] endpoint to list webhook resources.
      - Added [POST] endpoint to create webhook resources.
    - /webhooks/{id}:
      - Added [GET], [PUT] and [DELETE] endpoints to retrieve, update and
        delete a webhook resource.
    - /match_list_patterns:
      - Added matchPattern, matchPattern[exact], matchPattern[start],
        matchPattern[partial], matchPattern[end], matchPattern[neq],
        matchPattern[exists], exists[matchPattern] and _order[matchPattern]
        filter parameters.
* Models:
    - Webhook:
      - Added model with name, description, uri, template, callDirection,
        eventStart, eventRing, eventAnswer, eventEnd, eventUpdateClid, company,
        ddi and user properties.
    - MatchListPattern:
      - Added matchPattern property.
```

- Two blocks only, `* Endpoints:` and `* Models:`, and only when they have
  content.
- Paths and models are indented four spaces, their changes six, continuation
  eight. Lines wrap at 76 columns.
- Sentences end with a full stop.
- Parameters of one path are listed in a single sentence, joined with commas
  and a final `and`.
- Methods of the same path are merged, as in
  `Added [GET], [PUT] and [DELETE] endpoints`.
- `scripts/apispec-diff.sh` prints `Model-detailed` and `Model-collection`
  variants; they are the same model and get a single entry.

## GitHub release body

The ChangeLog entry without its date header and without the `released` line,
unwrapped so each entry is one line, followed by a fixed footer.

```
* Portals:
    - Added webhook management to brand and client portals
    - Added per-DDI webhook configuration to brand portal

* Core:
    - Added webhooks (entity, access control and dispatcher microservice)

* Misc:
    - Several dependency updates


See specific API changelog ([Platform](https://github.com/irontec/ivozprovider/blob/tempest/web/rest/platform/CHANGELOG.md), [Brand](https://github.com/irontec/ivozprovider/blob/tempest/web/rest/brand/CHANGELOG.md), [Client](https://github.com/irontec/ivozprovider/blob/tempest/web/rest/client/CHANGELOG.md) and [User](https://github.com/irontec/ivozprovider/blob/tempest/web/rest/user/CHANGELOG.md)) for detailed information on changes for each level

**Full Changelog**: https://github.com/irontec/ivozprovider/compare/v<PREVIOUS>...v<X.Y.Z>
```

The release title is `IvozProvider v<X.Y.Z>`.
