import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { UsersAddressProperties } from './UsersAddressProperties';
import foreignKeyResolver from './ForeignKeyResolver';

const properties: UsersAddressProperties = {
  'sourceAddress': {
    label: _('Source Address'),
  },
  'description': {
    label: _('Description'),
  },
  'id': {
    label: _('Id'),
  },
  'company': {
    label: _('Company'),
  },
};

const UsersAddress: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'UsersAddress',
  title: _('UsersAddress', { count: 2 }),
  path: '/UsersAddresses',
  toStr: (row: any) => row.id,
  properties,
  selectOptions: (props, customProps) => { return selectOptions(props, customProps); },
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default UsersAddress;