import AdminPanelSettingsIcon from '@mui/icons-material/AdminPanelSettings';
import EntityInterface, {
  ChildDecoratorType,
} from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior, {
  ChildDecorator as DefaultChildDecorator,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { EntityValues, isEntityItem } from '@irontec/ivoz-ui';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { AdministratorProperties } from './AdministratorProperties';
import foreignKeyResolver from './ForeignKeyResolver';
import AdministratorRelPublicEntity from '../AdministratorRelPublicEntity/AdministratorRelPublicEntity';

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
  title: _('Administrator', { count: 2 }),
  path: '/administrators',
  toStr: (row: EntityValues): string => row.username as string,
  properties,
  columns: ['username', 'active', 'restricted'],
  ChildDecorator,
  selectOptions,
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default Administrator;
