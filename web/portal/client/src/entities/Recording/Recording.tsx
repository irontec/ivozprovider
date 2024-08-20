import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface, {
  EntityColumnsFuncType,
} from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import SettingsVoiceIcon from '@mui/icons-material/SettingsVoice';

import Ddi from '../Ddi/Ddi';
import Type from './Field/Type';
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
  type: {
    label: _('Type'),
    enum: {
      ondemand: _('On-demand'),
      ddi: _('DDI', { count: 1 }),
    },
  },
  typeGhost: {
    label: _('Type'),
    component: Type,
  },
  recordedFile: {
    label: _('Recorded file'),
    type: 'file',
  },
};

const columnsFunc: EntityColumnsFuncType = () => {
  const showType = !location.pathname.includes(Ddi.path);
  const columns = [
    'calldate',
    showType && 'typeGhost',
    'caller',
    'callee',
    'duration',
  ];

  return columns.filter((row) => row !== false) as Array<string>;
};

const recording: EntityInterface = {
  ...defaultEntityBehavior,
  icon: SettingsVoiceIcon,
  link: '/doc/en/administration_portal/client/vpbx/calls/call_recordings.html',
  iden: 'Recording',
  title: _('Recording', { count: 2 }),
  path: '/recordings',
  properties,
  toStr: (row) => row.calldate,
  columns: columnsFunc,
  defaultOrderBy: '',
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'Recordings',
  },
  View: async () => {
    const module = await import('./View');

    return module.default;
  },
};

export default recording;
