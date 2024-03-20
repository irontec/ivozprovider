## Commit format

In order to maintain some kind of order in the commits the preferred languange
will be english.

Preferably the commit message will have a descriptive first line with a prefix
that will reference the most changed section by the commit. This line must not
be larger than 60 chars, as recommendation.

For a list of valid commit tags check doc/dev/AcceptedCommitTagsList.txt

Commit messages have optionally a long description from second line onwards. This
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

