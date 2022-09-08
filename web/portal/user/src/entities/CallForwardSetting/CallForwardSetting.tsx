import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import PhoneForwardedIcon from '@mui/icons-material/PhoneForwarded';
import { CallForwardSettingProperties } from './CallForwardSettingProperties';
import { foreignKeyGetter } from './ForeignKeyGetter';
import Form from './Form';

const properties: CallForwardSettingProperties = {
  callTypeFilter: {
    label: _('Call type filter'),
    enum: {
      internal: _('Internal'),
      external: _('External'),
      both: _('Both'),
    },
  },
  callForwardType: {
    label: _('Call forward type'),
    enum: {
      inconditional: _('Inconditional'),
      noAnswer: _('No Answer'),
      busy: _('Busy'),
      userNotRegistered: _('User NotRegistered'),
    },
  },
  targetType: {
    label: _('Target type'),
    enum: {
      number: _('Number'),
      extension: _('Extension'),
      voicemail: _('Voicemail'),
      retail: _('Retail'),
    },
  },
  numberValue: {
    label: _('Number value'),
  },
  noAnswerTimeout: {
    label: _('No answer timeout'),
  },
  enabled: {
    label: _('Enabled'),
  },
  id: {
    label: _('Id'),
  },
  user: {
    label: _('User'),
  },
  extension: {
    label: _('Extension'),
  },
  voicemail: {
    label: _('Voicemail'),
  },
  numberCountry: {
    label: _('Number country'),
  },
};

const columns = [
  'enabled',
  'callTypeFilter',
  'callForwardType',
  'targetType',
  'extension',
];

const CallForwardSetting: EntityInterface = {
  ...defaultEntityBehavior,
  icon: PhoneForwardedIcon,
  iden: 'CallForwardSetting',
  title: _('Call Forward Settings', { count: 2 }),
  path: '/my/call_forward_settings',
  toStr: (row: any) => row.id,
  properties,
  columns,
  foreignKeyGetter,
  Form,
};

export default CallForwardSetting;
