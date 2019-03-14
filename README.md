![IvozProvider Logo](web/admin/public/images/logoprovider.png) ![stable](web/admin/public/images/stable-1.7-blue.png) ![release](web/admin/public/images/release-oasis-14b9bc.png)

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
   - Powered by [Kamailo SIP Server 5.1](https://www.kamailio.org/w/)

 * Portal:
   - Provides **Web interfaces** for all platform roles
   - Access to all Bussiness data and shared files through **Rest API** services
   - Management interfaces powered by [Klear Framework](https://www.irontec.com/internet/klear)
   - User interface powered by [AngularJS](https://angularjs.org/)

 * Application Server:
   - Provides **PBX features** and runs configured logics
   - Powered by [Asterisk 13 LTS](http://www.asterisk.org/) with [PJSIP](http://www.pjsip.org/) channel driver
   - Logics implemented in PHP using fastagi AGI

 * Data:
   - Provides database and shared storage for the rest of machines
   - Powered by [MySQL 5.7 Server](http://www.mysql.com/)

And [many others](https://irontec.github.io/ivozprovider/en/artemis/basics/intro/what_is_inside.html) open source projects.

Bear in mind that, while at least one of each profile must be installed for the platform to work, there can be multiple machines of each profile and all of them can also be installed in the same machine (a.k.a. standalone installation).

![scaling](web/admin/public/images/horizontalscaling.png)

#### Cloud Service
IvozProvider is designed to work directly from the Internet. Although it can be used in local environments, being exposed to the public network [has it's advantages](https://irontec.github.io/ivozprovider/en/artemis/basics/intro/what_is_ivozprovider.html#exposed-to-the-public-network)

## Installation

There are [several ways](https://irontec.github.io/ivozprovider/en/artemis/basics/installation) to install IvozProvider.

If you want to test an [standalone](https://irontec.github.io/ivozprovider/en/artemis/basics/installation/install_types.html#standalone-install) installation, we recommend using one of auto-install CDs based on Debian Stretch 9.4 amd64.


| Version  | 64 bits  | 32 bits |
|----------|:--------:|:-------:|
|stable (oasis 1.7) | [![iso http](web/admin/public/images/iso-http-green.png)](http://packages.irontec.com/isos/ivozprovider-1.7.1-oasis-amd64.iso)| [![iso http](web/admin/public/images/iso-http-green.png)](http://packages.irontec.com/isos/ivozprovider-1.7.1-oasis-i386.iso)|
|testing (artemis 2.9.3) | [![iso http](web/admin/public/images/iso-http-green.png)](http://packages.irontec.com/isos/ivozprovider-2.9~2.9.3-artemis-amd64.iso)| [![iso http](web/admin/public/images/iso-http-green.png)](http://packages.irontec.com/isos/ivozprovider-2.9~2.9.3-artemis-i386.iso)|
|experimental (bleeding 2.x) | |


You can read about differences between releases [here](https://github.com/irontec/ivozprovider/blob/bleeding/FAQ.md#what-release-should-i-use).

## Documentation

You can browse online documentation in different formats:

| Language | HTML | LaTeX | PDF | EPUB |
|----------|:----:|:-----:|:---:|:----:|
| Spanish  | [![badge html](web/admin/public/images/doc-html-green.png)](https://irontec.github.io/ivozprovider/es/artemis) [![badge singlehtml](web/admin/public/images/doc-singlehtml-green.png)](https://irontec.github.io/ivozprovider/essingle/artemis) | [![badge latex](web/admin/public/images/doc-latex-ff69b4.png)](https://irontec.github.io/ivozprovider/eslatex/artemis/IvozProvider.tex) | [![badge pdf](web/admin/public/images/doc-pdf-blue.png)](https://irontec.github.io/ivozprovider/eslatex/artemis/IvozProvider.pdf) | [![badge epub](web/admin/public/images/doc-epub-orange.png)](https://irontec.github.io/ivozprovider/esepub/artemis/IvozProvider.epub) |
| English  | [![badge html](web/admin/public/images/doc-html-green.png)](https://irontec.github.io/ivozprovider/en/artemis) [![badge singlehtml](web/admin/public/images/doc-singlehtml-green.png)](https://irontec.github.io/ivozprovider/ensingle/artemis) | [![badge latex](web/admin/public/images/doc-latex-ff69b4.png)](https://irontec.github.io/ivozprovider/enlatex/artemis/IvozProvider.tex) | [![badge pdf](web/admin/public/images/doc-pdf-blue.png)](https://irontec.github.io/ivozprovider/enlatex/artemis/IvozProvider.pdf) | [![badge epub](web/admin/public/images/doc-epub-orange.png)](https://irontec.github.io/ivozprovider/enepub/artemis/IvozProvider.epub) |


## Feedback & Questions

Any feedback is also welcomed at [#ivozprovider irc channel](https://webchat.freenode.net/?channels=ivozprovider) at irc.freenode.net

You can read frequently asked questions [here](https://github.com/irontec/ivozprovider/blob/bleeding/FAQ.md).

## Commercial support

Don't hesitate to [contact us](https://www.irontec.com/contacto) for support if you plan to create a multi instance installation or want any kind of help with your systems.

## License
    Ivoz Provider - Multitenant solution for VoIP telephony providers
    Copyright (C) 2014-2018 Irontec S.L.

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

