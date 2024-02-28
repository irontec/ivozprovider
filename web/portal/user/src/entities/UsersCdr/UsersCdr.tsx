import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface, {
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
    enum: {
      inbound: _('Inbound'),
      outbound: _('Outbound'),
    },
  },
  caller: {
    label: _('Caller'),
  },
  callee: {
    label: _('Callee'),
  },
  disposition: {
    label: _('Disposition'),
    enum: {
      answered: _('Answered'),
      missed: _('Missed'),
      busy: _('Busy'),
    },
    readOnly: true,
  },
  id: {
    label: _('Id'),
  },
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
  acl: {
    create: false,
    delete: false,
    detail: false,
    read: true,
    update: false,
    iden: 'provider_users_cdrs',
  },
  defaultOrderBy: 'startTime',
  defaultOrderDirection: OrderDirection.desc,
  columns,
  customActions: Actions,
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
};

export default UsersCdr;
