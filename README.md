![IvozProvider Logo](portals/public/images/logoprovider.png) ![stable](portals/public/images/stable-1.0-blue.png) ![release](portals/public/images/release-oasis-14b9bc.png)

Ivoz Provider is a multitenant solution for VoIP telephony providers designed for horizontal scaling and load balancing.

## Features
#### Multitenancy
IvozProvider supports multiple management levels, from Global platform administator to final user, each of them having its own web interface with visibility to perform configuration tasks.

 * Global Administator manages multiple Brands
 * Brand Administrators manage multiple Companies
 * Company Administrators manage multiple Users
 * Users manage their preferences

#### Scaling
From its beginning, IvozProvider was designed to be installed distributed between multiple machines, each one fullfilling one of the existing profiles:

 * Proxy:
   - Provides **SIP communication** with Providers and Users terminals
   - Provides **media relay** between endpoints
   - Powered by [Kamailo SIP Server 4.4](https://www.kamailio.org/w/)

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
   - Powered by [MySQL 5.5 Server](http://www.mysql.com/)

And [many others](https://ivozprovider.github.io/ivozprovider/en/intro/what_is_inside.html) open source projects.

Bear in mind that, while at least one of each profile must be installed for the platform to work, there can be multiple machines of each profile and all of them can also be installed in the same machine (a.k.a. standalone installation).

![scaling](portals/public/images/horizontalscaling.png)

#### Cloud Service
IvozProvider is designed to work directly from the Internet. Although it can be used in local environments, being exposed to the public network [has it's advantages](https://ivozprovider.github.io/ivozprovider/es/intro/what_is_ivozprovider.html#expuesta-a-la-red-publica)

## Installation

There are [several ways](https://ivozprovider.github.io/ivozprovider/en/installation) to install IvozProvider.

If you want to test an [standlone](https://ivozprovider.github.io/ivozprovider/en/installation/install_types.html#instalacion-standalone) installation, we recommend using one of auto-install CDs based on Debian Jessie 8.0 amd64.


| Version  | 64 bits  | 32 bits | VMKD image |
|----------|:--------:|:-------:|:----------:|
|oasis 1.0 (stable) | [![iso torrent](portals/public/images/iso-torrent-blue.png)](http://daily.ivozprovider.irontec.com/torrents/ivozprovider-1.0-oasis-amd64-iso.torrent) [![iso http](portals/public/images/iso-http-green.png)](http://daily.ivozprovider.irontec.com/torrents/ivozprovider-1.0-oasis-amd64.iso)| [![iso torrent](portals/public/images/iso-torrent-blue.png)](http://daily.ivozprovider.irontec.com/torrents/ivozprovider-1.0-oasis-i386-iso.torrent) [![iso http](portals/public/images/iso-http-green.png)](http://daily.ivozprovider.irontec.com/torrents/ivozprovider-1.0-oasis-i386.iso)| [![vmkd torrent](portals/public/images/vmkd-torrent-blue.png)](http://daily.ivozprovider.irontec.com/torrents/ivozprovider-1.0-oasis-amd64-vmkd.torrent) [![vmkd http](portals/public/images/vmkd-http-green.png)](http://daily.ivozprovider.irontec.com/torrents/ivozprovider-1.0-oasis-amd64.vmkd)|
|oasis 1.1 (nightly-build) | [![iso http](portals/public/images/iso-http-green.png)](http://daily.ivozprovider.irontec.com/torrents/ivozprovider-1.1-oasis-nightly-amd64.iso)| [![iso http](portals/public/images/iso-http-green.png)](http://daily.ivozprovider.irontec.com/torrents/ivozprovider-1.1-oasis-nightly-amd64.iso)| [![vmkd http](portals/public/images/vmkd-http-green.png)](http://daily.ivozprovider.irontec.com/torrents/ivozprovider-1.1-oasis-nightly-amd64.vmkd)|


## Documentation

You can browse online documentation in different formats:

| Language | HTML | LaTeX | PDF | EPUB |
|----------|:----:|:-----:|:---:|:----:|
| Spanish  | [![badge html](portals/public/images/doc-html-green.png)](https://ivozprovider.github.io/ivozprovider/es) [![badge singlehtml](portals/public/images/doc-singlehtml-green.png)](https://ivozprovider.github.io/ivozprovider/essingle) | [![badge latex](portals/public/images/doc-latex-ff69b4.png)](https://ivozprovider.github.io/ivozprovider/eslatex/IvozProvider-1.0-oasis-es.tex) | [![badge pdf](portals/public/images/doc-pdf-blue.png)](https://ivozprovider.github.io/ivozprovider/eslatex/IvozProvider-1.0-oasis-es.pdf) | [![badge epub](portals/public/images/doc-epub-orange.png)](https://ivozprovider.github.io/ivozprovider/esepub/IvozProvider-1.0-oasis-es.epub) |
| English  | [![badge html](portals/public/images/doc-html-green.png)](https://ivozprovider.github.io/ivozprovider/en) [![badge singlehtml](portals/public/images/doc-singlehtml-green.png)](https://ivozprovider.github.io/ivozprovider/ensingle) | [![badge latex](portals/public/images/doc-latex-ff69b4.png)](https://ivozprovider.github.io/ivozprovider/enlatex/IvozProvider-1.0-oasis-en.tex) | [![badge pdf](portals/public/images/doc-pdf-blue.png)](https://ivozprovider.github.io/ivozprovider/enlatex/IvozProvider-1.0-oasis-en.pdf) | [![badge epub](portals/public/images/doc-epub-orange.png)](https://ivozprovider.github.io/ivozprovider/esepub/IvozProvider-1.0-oasis-en.epub) |


## Feedback & Questions

Feel free to subscribe to ivozprovider mailing lists for users or developers for any question
or suggestion.

 - users@lists-ivozprovider.irontec.com
 - dev@list-ivozproivder.irontec.com

Any feedback is also welcomed at [#ivozprovider irc channel](https://webchat.freenode.net/?channels=ivozprovider) at irc.freenode.net

## License
    Ivoz Provider - Multitenant solution for VoIP telephony providers
    Copyright (C) 2014-2016 Irontec S.L.

    Licensed under the EUPL, Version 1.1 or - as soon they will be approved by the European
    Commission - subsequent versions of the EUPL (the "Licence"); You may not use this work
    except in compliance with the Licence.

    You may obtain a copy of the Licence at:
    http://ec.europa.eu/idabc/eupl.html

    Unless required by applicable law or agreed to in writing, software distributed under
    the Licence is distributed on an "AS IS" basis, WITHOUT WARRANTIES OR CONDITIONS OF
    ANY KIND, either express or implied. See the Licence for the specific language
    governing permissions and limitations under the Licence.


