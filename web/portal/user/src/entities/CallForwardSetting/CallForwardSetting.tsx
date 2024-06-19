import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import PhoneForwardedIcon from '@mui/icons-material/PhoneForwarded';

import {
  CallForwardSettingProperties,
  CallForwardSettingPropertyList,
} from './CallForwardSettingProperties';

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
      inconditional: _('Unconditional'),
      noAnswer: _('No answer'),
      busy: _('Busy'),
      userNotRegistered: _('User not registered'),
    },
  },
  targetType: {
    label: _('Target type'),
    enum: {
      number: _('Number'),
      extension: _('Extension', { count: 1 }),
      voicemail: _('Voicemail', { count: 1 }),
    },
    visualToggle: {
      number: {
        show: ['numberCountry', 'numberValue'],
        hide: ['extension', 'voicemail'],
      },
      extension: {
        show: ['extension'],
        hide: ['numberCountry', 'numberValue', 'voicemail'],
      },
      voicemail: {
        show: ['voicemail'],
        hide: ['numberCountry', 'numberValue', 'extension'],
      },
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
    label: _('Extension', { count: 1 }),
  },
  voicemail: {
    label: _('Voicemail', { count: 1 }),
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
  title: _('Call forward setting', { count: 2 }),
  path: '/my/call_forward_settings',
  toStr: (row: CallForwardSettingPropertyList<string>) => `${row.id}`,
  properties,
  columns,
  foreignKeyResolver: async () => {
    const module = await import('./ForeignKeyResolver');

    return module.default;
  },
  foreignKeyGetter: async () => {
    const module = await import('./ForeignKeyGetter');

    return module.foreignKeyGetter;
  },
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
};

export default CallForwardSetting;
