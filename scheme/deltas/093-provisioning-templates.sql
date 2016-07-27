INSERT IGNORE INTO TerminalManufacturers (iden, name, description)  VALUES ('Yealink','Yealink','Yealink'),('Cisco','Cisco','Cisco');
INSERT IGNORE INTO TerminalModels (iden, name, description, genericTemplate, genericUrlPattern, specificTemplate, specificUrlPattern, TerminalManufacturerId) VALUES ('YealinkT21P_E2', 'YealinkT21P_E2', 'YealinkT21P_E2','#!version:1.0.0.1
account.1.enable = 1
account.1.label = Line

auto_provision.mode = 6
auto_provision.schedule.periodic_minute = 1
auto_provision.server.url = https://<?php echo $_SERVER[\'HTTP_HOST\'] ?>:1443/provision/t21E2
auto_provision.dhcp_option.enable = 0
auto_provision.pnp_enable = 0


lang.gui = Spanish
lang.wui = Spanish

local_time.time_zone = +1
local_time.ntp_server1 = es.pool.ntp.org
local_time.interval = 1000
local_time.summer_time = 2
local_time.start_time = 1/1/0
local_time.end_time = 12/31/23

security.trust_certificates = 0
','y000000000052.cfg','#!version:1.0.0.1
account.1.user_name = <?php echo $this->terminal->getName(); ?>
account.1.auth_name = <?php echo $this->terminal->getName(); ?>
account.1.password = <?php echo $this->terminal->getPassword(); ?>
account.1.display_name = <?php echo $this->user->getName(); ?>
account.1.label = <?php echo $this->user->getName(); ?>
account.1.sip_server_host = <?php echo $this->company->getDomainUsers(); ?>
account.1.sip_server_port = 5060
','t21E2/{mac}.cfg',(SELECT id from TerminalManufacturers WHERE iden = 'Yealink'));

INSERT IGNORE INTO TerminalModels (iden, name, description, genericTemplate, genericUrlPattern, specificTemplate, specificUrlPattern, TerminalManufacturerId) VALUES ('YealinkT21P', 'YealinkT21P', 'YealinkT21P','#!version:1.0.0.1
account.1.enable = 1
account.1.label = Line

auto_provision.mode = 6
auto_provision.schedule.periodic_minute = 1
auto_provision.server.url = https://<?php echo $_SERVER[\'HTTP_HOST\'] ?>:1443/provision/t21
auto_provision.dhcp_option.enable = 0
auto_provision.pnp_enable = 0

lang.gui = Spanish
lang.wui = Spanish

local_time.time_zone = +1
local_time.ntp_server1 = es.pool.ntp.org
local_time.interval = 1000
local_time.summer_time = 2
local_time.start_time = 1/1/0
local_time.end_time = 12/31/23

security.trust_certificates = 0
','y000000000034.cfg','#!version:1.0.0.1
account.1.user_name = <?php echo $this->terminal->getName(); ?>
account.1.auth_name = <?php echo $this->terminal->getName(); ?>
account.1.password = <?php echo $this->terminal->getPassword(); ?>
account.1.display_name = <?php echo $this->user->getName(); ?>
account.1.sip_server_host = <?php echo $this->company->getDomainUsers(); ?>
account.1.sip_server_port = 5060
','t21/{mac}.cfg',(SELECT id from TerminalManufacturers WHERE iden = 'Yealink'));

INSERT IGNORE INTO TerminalModels (iden, name, description, genericTemplate, genericUrlPattern, specificTemplate, specificUrlPattern, TerminalManufacturerId) VALUES ('YealinkT27P', 'YealinkT27P', 'YealinkT27P','#!version:1.0.0.1
account.1.enable = 1
account.1.label = Line

auto_provision.mode = 6
auto_provision.schedule.periodic_minute = 1
auto_provision.server.url = https://<?php echo $_SERVER[\'HTTP_HOST\'] ?>:1443/provision/t27
auto_provision.dhcp_option.enable = 0
auto_provision.pnp_enable = 0

lang.gui = Spanish
lang.wui = Spanish

local_time.time_zone = +1
local_time.ntp_server1 = es.pool.ntp.org
local_time.interval = 1000
local_time.summer_time = 2
local_time.start_time = 1/1/0
local_time.end_time = 12/31/23

security.trust_certificates = 0
','y000000000045.cfg','#!version:1.0.0.1
account.1.user_name = <?php echo $this->terminal->getName(); ?>
account.1.auth_name = <?php echo $this->terminal->getName(); ?>
account.1.password = <?php echo $this->terminal->getPassword(); ?>
account.1.display_name = <?php echo $this->user->getName(); ?>
account.1.sip_server_host = <?php echo $this->company->getDomainUsers(); ?>
account.1.sip_server_port = 5060
','t27/{mac}.cfg',(SELECT id from TerminalManufacturers WHERE iden = 'Yealink'));

INSERT IGNORE INTO TerminalModels (iden, name, description, genericTemplate, genericUrlPattern, specificTemplate, specificUrlPattern, TerminalManufacturerId) VALUES ('SPA502G', 'SPA502G', 'SPA502G','
<flat-profile>

<Provision_Enable>Yes</Provision_Enable>
<Resync_On_Reset>Yes</Resync_On_Reset>
<Resync_Random_Delay>2</Resync_Random_Delay>
<Resync_Periodic>30</Resync_Periodic>
<Resync_Error_Retry_Delay>4000</Resync_Error_Retry_Delay>
<Forced_Resync_Delay>14400</Forced_Resync_Delay>
<Resync_From_SIP>Yes</Resync_From_SIP>
<Resync_After_Upgrade_Attempt>Yes</Resync_After_Upgrade_Attempt>
<Resync_Trigger_1/>
<Resync_Trigger_2/>
<Resync_Fails_On_FNF>Yes</Resync_Fails_On_FNF>
<SPCP_Auto-detect>No</SPCP_Auto-detect>

<Profile_Rule>https://<?php echo $_SERVER[\'HTTP_HOST\'] ?>:2433/provision/spa502g/$MA.cfg</Profile_Rule>

<Set_Local_Date__mm_dd_/>
<Set_Local_Time__HH_mm_/>
<Time_Zone>GMT+01:00</Time_Zone>
<Time_Offset__HH_mm_/>
<Daylight_Saving_Time_Rule>start=3/-1/7/2;end=10/-1/7/3;save=1;</Daylight_Saving_Time_Rule>
<Daylight_Saving_Time_Enable>Yes</Daylight_Saving_Time_Enable>
<DTMF_Playback_Level>-16</DTMF_Playback_Level>
<DTMF_Playback_Length>.1</DTMF_Playback_Length>
<Inband_DTMF_Boost>12dB</Inband_DTMF_Boost>
<Default_Character_Encoding>UTF-8</Default_Character_Encoding>

<Primary_NTP_Server>es.pool.ntp.org</Primary_NTP_Server>


<?php
echo \"<Language_Selection>Spanish</Language_Selection>\";
echo \"<Dictionary_Server_Script>serv=https://\" . $_SERVER[\'HTTP_HOST\'] . \":2443/terminals/ciscolang/\";

preg_match(\"/-([0-9\.]*).*[\s,]+/\",$_SERVER[\'HTTP_USER_AGENT\'],$firmware);
if(array_key_exists(\"1\",$firmware)){
    switch($firmware[1]){
        case \"7.5.1\": echo \";d0=English;x0=spa50x_30x_en_v751.xml;d1=Spanish;x1=spa50x_30x_es_v751.xml\"; break;
        case \"7.5.2\": echo \";d0=English;x0=spa50x_30x_en_v751.xml;d1=Spanish;x1=spa50x_30x_es_v751.xml\"; break;
        case \"7.5.3\": echo \";d0=English;x0=spa50x_30x_en_v753.xml;d1=Spanish;x1=spa50x_30x_es_v753.xml\"; break;
        case \"7.5.4\": echo \";d0=English;x0=spa50x_30x_en_v754.xml;d1=Spanish;x1=spa50x_30x_es_v754.xml\"; break;
        case \"7.5.5\": echo \";d0=English;x0=spa50x_30x_en_v755.xml;d1=Spanish;x1=spa50x_30x_es_v755.xml\"; break;
        case \"7.5.6\": echo \";d0=English;x0=spa50x_30x_en_v756.xml;d1=Spanish;x1=spa50x_30x_es_v756.xml\"; break;
        default:        echo \";d0=English;x0=spa50x_30x_en_v756.xml;d1=Spanish;x1=spa50x_30x_es_v756.xml\"; break;
    }
}
echo \"</Dictionary_Server_Script>\"
?>

</flat-profile>
','spa502G.cfg','
<flat-profile>

<User_ID_1_><?php echo $this->terminal->getName(); ?></User_ID_1_>
<Password_1_><?php echo $this->terminal->getPassword(); ?></Password_1_>
<Use_Auth_ID_1_>No</Use_Auth_ID_1_>
<Auth_ID_1_><?php echo $this->terminal->getName(); ?></Auth_ID_1_>
<Station_Name><?php echo $this->user->getName()?> </Station_Name>
<Proxy_1_><?php echo $this->company->getDomainUsers(); ?>:5060</Proxy_1_>

<?php echo \"#HTTPS BUG. retarda terminales si pide provisioning cada X segundos\n\";?>
<Resync_Periodic></Resync_Periodic>

<?php echo \"#Pedimos provisioning una vez al dÃ­a a las 3 AM\n\";?>
<Resync_At__HHmm_>0300</Resync_At__HHmm_>

</flat-profile>
','spa502g/{mac}.cfg',(SELECT id from TerminalManufacturers WHERE iden = 'Cisco'));

INSERT IGNORE INTO TerminalModels (iden, name, description, genericTemplate, genericUrlPattern, specificTemplate, specificUrlPattern, TerminalManufacturerId) VALUES ('SPA504G', 'SPA504G', 'SPA504G','
<flat-profile>


<Provision_Enable>Yes</Provision_Enable>
<Resync_On_Reset>Yes</Resync_On_Reset>
<Resync_Random_Delay>2</Resync_Random_Delay>
<Resync_Periodic>30</Resync_Periodic>
<Resync_Error_Retry_Delay>4000</Resync_Error_Retry_Delay>
<Forced_Resync_Delay>14400</Forced_Resync_Delay>
<Resync_From_SIP>Yes</Resync_From_SIP>
<Resync_After_Upgrade_Attempt>Yes</Resync_After_Upgrade_Attempt>
<Resync_Trigger_1/>
<Resync_Trigger_2/>
<Resync_Fails_On_FNF>Yes</Resync_Fails_On_FNF>
<SPCP_Auto-detect>No</SPCP_Auto-detect>

<Profile_Rule>https://<?php echo $_SERVER[\'HTTP_HOST\'] ?>:2433/provision/spa504g/$MA.cfg</Profile_Rule>

<Resync_Periodic></Resync_Periodic>


<Set_Local_Date__mm_dd_/>
<Set_Local_Time__HH_mm_/>
<Time_Zone>GMT+01:00</Time_Zone>
<Time_Offset__HH_mm_/>
<Daylight_Saving_Time_Rule>start=3/-1/7/2;end=10/-1/7/3;save=1;</Daylight_Saving_Time_Rule>
<Daylight_Saving_Time_Enable>Yes</Daylight_Saving_Time_Enable>
<DTMF_Playback_Level>-16</DTMF_Playback_Level>
<DTMF_Playback_Length>.1</DTMF_Playback_Length>
<Inband_DTMF_Boost>12dB</Inband_DTMF_Boost>
<Default_Character_Encoding>UTF-8</Default_Character_Encoding>

<Primary_NTP_Server>es.pool.ntp.org</Primary_NTP_Server>


<?php
echo \"<Language_Selection>Spanish</Language_Selection>\";
echo \"<Dictionary_Server_Script>serv=https://\" . $_SERVER[\'HTTP_HOST\'] . \":2443/terminals/ciscolang/\";

preg_match(\"/-([0-9\.]*).*[\s,]+/\",$_SERVER[\'HTTP_USER_AGENT\'],$firmware);
if(array_key_exists(\"1\",$firmware)){
    switch($firmware[1]){
        case \"7.5.1\": echo \";d0=English;x0=spa50x_30x_en_v751.xml;d1=Spanish;x1=spa50x_30x_es_v751.xml\"; break;
        case \"7.5.2\": echo \";d0=English;x0=spa50x_30x_en_v751.xml;d1=Spanish;x1=spa50x_30x_es_v751.xml\"; break;
        case \"7.5.3\": echo \";d0=English;x0=spa50x_30x_en_v753.xml;d1=Spanish;x1=spa50x_30x_es_v753.xml\"; break;
        case \"7.5.4\": echo \";d0=English;x0=spa50x_30x_en_v754.xml;d1=Spanish;x1=spa50x_30x_es_v754.xml\"; break;
        case \"7.5.5\": echo \";d0=English;x0=spa50x_30x_en_v755.xml;d1=Spanish;x1=spa50x_30x_es_v755.xml\"; break;
        case \"7.5.6\": echo \";d0=English;x0=spa50x_30x_en_v756.xml;d1=Spanish;x1=spa50x_30x_es_v756.xml\"; break;
        default:        echo \";d0=English;x0=spa50x_30x_en_v756.xml;d1=Spanish;x1=spa50x_30x_es_v756.xml\"; break;
    }
}
echo \"</Dictionary_Server_Script>\"
?>
</flat-profile>
','spa504G.cfg','
<flat-profile>

<User_ID_1_><?php echo $this->terminal->getName(); ?></User_ID_1_>
<Password_1_><?php echo $this->terminal->getPassword(); ?></Password_1_>
<Use_Auth_ID_1_>No</Use_Auth_ID_1_>
<Auth_ID_1_><?php echo $this->terminal->getName(); ?></Auth_ID_1_>
<Station_Name><?php echo $this->user->getName()?> </Station_Name>
<Proxy_1_><?php echo $this->company->getDomainUsers(); ?>:5060</Proxy_1_>

<Resync_Periodic></Resync_Periodic>


<Resync_At__HHmm_>0300</Resync_At__HHmm_>


</flat-profile>
','spa504g/{mac}.cfg',(SELECT id from TerminalManufacturers WHERE iden = 'Cisco'));

INSERT IGNORE INTO TerminalModels (iden, name, description, genericTemplate, genericUrlPattern, specificTemplate, specificUrlPattern, TerminalManufacturerId) VALUES ('SPA509G', 'SPA509G', 'SPA509G','
<flat-profile>

<Provision_Enable>Yes</Provision_Enable>
<Resync_On_Reset>Yes</Resync_On_Reset>
<Resync_Random_Delay>2</Resync_Random_Delay>
<Resync_Periodic>30</Resync_Periodic>
<Resync_Error_Retry_Delay>4000</Resync_Error_Retry_Delay>
<Forced_Resync_Delay>14400</Forced_Resync_Delay>
<Resync_From_SIP>Yes</Resync_From_SIP>
<Resync_After_Upgrade_Attempt>Yes</Resync_After_Upgrade_Attempt>
<Resync_Trigger_1/>
<Resync_Trigger_2/>
<Resync_Fails_On_FNF>Yes</Resync_Fails_On_FNF>
<SPCP_Auto-detect>No</SPCP_Auto-detect>

<Profile_Rule>https://<?php echo $_SERVER[\'HTTP_HOST\'] ?>:2433/provision/spa509g/$MA.cfg</Profile_Rule>

<Set_Local_Date__mm_dd_/>
<Set_Local_Time__HH_mm_/>
<Time_Zone>GMT+01:00</Time_Zone>
<Time_Offset__HH_mm_/>
<Daylight_Saving_Time_Rule>start=3/-1/7/2;end=10/-1/7/3;save=1;</Daylight_Saving_Time_Rule>
<Daylight_Saving_Time_Enable>Yes</Daylight_Saving_Time_Enable>
<DTMF_Playback_Level>-16</DTMF_Playback_Level>
<DTMF_Playback_Length>.1</DTMF_Playback_Length>
<Inband_DTMF_Boost>12dB</Inband_DTMF_Boost>
<Default_Character_Encoding>UTF-8</Default_Character_Encoding>

<Primary_NTP_Server>es.pool.ntp.org</Primary_NTP_Server>


<?php
echo \"<Language_Selection>Spanish</Language_Selection>\";
echo \"<Dictionary_Server_Script>serv=https://\" . $_SERVER[\'HTTP_HOST\'] . \":2443/terminals/ciscolang/\";

preg_match(\"/-([0-9\.]*).*[\s,]+/\",$_SERVER[\'HTTP_USER_AGENT\'],$firmware);
if(array_key_exists(\"1\",$firmware)){
    switch($firmware[1]){
        case \"7.5.1\": echo \";d0=English;x0=spa50x_30x_en_v751.xml;d1=Spanish;x1=spa50x_30x_es_v751.xml\"; break;
        case \"7.5.2\": echo \";d0=English;x0=spa50x_30x_en_v751.xml;d1=Spanish;x1=spa50x_30x_es_v751.xml\"; break;
        case \"7.5.3\": echo \";d0=English;x0=spa50x_30x_en_v753.xml;d1=Spanish;x1=spa50x_30x_es_v753.xml\"; break;
        case \"7.5.4\": echo \";d0=English;x0=spa50x_30x_en_v754.xml;d1=Spanish;x1=spa50x_30x_es_v754.xml\"; break;
        case \"7.5.5\": echo \";d0=English;x0=spa50x_30x_en_v755.xml;d1=Spanish;x1=spa50x_30x_es_v755.xml\"; break;
        case \"7.5.6\": echo \";d0=English;x0=spa50x_30x_en_v756.xml;d1=Spanish;x1=spa50x_30x_es_v756.xml\"; break;
        default:        echo \";d0=English;x0=spa50x_30x_en_v756.xml;d1=Spanish;x1=spa50x_30x_es_v756.xml\"; break;
    }
}
echo \"</Dictionary_Server_Script>\"
?>

</flat-profile>
','spa509G.cfg','
<flat-profile>

<User_ID_1_><?php echo $this->terminal->getName(); ?></User_ID_1_>
<Password_1_><?php echo $this->terminal->getPassword(); ?></Password_1_>
<Use_Auth_ID_1_>No</Use_Auth_ID_1_>
<Auth_ID_1_><?php echo $this->terminal->getName(); ?></Auth_ID_1_>
<Station_Name><?php echo $this->user->getName()?> </Station_Name>
<Proxy_1_><?php echo $this->company->getDomainUsers(); ?>:5060</Proxy_1_>


<Resync_Periodic></Resync_Periodic>


<Resync_At__HHmm_>0300</Resync_At__HHmm_>

</flat-profile>
','spa509g/{mac}.cfg',(SELECT id from TerminalManufacturers WHERE iden = 'Cisco'));

INSERT IGNORE INTO TerminalModels (iden, name, description, genericTemplate, genericUrlPattern, specificTemplate, specificUrlPattern, TerminalManufacturerId) VALUES ('spa525G2', 'SPA525G2', 'SPA525G2','
<flat-profile>

<Provision_Enable>Yes</Provision_Enable>
<Resync_On_Reset>Yes</Resync_On_Reset>
<Resync_Random_Delay>2</Resync_Random_Delay>
<Resync_Periodic>30</Resync_Periodic>
<Resync_Error_Retry_Delay>4000</Resync_Error_Retry_Delay>
<Forced_Resync_Delay>14400</Forced_Resync_Delay>
<Resync_From_SIP>Yes</Resync_From_SIP>
<Resync_After_Upgrade_Attempt>Yes</Resync_After_Upgrade_Attempt>
<Resync_Trigger_1/>
<Resync_Trigger_2/>
<Resync_Fails_On_FNF>Yes</Resync_Fails_On_FNF>
<SPCP_Auto-detect>No</SPCP_Auto-detect>

<Profile_Rule>https://<?php echo $_SERVER[\'HTTP_HOST\'] ?>:2433/provision/spa525g2/$MA.cfg</Profile_Rule>

<Set_Local_Date__mm_dd_/>
<Set_Local_Time__HH_mm_/>
<Time_Zone>GMT+01:00</Time_Zone>
<Time_Offset__HH_mm_/>
<Daylight_Saving_Time_Rule>start=3/-1/7/2;end=10/-1/7/3;save=1;</Daylight_Saving_Time_Rule>
<Daylight_Saving_Time_Enable>Yes</Daylight_Saving_Time_Enable>
<DTMF_Playback_Level>-16</DTMF_Playback_Level>
<DTMF_Playback_Length>.1</DTMF_Playback_Length>
<Inband_DTMF_Boost>12dB</Inband_DTMF_Boost>
<Default_Character_Encoding>UTF-8</Default_Character_Encoding>

<Primary_NTP_Server>es.pool.ntp.org</Primary_NTP_Server>


<?php

echo \"<Language_Selection>Spanish</Language_Selection>\";
echo \"<Dictionary_Server_Script>serv=https://\" . $_SERVER[\'SERVER_NAME\'] . \":2443/terminals/ciscolang/\";

preg_match(\"/-([0-9\.]*).*[\s,]+/\", $_SERVER[\'HTTP_USER_AGENT\'], $firmware);
if(array_key_exists(\"1\", $firmware)){
    switch($firmware[1]){
        case \"7.5.1\": echo \";d0=English;x0=spa525_en_v751.xml;d1=Spanish;x1=spa525_es_v751.xml\"; break;
        case \"7.5.2\": echo \";d0=English;x0=spa525_en_v751.xml;d1=Spanish;x1=spa525_es_v751.xml\"; break;
        case \"7.5.3\": echo \";d0=English;x0=spa525_en_v753.xml;d1=Spanish;x1=spa525_es_v753.xml\"; break;
        case \"7.5.4\": echo \";d0=English;x0=spa525_en_v754.xml;d1=Spanish;x1=spa525_es_v754.xml\"; break;
        case \"7.5.5\": echo \";d0=English;x0=spa525_en_v755.xml;d1=Spanish;x1=spa525_es_v755.xml\"; break;
        case \"7.5.6\": echo \";d0=English;x0=spa525_en_v756.xml;d1=Spanish;x1=spa525_es_v756.xml\"; break;
        default:        echo \";d0=English;x0=spa525_en_v756.xml;d1=Spanish;x1=spa525_es_v756.xml\"; break;
    }
}
echo \"</Dictionary_Server_Script>\";
?>


</flat-profile>
','spa525G2.cfg','
<flat-profile>

<User_ID_1_><?php echo $this->terminal->getName(); ?></User_ID_1_>
<Password_1_><?php echo $this->terminal->getPassword(); ?></Password_1_>
<Use_Auth_ID_1_>No</Use_Auth_ID_1_>
<Auth_ID_1_><?php echo $this->terminal->getName(); ?></Auth_ID_1_>
<Station_Name><?php echo $this->user->getName()?> </Station_Name>
<Proxy_1_><?php echo $this->company->getDomainUsers(); ?>:5060</Proxy_1_>


<Resync_Periodic></Resync_Periodic>


<Resync_At__HHmm_>0300</Resync_At__HHmm_>

</flat-profile>
','spa525g2/{mac}.cfg',(SELECT id from TerminalManufacturers WHERE iden = 'Cisco'));

