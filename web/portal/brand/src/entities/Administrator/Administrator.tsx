import { EntityValues, isEntityItem } from '@irontec/ivoz-ui';
import ChildEntityLink from '@irontec/ivoz-ui/components/List/Content/Shared/ChildEntityLink';
import defaultEntityBehavior, {
  ChildDecorator as DefaultChildDecorator,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface, {
  ChildDecoratorType,
} from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import AdminPanelSettingsIcon from '@mui/icons-material/AdminPanelSettings';

import AdministratorRelPublicEntity from '../AdministratorRelPublicEntity/AdministratorRelPublicEntity';
import Actions from './Action';
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
    visualToggle: {
      '0': {
        show: [],
        hide: ['canImpersonate'],
      },
      '1': {
        show: ['canImpersonate'],
        hide: [],
      },
    },
    helpText: _(
      'Restricted administrators have read-only permissions by default. This privileges can be fine-tuned in <i>List of Administrator access privileges</i> subsection. <br><br><strong>Client</strong> restricted administrators can be used both for API integrations and limited web access.'
    ),
  },
  canImpersonate: {
    label: _('Can impersonate'),
    default: 0,
    enum: {
      '0': _('No'),
      '1': _('Yes'),
    },
    helpText: _(
      'Controls whether this restricted administrator can impersonate lower level administrators.'
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
  const { routeMapItem, row, variant } = props;

  if (
    isEntityItem(routeMapItem) &&
    routeMapItem.entity.iden === AdministratorRelPublicEntity.iden
  ) {
    if (!row.restricted) {
      if (variant === 'text') {
        return <a className='disabled'>{AdministratorRelPublicEntity.title}</a>;
      }

      return (
        <ChildEntityLink
          routeMapItem={routeMapItem}
          row={row}
          disabled={true}
        />
      );
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
  customActions: Actions,
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
