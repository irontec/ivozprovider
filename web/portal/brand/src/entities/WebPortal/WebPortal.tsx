import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { WebPortalProperties } from './WebPortalProperties';
import foreignKeyResolver from './ForeignKeyResolver';

const properties: WebPortalProperties = {
  'url': {
    label: _('Url'),
  },
  'klearTheme': {
    label: _('Klear Theme'),
  },
  'urlType': {
    label: _('Url Type'),
    enum: {
      'god' : _('God'),
      'brand' : _('Brand'),
      'admin' : _('Admin'),
      'user' : _('User'),
    },
  },
  'name': {
    label: _('Name'),
  },
  'userTheme': {
    label: _('User Theme'),
  },
  'id': {
    label: _('Id'),
  },
  'logo': {
    label: _('Logo'),
  },
};

const WebPortal: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'WebPortal',
  title: _('WebPortal', { count: 2 }),
  path: '/WebPortals',
  toStr: (row: any) => row.id,
  properties,
  selectOptions: (props, customProps) => { return selectOptions(props, customProps); },
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default WebPortal;