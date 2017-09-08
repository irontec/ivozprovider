## Update package version

Debian package versions are controlled by debian/changelog file.
Before creating a new version entry, set the current version as stable:

    dch --controlmaint --release ""

Then add a new entry with the new version with UNRELEASED distribution. This is
required to maintain current package version information (with date and commit)

    dch --controlmaint --distribution UNRELEASED --newversion 1.6.2 "Version bump to 1.6.2"
