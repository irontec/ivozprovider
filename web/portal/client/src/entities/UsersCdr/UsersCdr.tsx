import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface, {
  OrderDirection,
} from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import ChatBubbleOutlineIcon from '@mui/icons-material/ChatBubbleOutline';

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
  callid: {
    label: 'Call-ID',
    readOnly: true,
  },
  xcallid: {
    label: 'X-Call-ID',
    readOnly: true,
  },
  callidHash: {
    label: 'Call-ID Hash',
    readOnly: true,
  },
  party: {
    label: _('Party'),
    readOnly: true,
    memoize: false,
  },
};

const columns = ['startTime', 'owner', 'direction', 'party', 'duration'];

const usersCdr: EntityInterface = {
  ...defaultEntityBehavior,
  icon: ChatBubbleOutlineIcon,
  link: '/doc/en/administration_portal/client/vpbx/calls/call_registry.html',
  iden: 'UsersCdr',
  title: _('Call registry', { count: 2 }),
  path: '/users_cdrs',
  properties,
  columns,
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'kam_users_cdrs',
  },
  defaultOrderBy: 'startTime',
  defaultOrderDirection: OrderDirection.desc,
  foreignKeyResolver: async () => {
    const module = await import('./ForeignKeyResolver');

    return module.default;
  },
  View: async () => {
    const module = await import('./View');

    return module.default;
  },
};

export default usersCdr;
