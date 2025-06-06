# Frequently Asked Questions

## Table of Contents
1. [What is IvozProvider?](#what-is-ivozprovider)
2. [Is IvozProvider free?](#is-ivozprovider-free)
3. [I would like to try, where should I start?](#i-would-like-to-try-where-should-i-start)
4. [What release should I use?](#what-release-should-i-use)
5. [Can I use IvozProvider without public IP address?](#can-i-use-ivozprovider-without-public-ip-address)
6. [I have trouble with my environment!](#i-have-a-trouble-with-my-environment)
7. [I have found a bug](#i-have-found-a-bug)
8. [I have a feature request](#i-have-a-feature-request)
9. [What language should I use while reporting?](#what-language-should-i-use-while-reporting)
10. [I have tested standalone, how can I install a distributed installation?](#i-have-tested-standalone-how-can-i-install-a-distributed-installation)
11. [This solution is not useful without this feature](#this-solution-is-not-useful-without-this-feature)
12. [I would like to contribute](#i-would-like-to-contribute)
13. [How can I setup a development environment of the project?](#how-can-i-setup-a-development-environment-of-the-project)

### What is IvozProvider?

IvozProvider is a carrier grade multilevel IP telephony solution exposed to the public network.

### Is IvozProvider free?

Yes. This project is free as in freedom, but not as in beer.
Source code is licensed under GPLv3 or later, so you can download, modify and distribute it for free.

### I would like to try, where should I start?

We provide a standalone iso to test the solution in a single machine. These environments are not
recommended for production. You will also find [online docs](https://irontec.github.io/ivozprovider/en/halliday/)
with detailed information of every section.

### What release should I use?

Current stable release is called artemis. Stable releases have frozen features, so they won't evolve too much in time.
This provides the required stability that telephony solutions demands.

Halliday release has ended as a transition release without extensive battle testing, so we discourage its usage.

If you're interested in testing the newest features, you can use Tempest release. Keep in mind that Tempest release is actively being developed and some bugs may arise, so use it at your own risk.

### Can I use IvozProvider without public IP address?

No. Current design assumes you have at least one public IP address.
That address must be present in your network interfaces in order to bind services.

### I have trouble with my environment!

We don't provide any kind of free support for installations. If you have trouble, you can contact our sales department
at comercial@irontec.com or ask in [ivozprovider-users](https://groups.google.com/forum/#!forum/ivozprovider-users) group.

If by any chance you receive support in the group or #ivozprovider Libera.Chat IRC channel by any developer, it's most
probably provided during spare time, so be thankful for the people giving part of their time.

### I have found a bug

If you have a bug or something that you can prove it's not working as it should, don't hesitate to open an issue
in Github project. We appreciate well documented bug reports that help to improve the software quality.

### I have a feature request

If you have a feature request that you think it would be helpful for others, don't hesitate to open an issue in github
project. Take into account that we're a small development team and features won't be scheduled unless someone pays
for them. If you're interested in sponsoring a feature, please contact with our sales department at comercial@irontec.com
Otherwise, the feature won't be implemented unless one of our clients finds it useful.

### What language should I use while reporting?

We use english for reporting Github issues and IRC. It's not our native language so we apologize in advance for
grammatical errors, but we think it's the best way to share knowledge and information with everyone.

### I have tested standalone, how can I install a distributed installation?

Currently there is no documentation for distributed installations. This requires quite some time and we are a small team with
lots of tasks scheduled. If you need advice or support for distributed installations, please contact our sales department at
comercial@irontec.com so we can schedule it properly.

### This solution is not useful without this feature

We do free (as in freedom) software because we think it's the best way to produce high quality products. Our code is
public so everyone can see what's exactly being done during each process. But this software is shipped without any kind
of warranty and project members have no debt with others but their clients, so avoid any kind of order or imposition.

If solution doesn't fulfill your requirements or you find a solution that fits better, use it. If you are
interested in improving the software, consider sponsoring any missing feature.

### I would like to contribute

Free projects are usually managed by small developers teams, so we highly appreciate all contributions. There are all
kind of different tasks you can contribute, from coding to documenting or translating.

If you're opening a Pull request in Github, take a look to [development docs](https://github.com/irontec/ivozprovider/tree/main/doc/dev/en)
for commits and branches naming. Also, try to listen to provided suggestions from project developers: they strive to
make the software as good as possible.

### How can I setup a development environment of the project?

Currently there is no documentation for creating a development environment.



