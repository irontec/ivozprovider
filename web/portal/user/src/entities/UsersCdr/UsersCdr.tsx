import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import ChatBubbleIcon from '@mui/icons-material/ChatBubble';
import Form from './Form';
import { UsersCdrProperties } from './UsersCdrProperties';

const properties: UsersCdrProperties = {
  startTime: {
    label: _('Start Time'),
  },
  endTime: {
    label: _('End Time'),
  },
  duration: {
    label: _('Duration'),
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
  diversion: {
    label: _('Diversion'),
  },
  referee: {
    label: _('Referee'),
  },
  referrer: {
    label: _('Referrer'),
  },
  callid: {
    label: _('Callid'),
  },
  callidHash: {
    label: _('Callid Hash'),
  },
  xcallid: {
    label: _('Xcallid'),
  },
  id: {
    label: _('Id'),
  },
  user: {
    label: _('User'),
  },
};

const columns = ['startTime', 'caller', 'duration', 'direction'];

const UsersCdr: EntityInterface = {
  ...defaultEntityBehavior,
  icon: ChatBubbleIcon,
  iden: 'UsersCdr',
  title: _('Calls', { count: 2 }),
  path: '/my/call_history',
  toStr: (row: any) => row.id,
  properties,
  columns,
  Form,
};

export default UsersCdr;
