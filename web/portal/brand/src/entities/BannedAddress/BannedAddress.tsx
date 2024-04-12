import { EntityValues } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import DoDisturbOnIcon from '@mui/icons-material/DoDisturbOn';

import {
  BannedAddressProperties,
  BannedAddressPropertyList,
} from './BannedAddressProperties';

const properties: BannedAddressProperties = {
  ip: {
    label: _('IP address'),
  },
  lastTimeBanned: {
    label: _('Last time banned'),
    format: 'date-time',
  },
  company: {
    label: _('Client'),
  },
  blocker: {
    label: _('Blocker'),
    enum: {
      antiflood: _('Antiflood'),
      ipfilter: _('IP filter'),
      antibruteforce: _('Anti bruteforce'),
    },
  },
  aor: {
    label: _('SIP address'),
  },
  description: {
    label: _('Description'),
  },
};

const BannedAddress: EntityInterface = {
  ...defaultEntityBehavior,
  icon: DoDisturbOnIcon,
  link: '/doc/en/administration_portal/brand/views/ipfilter_blocked_addresses.html',
  iden: 'BannedAddress',
  title: _('Banned IP address', { count: 2 }),
  path: '/banned_addresses',
  toStr: (row: BannedAddressPropertyList<EntityValues>) => `${row.id}`,
  defaultOrderBy: '',
  acl: {
    create: false,
    read: true,
    detail: false,
    update: false,
    delete: false,
    iden: 'BannedAddresses',
  },
  properties,
  columns: ['company', 'ip', 'lastTimeBanned'],
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

export default BannedAddress;
