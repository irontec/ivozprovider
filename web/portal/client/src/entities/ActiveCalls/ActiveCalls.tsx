import DefaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface, {
  OrderDirection,
} from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import ChatBubbleIcon from '@mui/icons-material/ChatBubble';

import { BillableCallProperties } from './ActiveCallsProperties';

const properties: BillableCallProperties = {
  startTime: {
    label: _('Start time'),
  },
};

const activeCalls: EntityInterface = {
  ...DefaultEntityBehavior,
  icon: ChatBubbleIcon,
  link: '/doc/en/administration_portal/client/vpbx/calls/active_calls.html',
  iden: 'ActiveCalls',
  title: _('Active call', { count: 2 }),
  path: '/active_calls',
  properties,
  acl: {
    create: false,
    read: true,
    detail: false,
    update: false,
    delete: false,
    iden: 'BillableCalls',
  },
  defaultOrderBy: 'startTime',
  defaultOrderDirection: OrderDirection.desc,
};

export default activeCalls;
