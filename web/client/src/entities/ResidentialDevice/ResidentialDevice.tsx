import SettingsApplications from '@mui/icons-material/SettingsApplications';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { PartialPropertyList } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import selectOptions from './SelectOptions';

const properties: PartialPropertyList = {
  company: {
    label: _('Client'),
  },
  name: {
    label: _('Name'),
    pattern: new RegExp('^[a-zA-Z0-9_*]+$'),
    helpText: _("Allowed characters: a-z, A-Z, 0-9, underscore and '*'"),
  },
  domain: {
    label: _('Domain'),
  },
  description: {
    label: _('Description'),
  },
  transport: {
    label: _('Transport'),
    enum: {
      'udp': 'UDP',
      'tcp': 'TCP',
      'tls': 'TLS',
    },
  },
  ip: {
    label: _('Destination IP address'),
    pattern: new RegExp('^[.0-9]+$'),
    helpText: _('e.g. 8.8.8.8'),
  },
  port: {
    label: _('Port'),
    pattern: new RegExp('^[0-9]+$'),
    default: 5060,
  },
  authNeeded: {
    label: _('Auth needed'),
    default: 'no',
    enum: {
      'yes': _('Yes'),
      'no': _('No'),
    },
  },
  password: {
    label: _('Password'),
    pattern: new RegExp('^(?=.*[A-Z].*[A-Z].*[A-Z])(?=.*[+*_-])(?=.*[0-9].*[0-9].*[0-9])(?=.*[a-z].*[a-z].*[a-z]).{10,}$'),
    helpText: _("Minimal length 10, including 3 uppercase letters, 3 lowercase letters, 3 digits and one character in '+*_-'"),
    // @TODO generatePassword_command: true
  },
  outgoingDdi: {
    label: _('Fallback Outgoing DDI'),
    null: _("Client's default"),
    helpText: _("This DDI will be used if presented DDI doesn't match any of the company DDIs"),
  },
  disallow: {
    label: _('Disallowed audio codecs'),
    maxLength: 100,
    helpText: (
            <div>
                Comma separated codec names in preferred order. For example: alaw,g729,ulaw
                <br />
                <pre>
                    <b>alaw </b>  <i>G.711 a-law</i><br />
                    <b>ulaw </b>  <i>G.711 u-law</i><br />
                    <b>gsm  </b>  <i>GSM</i><br />
                    <b>speex</b>  <i>SpeeX 32khz</i><br />
                    <b>g722 </b>  <i>G722</i><br />
                    <b>g726 </b>  <i>G.726 RFC3551</i><br />
                    <b>g729 </b>  <i>G.729A</i><br />
                    <b>ilbc </b>  <i>iLBC</i><br />
                    <b>opus </b>  <i>Opus Codec</i><br />
                    <b>all  </b>  <i>All the previous</i>
                </pre>
            </div>),
  },
  allow: {
    label: _('Allowed audio codecs'),
    default: 'alaw',
    enum: {
      'alaw': 'alaw - G.711 a-law',
      'ulaw': 'ulaw - G.711 u-law',
      'gsm': 'gsm - GSM',
      'speex': 'speex - SpeeX 32khz',
      'g722': 'g722 - G.722',
      'g726': 'g726 - G.726 RFC3551',
      'g729': 'g729 - G.729A',
      'ilbc': 'ilbc - iLBC',
      'opus': 'opus - Opus codec',
    },
  },
  directMediaMethod: {
    label: _('CallerID update method'),
    enum: {
      'invite': 'invite',
      'update': 'update',
    },
    helpText: (
            <div>
                This setting chooses the SIP method to update the other party&apos;s name and number
                during the conversation (e.g. due to transfers).
                <br /><br />
                UPDATE method is the preferred one as it doesn&apos;t imply 3 messages like INVITE does.
                <br /><br />
                However, some phones do not support UPDATE, so INVITE legacy method is also supported.
                <pre>
                    <b>Cisco </b>    <i>UPDATE</i><br />
                    <b>Yealink </b>  <i>INVITE</i><br />
                    <b>Bria </b>     <i>INVITE</i><br />
                </pre>
                Read manufacturer&apos;s documentation to choose correctly, please.
            </div>
    ),
  },
  calleridUpdateHeader: {
    label: _('CallerID update header'),
    enum: {
      'pai': 'P-Asserted-Identity (PAI)',
      'rpid': 'Remote-Party-ID (RPID)',
    },
    default: 'pai',
  },
  updateCallerid: {
    label: _('Update CallerID?'),
    enum: {
      'yes': _('Yes'),
      'no': _('No'),
    },
    default: 'yes',
    visualToggle: {
      'yes': {
        show: ['direct_media_method', 'callerid_update_header'],
        hide: [],
      },
      'no': {
        show: [],
        hide: ['direct_media_method', 'callerid_update_header'],
      },
    },
  },
  fromDomain: {
    label: _('From domain'),
  },
  directConnectivity: {
    label: _('Direct connectivity'),
    default: 'no',
    enum: {
      'yes': _('Yes'),
      'no': _('No'),
    },
    visualToggle: {
      'yes': {
        show: ['ip', 'port', 'transport', 'auth_needed'],
        hide: ['multiContact'],
      },
      'no': {
        show: ['multiContact'],
        hide: ['ip', 'port', 'transport', 'auth_needed'],
      },
    },
  },
  ddiIn: {
    label: _('DDI In'),
    default: 'yes',
    enum: {
      'yes': _('Yes'),
      'no': _('No'),
    },
    helpText: _("If set to 'Yes', set destination (R-URI and To) to called DDI when calling to this residential device."),
  },
  language: {
    label: _('Language'),
    null: _("Client's default"),
  },
  statusIcon: {
    label: _('Status'),
    // @TODO IvozProvider_Klear_Ghost_RegisterStatus::getResidentialDeviceStatusIcon
  },
  status: {
    label: _('Status'),
    // @TODO IvozProvider_Klear_Ghost_RegisterStatus::getResidentialDeviceStatus
  },
  transformationRuleSet: {
    label: _('Numeric transformation'),
    null: _("Client's default"),
  },
  maxCalls: {
    label: _('Call waiting'),
    default: 1,
    // @TODO min: 0
    // @TODO  max: 100
    helpText: _('Limits received calls when already handling this number of calls. Set 0 for unlimited.'),
  },
  t38Passthrough: {
    label: _('Enable T.38 passthrough'),
    default: 'no',
    enum: {
      'yes': _('Yes'),
      'no': _('No'),
    },
  },
  rtpEncryption: {
    label: _('RTP encryption'),
    default: 0,
    enum: {
      '0': _('No'),
      '1': _('Yes'),
    },
    helpText: _("Enable to force audio encryption. Call won't be established unless it is encrypted."),
  },
  multiContact: {
    label: _('Multi contact'),
    default: 1,
    enum: {
      '0': _('No'),
      '1': _('Yes'),
    },
    helpText: _("Set to 'No' to call only to latest registered SIP device instead of making all registered devices ring."),
  },
};

const residentialDevice: EntityInterface = {
  ...defaultEntityBehavior,
  icon: SettingsApplications,
  iden: 'ResidentialDevice',
  title: _('Residential device', { count: 2 }),
  path: '/residential_devices',
  properties,
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'ResidentialDevices',
  },
  selectOptions: (props, customProps) => { return selectOptions(props, customProps); },
};

export default residentialDevice;