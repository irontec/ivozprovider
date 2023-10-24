import { EntityValues, isEntityItem } from '@irontec/ivoz-ui';
import defaultEntityBehavior, {
  ChildDecorator as DefaultChildDecorator,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface, {
  ChildDecoratorType,
} from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import AdminPanelSettingsIcon from '@mui/icons-material/AdminPanelSettings';

import AdministratorRelPublicEntity from '../AdministratorRelPublicEntity/AdministratorRelPublicEntity';
import {
  AdministratorProperties,
  AdministratorPropertyList,
} from './AdministratorProperties';

const properties: AdministratorProperties = {
  username: {
    label: _('Username'),
    maxLength: 65,
  },
  pass: {
    label: _('Password'),
    format: 'password',
  },
  email: {
    label: _('Email'),
    maxLength: 100,
    required: false,
  },
  active: {
    label: _('Active'),
    default: 1,
    enum: {
      '0': _('No'),
      '1': _('Yes'),
    },
  },
  restricted: {
    label: _('Restricted'),
    default: 0,
    enum: {
      '0': _('No'),
      '1': _('Yes'),
    },
    helpText: _(
      'Restricted administrators have read-only permissions by default. This privileges can be fine-tuned in <i>List of Administrator access privileges</i> subsection. <br><br><b>Global/Brand</b> restricted administrators have no web access and can only be used for API integrations. <br><br><b>Client</b> restricted administrators can be used both for API integrations and limited web access.'
    ),
  },
  name: {
    label: _('Name'),
  },
  lastname: {
    label: _('Lastname'),
  },
  company: {
    label: _('Client', { count: 1 }),
    null: _('Unassigned'),
    default: '__null__',
  },
  timezone: {
    label: _('Timezone', { count: 1 }),
    default: 145,
  },
};

export const ChildDecorator: ChildDecoratorType = (props) => {
  const { routeMapItem, row } = props;

  if (
    isEntityItem(routeMapItem) &&
    routeMapItem.entity.iden === AdministratorRelPublicEntity.iden
  ) {
    if (!row.restricted) {
      return null;
    }
  }

  return DefaultChildDecorator(props);
};

const Administrator: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AdminPanelSettingsIcon,
  iden: 'Administrator',
  title: _('Administrator of client', { count: 2 }),
  path: '/administrators',
  toStr: (row: AdministratorPropertyList<EntityValues>) =>
    (row?.username as string | undefined) || '',
  properties,
  columns: ['username', 'active', 'restricted'],
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'Administrators',
  },
  ChildDecorator,
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
  foreignKeyResolver: async () => {
    const module = await import('./ForeignKeyResolver');

    return module.default;
  },
  foreignKeyGetter: async () => {
    const module = await import('./ForeignKeyGetter');

    return module.foreignKeyGetter;
  },
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
};

export default Administrator;
