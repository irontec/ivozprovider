## Update package version

Debian package versions are controlled by debian/changelog file.
Before creating a new version entry, set the current version as stable:

    # dch --controlmaint --release ""

Then add a new entry with the new version with UNRELEASED distribution. This is
required to maintain current package version information (with date and commit)

    # dch --controlmaint --distribution UNRELEASED --newversion 2.2~2.2.6 "Version bump to 2.2.6"

## Update documentation version

_This is only required for minor releases upgrades (ignore for patch versioning)._

Sphinx shows documentation version above the left menu:

    # sed -i 's/\(version =\) .*/\1 "2.8"/' doc/sphinx/conf.py
    # sed -i 's/IvozProvider [0-9\.]\+ Documentation/IvozProvider 2.8 Documentation/' doc/sphinx/conf.py

## Update Application User Agent

_This is only required for minor releases upgrades (ignore for patch versioning)._

Update the user-agent presented by asterisk:

    # sed -i 's/\(user_agent=Irontec IvozProvider\) .*/\1 v2.2/' asterisk/config/pjsip.conf

## Update Kamailio User Agent and Server

_This is only required for minor releases upgrades (ignore for patch versioning)._

Update the strings presented by both kamailios:

    # sed -i 's/\(server_header="Server: Irontec IvozProvider\) .*/\1 v2.2"/' kamailio/trunks/config/kamailio.cfg
    # sed -i 's/\(server_header="Server: Irontec IvozProvider\) .*/\1 v2.2"/' kamailio/users/config/kamailio.cfg
    # sed -i 's/\(user_agent_header="User-Agent: Irontec IvozProvider\) .*/\1 v2.2"/' kamailio/trunks/config/kamailio.cfg
    # sed -i 's/\(user_agent_header="User-Agent: Irontec IvozProvider\) .*/\1 v2.2"/' kamailio/users/config/kamailio.cfg


## Update project README.md and ChangeLog

This is a bit tricky, because the _visible_ README in github may not belong the released branch, but the stable release.

The best approach is to update the releasing branch README.md and ChangeLog with new information in a single commit then
cherry-pick it to other maintained branches.

- Update ISO links and version information in Installation section
    The filenames for ISOs can be browsed at http://packages.irontec.com/isos/

- If the stable minor version has changed, update the README header with a new badget
    Cool badgets can be generated at https://shields.io/ and must be saved at _web/admin/public/images/_

If all this changes and new files are added/modified in the same commit it should be safe for all branches.
