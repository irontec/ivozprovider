import { EntityValues, isEntityItem } from '@irontec-voip/ivoz-ui';
import ChildEntityLink from '@irontec-voip/ivoz-ui/components/List/Content/Shared/ChildEntityLink';
import defaultEntityBehavior, {
  ChildDecorator as DefaultChildDecorator,
  marshaller as defaultMarshaller,
} from '@irontec-voip/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface, {
  ChildDecoratorType,
} from '@irontec-voip/ivoz-ui/entities/EntityInterface';
import _ from '@irontec-voip/ivoz-ui/services/translations/translate';
import AdminPanelSettingsIcon from '@mui/icons-material/AdminPanelSettings';

import AdministratorRelPublicEntity from '../AdministratorRelPublicEntity/AdministratorRelPublicEntity';
import Actions from './Action';
import { AdministratorProperties } from './AdministratorProperties';

type marshallerType = typeof defaultMarshaller;
const marshaller: marshallerType = (row, properties, whitelist) => {
  if (row.brand === false) {
    row.brand = null;
  }

  return defaultMarshaller(row, properties, whitelist);
};

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
      'Restricted administrators have read-only permissions by default. This privileges can be fine-tuned in <i>List of Administrator access privileges</i> subsection. <br><br><strong>Global/Brand</strong> restricted administrators can be used both for API integrations and limited web access.'
    ),
  },
  name: {
    label: _('Name'),
  },
  lastname: {
    label: _('Lastname'),
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
  link: '/doc/en/administration_portal/platform/main_operators.html',
  iden: 'Administrator',
  title: _('Main operator', { count: 2 }),
  path: '/administrators',
  toStr: (row: EntityValues): string => row.username as string,
  properties,
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'Administrators',
  },
  columns: ['username', 'active', 'restricted'],
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
  marshaller,
};

export default Administrator;
