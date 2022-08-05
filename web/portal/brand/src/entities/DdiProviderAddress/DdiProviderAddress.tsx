import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { DdiProviderAddressProperties } from './DdiProviderAddressProperties';
import foreignKeyResolver from './ForeignKeyResolver';

const properties: DdiProviderAddressProperties = {
  'ip': {
    label: _('Ip'),
  },
  'description': {
    label: _('Description'),
  },
  'id': {
    label: _('Id'),
  },
  'ddiProvider': {
    label: _('Ddi Provider'),
  },
};

const DdiProviderAddress: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'DdiProviderAddress',
  title: _('DdiProviderAddress', { count: 2 }),
  path: '/DdiProviderAddresses',
  toStr: (row: any) => row.id,
  properties,
  selectOptions: (props, customProps) => { return selectOptions(props, customProps); },
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default DdiProviderAddress;