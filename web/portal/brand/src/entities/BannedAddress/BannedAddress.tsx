import DoDisturbOnIcon from '@mui/icons-material/DoDisturbOn';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { BannedAddressProperties } from './BannedAddressProperties';
import foreignKeyResolver from './ForeignKeyResolver';

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
  iden: 'BannedAddress',
  title: _('Banned IP address', { count: 2 }),
  path: '/banned_addresses',
  toStr: (row: any) => row.id,
  acl: {
    create: false,
    read: true,
    detail: false,
    update: false,
    delete: false,
  },
  properties,
  columns: ['company', 'ip', 'lastTimeBanned'],
  selectOptions,
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default BannedAddress;
