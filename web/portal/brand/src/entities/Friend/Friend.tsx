import { EntityValues } from '@irontec-voip/ivoz-ui';
import defaultEntityBehavior from '@irontec-voip/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec-voip/ivoz-ui/entities/EntityInterface';
import _ from '@irontec-voip/ivoz-ui/services/translations/translate';
import AccountTreeIcon from '@mui/icons-material/AccountTree';

import Password from '../ResidentialDevice/Field/Password';
import StatusIcon from './Field/StatusIcon';
import { FriendProperties, FriendPropertyList } from './FriendProperties';

const properties: FriendProperties = {
  name: {
    label: _('Name'),
    required: true,
    hint: _("Allowed characters: a-z, A-Z, 0-9, underscore and '*'"),
  },
  description: {
    label: _('Description'),
    required: false,
  },
  transport: {
    label: _('Transport'),
    required: true,
    enum: {
      udp: 'UDP',
      tcp: 'TCP',
      tls: 'TLS',
    },
  },
  ip: {
    label: _('IP address'),
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
    component: Password,
    pattern: new RegExp(
      `^(?=.*[A-Z].*[A-Z].*[A-Z])(?=.*[+*_-])(?=.*[0-9].*[0-9].*[0-9])(?=.*[a-z].*[a-z].*[a-z]).{10,}$`
    ),
    helpText: _(
      `Minimal length 10, including 3 uppercase letters, 3 lowercase letters, 3 digits and one character in '+*_-'`
    ),
  },
  allow: {
    label: _('Allow'),
  },
  fromUser: {
    label: _('From User'),
  },
  fromDomain: {
    label: _('From Domain'),
  },
  directConnectivity: {
    label: _('Connectivity mode'),
    enum: {
      yes: _('Direct'),
      no: _('Register'),
      intervpbx: _('Inter vPBX'),
    },
    default: 'no',
    visualToggle: {
      yes: {
        show: [
          'ip',
          'port',
          'transport',
          'ruriDomain',
          'proxyUser',
          'name',
          'priority',
          'password',
        ],
        hide: ['multiContact', 'interCompany'],
      },
      no: {
        show: ['multiContact', 'name', 'priority', 'password'],
        hide: [
          'ip',
          'port',
          'transport',
          'ruriDomain',
          'proxyUser',
          'interCompany',
        ],
      },
      intervpbx: {
        show: ['interCompany'],
        hide: [
          'ip',
          'port',
          'transport',
          'ruriDomain',
          'proxyUser',
          'multiContact',
          'name',
          'priority',
          'password',
        ],
      },
    },
  },
  priority: {
    label: _('Priority'),
    default: 1,
  },
  alwaysApplyTransformations: {
    label: _('Always apply transformations'),
    enum: {
      '0': _('No'),
      '1': _('Yes'),
    },
    default: '0',
    helpText: _(
      "Enable to force numeric transformation on numbers in Extensions or numbers matching any Friend regexp. Otherwise, those numbers won't traverse numeric transformations rules."
    ),
  },
  ddiIn: {
    label: _('DDI In'),
    enum: {
      yes: _('Yes'),
      no: _('No'),
    },
  },
  t38Passthrough: {
    label: _('T38 Passthrough'),
    enum: {
      yes: _('Yes'),
      no: _('No'),
    },
  },
  id: {
    label: _('Id'),
  },
  company: {
    label: _('Client', { count: 1 }),
    required: true,
  },
  transformationRuleSet: {
    label: _('Numeric transformation', { count: 1 }),
  },
  outgoingDdi: {
    label: _('Outgoing DDI'),
  },
  language: {
    label: _('Language', { count: 1 }),
  },
  interCompany: {
    label: _('Target client'),
    required: true,
    null: _('Not configured'),
    default: '__null__',
    helpText:
      'Only customers belonging to the same corporation will be listed.',
  },
  domain: {
    label: _('Domain'),
    $ref: '#/definitions/Domain',
  },
  domainName: {
    label: _('Domain Name'),
  },
  status: {
    label: _('Status'),
  },
  ruriDomain: {
    label: _('R-URI domain'),
    type: 'string',
  },
  statusIcon: {
    label: _('Status'),
    component: StatusIcon,
  },
  proxyUser: {
    label: _('Local Address'),
    default: '__null__',
    required: true,
  },
};

const Friend: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'Friend',
  title: _('Friend', { count: 2 }),
  path: '/friends',
  toStr: (row: FriendPropertyList<EntityValues>) => `${row.name}`,
  properties,
  columns: ['company', 'name', 'domain', 'description', 'statusIcon'],
  defaultOrderBy: '',
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'Friends',
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

export default Friend;
