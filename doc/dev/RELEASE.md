# Releasing IvozProvider

Releases are cut from `main` and published on the branch of the maintained
release, currently `tempest`. Every release is made of:

- A pull request against `main` bumping versions and writing changelogs.
- A set of post-merge steps that move `tempest` forward, tag it and publish
  the GitHub release.

A single Jira ticket owns the release: its key gives the branch prefix and its
fix version the version being released.

The whole procedure is also available as the `release-ivozprovider` Claude Code
skill (`.claude/skills/release-ivozprovider/`), which runs these same steps and
helper scripts.

## 1. Before you start

- Work on an up to date and clean `main`.
- Get the Jira ticket of the release: it gives both the branch prefix and,
  through its fix version, the version being released.
- The previous release is `git describe --tags --abbrev=0 main`, and the range
  of the release is everything between that tag and `main`.

Create the branch:

```bash
git checkout -b PROVIDER-<ticket>-changelog-<X.Y.Z> main
```

## 2. Bump versions

```bash
scripts/update-version.sh X.Y.Z
```

This updates the Sphinx documentation version, the Asterisk and Kamailio user
agents, the README stable badge and tempest ISO row, and the four portal
`package.json` files.

On a **minor** release the nine files change and go in a single commit:

```
doc: update all versions to X.Y.Z
```

On a **patch** release only the README ISO row and the portal versions end up
modified (the rest of the substitutions write the same `MAJOR.MINOR` value
back), and they are split in two commits:

```
portal: update portals versions to X.Y.Z
doc: update README for X.Y.Z release
```

Check that nothing else changed, and that no stray commit or tag was created:

```bash
git status --short
```

Then bump the Debian package version, which marks the current entry of
`debian/changelog` as stable and opens a new `UNRELEASED` one:

```bash
scripts/update-package-version.sh X.Y.Z
```

Commit as:

```
pkg: version bump to X.Y.Z
```

## 3. Write the ChangeLog

```bash
scripts/release-commits.sh
```

It lists every pull request merged in the release range with its Jira ticket,
its commit tags, the components it touched and a suggested ChangeLog section,
plus two extra groups: dependency updates, which collapse into a single entry,
and commits pushed to `main` without a pull request, which are easy to miss.

Add the new entry at the top of `ChangeLog`, keeping the existing style:

```
Tue, 16 Jun 2026 10:00:00 +0200 IvozProvider Team <vozip+ivozprovider@irontec.com>

    * IvozProvider 4.7.0 released

    * Portals:
        - Added webhook management to brand and client portals (#3082)
```

- Sections are `Portals`, `Core`, `Kamailio`, `Asterisk`, `Provisioning`,
  `Schema` and `Misc`, in that order, and only the ones with entries.
- Entries are written for users, not for developers: features, visible fixes,
  API and configuration changes, and library updates. Refactors, CI, tests,
  local development environment and internal cleanups are left out.
- One entry may summarise several pull requests, listing all of their
  references.
- Lines wrap at 76 columns, with continuation lines indented ten spaces.

Commit as:

```
doc: update ChangeLog for X.Y.Z release
```

## 4. Write the API changelog

Each REST application keeps its own `web/rest/<app>/CHANGELOG.md`, written from
the differences between the committed API specs:

```bash
scripts/apispec-diff.sh platform
scripts/apispec-diff.sh brand
scripts/apispec-diff.sh client
scripts/apispec-diff.sh user
```

The script exits with 1 when an application has no changes; that application
gets no entry. Add a `## X.Y.Z` section on top of each changed file, with an
`* Endpoints:` block grouped by path and a `* Models:` block grouped by model,
following the previous entries.

Commit as:

```
doc: update API Changelog for X.Y.Z release
```

## 5. Check the ISO package list

```bash
scripts/check-iso-packages.sh
```

Packages added to `debian/control` during the release cycle are easily left out
of `extra/simple-cdd/package.list` and therefore out of the ISO. If the script
reports any, add them in alphabetical order and commit:

```
iso: add missing ivozprovider packages for ISO generation
```

## 6. Open the pull request

Open it against `main`, titled `Update ChangeLog for X.Y.Z release`, filling
the pull request template. Wait for Jenkins to pass and for a review, and merge
it once green.

## 7. After the merge

With the pull request merged and `main` updated:

```bash
# Move the maintained release branch forward and tag it
git checkout tempest
git merge main -m "Merge commit for X.Y.Z"
git tag vX.Y.Z

# Leave main at the same point as tempest
git checkout main
git merge --ff-only tempest

git push origin main tempest
git push origin vX.Y.Z
```

`git merge --ff-only` is deliberate: it fails instead of discarding anything if
someone merged into `main` in the meantime.

Then publish the GitHub release `IvozProvider vX.Y.Z` on the new tag. Its body
is the ChangeLog entry without the date header and without the line breaks
introduced by the 76 column wrap, followed by the links to the four API
changelogs and the full changelog comparison.

## 8. Steps left outside the repository

1. Wait for the package build to finish; it is announced in Mattermost and
   Jenkins.
2. Run the [ivozprovider-install-cd](https://jenkins.irontec.com/view/VoIP/job/ivozprovider/view/Other/job/ivozprovider-install-cd/)
   job to build the ISO image.
3. Run the [ivozprovider-github-pages](https://jenkins.irontec.com/view/VoIP/job/ivozprovider/view/Other/job/ivozprovider-github-pages/)
   job to regenerate the documentation.
4. Check that the ISO link written in the README resolves.
