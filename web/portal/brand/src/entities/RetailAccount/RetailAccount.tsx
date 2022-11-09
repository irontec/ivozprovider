import KeyIcon from '@mui/icons-material/Key';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { RetailAccountProperties } from './RetailAccountProperties';
import foreignKeyResolver from './ForeignKeyResolver';
import StatusIcon from './Field/StatusIcon';

const properties: RetailAccountProperties = {
  company: {
    label: _('Client'),
  },
  name: {
    label: _('Name'),
    readOnly: true,
    pattern: new RegExp('^[a-zA-Z0-9_*]+$'),
    maxLength: 100,
    helpText: _("Allowed characters: a-z, A-Z, 0-9, underscore and '*'"),
  },
  domain: {
    label: _('Domain'),
  },
  domainName: {
    label: _('Domain'),
  },
  description: {
    label: _('Description'),
    maxLength: 500,
  },
  transport: {
    label: _('Transport'),
    enum: {
      udp: 'UDP',
      tcp: 'TCP',
      tls: 'TLS',
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
  password: {
    label: _('Password'),
    pattern: new RegExp(
      '^(?=.*[A-Z].*[A-Z].*[A-Z])(?=.*[+*_-])(?=.*[0-9].*[0-9].*[0-9])(?=.*[a-z].*[a-z].*[a-z]).{10,}$'
    ),
    helpText: _(
      "Minimal length 10, including 3 uppercase letters, 3 lowercase letters, 3 digits and one character in '+*_-'"
    ),
    //@TODO pass generator
  },
  outgoingDdi: {
    label: _('Fallback Outgoing DDI'),
    null: _("Client's default"),
    helpText: _(
      "This DDI will be used if presented DDI doesn't match any of the company DDIs"
    ),
  },
  fromDomain: {
    label: _('From domain'),
    maxLength: 190,
  },
  directConnectivity: {
    label: _('Direct connectivity'),
    default: 'no',
    enum: {
      yes: _('Yes'),
      no: _('No'),
    },
    visualToggle: {
      yes: {
        show: ['ip', 'port', 'transport'],
        hide: [],
      },
      no: {
        hide: ['ip', 'port', 'transport'],
        show: [],
      },
    },
  },
  ddiIn: {
    label: _('DDI In'),
    default: 'yes',
    enum: {
      yes: _('Yes'),
      no: _('No'),
    },
    helpText: _(
      "If set to 'Yes', set destination (R-URI and To) to called DDI when calling to this retail account."
    ),
  },
  statusIcon: {
    label: _('Status'),
    component: StatusIcon,
  },
  transformationRuleSet: {
    label: _('Numeric transformation'),
    null: _("Client's default"),
  },
  t38Passthrough: {
    label: _('Enable T.38 passthrough'),
    enum: {
      yes: _('Yes'),
      no: _('No'),
    },
    default: 'no',
  },
  rtpEncryption: {
    label: _('RTP encryption'),
    default: 0,
    enum: {
      '0': _('No'),
      '1': _('Yes'),
    },
    helpText: _(
      "Enable to force audio encryption. Call won't be established unless it is encrypted."
    ),
  },
  multiContact: {
    label: _('Multi contact'),
    default: 1,
    enum: {
      '0': _('No'),
      '1': _('Yes'),
    },
    helpText: _(
      "Set to 'No' to call only to latest registered SIP device instead of making all registered devices ring."
    ),
  },
};

const RetailAccount: EntityInterface = {
  ...defaultEntityBehavior,
  icon: KeyIcon,
  iden: 'RetailAccount',
  title: _('Retail Account', { count: 2 }),
  path: '/retail_accounts',
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

export default RetailAccount;
