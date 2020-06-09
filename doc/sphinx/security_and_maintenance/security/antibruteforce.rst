########################
Anti brute-force attacks
########################

IvozProvider ships a simple anti brute-force attack in KamUsers that bans sources after continuous SIP auth failures.

It works like this:

- On SIP failures (invalid user or invalid password cases only), a counter is increased:

  - Key: fromUsername@fromDomain::protocol:source_ip:source_port
     - e.g. terminal@vpbx.domain.net::udp:1.2.3.4:24107

- Counter is increased on every failure.

- When counter reaches 100, that specific source (user + domain + proto + ip + port) is banned for 12 hours.


After 12 hours, source is accepted again and:

- Counter starts counting again from 80.

- If it reaches 100 again, it is banned for another 12 hours.


This simple mechanism prevents brute-force attacks from sources excluded from :ref:`SIP Antiflooding` mechanism.
