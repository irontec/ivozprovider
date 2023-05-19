import { EntityValues } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import StorageIcon from '@mui/icons-material/Storage';

import {
  CarrierServerProperties,
  CarrierServerPropertyList,
} from './CarrierServerProperties';
import StatusIcon from './Field/StatusIcon';

const properties: CarrierServerProperties = {
  ip: {
    label: _('Destination IP address'),
    pattern: new RegExp('^[.0-9]+$'),
    helpText: _('Leave empty to send to Host field'),
  },
  hostname: {
    label: _('Host'),
    helpText: _('Use address or hostname'),
  },
  port: {
    label: _('Port'),
    default: 5060,
  },
  uriScheme: {
    label: _('URI scheme'),
    default: 1,
    enum: {
      '1': _('sip'),
      '2': _('sips'),
    },
  },
  transport: {
    label: _('Transport'),
    default: 1,
    enum: {
      '1': _('UDP'),
      '2': _('TCP'),
      '3': _('TLS'),
    },
  },
  sendPAI: {
    label: _('Send PAI'),
    default: 1,
  },
  sendRPID: {
    label: _('Send RPID'),
  },
  authNeeded: {
    label: _('Auth Needed'),
    default: 'no',
    enum: {
      yes: _('Yes'),
      no: _('No'),
    },
    visualToggle: {
      yes: {
        show: ['authUser', 'authPassword'],
        hide: [],
      },
      no: {
        show: [],
        hide: ['authUser', 'authPassword'],
      },
    },
  },
  authUser: {
    label: _('Auth User'),
  },
  authPassword: {
    label: _('Auth Password'),
    type: 'string',
    format: 'password',
  },
  sipProxy: {
    label: _('SIP Proxy'),
    maxLength: 128,
    helpText: _("IP or domain name (port with ':')"),
    required: true,
  },
  outboundProxy: {
    label: _('Outbound Proxy'),
    maxLength: 128,
    helpText: _('Send to IP[:PORT] instead of SIP Proxy address'),
  },
  fromUser: {
    label: _('From User'),
    maxLength: 64,
    helpText: _('Use this instead in From header username'),
  },
  fromDomain: {
    label: _('From Domain'),
    maxLength: 190,
    helpText: _('Use this instead in From header domain'),
  },
  statusIcon: {
    label: _('Status'),
    component: StatusIcon,
  },
  carrier: {
    label: _('Carrier', { count: 1 }),
  },
};

const CarrierServer: EntityInterface = {
  ...defaultEntityBehavior,
  icon: StorageIcon,
  iden: 'CarrierServer',
  title: _('Carrier server', { count: 2 }),
  path: '/carrier_servers',
  toStr: (row: CarrierServerPropertyList<EntityValues>) => `${row.id}`,
  properties,
  columns: ['sipProxy', 'outboundProxy', 'statusIcon'],
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

export default CarrierServer;
