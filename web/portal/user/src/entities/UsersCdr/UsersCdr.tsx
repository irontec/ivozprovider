import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface, {
  ChildDecoratorType,
  OrderDirection,
} from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import ChatBubbleIcon from '@mui/icons-material/ChatBubble';

import Actions from './Action';
import Duration from './Field/Duration';
import { UsersCdrProperties, UsersCdrPropertyList } from './UsersCdrProperties';

const properties: UsersCdrProperties = {
  startTime: {
    label: _('Start Time'),
  },
  owner: {
    label: _('Owner'),
    readOnly: true,
    memoize: false,
  },
  duration: {
    label: _('Duration'),
    component: Duration,
  },
  direction: {
    label: _('Direction'),
  },
  caller: {
    label: _('Caller'),
  },
  callee: {
    label: _('Callee'),
  },
  disposition: {
    label: 'Tipificación',
    readOnly: true,
  },
  id: {
    label: _('Id'),
  },
};

export const ChildDecorator: ChildDecoratorType = () => {
  return null;
};

const columns = [
  'startTime',
  'owner',
  'direction',
  'caller',
  'callee',
  'duration',
  'disposition',
];

const UsersCdr: EntityInterface = {
  ...defaultEntityBehavior,
  icon: ChatBubbleIcon,
  iden: 'UsersCdr',
  title: _('Call', { count: 2 }),
  path: '/my/call_history',
  toStr: (row: UsersCdrPropertyList<string>) => `${row.id}`,
  properties,
  defaultOrderBy: 'startTime',
  defaultOrderDirection: OrderDirection.desc,
  ChildDecorator,
  columns,
  customActions: Actions,
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
};

export default UsersCdr;
