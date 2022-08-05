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
  'ip': {
    label: _('Ip'),
  },
  'lastTimeBanned': {
    label: _('Last TimeBanned'),
  },
  'id': {
    label: _('Id'),
  },
  'company': {
    label: _('Company'),
  },
  'blocker': {
    label: _('Blocker'),
    enum: {
      'antiflood' : _('Antiflood'),
      'ipfilter' : _('Ipfilter'),
      'antibruteforce' : _('Antibruteforce'),
    },
  },
  'aor': {
    label: _('Aor'),
  },
  'description': {
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
  selectOptions: (props, customProps) => { return selectOptions(props, customProps); },
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default BannedAddress;