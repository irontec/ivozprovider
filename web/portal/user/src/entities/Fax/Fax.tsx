import defaultEntityBehavior, {
  ChildDecorator as DefaultChildDecorator,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface, {
  ChildDecoratorType,
} from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import FaxIcon from '@mui/icons-material/Fax';

import { FaxProperties, FaxPropertyList } from './FaxProperties';

const ChildDecorator: ChildDecoratorType = (props) => {
  const { routeMapItem } = props;

  const Fax = routeMapItem.entity;

  const isDeletePath = routeMapItem.route === `${Fax.path}/:id`;
  const isUpdatePath = routeMapItem.route === `${Fax.path}/:id/update`;
  const isDetailedPath = routeMapItem.route === `${Fax.path}/:id/detailed`;

  if (isUpdatePath || isDeletePath || isDetailedPath) {
    return null;
  }

  return DefaultChildDecorator(props);
};

const properties: FaxProperties = {
  name: {
    label: _('Name'),
  },
  email: {
    label: _('Email'),
    required: true,
  },
  sendByEmail: {
    label: _('Send by email'),
    enum: {
      '0': _('No'),
      '1': _('Yes'),
    },
    default: '1',
    visualToggle: {
      '0': {
        show: [],
        hide: ['email'],
      },
      '1': {
        show: ['email'],
        hide: [],
      },
    },
  },
  outgoingDdi: {
    label: _('Outgoing DDI'),
    null: _("Client's default"),
  },
  relUserIds: {
    label: _('Users'),
    type: 'array',
    $ref: '#/definitions/User',
  },
};

const columns = ['name', 'outgoingDdi', 'sendByEmail', 'email'];

const fax: EntityInterface = {
  ...defaultEntityBehavior,
  icon: FaxIcon,
  iden: 'Fax',
  title: _('Fax', { count: 2 }),
  path: '/my/faxes',
  toStr: (row: FaxPropertyList<string>) => `${row.name}`,
  properties,
  columns,
  defaultOrderBy: '',
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
  foreignKeyResolver: async () => {
    const module = await import('./ForeignKeyResolver');

    return module.default;
  },
  ChildDecorator,
};

export default fax;
