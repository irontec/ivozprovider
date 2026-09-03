---
name: release-ivozprovider
description: Cut an IvozProvider release - bump versions, write the ChangeLog and the API changelogs, open the release pull request and, once merged, tag tempest and publish the GitHub release. Use when the user asks to prepare or publish a release, "sacar la release", "prepara la 4.8.0", or says "/release-ivozprovider".
---

# Release

Prepare and publish an IvozProvider release. The human procedure this automates
is documented in `doc/dev/RELEASE.md`; keep both in sync when changing either.

Releases go from `main` to `tempest`, the maintained release branch. The work is
split in a pull request (phases 1 to 5) and a set of post-merge steps (phase 6).

## Rules

- **Never write to Jira.** Reading a ticket is required; creating, commenting,
  transitioning or releasing versions is not this skill's job.
- **Never run the ISO or documentation Jenkins jobs.** They are listed as a
  reminder at the end.
- Commits carry no `Co-Authored-By` trailer, as stated in `AGENTS.md`.
- Stop for review before committing anything the model wrote (phases 3 and 4).
  Everything else is mechanical and self-checked.

## Resuming

The skill has no state of its own: on every run, work out where the release
stands and continue from there.

```bash
git rev-parse --abbrev-ref HEAD
git log --oneline origin/main..HEAD
gh pr view --json number,state,mergedAt,url 2>/dev/null
git tag --list "v<X.Y.Z>"
```

| Situation | Phase to continue from |
| --- | --- |
| No release branch | 0 |
| Branch without version commit | 2 |
| Version commit present, no package version commit | 2, from the package step |
| Package version commit present, no ChangeLog commit | 3 |
| ChangeLog commit present, no API changelog commit | 4 |
| Commits ready, no pull request | 5 |
| Pull request merged, tag missing | 6 |
| Tag present, GitHub release missing | 6, from the release step |

## Phase 0 - Ticket and version

Ask the user which Jira ticket the release belongs to. Read it (read only) to
get its key and its fix version:

- Branch prefix: the ticket key, for example `PROVIDER-2467`.
- Version: the ticket fix version, for example `4.7.0`.

If Jira cannot be reached, ask the user for the ticket key and the version.
**Without a ticket, stop**: the branch name is what links the pull request to
Jira in Jenkins.

Then work out the release type and confirm it with the user before touching
anything:

```bash
git describe --tags --abbrev=0 main      # previous release, e.g. v4.7.0
git merge-base main tempest              # release range starts here
```

- `MAJOR.MINOR` changed since the previous tag: **minor** release.
- Only `PATCH` changed: **patch** release.

Show which files each type touches and ask for confirmation. If the user's
answer contradicts the version numbers, stop and explain the conflict; never
mix both flows.

Refuse to continue if `main` is not clean and up to date.

## Phase 1 - Branch

```bash
git fetch origin main
git checkout -b <TICKET>-changelog-<X.Y.Z> origin/main
```

## Phase 2 - Versions

```bash
scripts/update-version.sh <X.Y.Z>
git status --short
```

Expected on a **minor** release, nothing else:

```
README.md  asterisk/config/pjsip.conf.in  doc/sphinx/conf.py
kamailio/trunks/config/kamailio.cfg  kamailio/users/config/kamailio.cfg
web/portal/{platform,brand,client,user}/package.json
```

On a **patch** release only `README.md` and the four `package.json` change; the
other substitutions rewrite the same `MAJOR.MINOR` value.

Verify no commit or tag appeared on its own (`git log --oneline -1`,
`git tag --points-at HEAD`), then commit:

- Minor: `doc: update all versions to <X.Y.Z>`
- Patch: `portal: update portals versions to <X.Y.Z>` for the four
  `package.json`, then `doc: update README for <X.Y.Z> release`

Then bump the Debian package version, which marks the current
`debian/changelog` entry as stable and opens a new `UNRELEASED` one:

```bash
scripts/update-package-version.sh <X.Y.Z>
```

Only `debian/changelog` changes. Commit it as `pkg: version bump to <X.Y.Z>`.

## Phase 3 - ChangeLog

```bash
scripts/release-commits.sh
```

Read `reference/changelog-format.md` before writing. Turn its output into a new
entry at the top of `ChangeLog`:

- Group by section, merge related pull requests into one entry, and rewrite
  each one for users rather than for developers.
- Drop internal work: CI, tests, refactors, local development environment,
  packaging plumbing. Collapse dependency updates into a single entry.
- Keep every discarded pull request in a list and **show it to the user** along
  with the draft, so nothing disappears silently.

Stop, show the draft entry and the discarded list, and apply the user's
corrections. Then commit `doc: update ChangeLog for <X.Y.Z> release`.

## Phase 4 - API changelog

```bash
for APP in platform brand client user; do scripts/apispec-diff.sh $APP; done
```

An application exiting with 1 has no API changes and gets no entry. For the
rest, add a `## <X.Y.Z>` section on top of `web/rest/<app>/CHANGELOG.md`
following `reference/changelog-format.md`.

Stop for review, then commit `doc: update API Changelog for <X.Y.Z> release`.

## Phase 5 - ISO packages and pull request

```bash
scripts/check-iso-packages.sh
```

If it reports missing packages, add them to `extra/simple-cdd/package.list` in
alphabetical order and commit `iso: add missing ivozprovider packages for ISO
generation`, listing them in the commit body.

Check the commit tags and open the pull request:

```bash
library/bin/test-commit-tags origin/main
git push -u origin <TICKET>-changelog-<X.Y.Z>
gh pr create --base main --title "Update ChangeLog for <X.Y.Z> release" --body-file <body>
```

Title and body in English. Body is `.github/PULL_REQUEST_TEMPLATE.md` with
`New feature or enhancement` and the two commit checklist boxes ticked.

Then wait for the checks and merge it after the user confirms:

```bash
gh pr view --json statusCheckRollup,reviewDecision,mergeable
gh pr merge --merge
```

Warn the user if Jenkins is red or the review is missing, and do not merge
until they explicitly say so.

## Phase 6 - After the merge

Only once the pull request is merged (`gh pr view --json mergedAt`). Otherwise
stop and say so.

```bash
git checkout main && git pull --ff-only
git checkout tempest && git pull --ff-only
git merge main -m "Merge commit for <X.Y.Z>"
git tag v<X.Y.Z>

git checkout main
git merge --ff-only tempest

git push origin main tempest
git push origin v<X.Y.Z>
```

`--ff-only` on `main` is deliberate: it fails instead of discarding commits
someone else merged meanwhile. If it fails, stop and report it.

Publish the GitHub release with the body format from
`reference/changelog-format.md`:

```bash
gh release create v<X.Y.Z> --title "IvozProvider v<X.Y.Z>" --notes-file <body>
```

Finally print, without doing any of it:

```
Release v<X.Y.Z> published. Left to do by hand:

1. Wait for the package build to finish (announced in Mattermost / Jenkins).
2. Run the ivozprovider-install-cd job to build the ISO image:
   https://jenkins.irontec.com/view/VoIP/job/ivozprovider/view/Other/job/ivozprovider-install-cd/
3. Run the ivozprovider-github-pages job to regenerate the documentation:
   https://jenkins.irontec.com/view/VoIP/job/ivozprovider/view/Other/job/ivozprovider-github-pages/
4. Check that the ISO link written in the README resolves.
```
