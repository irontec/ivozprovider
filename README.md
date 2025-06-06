<img src="doc/images/logoprovider.png" width="350"> ![stable](https://raster.shields.io/badge/latest-4.4-blue.png) ![release](https://raster.shields.io/badge/release-tempest-14b9bc.png)

Ivoz Provider is a multitenant solution for VoIP telephony providers designed for horizontal scaling and load balancing.

## Features
#### Multitenancy
IvozProvider supports multiple management levels, from Global platform administrator to final user, each of them having its own web interface with visibility to perform configuration tasks.

 * Global Administrator manages multiple Brands
 * Brand Administrators manage multiple Companies
 * Company Administrators manage multiple Users
 * Users manage their preferences

#### Scaling
From its beginning, IvozProvider was designed to be installed distributed between multiple machines, each one fullfilling one of the existing profiles:

 * Proxy:
   - Provides **SIP communication** with Providers and Users terminals
   - Provides **media relay** between endpoints
   - Powered by [Kamailo SIP Server 5.7](https://www.kamailio.org/w/)

 * Portal:
   - Provides **Web interfaces** for all platform roles
   - Access to all Bussiness data and shared files through **Rest API** services

 * Application Server:
   - Provides **PBX features** and runs configured logics
   - Powered by [Asterisk 20 LTS](http://www.asterisk.org/) with [PJSIP](http://www.pjsip.org/) channel driver
   - Logics implemented in PHP using fastagi AGI

 * Data:
   - Provides database and shared storage for the rest of machines
   - Powered by [Percona Server 8.0](https://www.percona.com/software/mysql-database/percona-server)

And [many others](https://irontec.github.io/ivozprovider/en/basic_concepts/intro/what_is_inside.html) open source projects.

Bear in mind that, while at least one of each profile must be installed for the platform to work, there can be multiple machines of each profile and all of them can also be installed in the same machine (a.k.a. standalone installation).

#### Cloud Service
IvozProvider is designed to work directly from the Internet. Although it can be used in local environments, being exposed to the public network [has it's advantages](https://irontec.github.io/ivozprovider/en/basic_concepts/intro/what_is_ivozprovider.html#exposed-to-the-public-network)

## Installation

There are [several ways](https://irontec.github.io/ivozprovider/en/basic_concepts/installation/index.html) to install IvozProvider.

If you want to test an [standalone](https://irontec.github.io/ivozprovider/en/basic_concepts/installation/install_types.html#standalone-install) installation, we recommend using one of auto-install CDs based on Debian Bookworm 12 amd64.


| Release | Version                    |                                                                 ISO Link                                                                 |
|-----------------------|----------------------------|:---------------------------------------------------------------------------------------------------------------------------------------:|
| oasis | 1.7 |     [![iso http](doc/images/iso-http-green.png)](https://packages.irontec.com/isos/ivozprovider-1.7.1-oasis-amd64.iso)     |
| artemis | 2.23.0 | [![iso http](doc/images/iso-http-green.png)](https://packages.irontec.com/isos/ivozprovider-2.23~2.23.0-artemis-amd64.iso) | |
| halliday | 3.4.1 | [![iso http](doc/images/iso-http-green.png)](https://packages.irontec.com/isos/ivozprovider-3.4~3.4.1-halliday-amd64.iso)  | |
| tempest | 4.4.0 |  [![iso http](doc/images/iso-http-green.png)](https://packages.irontec.com/isos/ivozprovider-4.4~4.4.0-tempest-amd64.iso)  | |


You can read about differences between releases [here](https://github.com/irontec/ivozprovider/blob/main/FAQ.md#what-release-should-i-use).

## Documentation

You can browse online documentation in different formats:

| Language | HTML | LaTeX | PDF | EPUB |
|----------|:----:|:-----:|:---:|:----:|
| Spanish  | [![badge html](doc/images/doc-html-green.png)](https://irontec.github.io/ivozprovider/es/tempest) [![badge singlehtml](doc/images/doc-singlehtml-green.png)](https://irontec.github.io/ivozprovider/essingle/tempest) | [![badge latex](doc/images/doc-latex-ff69b4.png)](https://irontec.github.io/ivozprovider/eslatex/tempest/IvozProvider.tex) | [![badge pdf](doc/images/doc-pdf-blue.png)](https://irontec.github.io/ivozprovider/eslatex/tempest/IvozProvider.pdf) | [![badge epub](doc/images/doc-epub-orange.png)](https://irontec.github.io/ivozprovider/esepub/tempest/IvozProvider.epub) |
| English  | [![badge html](doc/images/doc-html-green.png)](https://irontec.github.io/ivozprovider/en/tempest) [![badge singlehtml](doc/images/doc-singlehtml-green.png)](https://irontec.github.io/ivozprovider/ensingle/tempest) | [![badge latex](doc/images/doc-latex-ff69b4.png)](https://irontec.github.io/ivozprovider/enlatex/tempest/IvozProvider.tex) | [![badge pdf](doc/images/doc-pdf-blue.png)](https://irontec.github.io/ivozprovider/enlatex/tempest/IvozProvider.pdf) | [![badge epub](doc/images/doc-epub-orange.png)](https://irontec.github.io/ivozprovider/enepub/tempest/IvozProvider.epub) |


## Feedback & Questions

Any feedback is also welcomed at [#ivozprovider irc channel](https://kiwiirc.com/nextclient/irc.libera.chat/#ivozprovider) at irc.libera.chat

You can read frequently asked questions [here](https://github.com/irontec/ivozprovider/blob/main/FAQ.md).

For environment or functional questions, use [ivozprovider-users](https://groups.google.com/forum/#!forum/ivozprovider-users) group.

## Commercial support

Don't hesitate to [contact us](https://www.irontec.com/contacto) for support if you plan to create a multi instance installation or want any kind of help with your systems.

## License
    Ivoz Provider - Multitenant solution for VoIP telephony providers
    Copyright (C) 2014-2024 Irontec S.L.

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    In addition, as a special exception, the copyright holders give
    permission to link the code of portions of this program with the
    OpenSSL library under certain conditions as described in each
    individual source file, and distribute linked combinations
    including the two.
    You must obey the GNU General Public License in all respects
    for all of the code used other than OpenSSL.  If you modify
    file(s) with this exception, you may extend this exception to your
    version of the file(s), but you are not obligated to do so.  If you
    do not wish to do so, delete this exception statement from your
    version.  If you delete this exception statement from all source
    files in the program, then also delete it here.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.

