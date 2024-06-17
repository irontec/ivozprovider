import defaultEntityBehavior from '@irontec-voip/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface, {
  OrderDirection,
} from '@irontec-voip/ivoz-ui/entities/EntityInterface';
import _ from '@irontec-voip/ivoz-ui/services/translations/translate';
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
    label: _('Recording', { count: 1 }),
    type: 'file',
  },
};

const columns = ['status', 'calldate', 'caller', 'duration'];

const voicemailMessage: EntityInterface = {
  ...defaultEntityBehavior,
  icon: FormatListBulletedIcon,
  iden: 'VoicemailMessage',
  title: _('Voicemail Message', { count: 2 }),
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
