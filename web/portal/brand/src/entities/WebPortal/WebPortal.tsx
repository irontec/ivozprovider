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
  url: {
    label: _('URL'),
    pattern: new RegExp(`^https://[^/]*$`),
    maxLength: 255,
    helpText: _(`'https://' URLs valid only (without trailing '/')`),
  },
  klearTheme: {
    label: _('Theme'),
  },
  urlType: {
    label: _('URL Type'),
    enum: {
      god: _('God'),
      brand: _('Brand'),
    },
    visualToggle: {
      god: {
        show: ['klearTheme'],
        hide: ['userTheme'],
      },
      brand: {
        show: ['klearTheme'],
        hide: ['userTheme'],
      },
    },
  },
  name: {
    label: _('Name'),
    maxLength: 200,
    helpText: _(`Will be shown on page footer`),
  },
  userTheme: {
    label: _('User Theme'),
  },
  logo: {
    label: _('Logo'),
    //@TODO
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
  selectOptions,
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default WebPortal;
