import AccountTreeIcon from '@mui/icons-material/AccountTree';
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
  icon: AccountTreeIcon,
  iden: 'BannedAddress',
  title: _('BannedAddress', { count: 2 }),
  path: '/BannedAddresses',
  toStr: (row: any) => row.id,
  properties,
  selectOptions,
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default BannedAddress;
