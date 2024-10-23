import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import SettingsVoiceIcon from '@mui/icons-material/SettingsVoice';

import Actions from './Action';
import { RecordingProperties } from './RecordingProperties';

const properties: RecordingProperties = {
  callid: {
    label: 'Callid',
  },
  calldate: {
    label: _('Call date'),
  },
  duration: {
    label: _('Duration'),
  },
  caller: {
    label: _('Caller'),
  },
  callee: {
    label: _('Callee'),
  },
  recordedFile: {
    label: _('Recorded file'),
    type: 'file',
  },
};

const columns = ['calldate', 'caller', 'callee', 'duration'];

const recording: EntityInterface = {
  ...defaultEntityBehavior,
  icon: SettingsVoiceIcon,
  link: '/doc/en/administration_portal/client/vpbx/calls/call_recordings.html',
  iden: 'Recording',
  title: _('Recording', { count: 2 }),
  path: '/recordings',
  properties,
  toStr: (row) => row.calldate as string,
  columns,
  defaultOrderBy: '',
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'Recordings',
  },
  customActions: Actions,
  View: async () => {
    const module = await import('./View');

    return module.default;
  },
};

export default recording;
