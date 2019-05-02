## Commit format

In order to maintain some kind of order in the commits the preferred languange
will be english.

Preferably the commit message will have a descriptive first line with a prefix
that will reference the most changed section by the commit. This line must not
be larger than 60 chars, as recommendation.

While this prefixs are not fixed, it is recommended to use the already existing
ones in the git log history.

    - doc: Changes in documentation (no source code changed)
    - web/admin: Changes for web, portals klears, and so on
    - web/rest: Changes in API entities and endpoints
    - web/user: Changes in user angular based portal
    - kamtrunks: Changes in proxys working with trunks
    - kamusers: Changes in proxys working with users
    - agis: Changes that affect logic of PBX
    - schema: Changes that only affect database tables structures
    - core: Changes in data entities (almost everything under libray dir)
    - i18n: Internalization or translation changes
    - pkg: Changes related to debian package system
    - tests: Changes affecting how CI test behave
    - ...

Tags can be as especific as required and could reference some services like
fax:, provisioning: or invoicer:

Commit messages have optionaly a long description from second line onwards. This
description can contain a mantis or gitlab issue code.


## Conflict resolution

Whenever possible, it is preferred to avoid merge commits when we pull new changes.
A common practice to avoid this changes will be to rebase our changes while pulling:

    git pull --rebase

This way, our pending commits will be generated from the latest pushed commit to the
server, instead of forcing a merge commit.

If multiple developers have changed the same files, the latest must try to merge its
changes and continue with the rebase process. If this is not possible, check your changes
with the developer that make the prior conflict commit.

