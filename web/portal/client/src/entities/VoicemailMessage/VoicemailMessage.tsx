import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface, {
  OrderDirection,
} from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import FormatListBulletedIcon from '@mui/icons-material/FormatListBulleted';

import Status from '../VoicemailMessage/Field/Status';
import { VoicemailMessageProperties } from './VoicemailMessageProperties';

const properties: VoicemailMessageProperties = {
  status: {
    label: _('Status'),
    component: Status,
  },
  folder: {
    label: _('Folder'),
  },
  calldate: {
    label: _('Date'),
  },
  caller: {
    label: _('Caller'),
  },
  duration: {
    label: _('Duration'),
  },
  recordingFile: {
    label: _('Recording'),
    type: 'file',
  },
};

const columns = ['status', 'calldate', 'caller', 'duration'];

const voicemailMessage: EntityInterface = {
  ...defaultEntityBehavior,
  icon: FormatListBulletedIcon,
  iden: 'VoicemailMessage',
  title: _('VoicemailMessage', { count: 2 }),
  path: '/voicemail_messages',
  properties,
  columns,
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'VoicemailMessages',
  },
  defaultOrderBy: 'calldate',
  defaultOrderDirection: OrderDirection.desc,
  View: async () => {
    const module = await import('./View');

    return module.default;
  },
};

export default voicemailMessage;
