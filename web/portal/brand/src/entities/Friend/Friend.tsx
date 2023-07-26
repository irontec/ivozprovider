import { EntityValues } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import AccountTreeIcon from '@mui/icons-material/AccountTree';

import { FriendProperties, FriendPropertyList } from './FriendProperties';

const properties: FriendProperties = {
  name: {
    label: _('Name'),
  },
  description: {
    label: _('Description'),
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
    label: _('IP address'),
  },
  port: {
    label: _('Port'),
  },
  password: {
    label: _('Password'),
  },
  priority: {
    label: _('Priority'),
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
    label: _('Direct connectivity'),
    enum: {
      yes: _('Yes'),
      no: _('No'),
      intervpbx: _('Intervpbx'),
    },
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
  },
  domain: {
    label: _('Domain'),
  },
  domainName: {
    label: _('Domain Name'),
  },
  status: {
    label: _('Status'),
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

export default Friend;
