import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { AdministratorProperties } from './AdministratorProperties';
import foreignKeyResolver from './ForeignKeyResolver';

const properties: AdministratorProperties = {
  'username': {
    label: _('Username'),
  },
  'pass': {
    label: _('Pass'),
  },
  'email': {
    label: _('Email'),
  },
  'active': {
    label: _('Active'),
  },
  'restricted': {
    label: _('Restricted'),
  },
  'name': {
    label: _('Name'),
  },
  'lastname': {
    label: _('Lastname'),
  },
  'id': {
    label: _('Id'),
  },
  'company': {
    label: _('Company'),
  },
  'timezone': {
    label: _('Timezone'),
  },
};

const Administrator: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'Administrator',
  title: _('Administrator', { count: 2 }),
  path: '/Administrators',
  toStr: (row: any) => row.id,
  properties,
  selectOptions: (props, customProps) => { return selectOptions(props, customProps); },
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default Administrator;