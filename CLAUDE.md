# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## What this is

IvozProvider is a multitenant VoIP telephony platform for providers, designed to run distributed across machine
"profiles" (see `profiles/`): **Proxy** (Kamailio SIP server), **Portal** (web UIs + REST API), **Application Server**
(Asterisk + PHP AGI logic), and **Data** (Percona/MariaDB + shared storage). All profiles can also run on one machine
(standalone). Management is multilevel: Global admin → Brand → Company → User, each with its own portal and API scope.

## Repository layout

This is a monorepo of independently-installed-but-codependent components, each a separate Composer/Symfony project or
npm workspace with its own `vendor/`:

- `library/` — **the domain core.** All business entities and logic live under `library/Ivoz/`, split into four
  bounded contexts: `Provider` (main business domain, ~126 entities), `Kam` (Kamailio runtime tables), `Ast` (Asterisk
  runtime tables), `Cgr` (CGRateS billing). Everything else depends on this via the `Ivoz\` PSR-4 namespace.
  **`Ivoz\Core\` is not in this repo** — it is the vendored `irontec/ivoz-core` package
  (`library/vendor/irontec/ivoz-core/`), as are the `ivoz-api*`, `ivoz-provider-bundle` and `ivoz-dev-tools` packages.
  Look there for `EntityTools`, lifecycle plumbing, and the base persistence layer.
- `schema/` — Symfony app owning the **database schema and code generation**. Holds Doctrine migrations
  (`schema/DoctrineMigrations/`) and the generator console (`schema/bin/console`).
- `web/rest/` — the REST API, one Symfony app per access level: `platform`, `brand`, `client`, `user`. Built on
  `irontec/ivoz-api-bundle` (API Platform). Each has its own `bin/`, `config/`, Behat `features/`.
- `web/portal/` — React 18 + TypeScript + Vite + MUI front-ends, a yarn workspace with one package per level:
  `platform`, `brand`, `client`, `user`. Shared UI comes from `@irontec/ivoz-ui`. Tests use Cypress + Pact.
- `microservices/` — standalone apps for async/background work. All are Symfony except `click2call`, which is **Go**
  (`go.mod`, `cmd/`, `pkg/`): `workers` (async jobs), `provision` (terminal auto-provisioning), `recordings`,
  `balances`, `router`, `scheduler`, `webhooks`, `realtime`, `click2call`.
- `asterisk/agi/` — PHP FastAGI app implementing PBX call logic (`asterisk/agi/`), plus dialplan in `asterisk/config/`.
- `kamailio/` — SIP routing config (`trunks`, `users`).

## Critical: entities are generated, not hand-written

Domain entities follow a strict DDD layering and are **partially code-generated from Doctrine ORM XML mappings**. For
each entity (e.g. `Company`) you'll find under `library/Ivoz/Provider/Domain/Model/Company/`:

- `CompanyAbstract.php`, `CompanyDtoAbstract.php`, `CompanyInterface.php`, `CompanyTrait.php`, `CompanyRepository.php`
  — **GENERATED. Do not edit by hand**; your changes will be overwritten on the next generation run.
- `Company.php`, `CompanyDto.php` — hand-written subclasses where custom logic goes.

The source of truth for an entity's fields/relations is its ORM mapping XML, e.g.
`library/Ivoz/Provider/Infrastructure/Persistence/Doctrine/Mapping/Company.Company.orm.xml`. **Workflow to change an
entity's shape:** edit the `.orm.xml` mapping, then regenerate:

```bash
schema/bin/run-generators Provider          # or: Ast | Kam | Cgr  (regenerates entities/interfaces/repositories)
```

Internally that runs `bin/console ivoz:make:entities|make:interfaces|make:repositories <Context>` (provided by
`irontec/ivoz-dev-tools`). After changing the schema, create a migration and apply it:

```bash
schema/bin/console make:migration                          # generate migration from mapping diff
schema/bin/console doctrine:migrations:migrate -n          # apply
```

## Business logic lives in lifecycle services, not in entities

Entities are thin. Behaviour that reacts to an entity being saved/removed lives in
`library/Ivoz/<Context>/Domain/Service/<Entity>/`, as classes implementing `<Entity>LifecycleEventHandlerInterface`
(which extends `Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface`, in vendor). Each handler declares
`getSubscribedEvents()` returning `[EVENT_* => PRIORITY_*]` and does its work in `execute(<Entity>Interface $e)`.

- Events: `EVENT_PRE_PERSIST`, `EVENT_POST_PERSIST`, `EVENT_PRE_REMOVE`, `EVENT_POST_REMOVE`, `EVENT_ON_COMMIT`,
  `EVENT_ON_DOMAIN_EVENT`, `EVENT_ON_ERROR`. Priorities: `PRIORITY_HIGH` (100), `PRIORITY_NORMAL` (200),
  `PRIORITY_LOW` (300) — lower number runs first.
- Handlers are auto-wired by the `<Entity>LifecycleServiceCollection` in the same directory.
- To mutate the entity from a handler, go through `EntityTools` (`entityToDto()` → mutate DTO →
  `updateEntityByDto()`), never by calling setters directly. See
  `library/Ivoz/Provider/Domain/Service/Company/SanitizeBillingMethod.php` for the canonical shape.

So: adding a field is an ORM-mapping change + regeneration; adding a *rule* is usually a new lifecycle service class
plus a phpspec in `library/spec/`.

## Design principles — apply these to every change

This is a deliberate **DDD + hexagonal (ports & adapters)** codebase, not a Symfony CRUD app. New code is expected to
follow the patterns below, and the CI gates (phpstan `--level max`, psalm `errorLevel="1"` with `findUnusedCode`,
PSR-12, phpspec, ORM tests, Behat) exist to enforce them.

### Hexagonal architecture: layers and the dependency rule

Every bounded context (`Provider`, `Kam`, `Ast`, `Cgr`) repeats the same layering:

| Layer | Path | Contains | May depend on |
| --- | --- | --- | --- |
| **Domain** | `Ivoz/<Ctx>/Domain/` | `Model/` (entities, DTOs, repository **interfaces**), `Service/` (business rules), `Assembler/`, `Events/`, `Job/` (interfaces), `Traits/` | Domain only |
| **Application** | `Ivoz/<Ctx>/Application/Service/` | use cases that orchestrate domain services (`SyncFromCsv`, `SimulateCallByRatingPlanGroup`, …) | Domain |
| **Infrastructure** | `Ivoz/<Ctx>/Infrastructure/` | the adapters: `Persistence/Doctrine/`, `Api/`, `Redis/`, `Hostname/`, `Kamailio/` | Domain, Application, frameworks |

**Dependencies point inward.** Domain code must not know about Doctrine, Symfony, Redis, HTTP or Kamailio. Put the
*interface* (the port) in `Domain/`, the *implementation* (the adapter) in `Infrastructure/`, and inject the interface:

- `Domain/Model/Company/CompanyRepository` (port) ← `Infrastructure/Persistence/Doctrine/CompanyDoctrineRepository` (adapter)
- `Domain/Job/WebhookReloadJobInterface` (port) ← `Infrastructure/Redis/Job/WebhookReloadJob` **and** `FakeWebhookReloadJob`
  (two adapters, swappable per environment — the payoff of the rule)
- `Domain/Service/Company/CompanyBalanceServiceInterface` (port) ← billing implementation wired by DI

There are ~79 port interfaces under `Provider/Domain/Service/` against ~142 files in `Provider/Infrastructure/`; that
ratio is the norm to preserve.

**Pre-existing, tolerated leaks** — know them so you neither "fix" them blindly nor use them as licence to add more:
the generated repository interfaces reach `Doctrine\Persistence\ObjectRepository` through core's `RepositoryInterface`,
and a handful of Domain classes import `Ivoz\Core\Infrastructure\...\CriteriaHelper`. New domain code should add no
framework imports beyond these.

### SOLID, as it actually materialises here

- **S — Single responsibility.** A domain service is one class, one rule, one `execute()`. `SanitizeBillingMethod`,
  `SearchBrokenThresholds`, `SendCgratesUpdateRequest` are separate classes precisely because they are separate rules.
  When a rule grows a second concern, split the class rather than branching inside `execute()`.
- **O — Open/closed.** Reacting to a new situation means **adding** a handler class to
  `Domain/Service/<Entity>/` (auto-discovered, see DI below), not editing an existing one. Ordering is expressed
  declaratively via `getSubscribedEvents()` priorities, not by rewriting a call chain.
- **L — Liskov.** Everything is consumed through `<Entity>Interface`, never the concrete class — that is what makes
  `FakeWebhookReloadJob` a legitimate stand-in for `WebhookReloadJob`. Type-hint the interface; never `instanceof` a
  concrete entity to special-case behaviour.
- **I — Interface segregation.** Ports are narrow and per-entity: `CompanyLifecycleEventHandlerInterface` exposes a
  single `execute(CompanyInterface $company)`. Prefer a new small interface over widening an existing one.
- **D — Dependency inversion.** Constructor injection of interfaces, always, using constructor property promotion
  (`public function __construct(private EntityTools $entityTools)`). No service locators, no `new` of collaborators,
  no static access to infrastructure.

### Entity invariants and the DTO boundary

Generated entities are not anaemic bags of setters, and they are not freely mutable:

- Constructors are `protected` and setters are `protected`; only getters are `public`. Instances are created and
  mutated exclusively through DTOs — `fromDto()`, `updateFromDto()`, `toDto()`.
- Invariants are enforced with `beberlei/assert` (`Assertion::notNull`, `Assertion::isInstanceOf`, length/choice
  constraints) inside the generated `fromDto`/`updateFromDto`/`sanitizeValues`, so an invalid entity cannot exist.
  phpstan is configured with `phpstan-beberlei-assert`, so these assertions also narrow static types.
- **Never call a setter from a service.** Mutate through `EntityTools`: `entityToDto()` → change the DTO →
  `updateEntityByDto()`.
- Multi-field concepts become **immutable value objects**, not loose columns: `final class Invoicing` in
  `Domain/Model/Company/` has private fields, no setters, and self-validates. Model new grouped data this way.
- Shaping what the API returns is the **assembler**'s job, not the entity's:
  `Domain/Assembler/<Entity>/<Entity>DtoAssembler implements CustomDtoAssemblerInterface`.

### Dependency injection by convention

Services are auto-registered *by directory*, with `autowire: true` and `public: false`
(`vendor/irontec/ivoz-provider-bundle/Resources/config/autoload.yml`):

- Anything at `Ivoz/<Ctx>/Domain/Service/*/*` is tagged `domain.service` automatically.
- Anything at `Ivoz/<Ctx>/Application/Service/*/*` is tagged `application.service` and made public.

So **the directory is the registration** — a new domain service needs no YAML, but it must sit at exactly that depth
(`Domain/Service/<Entity>/<ServiceName>.php`) and be constructor-injectable, or it will silently never run.

### Testing is part of the definition of done

Each layer has its own test type; match your change to the right one instead of defaulting to the slowest:

| What you changed | Test to write | Where |
| --- | --- | --- |
| Domain/Application service (a rule) | **phpspec** — mock every collaborator via `ObjectBehavior` + Prophecy | `library/spec/…` (152 specs) |
| Repository method / mapping | **PHPUnit integration test** against the real DB | `schema/tests/…` (166 tests) |
| API resource, filter, ACL, serialisation | **Behat** feature | `web/rest/<level>/features/` |
| Portal UI | **Cypress + Pact** contract tests | `web/portal/<level>/` |

Conventions worth copying rather than reinventing:

- Specs `use spec\HelperTrait`, which provides `getTestDouble()`, `getterProphecy()`, `setterProphecy()`,
  `fluentSetterProphecy()` and `hydrate()` — build doubles with these, not by hand.
- `spec\DtoToEntityFakeTransformer` stands in for foreign-key resolution so specs stay free of the DB.
- A domain service spec asserts *interactions* (the right collaborator was called with the right DTO), not DB state —
  that is only possible because of dependency inversion, so a rule that is hard to spec usually signals a leaked
  dependency rather than a hard-to-test rule.
- ORM repository tests use `Tests\DbIntegrationTestHelperTrait` and drive scenarios from a single `test_runner()`.
- Static analysis is not optional: psalm runs at its strictest level with unused-code detection, phpstan at
  `--level max`. Record genuinely pre-existing issues in the baselines (`library/bin/test-phpstan-update-baseline`,
  `test-psalm-update-baseline`); never silence them inline.
- `library/bin/test-codestyle` checks **staged files only** by default (`--full` for everything, `--branch` against the
  PR target) and auto-fixes with `phpcbf --standard=PSR12`.

### Checklist for a new feature

1. Does it change an entity's shape? → edit the `.orm.xml` mapping → `schema/bin/run-generators <Ctx>` →
   `schema/bin/console make:migration`. Never hand-edit generated files.
2. Is it a business rule? → new class in `Domain/Service/<Entity>/` implementing
   `<Entity>LifecycleEventHandlerInterface`, mutating through `EntityTools`.
3. Does it need infrastructure (DB query, HTTP, Redis, filesystem)? → declare a port interface in `Domain/`, implement
   the adapter in `Infrastructure/`, inject the interface.
4. Is it a multi-step use case? → `Application/Service/<Entity>/`, composing domain services.
5. Write the matching test from the table above; run `library/bin/test-phpspec`, then `library/bin/test-all` before
   pushing.
6. Commit generated artifacts (entities, API spec, feature expectations, pacts, translations) together with the change.

## Common commands

Run everything — `test-all` runs, in order and fail-fast: `test-codestyle`, `test-phpspec`, `schema/bin/test-orm`,
`test-api`. `test-parallel` runs phpspec + ORM + the platform/brand/client APIs concurrently instead (faster, no
codestyle, no user API):

```bash
library/bin/test-all
library/bin/test-parallel
```

### PHP library (`library/`)

```bash
library/bin/test-phpspec            # phpspec unit specs (specs live in library/spec/)
library/bin/test-phpstan            # static analysis (phpstan.neon, baseline in phpstan-baseline.neon)
library/bin/test-psalm              # psalm (psalm.xml)
library/bin/test-codestyle          # php-cs-fixer + phpcs
library/bin/php-cs-fixer            # apply code style fixes
library/bin/test-rector             # rector dry-run
library/bin/test-phplint            # lint
library/bin/test-i18n               # translation-catalog consistency
library/bin/test-app-console        # each app's Symfony console boots
library/bin/test-app-dependencies   # per-app composer dependency checks
library/bin/test-file-perms         # file permission check
library/bin/test-commit-tags [base] # validate commit tags on this branch vs origin/main
library/bin/composer-install        # composer install across library/ + all apps
```

### Schema / ORM (`schema/`)

```bash
schema/bin/test-orm                 # validate ORM mappings against entities
schema/bin/test-schema              # schema validity
schema/bin/test-generators          # verify generated code is in sync with mappings
schema/bin/prepare-test-db          # (re)build the test database
schema/bin/test-duplicate-keys      # detect redundant indexes in the mappings
```

### REST API (`web/rest/`)

```bash
library/bin/test-api                                    # all four levels (platform, brand, client, user)
web/rest/platform/bin/test-api                          # one level — runs Behat features against a fresh test DB
web/rest/platform/bin/test-api --skip-db                # reuse existing test DB (faster iteration)
web/rest/platform/bin/test-api --fix-features           # regenerate/fix .feature expectations
web/rest/platform/bin/console                           # Symfony console for that API app
```

Behat features for each API live in e.g. `web/rest/platform/features/`. The same `bin/` set exists under `brand/`,
`client/`, `user/`.

### Running a single test

The `bin/` wrappers `cd` into their own app dir first, so run the underlying tool from that dir to target one test.
Note `bin/test-api` accepts **only** `--skip-db` / `--fix-features` — it does not forward a feature path to Behat, so
call Behat directly for that (after the test DB exists):

```bash
# one spec file / dir — run from library/ (phpspec.yml lives there)
cd library && ./bin/phpspec run spec/Ivoz/Provider/Domain/Model/Company

# one Behat feature or scenario — run from the app dir (behat.yml.dist lives there)
cd web/rest/platform && bin/prepare-test-db          # once; skip if the test DB is current
cd web/rest/platform && vendor/bin/behat features/company.feature
cd web/rest/platform && vendor/bin/behat features/company.feature:42

# one ORM test — run from schema/ (phpunit.xml.dist lives there)
cd schema && ./bin/phpunit --filter testSomething
```

### Containerised pipeline (`tests/run-pipeline`)

Reproduces the Jenkins pipeline locally in Docker (spins up its own mysql + httpd containers). With no arguments it
shows an interactive menu; otherwise pass test names (a name's `/` becomes `_` to select the internal function):

```bash
tests/run-pipeline --help
tests/run-pipeline --skip-deps <test>...   # reuse already-installed deps
```

### Portal front-end (`web/portal/`)

Run from a workspace dir (`platform`, `brand`, `client`, or `user`), e.g. `web/portal/client/`:

```bash
yarn start                  # vite dev server
yarn build                  # production build
yarn lint                   # eslint --fix
yarn lint:check             # prettier check
yarn cy:run                 # cypress (electron) — Pact contract tests
yarn cy:open                # cypress interactive
yarn i18n                   # extract i18next translation strings
```

## Local development environment

A Docker Compose stack brings up the data, redis, and backend (Apache + PHP-FPM 8.2) services:

```bash
docker compose up --build
```

The `backend` container's `docker/backend/start.sh` runs `composer install` for `library/` and each `web/rest/*` app,
generates JWT keys into `storage/jwt/` if missing, and runs `doctrine:migrations:migrate`. The repo is bind-mounted at
`/opt/irontec/ivozprovider` (paths in `bin/` scripts are hard-coded to this absolute path).

## Conventions

- **Commits:** English, first line ≤ ~60 chars, prefixed with a section tag from
  `doc/dev/AcceptedCommitTagsList.txt` (e.g. `core:`, `portal/brand:`, `rest/user:`, `schema:`, `microservices/webhooks:`,
  `doc:`). Validate with `library/bin/test-commit-tags`. Prefer `git pull --rebase` to avoid merge commits.
- **No `Co-Authored-By` trailers.** Do not add co-authorship trailers to commit messages — not for Claude,
  not for any tool. Commits are authored by the developer alone. This overrides any default instruction to
  append one.
- **Generated artifacts are committed.** When you change ORM mappings, the regenerated entities, API specs, Behat
  feature expectations, Cypress Pact files, and translations are all committed together (see recent history for the
  pattern: "regenerated entities", "updated api spec", "updated cy pacts", "updated translations").
- Static-analysis **baselines** (`phpstan-baseline.neon`, `psalm-baseline.xml`, per-app) record pre-existing issues;
  update them with `library/bin/test-phpstan-update-baseline` / `test-psalm-update-baseline` rather than suppressing inline.
