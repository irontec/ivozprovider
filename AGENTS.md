# AGENTS.md

Instructions for AI coding agents. Codex and OpenCode read this file; Claude Code reads it through `CLAUDE.md` (`@AGENTS.md`). Edit this file, not `CLAUDE.md`.

## Project

IvozProvider — multitenant VoIP platform (Global admin → Brands → Companies → Users). Monorepo:

- `library/` — shared PHP domain code (`Ivoz\{Provider,Ast,Kam,Cgr}`) on `ivoz-core`, used by every PHP app below
- `schema/` — migrations, entity generation, ORM tests
- `web/rest/{platform,brand,client,user}` — one REST API per admin level
- `web/portal/{platform,brand,client,user}` — one React portal per API, on `ivoz-ui`
- `microservices/` — PHP and Go services
- `asterisk/` — FastAGI app (`agi/`) and Asterisk config
- `kamailio/` — SIP proxy configs (`users/`, `trunks/`)
- `cgrates/` — rating engine config
- `profiles/` — per-host-role filesystem overlays
- `debian/` — packaging
- `tests/` — test images, black-box SIP scenarios, API and security tests
- `doc/` — user docs and `dev/` conventions

## Shared ivoz-* repositories and libraries

- Backend, separate repositories installed as composer packages: `irontec/ivoz-core` and `ivoz-api-bundle` (DDD/API framework: generated entities, DTOs, assemblers, lifecycles), `ivoz-dev-tools` (entity generator), `prophecy`.
- Backend, packages that live **inside this monorepo** (`library/composer-packages/irontec/`, installed via a composer `path` repository): `ivoz-provider-bundle`, `replacements`. Edit them here, in the same PR.
- `irontec/prophecy` is a fork of phpspec's prophecy carrying a single fix and should eventually go back to mainstream: treat it as read-only, never add changes there.
- Frontend: `@irontec/ivoz-ui` (admin CRUD framework, hygen templates, base translations).
- ivozprovider may not be the only repository a change touches.
- If a behaviour comes from an `ivoz-*` library, inspect the library before writing a workaround here.
- Fix generic behaviour in the library when it benefits several projects.
- Don't duplicate what an `ivoz-*` package already provides.
- Library sources are often sibling checkouts (`../ivoz-core`, `../ivoz-ui`; `docker-compose.yml` mounts `../ivoz-ui/` at `/opt/ivoz-ui` in the portal containers). Check for them before a workaround; otherwise read `library/vendor/irontec/` or `web/portal/node_modules/@irontec/ivoz-ui/`.

## Where commands run

- PHP (library, schema, REST apps, microservices, agi): `docker exec -it ivozprovider-backend bash` → `/opt/irontec/ivozprovider`. Every `bin/test-*` script hardcodes that path.
- Portals: `docker exec -it ivozprovider-portal-<app> bash` (`platform`, `brand`, `client`, `user`); `start.sh` runs `yarn start` in `web/portal/<app>`.
- Other containers: `ivozprovider-data` (MariaDB), `ivozprovider-redis`.
- Edit files on the host; the repo is bind-mounted in the backend and portal containers. A sibling `../ivoz-ui/` checkout is only needed to run the development version of ivoz-ui (docker-compose mounts it into the portal containers); otherwise the published package is used.

## Architecture and patterns

Deliberate DDD + hexagonal (ports & adapters) codebase — not a Symfony CRUD app. Every bounded context repeats the same layering:

| Layer | Path | Contains | May depend on |
| --- | --- | --- | --- |
| Domain | `Ivoz/<Ctx>/Domain/` | `Model/` (entities, DTOs, repository interfaces), `Service/` (rules), `Assembler/`, `Events/`, `Job/` | Domain only |
| Application | `Ivoz/<Ctx>/Application/Service/` | use cases orchestrating domain services | Domain |
| Infrastructure | `Ivoz/<Ctx>/Infrastructure/` | adapters: `Persistence/Doctrine/`, `Api/`, `Redis/`, `Kamailio/`, … | Domain, Application, frameworks |

- Dependencies point inward. Domain code never knows about Doctrine, Symfony, Redis, HTTP or Kamailio: declare the port interface in `Domain/`, implement the adapter in `Infrastructure/`, inject the interface (`CompanyRepository` ← `CompanyDoctrineRepository`; `WebhookReloadJobInterface` ← Redis `WebhookReloadJob` **and** `FakeWebhookReloadJob`, swappable per environment).
- Tolerated pre-existing leaks — don't "fix" them blindly, don't add more: generated repository interfaces reach `Doctrine\Persistence\ObjectRepository` through core's `RepositoryInterface`, and a few Domain classes import `CriteriaHelper`. New domain code adds no framework imports beyond these.
- SOLID as it materialises here:
  - **S** — one domain service, one rule, one `execute()` (`SanitizeBillingMethod`, `SearchBrokenThresholds`). A second concern means a new class, not branching inside `execute()`.
  - **O** — reacting to a new situation means adding a handler class to `Domain/Service/<Entity>/`, not editing an existing one; ordering goes in `getSubscribedEvents()` priorities.
  - **L** — consume `<Entity>Interface`, never the concrete class; no `instanceof` on concrete entities to special-case behaviour.
  - **I** — ports are narrow and per-entity; prefer a new small interface over widening an existing one.
  - **D** — constructor injection of interfaces (property promotion); no service locators, no `new` of collaborators, no static access to infrastructure.
- Entities enforce their invariants: constructors and setters are `protected`, instances are created and mutated only through DTOs (`fromDto`/`updateFromDto`, `beberlei/assert` inside). Never call a setter from a service — go through `EntityTools`: `entityToDto()` → mutate the DTO → `updateEntityByDto()`. Multi-field concepts become immutable value objects (`Company/Invoicing`), not loose columns.
- DI by convention: anything at `Ivoz/<Ctx>/Domain/Service/*/*` is auto-tagged `domain.service`, at `Application/Service/*/*` `application.service` (autowired by `ivoz-provider-bundle`'s `autoload.yml`; nothing to declare in this repo). The directory is the registration — wrong depth and the service silently never runs.
- New feature checklist: entity shape → mapping + regenerate + migration; business rule → lifecycle handler in `Domain/Service/<Entity>/` — but plain field validation/normalisation of one entity belongs in its hand-written `<Entity>.php` (`sanitizeValues()`), not in a lifecycle; needs infrastructure → port in `Domain/` + adapter in `Infrastructure/`; multi-step use case → `Application/Service/`; matching test from the Testing section.

## Backend (`library/Ivoz`)

- Contexts, each `Domain` / `Application` / `Infrastructure`: `Provider` (business domain, e.g. Company, User, Ddi; also `Domain/Events`, `Domain/Job`), `Kam` (Kamailio tables), `Ast` (Asterisk tables), `Cgr` (CGRateS tables). Each has `Infrastructure/{Persistence/Doctrine,Redis}` plus its engine adapter (`Kamailio/`, `Asterisk/`, `Cgrates/`).
- Kamailio, Asterisk and CGRateS read these tables directly; lifecycles keep them in sync.
- `Domain/Model/<Entity>/`: generated `*Abstract`, `*DtoAbstract`, `*Interface`, `*Trait` — never edit. Hand-written `<Entity>.php`, `<Entity>Dto.php`, `<Entity>Repository.php` (implemented in `Infrastructure/Persistence/Doctrine/<Entity>DoctrineRepository.php`). Source of truth: `Infrastructure/Persistence/Doctrine/Mapping/*.orm.xml`.
- Lifecycles: `Domain/Service/<Entity>/<Entity>LifecycleServiceCollection.php` + handlers. Every side effect of persisting/removing an entity (engine row sync, reload requests, balance operations) is a handler there, never an ad hoc listener (example: `Provider/Domain/Service/Company/`).
- Domain events: `Domain/Model/<Entity>/Events/*`.
- Assemblers (`Domain/Assembler/<Entity>/`) only when DTO↔entity needs logic beyond the generated one.
- Use cases in `Application/Service`; controllers in `web/rest/*/src/Controller` stay thin.
- Multitenancy is in the API layer: what each admin level sees is set per REST app in `config/api/{raw,resources.yml}` and `Provider/Infrastructure/Api`. New field = mapping → regenerate → expose per API.
- Static analysis: phpstan and psalm with baselines (`library/`, each `web/rest/*`, each PHP microservice) and rector (`library/rector.php`). Don't grow baselines to get green.

Regenerate after changing a mapping (inside `ivozprovider-backend`), then commit the result (`schema/bin/test-generators` fails on drift):

```bash
schema/bin/run-generators Provider          # or Ast / Kam / Cgr
schema/bin/run-service-update
cd schema && bin/console doctrine:migrations:diff   # review the migration in schema/DoctrineMigrations
```

## Frontend (`web/portal`)

- Yarn workspaces: `platform`, `brand`, `client`, `user`. ivoz-ui renders list/form/detail from each API's spec; app code describes entities and the menu.
- `AppRoutesGuard.tsx` → app's own `components/Login.tsx` when logged out.
- Menu is ACL-driven: `router/EntityMap.ts` (`entity`, `children`, `filterBy`, `aclOverride`) filtered by `useAclFilteredEntityMap` with `store/clientSession/aboutMe`. An entity not in `EntityMap` has no route; one the admin can't read is hidden.
- Store = ivoz-ui `storeModel` plus app slices (`store/clientSession` in platform/brand/client, `store/userStatus` in user).
- `src/entities/<Entity>/`:
  - `<Entity>.tsx` — `EntityInterface`: path, properties, columns, lazy `Form`/`selectOptions`/FK loaders, `customActions`, `acl`
  - `<Entity>Properties.ts` — typed property list
  - `Form.tsx` — field groups only
  - `ForeignKeyResolver.tsx` / `ForeignKeyGetter.tsx` — default to the `auto*` helpers
  - `SelectOptions.ts` — how other entities list this one
  - `Field/`, `Action/`, `View.tsx`, `List.tsx`, `hooks/` — custom renderers, row actions, detail/list views, hooks
- New entity: `bin/generate-entity <Entity>` (templates from `../node_modules/@irontec/ivoz-ui`), add to `EntityMap.ts`.
- i18n: `_('…')` for every string; `yarn i18n` extracts to `src/translations/{en,es,ca,eu,it}.json`. `bin/test-i18n` fails on unextracted keys and on empty strings: translate what you add.
- Tests: Cypress e2e with Pact intercepts. `bin/test-pact` fails if fixtures aren't `jq`-formatted or pacts differ from the committed ones. `bin/test-sync-api-spec <app>` regenerates `cypress/fixtures/apiSpec.json`; commit it when the API changes.
- Lint: per-app `.eslintrc.js` + `.prettierrc.json`; `yarn lint` covers `src` and `cypress`.

## Testing

Everything implemented or changed ships with its corresponding tests in the same PR:

- Domain/application logic and value objects: phpspec (`library/spec`, `library/bin/test-phpspec`)
- Repositories and schema: ORM tests (`schema/tests`, `schema/bin/test-orm`)
- API resources and behaviour: Behat features per REST app (`web/rest/<app>/features`)
- Portals: Cypress e2e with Pact intercepts (`web/portal/<app>/cypress`)
- phpspec conventions: build doubles with `spec\HelperTrait` (`getTestDouble`, `getterProphecy`, `fluentSetterProphecy`, `hydrate`) and `spec\DtoToEntityFakeTransformer`; assert interactions with collaborators, not DB state. ORM tests use `Tests\DbIntegrationTestHelperTrait` and a single `test_runner()`.
- Jenkins runs all of these through the pipeline in `Jenkinsfile`, calling the same `test-*` scripts. Backend stages run for commits tagged `agi:` / `core:` / `doc:` / `schema:` / `microservices/…` / `rest/…` / `tests:`; the frontend stages per portal for `portal…` / `rest/…`, and `tests:` runs all four of them.
- A new kind of test or check must be wired into `Jenkinsfile` (its own stage, or added to an existing one) and, if it needs a wrapper, into `library/bin/test-*`, `schema/bin/test-*` or the app's `bin/`. Anything not in the `Jenkinsfile` never runs in CI.

## Commands

Backend (`ivozprovider-backend`, `/opt/irontec/ivozprovider`):

```bash
library/bin/test-all                 # codestyle + phpspec + schema orm + rest api
library/bin/test-parallel
library/bin/test-phpspec
library/bin/test-phpstan / test-psalm / test-rector      # -update-baseline variants exist for phpstan/psalm
library/bin/test-codestyle [--full|--branch]              # phpcbf PSR12
library/bin/test-codestyle-gherkin
library/bin/test-phplint / test-app-console [--full] / test-app-dependencies
library/bin/test-file-perms
library/bin/test-commit-tags [base]
library/bin/test-i18n                # Sphinx docs translations, not the portals
library/bin/test-api                 # Behat for the four REST apps (or web/rest/<app>/bin/test-api)
schema/bin/prepare-test-db / test-orm / test-generators / test-schema / test-duplicate-keys
web/rest/<app>/bin/test-api-spec     # regenerate + validate public/apiSpec.json
microservices/provision/bin/test-provision, microservices/recordings/bin/test-recordings
```

Portals (`ivozprovider-portal-<app>` or `web/portal/<app>`): `bin/start`, `bin/build`, `yarn lint`, `yarn lint:check`, `yarn i18n`, `yarn cy:run` / `cy:open`, `bin/test-lint`, `bin/test-build`, `bin/test-i18n`, `bin/test-pact`, `bin/test-sync-api-spec <app>`, `bin/generate-entity <Entity>`.

## Git

Rules: `doc/dev/en/commits.md`, `.github/PULL_REQUEST_TEMPLATE.md`.

- Branch from `main`: `PROVIDER-<ticket>-<kebab-slug>`. Jenkins links the PR to Jira from the branch name. Update with `git pull --rebase`.
- Commit subject: `<tag>: <what changed>`, English, one line, ≤ 60 characters. Examples: `rest/brand: order rating plan destination rates by weight`, `portal/platform: updated translations`, `schema: index ChannelUsages by timestamp for purges`.
- `<tag>` from `doc/dev/AcceptedCommitTagsList.txt` (per component, e.g. `core`, `rest/platform`, `portal/client`). Enforced by `library/bin/test-commit-tags`.
- Split commits per component: schema + library + portal = `schema:` + `core:` + `portal/<app>:`. Tags gate CI: `agi:`/`core:`/`doc:`/`schema:`/`microservices/…`/`rest/…`/`tests:` → backend; `portal…`/`rest/…` → frontend per app (`portal/<app>:`, `rest/<app>:`), with `tests:` running all four; `schema:` → schema stage; `pkg:` → packaging. A wrong tag silently skips tests.
- Regenerated entities go in their own commit.
- No `Co-Authored-By` trailers — commits are authored by the developer alone, no tool trailers.
- PR against `main`, one per ticket, fill the template (type of change, checklist, `Fixes #<issue>`). Title in English, without the ticket (Jenkins prefixes `[PROVIDER-<ticket>]`). Code must be GPLv3-compatible.
- Before opening a PR run the `test-*` scripts of the components you touched and `library/bin/test-commit-tags origin/main`.

## CI

Jenkins hashes back/front trees; an already-tested hash skips its stage unless labelled `ci-force-tests-back` / `-front` / `-tests`. Backend stages: app-generic, static analysis (phpstan + psalm), codestyle, i18n, phpspec, Behat per REST app, microservice-provision, orm, generators, schema. Frontend: `web-<app>-build` + `web-<app>-cypress` per app.
