import { EntityValues } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import KeyIcon from '@mui/icons-material/Key';

import Password from '../ResidentialDevice/Field/Password';
import StatusIcon from './Field/StatusIcon';
import {
  RetailAccountProperties,
  RetailAccountPropertyList,
} from './RetailAccountProperties';

const properties: RetailAccountProperties = {
  company: {
    label: _('Client'),
    required: true,
  },
  name: {
    label: _('Name'),
    pattern: new RegExp('^[a-zA-Z0-9_*]+$'),
    maxLength: 100,
    helpText: _("Allowed characters: a-z, A-Z, 0-9, underscore and '*'"),
    required: true,
  },
  domain: {
    label: _('Domain'),
    $ref: '#/definitions/Domain',
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
      required: true,
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
    component: Password,
    pattern: new RegExp(
      '^(?=.*[A-Z].*[A-Z].*[A-Z])(?=.*[+*_-])(?=.*[0-9].*[0-9].*[0-9])(?=.*[a-z].*[a-z].*[a-z]).{10,}$'
    ),
    helpText: _(
      "Minimal length 10, including 3 uppercase letters, 3 lowercase letters, 3 digits and one character in '+*_-'"
    ),
  },
  outgoingDdi: {
    label: _('Fallback Outgoing DDI'),
    null: _("Client's default"),
    helpText: _(
      "This DDI will be used if presented DDI doesn't match any of the company DDIs"
    ),
  },
  fromDomain: {
    label: _('From Domain'),
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
        show: ['ip', 'port', 'transport', 'ruriDomain', 'proxyUser'],
        hide: ['multiContact'],
      },
      no: {
        hide: ['ip', 'port', 'transport', 'ruriDomain', 'proxyUser'],
        show: ['multiContact'],
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
    label: _('Numeric transformation', { count: 1 }),
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
    default: 0,
    enum: {
      '0': _('No'),
      '1': _('Yes'),
    },
    helpText: _(
      "Set to 'No' to call only to latest registered SIP device instead of making all registered devices ring."
    ),
  },
  ruriDomain: {
    label: _('R-URI domain'),
    type: 'string',
  },
  proxyUser: {
    label: _('Local Address'),
    required: true,
    default: '__null__',
  },
};

const RetailAccount: EntityInterface = {
  ...defaultEntityBehavior,
  icon: KeyIcon,
  link: '/doc/${language}/administration_portal/brand/views/retail_accounts.html',
  iden: 'RetailAccount',
  title: _('Retail Account', { count: 2 }),
  path: '/retail_accounts',
  toStr: (row: RetailAccountPropertyList<EntityValues>) => `${row.name}`,
  properties,
  columns: ['company', 'name', 'domain', 'description', 'statusIcon'],
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'RetailAccounts',
  },
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
  foreignKeyResolver: async () => {
    const module = await import('./ForeignKeyResolver');

    return module.default;
  },
  foreignKeyGetter: async () => {
    const module = await import('./ForeignKeyGetter');

    return module.foreignKeyGetter;
  },
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
};

export default RetailAccount;
