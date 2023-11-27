import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface, {
  ChildDecoratorType,
  OrderDirection,
} from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import ChatBubbleOutlineIcon from '@mui/icons-material/ChatBubbleOutline';

import Actions from './Action';
import { UsersCdrProperties } from './UsersCdrProperties';

const properties: UsersCdrProperties = {
  startTime: {
    label: _('Start time'),
    readOnly: true,
  },
  owner: {
    label: _('Owner'),
    readOnly: true,
    memoize: false,
  },
  duration: {
    label: _('Duration'),
    readOnly: true,
  },
  direction: {
    label: _('Direction'),
    enum: {
      inbound: _('Inbound'),
      outbound: _('Outbound'),
    },
    readOnly: true,
  },
  caller: {
    label: _('Source'),
    readOnly: true,
  },
  callee: {
    label: _('Destination'),
    readOnly: true,
  },
  disposition: {
    label: 'Tipificación',
    readOnly: true,
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

const usersCdr: EntityInterface = {
  ...defaultEntityBehavior,
  icon: ChatBubbleOutlineIcon,
  link: '/doc/en/administration_portal/client/vpbx/calls/call_registry.html',
  iden: 'UsersCdr',
  title: _('Call registry', { count: 2 }),
  path: '/users_cdrs',
  properties,
  columns,
  customActions: Actions,
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'provider_users_cdrs',
  },
  defaultOrderBy: 'startTime',
  defaultOrderDirection: OrderDirection.desc,
  ChildDecorator,
  foreignKeyResolver: async () => {
    const module = await import('./ForeignKeyResolver');

    return module.default;
  },
};

export default usersCdr;
