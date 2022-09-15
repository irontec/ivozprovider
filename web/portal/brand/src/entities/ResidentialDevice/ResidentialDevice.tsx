import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import RoofingIcon from '@mui/icons-material/Roofing';
import { foreignKeyGetter } from './ForeignKeyGetter';
import foreignKeyResolver from './ForeignKeyResolver';
import Form from './Form';
import { ResidentialDeviceProperties } from './ResidentialDeviceProperties';
import selectOptions from './SelectOptions';
import StatusIcon from '../RetailAccount/Field/StatusIcon';

const properties: ResidentialDeviceProperties = {
  name: {
    label: _('Name'),
    pattern: new RegExp(`^[a-zA-Z0-9_*]+$`),
    maxLength: 100,
    helpText: _(`Allowed characters: a-z, A-Z, 0-9, underscore and '*'`),
  },
  description: {
    label: _('Description'),
    maxLength: 500,
  },
  transport: {
    label: _('Transport'),
    enum: {
      udp: _('UDP'),
      tcp: _('TCP'),
      tls: _('TLS'),
    },
  },
  ip: {
    label: _('Ip'),
    pattern: new RegExp(`^[.0-9]+$`),
    helpText: _(`e.g. 8.8.8.8`),
  },
  port: {
    label: _('Port'),
    pattern: new RegExp(`^[0-9]+$`),
    default: 5060,
  },
  password: {
    label: _('Password'),
    //@TODO pass generator
    pattern: new RegExp(
      `^(?=.*[A-Z].*[A-Z].*[A-Z])(?=.*[+*_-])(?=.*[0-9].*[0-9].*[0-9])(?=.*[a-z].*[a-z].*[a-z]).{10,}$`
    ),
    helpText: _(
      `Minimal length 10, including 3 uppercase letters, 3 lowercase letters, 3 digits and one character in '+*_-'`
    ),
  },
  fromDomain: {
    label: _('From Domain'),
    maxLength: 190,
  },
  directConnectivity: {
    label: _('Direct connectivity'),
    enum: {
      yes: _('Yes'),
      no: _('No'),
    },
    visualToggle: {
      yes: {
        show: ['ip', 'port', 'transport', 'auth_needed'],
        hide: ['multiContact'],
      },
      no: {
        show: ['multiContact'],
        hide: ['ip', 'port', 'transport', 'auth_needed'],
      },
    },
  },
  ddiIn: {
    label: _('DDI In'),
    enum: {
      yes: _('Yes'),
      no: _('No'),
    },
    helpText: _(
      `If set to 'Yes', set destination (R-URI and To) to called DDI when calling to this residential device.`
    ),
  },
  maxCalls: {
    label: _('Call waiting'),
    default: 1,
    minimum: 0,
    maximum: 100,
    helpText: _(
      `Limits received calls when already handling this number of calls. Set 0 for unlimited.`
    ),
  },
  t38Passthrough: {
    label: _('Enable T.38 passthrough'),
    default: 'no',
    enum: {
      yes: _('Yes'),
      no: _('No'),
    },
  },
  rtpEncryption: {
    label: _('RTP encryption'),
    default: '0',
    enum: {
      '0': _('Yes'),
      '1': _('No'),
    },
    helpText: _(
      `Enable to force audio encryption. Call won't be established unless it is encrypted.`
    ),
  },
  multiContact: {
    label: _(`Multi contact`),
    default: 1,
    enum: {
      '0': _('No'),
      '1': _('Yes'),
    },
    helpText: _(
      `Set to 'No' to call only to latest registered SIP device instead of making all registered devices ring.`
    ),
  },
  company: {
    label: _('Client'),
  },
  transformationRuleSet: {
    label: _('Numeric transformation'),
    null: _(`Client's default`),
  },
  outgoingDdi: {
    label: _('Fallback Outgoing DDI'),
    null: _(`Client's default`),
    helpText: _(
      `This DDI will be used if presented DDI doesn't match any of the company DDIs`
    ),
  },
  language: {
    label: _('Language'),
    null: _(`Client's default`),
  },
  domainName: {
    label: _('Domain Name'),
  },
  status: {
    label: _('Status'),
    //@TODO IvozProvider_Klear_Ghost_RegisterStatus::getResidentialDeviceStatus
  },
  statusIcon: {
    label: _('Status'),
    component: StatusIcon,
  },
  disallow: {
    label: _('Disallowed audio codecs'),
    maxLength: 100,
    //@TODO massive helpText
  },
  allow: {
    label: _('Allowed audio codecs'),
    default: 'alaw',
    maxLength: 100,
    enum: {
      alaw: 'alaw - G.711 a-law',
      ulaw: 'ulaw - G.711 u-law',
      gsm: 'gsm - GSM',
      speex: 'speex - SpeeX 32khz',
      g722: 'g722 - G.722',
      g726: 'g726 - G.726 RFC3551',
      g729: 'g729 - G.729A',
      opus: 'opus - Opus codec',
      ilbc: 'ilbc - iLBC',
    },
  },
  directMediaMethod: {
    label: _('CallerID update method'),
    enum: {
      invite: 'invite',
      update: 'update',
    },
    //@TODO massive helpText
  },
  calleridUpdateHeader: {
    label: _('CallerID update header'),
    default: 'pai',
    enum: {
      pai: 'P-Asserted-Identity (PAI)',
      rpid: 'Remote-Party-ID (RPID)',
    },
  },
  updateCallerid: {
    label: _('Update CallerID?'),
    default: 'yes',
    enum: {
      yes: _('Yes'),
      no: _('No'),
    },
    visualToggle: {
      yes: {
        show: ['direct_media_method', 'callerid_update_header'],
        hide: [],
      },
      no: {
        show: [],
        hide: ['direct_media_method', 'callerid_update_header'],
      },
    },
  },
};

const ResidentialDevice: EntityInterface = {
  ...defaultEntityBehavior,
  icon: RoofingIcon,
  iden: 'ResidentialDevice',
  title: _('Residential Device', { count: 2 }),
  path: '/residential_devices',
  toStr: (row: any) => row.id,
  properties,
  columns: [
    'company',
    'name',
    'domainName',
    'description',
    'statusIcon',
    'rtpEncryption',
    'multiContact',
  ],
  selectOptions,
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default ResidentialDevice;
