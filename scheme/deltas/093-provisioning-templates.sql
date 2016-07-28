INSERT IGNORE INTO TerminalManufacturers (iden, name, description)  VALUES ('Yealink','Yealink','Yealink'),('Cisco','Cisco','Cisco');
INSERT IGNORE INTO TerminalModels (iden, name, description, genericTemplate, genericUrlPattern, specificTemplate, specificUrlPattern, TerminalManufacturerId) VALUES (
'YealinkT21P_E2','YealinkT21P_E2','YealinkT21P_E2','#!version:1.0.0.1\r\n
account.1.enable = 1 \r\n
account.1.label = Line\r\n\r\n
auto_provision.mode = 6\r\n
auto_provision.schedule.periodic_minute = 1\r\n
auto_provision.server.url = https://<?php echo $_SERVER[\'SERVER_NAME\'] ?>:1443/provision/t21E2\r\n
auto_provision.dhcp_option.enable = 0\r\n
auto_provision.pnp_enable = 0\r\n\r\n\r\n
lang.gui = Spanish\r\nlang.wui = Spanish\r\n\r\n
local_time.time_zone = +1\r\n
local_time.ntp_server1 = es.pool.ntp.org\r\n
local_time.ntp_server2 = \r\n
local_time.interval = 1000\r\n
local_time.summer_time = 2\r\n
local_time.start_time = 1/1/0\r\n
local_time.end_time = 12/31/23\r\n\r\n
security.trust_certificates = 0',
'y000000000052.cfg',
'#!version:1.0.0.1\r\n
account.1.user_name = <?php echo $this->terminal->getName(); ?> \r\n
account.1.auth_name = <?php echo $this->terminal->getName(); ?> \r\n
account.1.password = <?php echo $this->terminal->getPassword(); ?> \r\n
account.1.display_name = <?php echo $this->user->getName(); ?> \r\n
account.1.label = <?php echo $this->user->getName(); ?> \r\n
account.1.sip_server_host = <?php echo $this->company->getDomainUsers(); ?> \r\n
account.1.sip_server_port = 5060',
't21E2/{mac}.cfg',
(SELECT id from TerminalManufacturers WHERE iden = 'Yealink'));

INSERT IGNORE INTO TerminalModels (iden, name, description, genericTemplate, genericUrlPattern, specificTemplate, specificUrlPattern, TerminalManufacturerId) VALUES (
'YealinkT21P','YealinkT21P','YealinkT21P',
'#!version:1.0.0.1\r\n
account.1.enable = 1 \r\n
account.1.label = Line\r\n\r\n
auto_provision.mode = 6\r\n
auto_provision.schedule.periodic_minute = 1\r\n
auto_provision.server.url = https://<?php echo $_SERVER[\'SERVER_NAME\'] ?>:1443/provision/t21\r\n
auto_provision.dhcp_option.enable = 0\r\n
auto_provision.pnp_enable = 0\r\n\r\n
lang.gui = Spanish\r\n
lang.wui = Spanish\r\n\r\n
local_time.time_zone = +1\r\n
local_time.ntp_server1 = es.pool.ntp.org\r\n
local_time.ntp_server2 = \r\n
local_time.interval = 1000\r\n
local_time.summer_time = 2\r\n
local_time.start_time = 1/1/0\r\n
local_time.end_time = 12/31/23\r\n\r\n
security.trust_certificates = 0',
'y000000000034.cfg',
'#!version:1.0.0.1\r\n
account.1.user_name = <?php echo $this->terminal->getName(); ?>\r\n
account.1.auth_name = <?php echo $this->terminal->getName(); ?> \r\n
account.1.password = <?php echo $this->terminal->getPassword(); ?> \r\n
account.1.display_name = <?php echo $this->user->getName(); ?> \r\n
account.1.sip_server_host = <?php echo $this->company->getDomainUsers(); ?>\r\n
account.1.sip_server_port = 5060\r\n',
't21/{mac}.cfg',
(SELECT id from TerminalManufacturers WHERE iden = 'Yealink'));

INSERT IGNORE INTO TerminalModels (iden, name, description, genericTemplate, genericUrlPattern, specificTemplate, specificUrlPattern, TerminalManufacturerId) VALUES (
'YealinkT27P','YealinkT27P','YealinkT27P',
'#!version:1.0.0.1\r\n
account.1.enable = 1 \r\n
account.1.label = Line\r\n\r\n
auto_provision.mode = 6\r\n
auto_provision.schedule.periodic_minute = 1\r\n
auto_provision.server.url = https://<?php echo $_SERVER[\'SERVER_NAME\'] ?>:1443/provision/t27\r\n
auto_provision.dhcp_option.enable = 0\r\n
auto_provision.pnp_enable = 0\r\n\r\n
lang.gui = Spanish\r\n
lang.wui = Spanish\r\n\r\n
local_time.time_zone = +1\r\n
local_time.ntp_server1 = es.pool.ntp.org\r\n
local_time.ntp_server2 = \r\n
local_time.interval = 1000\r\n
local_time.summer_time = 2\r\n
local_time.start_time = 1/1/0\r\n
local_time.end_time = 12/31/23\r\n\r\n
security.trust_certificates = 0',
'y000000000045.cfg',
'#!version:1.0.0.1\r\n
account.1.user_name = <?php echo $this->terminal->getName(); ?>\r\n
account.1.auth_name = <?php echo $this->terminal->getName(); ?> \r\n
account.1.password = <?php echo $this->terminal->getPassword(); ?> \r\n
account.1.display_name = <?php echo $this->user->getName(); ?> \r\n
account.1.sip_server_host = <?php echo $this->company->getDomainUsers(); ?>\r\n
account.1.sip_server_port = 5060\r\n',
't27/{mac}.cfg',
(SELECT id from TerminalManufacturers WHERE iden = 'Yealink'));

INSERT IGNORE INTO TerminalModels (iden, name, description, genericTemplate, genericUrlPattern, specificTemplate, specificUrlPattern, TerminalManufacturerId) VALUES (
'SPA502G','SPA502G','SPA502G',
'<flat-profile>\r\n\r\n\r\n
<Provision_Enable>Yes</Provision_Enable>\r\n
<Resync_On_Reset>Yes</Resync_On_Reset>\r\n
<Resync_Random_Delay>2</Resync_Random_Delay>\r\n
<Resync_Periodic>30</Resync_Periodic>\r\n
<Resync_Error_Retry_Delay>4000</Resync_Error_Retry_Delay>\r\n
<Forced_Resync_Delay>14400</Forced_Resync_Delay>\r\n
<Resync_From_SIP>Yes</Resync_From_SIP>\r\n
<Resync_After_Upgrade_Attempt>Yes</Resync_After_Upgrade_Attempt>\r\n
<Resync_Trigger_1/>\r\n
<Resync_Trigger_2/>\r\n
<Resync_Fails_On_FNF>Yes</Resync_Fails_On_FNF>\r\n
<SPCP_Auto-detect>No</SPCP_Auto-detect>\r\n\r\n
<Transport_Protocol>https</Transport_Protocol>\r\n\r\n
<Profile_Rule>https://<?php echo $_SERVER[\'SERVER_NAME\']; ?>:2443/provision/spa502g/$MA.cfg</Profile_Rule>\r\n\r\n
<Set_Local_Date__mm_dd_/>\r\n
<Set_Local_Time__HH_mm_/>\r\n
<Time_Zone>GMT+01:00</Time_Zone>\r\n
<Time_Offset__HH_mm_/>\r\n
<Daylight_Saving_Time_Rule>start=3/-1/7/2;end=10/-1/7/3;save=1;</Daylight_Saving_Time_Rule>\r\n
<Daylight_Saving_Time_Enable>Yes</Daylight_Saving_Time_Enable>\r\n
<DTMF_Playback_Level>-16</DTMF_Playback_Level>\r\n
<DTMF_Playback_Length>.1</DTMF_Playback_Length>\r\n
<Inband_DTMF_Boost>12dB</Inband_DTMF_Boost>\r\n
<Default_Character_Encoding>UTF-8</Default_Character_Encoding>\r\n\r\n
<Primary_NTP_Server>es.pool.ntp.org</Primary_NTP_Server>\r\n\r\n
<?php\r\n
echo \"<Language_Selection>Spanish</Language_Selection>\";\r\n
echo \"<Dictionary_Server_Script>serv=https://\" . $_SERVER[\'SERVER_NAME\'] . \":2443/terminals/ciscolang/\";\r\n\r\n
preg_match(\"/-([0-9\\.]*).*[\\s,]+/\", $_SERVER[\'HTTP_USER_AGENT\'], $firmware);\r\n
if(array_key_exists(\"1\", $firmware)){\r\n
  switch($firmware[1]){\r\n
       case \"7.5.1\": echo \";d0=English;x0=spa50x_30x_en_v751.xml;d1=Spanish;x1=spa50x_30x_es_v751.xml\"; break;\r\n
       case \"7.5.2\": echo \";d0=English;x0=spa50x_30x_en_v751.xml;d1=Spanish;x1=spa50x_30x_es_v751.xml\"; break;\r\n
       case \"7.5.3\": echo \";d0=English;x0=spa50x_30x_en_v753.xml;d1=Spanish;x1=spa50x_30x_es_v753.xml\"; break;\r\n
       case \"7.5.4\": echo \";d0=English;x0=spa50x_30x_en_v754.xml;d1=Spanish;x1=spa50x_30x_es_v754.xml\"; break;\r\n
       case \"7.5.5\": echo \";d0=English;x0=spa50x_30x_en_v755.xml;d1=Spanish;x1=spa50x_30x_es_v755.xml\"; break;\r\n
       case \"7.5.6\": echo \";d0=English;x0=spa50x_30x_en_v756.xml;d1=Spanish;x1=spa50x_30x_es_v756.xml\"; break;\r\n
      default:      echo \";d0=English;x0=spa50x_30x_en_v756.xml;d1=Spanish;x1=spa50x_30x_es_v756.xml\"; break;\r\n
   }\r\n
}\r\n
echo \"</Dictionary_Server_Script>\";\r\n?>\r\n\r\n
</flat-profile>\r\n',
'spa502G.cfg',
'<flat-profile>\r\n\r\n
<User_ID_1_><?php echo $this->terminal->getName(); ?></User_ID_1_>\r\n
<Password_1_><?php echo $this->terminal->getPassword(); ?></Password_1_>\r\n
<Use_Auth_ID_1_>No</Use_Auth_ID_1_>\r\n
<Auth_ID_1_><?php echo $this->terminal->getName(); ?></Auth_ID_1_>\r\n
<Station_Name><?php echo $this->user->getName()?> </Station_Name>\r\n
<Proxy_1_><?php echo $this->company->getDomainUsers(); ?>:5060</Proxy_1_>\r\n\r\n
<?php echo \"# HTTPS BUG. retarda terminales si pide provisioning cada X segundos\\n\";?>\r\n
<Resync_Periodic></Resync_Periodic>\r\n\r\n
<?php echo \"# Pedimos provisioning una vez al dÃ­a a las 3 AM\\n\";?>\r\n
<Resync_At__HHmm_>0300</Resync_At__HHmm_>\r\n\r\n</flat-profile>',
'spa502g/{mac}.cfg',
(SELECT id from TerminalManufacturers WHERE iden = 'Cisco'));

INSERT IGNORE INTO TerminalModels (iden, name, description, genericTemplate, genericUrlPattern, specificTemplate, specificUrlPattern, TerminalManufacturerId) VALUES (
'SPA504G', 'SPA504G', 'SPA504G',
'<flat-profile>\r\n\r\n\r\n
<Provision_Enable>Yes</Provision_Enable>\r\n
<Resync_On_Reset>Yes</Resync_On_Reset>\r\n
<Resync_Random_Delay>2</Resync_Random_Delay>\r\n
<Resync_Periodic>30</Resync_Periodic>\r\n
<Resync_Error_Retry_Delay>4000</Resync_Error_Retry_Delay>\r\n
<Forced_Resync_Delay>14400</Forced_Resync_Delay>\r\n
<Resync_From_SIP>Yes</Resync_From_SIP>\r\n
<Resync_After_Upgrade_Attempt>Yes</Resync_After_Upgrade_Attempt>\r\n
<Resync_Trigger_1/>\r\n
<Resync_Trigger_2/>\r\n
<Resync_Fails_On_FNF>Yes</Resync_Fails_On_FNF>\r\n
<SPCP_Auto-detect>No</SPCP_Auto-detect>\r\n\r\n
<Transport_Protocol>https</Transport_Protocol>\r\n\r\n
<Profile_Rule>https://<?php echo $_SERVER[\'SERVER_NAME\']; ?>:2443/provision/spa504g/$MA.cfg</Profile_Rule>\r\n\r\n
<Set_Local_Date__mm_dd_/>\r\n
<Set_Local_Time__HH_mm_/>\r\n
<Time_Zone>GMT+01:00</Time_Zone>\r\n
<Time_Offset__HH_mm_/>\r\n
<Daylight_Saving_Time_Rule>start=3/-1/7/2;end=10/-1/7/3;save=1;</Daylight_Saving_Time_Rule>\r\n
<Daylight_Saving_Time_Enable>Yes</Daylight_Saving_Time_Enable>\r\n
<DTMF_Playback_Level>-16</DTMF_Playback_Level>\r\n
<DTMF_Playback_Length>.1</DTMF_Playback_Length>\r\n
<Inband_DTMF_Boost>12dB</Inband_DTMF_Boost>\r\n
<Default_Character_Encoding>UTF-8</Default_Character_Encoding>\r\n\r\n
<Primary_NTP_Server>es.pool.ntp.org</Primary_NTP_Server>\r\n\r\n
<?php\r\n
echo \"<Language_Selection>Spanish</Language_Selection>\";\r\n
echo \"<Dictionary_Server_Script>serv=https://\" . $_SERVER[\'SERVER_NAME\'] . \":2443/terminals/ciscolang/\";\r\n\r\n
preg_match(\"/-([0-9\\.]*).*[\\s,]+/\", $_SERVER[\'HTTP_USER_AGENT\'], $firmware);\r\n
if(array_key_exists(\"1\", $firmware)){\r\n
  switch($firmware[1]){\r\n
       case \"7.5.1\": echo \";d0=English;x0=spa50x_30x_en_v751.xml;d1=Spanish;x1=spa50x_30x_es_v751.xml\"; break;\r\n
       case \"7.5.2\": echo \";d0=English;x0=spa50x_30x_en_v751.xml;d1=Spanish;x1=spa50x_30x_es_v751.xml\"; break;\r\n
       case \"7.5.3\": echo \";d0=English;x0=spa50x_30x_en_v753.xml;d1=Spanish;x1=spa50x_30x_es_v753.xml\"; break;\r\n
       case \"7.5.4\": echo \";d0=English;x0=spa50x_30x_en_v754.xml;d1=Spanish;x1=spa50x_30x_es_v754.xml\"; break;\r\n
       case \"7.5.5\": echo \";d0=English;x0=spa50x_30x_en_v755.xml;d1=Spanish;x1=spa50x_30x_es_v755.xml\"; break;\r\n
       case \"7.5.6\": echo \";d0=English;x0=spa50x_30x_en_v756.xml;d1=Spanish;x1=spa50x_30x_es_v756.xml\"; break;\r\n
      default:      echo \";d0=English;x0=spa50x_30x_en_v756.xml;d1=Spanish;x1=spa50x_30x_es_v756.xml\"; break;\r\n
   }\r\n
}\r\n
echo \"</Dictionary_Server_Script>\";\r\n?>\r\n\r\n
</flat-profile>\r\n',
'spa504G.cfg',
'<flat-profile>\r\n\r\n
<User_ID_1_><?php echo $this->terminal->getName(); ?></User_ID_1_>\r\n
<Password_1_><?php echo $this->terminal->getPassword(); ?></Password_1_>\r\n
<Use_Auth_ID_1_>No</Use_Auth_ID_1_>\r\n
<Auth_ID_1_><?php echo $this->terminal->getName(); ?></Auth_ID_1_>\r\n
<Station_Name><?php echo $this->user->getName()?> </Station_Name>\r\n
<Proxy_1_><?php echo $this->company->getDomainUsers(); ?>:5060</Proxy_1_>\r\n\r\n
<?php echo \"# HTTPS BUG. retarda terminales si pide provisioning cada X segundos\\n\";?>\r\n
<Resync_Periodic></Resync_Periodic>\r\n\r\n
<?php echo \"# Pedimos provisioning una vez al dÃ­a a las 3 AM\\n\";?>\r\n
<Resync_At__HHmm_>0300</Resync_At__HHmm_>\r\n\r\n</flat-profile>',
'spa504g/{mac}.cfg',
(SELECT id from TerminalManufacturers WHERE iden = 'Cisco'));

INSERT IGNORE INTO TerminalModels (iden, name, description, genericTemplate, genericUrlPattern, specificTemplate, specificUrlPattern, TerminalManufacturerId) VALUES (
'SPA509G', 'SPA509G', 'SPA509G',
'<flat-profile>\r\n\r\n\r\n
<Provision_Enable>Yes</Provision_Enable>\r\n
<Resync_On_Reset>Yes</Resync_On_Reset>\r\n
<Resync_Random_Delay>2</Resync_Random_Delay>\r\n
<Resync_Periodic>30</Resync_Periodic>\r\n
<Resync_Error_Retry_Delay>4000</Resync_Error_Retry_Delay>\r\n
<Forced_Resync_Delay>14400</Forced_Resync_Delay>\r\n
<Resync_From_SIP>Yes</Resync_From_SIP>\r\n
<Resync_After_Upgrade_Attempt>Yes</Resync_After_Upgrade_Attempt>\r\n
<Resync_Trigger_1/>\r\n
<Resync_Trigger_2/>\r\n
<Resync_Fails_On_FNF>Yes</Resync_Fails_On_FNF>\r\n
<SPCP_Auto-detect>No</SPCP_Auto-detect>\r\n\r\n
<Transport_Protocol>https</Transport_Protocol>\r\n\r\n
<Profile_Rule>https://<?php echo $_SERVER[\'SERVER_NAME\']; ?>:2443/provision/spa509g/$MA.cfg</Profile_Rule>\r\n\r\n
<Set_Local_Date__mm_dd_/>\r\n
<Set_Local_Time__HH_mm_/>\r\n
<Time_Zone>GMT+01:00</Time_Zone>\r\n
<Time_Offset__HH_mm_/>\r\n
<Daylight_Saving_Time_Rule>start=3/-1/7/2;end=10/-1/7/3;save=1;</Daylight_Saving_Time_Rule>\r\n
<Daylight_Saving_Time_Enable>Yes</Daylight_Saving_Time_Enable>\r\n
<DTMF_Playback_Level>-16</DTMF_Playback_Level>\r\n
<DTMF_Playback_Length>.1</DTMF_Playback_Length>\r\n
<Inband_DTMF_Boost>12dB</Inband_DTMF_Boost>\r\n
<Default_Character_Encoding>UTF-8</Default_Character_Encoding>\r\n\r\n
<Primary_NTP_Server>es.pool.ntp.org</Primary_NTP_Server>\r\n\r\n
<?php\r\n
echo \"<Language_Selection>Spanish</Language_Selection>\";\r\n
echo \"<Dictionary_Server_Script>serv=https://\" . $_SERVER[\'SERVER_NAME\'] . \":2443/terminals/ciscolang/\";\r\n\r\n
preg_match(\"/-([0-9\\.]*).*[\\s,]+/\", $_SERVER[\'HTTP_USER_AGENT\'], $firmware);\r\n
if(array_key_exists(\"1\", $firmware)){\r\n
  switch($firmware[1]){\r\n
       case \"7.5.1\": echo \";d0=English;x0=spa50x_30x_en_v751.xml;d1=Spanish;x1=spa50x_30x_es_v751.xml\"; break;\r\n
       case \"7.5.2\": echo \";d0=English;x0=spa50x_30x_en_v751.xml;d1=Spanish;x1=spa50x_30x_es_v751.xml\"; break;\r\n
       case \"7.5.3\": echo \";d0=English;x0=spa50x_30x_en_v753.xml;d1=Spanish;x1=spa50x_30x_es_v753.xml\"; break;\r\n
       case \"7.5.4\": echo \";d0=English;x0=spa50x_30x_en_v754.xml;d1=Spanish;x1=spa50x_30x_es_v754.xml\"; break;\r\n
       case \"7.5.5\": echo \";d0=English;x0=spa50x_30x_en_v755.xml;d1=Spanish;x1=spa50x_30x_es_v755.xml\"; break;\r\n
       case \"7.5.6\": echo \";d0=English;x0=spa50x_30x_en_v756.xml;d1=Spanish;x1=spa50x_30x_es_v756.xml\"; break;\r\n
      default:      echo \";d0=English;x0=spa50x_30x_en_v756.xml;d1=Spanish;x1=spa50x_30x_es_v756.xml\"; break;\r\n
   }\r\n
}\r\n
echo \"</Dictionary_Server_Script>\";\r\n?>\r\n\r\n
</flat-profile>\r\n',
'spa509G.cfg',
'<flat-profile>\r\n\r\n
<User_ID_1_><?php echo $this->terminal->getName(); ?></User_ID_1_>\r\n
<Password_1_><?php echo $this->terminal->getPassword(); ?></Password_1_>\r\n
<Use_Auth_ID_1_>No</Use_Auth_ID_1_>\r\n
<Auth_ID_1_><?php echo $this->terminal->getName(); ?></Auth_ID_1_>\r\n
<Station_Name><?php echo $this->user->getName()?> </Station_Name>\r\n
<Proxy_1_><?php echo $this->company->getDomainUsers(); ?>:5060</Proxy_1_>\r\n\r\n
<?php echo \"# HTTPS BUG. retarda terminales si pide provisioning cada X segundos\\n\";?>\r\n
<Resync_Periodic></Resync_Periodic>\r\n\r\n
<?php echo \"# Pedimos provisioning una vez al dÃ­a a las 3 AM\\n\";?>\r\n
<Resync_At__HHmm_>0300</Resync_At__HHmm_>\r\n\r\n</flat-profile>',
'spa509g/{mac}.cfg',
(SELECT id from TerminalManufacturers WHERE iden = 'Cisco'));

INSERT IGNORE INTO TerminalModels (iden, name, description, genericTemplate, genericUrlPattern, specificTemplate, specificUrlPattern, TerminalManufacturerId) VALUES (
'spa525G2', 'SPA525G2', 'SPA525G2',
'<flat-profile>\r\n\r\n\r\n
<Provision_Enable>Yes</Provision_Enable>\r\n
<Resync_On_Reset>Yes</Resync_On_Reset>\r\n
<Resync_Random_Delay>2</Resync_Random_Delay>\r\n
<Resync_Periodic>30</Resync_Periodic>\r\n
<Resync_Error_Retry_Delay>4000</Resync_Error_Retry_Delay>\r\n
<Forced_Resync_Delay>14400</Forced_Resync_Delay>\r\n
<Resync_From_SIP>Yes</Resync_From_SIP>\r\n
<Resync_After_Upgrade_Attempt>Yes</Resync_After_Upgrade_Attempt>\r\n
<Resync_Trigger_1/>\r\n
<Resync_Trigger_2/>\r\n
<Resync_Fails_On_FNF>Yes</Resync_Fails_On_FNF>\r\n
<SPCP_Auto-detect>No</SPCP_Auto-detect>\r\n\r\n
<Profile_Rule>https://<?php echo $_SERVER[\'SERVER_NAME\']; ?>:2443/provision/spa525g2/$MA.cfg</Profile_Rule>\r\n\r\n
<Set_Local_Date__mm_dd_/>\r\n
<Set_Local_Time__HH_mm_/>\r\n
<Time_Zone>GMT+01:00</Time_Zone>\r\n
<Time_Offset__HH_mm_/>\r\n
<Daylight_Saving_Time_Rule>start=3/-1/7/2;end=10/-1/7/3;save=1;</Daylight_Saving_Time_Rule>\r\n
<Daylight_Saving_Time_Enable>Yes</Daylight_Saving_Time_Enable>\r\n
<DTMF_Playback_Level>-16</DTMF_Playback_Level>\r\n
<DTMF_Playback_Length>.1</DTMF_Playback_Length>\r\n
<Inband_DTMF_Boost>12dB</Inband_DTMF_Boost>\r\n
<Default_Character_Encoding>UTF-8</Default_Character_Encoding>\r\n\r\n
<Primary_NTP_Server>es.pool.ntp.org</Primary_NTP_Server>\r\n\r\n\r\n
<?php\r\necho \"<Language_Selection>Spanish</Language_Selection>\";\r\n
echo \"<Dictionary_Server_Script>serv=https://\" . $_SERVER[\'SERVER_NAME\'] . \":2443/terminals/ciscolang/\";\r\n\r\
npreg_match(\"/-([0-9\\.]*).*[\\s,]+/\", $_SERVER[\'HTTP_USER_AGENT\'], $firmware);\r\n
if(array_key_exists(\"1\", $firmware)){\r\n
    switch($firmware[1]){\r\n
       case \"7.5.1\": echo \";d0=English;x0=spa525_en_v751.xml;d1=Spanish;x1=spa525_es_v751.xml\"; break;\r\n
       case \"7.5.2\": echo \";d0=English;x0=spa525_en_v751.xml;d1=Spanish;x1=spa525_es_v751.xml\"; break;\r\n
       case \"7.5.3\": echo \";d0=English;x0=spa525_en_v753.xml;d1=Spanish;x1=spa525_es_v753.xml\"; break;\r\n
       case \"7.5.4\": echo \";d0=English;x0=spa525_en_v754.xml;d1=Spanish;x1=spa525_es_v754.xml\"; break;\r\n
       case \"7.5.5\": echo \";d0=English;x0=spa525_en_v755.xml;d1=Spanish;x1=spa525_es_v755.xml\"; break;\r\n
       case \"7.5.6\": echo \";d0=English;x0=spa525_en_v756.xml;d1=Spanish;x1=spa525_es_v756.xml\"; break;\r\n
       default:      echo \";d0=English;x0=spa525_en_v756.xml;d1=Spanish;x1=spa525_es_v756.xml\"; break;\r\n
   }\r\n
}\r\n
echo \"</Dictionary_Server_Script>\";\r\n
?>\r\n\r\n\r\n
</flat-profile>\r\n',
'spa525G2.cfg',
'<flat-profile>\r\n\r\n
<User_ID_1_><?php echo $this->terminal->getName(); ?></User_ID_1_>\r\n
<Password_1_><?php echo $this->terminal->getPassword(); ?></Password_1_>\r\n
<Use_Auth_ID_1_>No</Use_Auth_ID_1_>\r\n
<Auth_ID_1_><?php echo $this->terminal->getName(); ?></Auth_ID_1_>\r\n
<Station_Name><?php echo $this->user->getName()?> </Station_Name>\r\n
<Proxy_1_><?php echo $this->company->getDomainUsers(); ?>:5060</Proxy_1_>\r\n\r\n\r\n
<Resync_Periodic></Resync_Periodic>\r\n\r\n\r\n
<Resync_At__HHmm_>0300</Resync_At__HHmm_>\r\n\r\n
</flat-profile>',
'spa525g2/{mac}.cfg',
(SELECT id from TerminalManufacturers WHERE iden = 'Cisco'));

