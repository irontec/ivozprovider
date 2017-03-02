.. _provisioning:

#####################
Terminal provisioning
#####################

IvozProvider supports provisioning of terminals via HTTP/HTTPS that fulfill the
following requirements:

- Assuming a just unboxed terminal, just plugged and connected to the network:

   - Ask IP address via DHCP.

   - DCHP has enabled the option 66 that points to the platform portal

   - The first requested provisioning file is a static file (different for each 
     model) prefixed with the previous step URL.

   - The served file can redefine the URL for further requests


Any terminal model that can adapt to this provisioning way can be added into
the section **Platform Configuration > Terminal manufacturers**.

.. rubric:: Example Cisco SPA504G

- Cisco SPA504G is turned on and requests an IP address to DHCP

- Receives “http://provision.example.com/provision” as DHCP option 66

- Request HTTP configuration from http://provision.example.com/provision/spa504g.cfg

- All 504G request the same file (spa504.cfg), prefixed with the given URL

- This file only contain basic configuration settings for the model and the URL 
  for the next request (p.e. https://provision.example.com/provision/$MAC.cfg)

- This way, each terminal (MAC should be unique) request a specific file 
  (and different) after the generic one has been served.

- This file will contain the specific configuration for the terminal:

   - User

   - Password

   - SIP Domain


.. note:: IvozProvider provisioning system, right now, only has one goal:
          provide credential and language settings for the terminals.

Configuration of supported models
=================================

IvozProvider uses a template system that allows global operator (God) to
define new models and configure what files will be served.

The help section of **Terminal manufacturers** has examples for models supported
*out-of-the-box* in IvozProvider:

- Cisco SPA (502, 504, 509, 514 y 525)

- Yealink (T21P, T21Pe2, T23P, T27P, T48G, W52P, W56P)

.. hint:: These models will be available after the initial installation, but
          you must edit them and load the default configuration before
          you can use the provisioning system (option **Restore default template**).

Analyzing the suggested templates you can have a basic idea of the flexibility of
the system to configure any existing terminal model in the market.

