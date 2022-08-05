import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { DdiProviderRegistrationProperties } from './DdiProviderRegistrationProperties';
import foreignKeyResolver from './ForeignKeyResolver';

const properties: DdiProviderRegistrationProperties = {
  'username': {
    label: _('Username'),
  },
  'domain': {
    label: _('Domain'),
  },
  'realm': {
    label: _('Realm'),
  },
  'authUsername': {
    label: _('Auth Username'),
  },
  'authPassword': {
    label: _('Auth Password'),
  },
  'authProxy': {
    label: _('Auth Proxy'),
  },
  'expires': {
    label: _('Expires'),
  },
  'multiDdi': {
    label: _('Multi Ddi'),
  },
  'contactUsername': {
    label: _('Contact Username'),
  },
  'id': {
    label: _('Id'),
  },
  'ddiProvider': {
    label: _('Ddi Provider'),
  },
  'status': {
    label: _('Status'),
  },
};

const DdiProviderRegistration: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'DdiProviderRegistration',
  title: _('DdiProviderRegistration', { count: 2 }),
  path: '/DdiProviderRegistrations',
  toStr: (row: any) => row.id,
  properties,
  selectOptions: (props, customProps) => { return selectOptions(props, customProps); },
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default DdiProviderRegistration;