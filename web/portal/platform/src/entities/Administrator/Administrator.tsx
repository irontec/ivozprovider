import { EntityValues, isEntityItem } from '@irontec/ivoz-ui';
import ChildEntityLink from '@irontec/ivoz-ui/components/List/Content/Shared/ChildEntityLink';
import defaultEntityBehavior, {
  ChildDecorator as DefaultChildDecorator,
  marshaller as defaultMarshaller,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface, {
  ChildDecoratorType,
  EntityValidator,
  EntityValidatorResponse,
} from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import AdminPanelSettingsIcon from '@mui/icons-material/AdminPanelSettings';

import AdministratorRelPublicEntity from '../AdministratorRelPublicEntity/AdministratorRelPublicEntity';
import Actions from './Action';
import { AdministratorProperties } from './AdministratorProperties';
import List from './List';

type marshallerType = typeof defaultMarshaller;
const marshaller: marshallerType = (row, properties, whitelist) => {
  if (row.brand === false) {
    row.brand = null;
  }
  const pass = row.pass?.trim();
  if (pass === '') {
    row.pass = null;
  }

  return defaultMarshaller(row, properties, whitelist);
};

const validator: EntityValidator = (values, properties, visualToggle) => {
  const response: EntityValidatorResponse = defaultEntityBehavior.validator(
    values,
    properties,
    visualToggle
  );
  const id = values?.id;

  if (!id) {
    return response;
  }

  const pass = (values?.pass as string).trim();
  const active = values?.active;
  const isActive = active === '1' || active === true;

  if (pass === '' && isActive) {
    response['pass'] = _('Password cannot be empty in an active user');
  }

  return response;
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
      'Restricted administrators have read-only permissions by default. This privileges can be fine-tuned in <i>List of Administrator access privileges</i> subsection. <br><br><strong>Global/Brand</strong> restricted administrators can be used both for API integrations and limited web access.'
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
  link: '/doc/${language}/administration_portal/platform/main_operators.html',
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
  foreignKeyGetter: async () => {
    const module = await import('./ForeignKeyGetter');

    return module.foreignKeyGetter;
  },
  List: List,
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
  marshaller,
  validator,
  defaultOrderBy: '',
};

export default Administrator;
