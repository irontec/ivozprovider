import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { SpecialNumberProperties } from './SpecialNumberProperties';
import foreignKeyResolver from './ForeignKeyResolver';

const properties: SpecialNumberProperties = {
  number: {
    label: _('Number'),
    pattern: new RegExp(`^[0-9]+$`),
  },
  disableCDR: {
    label: _('Disable CDR'),
    default: '1',
    enum: {
      '0': _('No'),
      '1': _('Yes'),
    },
    helpText: _(`Mark yes to hide this destination calls in all lists`),
  },
  country: {
    label: _('Country'),
  },
  global: {
    label: _('Global'),
  },
};

const SpecialNumber: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'SpecialNumber',
  title: _('SpecialNumber', { count: 2 }),
  path: '/SpecialNumbers',
  toStr: (row: any) => row.id,
  properties,
  selectOptions,
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default SpecialNumber;
