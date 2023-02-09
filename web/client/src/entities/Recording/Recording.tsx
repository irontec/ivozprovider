import SettingsVoiceIcon from '@mui/icons-material/SettingsVoice';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import Type from './Field/Type';
import { RecordingProperties } from './RecordingProperties';
import View from './View';

const properties: RecordingProperties = {
  callid: {
    label: _('Callid'),
  },
  calldate: {
    label: _('Calldate'),
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
      ddi: _('DDI'),
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

const columns = ['calldate', 'typeGhost', 'caller', 'callee', 'duration'];

const recording: EntityInterface = {
  ...defaultEntityBehavior,
  icon: SettingsVoiceIcon,
  iden: 'Recording',
  title: _('Recording', { count: 2 }),
  path: '/recordings',
  properties,
  columns,
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'Recordings',
  },
  View,
};

export default recording;
