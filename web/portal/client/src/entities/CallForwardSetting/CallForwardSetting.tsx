import defaultEntityBehavior from '@irontec-voip/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec-voip/ivoz-ui/entities/EntityInterface';
import _ from '@irontec-voip/ivoz-ui/services/translations/translate';
import PhoneForwardedIcon from '@mui/icons-material/PhoneForwarded';

import { CallForwardSettingProperties } from './CallForwardSettingProperties';
import CallForwardType from './Field/CallForwardType';
import TargetType from './Field/TargetType';
import TargetTypeValue from './Field/TargetTypeValue';

const properties: CallForwardSettingProperties = {
  user: {
    label: _('User', { count: 1 }),
  },
  residentialDevice: {
    label: _('Residential Device', { count: 1 }),
  },
  retailAccount: {
    label: _('Retail Account', { count: 1 }),
  },
  friend: {
    label: _('Friend', { count: 1 }),
  },
  ddi: {
    label: _('Called DDI'),
    null: _('Any'),
    default: '__null__',
  },
  cfwToRetailAccount: {
    label: _('Retail Account', { count: 1 }),
    null: _('Unassigned'),
    default: '__null__',
    required: true,
  },
  callTypeFilter: {
    label: _('Call type'),
    enum: {
      internal: _('Internal'),
      external: _('External'),
      both: _('Both'),
    },
  },
  callForwardType: {
    label: _('Call forward type'),
    component: CallForwardType,
    enum: {
      inconditional: _('Unconditional'),
      noAnswer: _('No Answer'),
      busy: _('Busy'),
      userNotRegistered: _('Unreachable'),
    },
    visualToggle: {
      inconditional: {
        show: [],
        hide: ['noAnswerTimeout'],
      },
      noAnswer: {
        show: ['noAnswerTimeout'],
        hide: [],
      },
      busy: {
        show: [],
        hide: ['noAnswerTimeout'],
      },
      userNotRegistered: {
        show: [],
        hide: ['noAnswerTimeout'],
      },
    },
  },
  targetType: {
    label: _('Target type'),
    component: TargetType,
    enum: {
      number: _('Number'),
      extension: _('Extension', { count: 1 }),
      voicemail: _('Voicemail', { count: 1 }),
      retail: _('Retail Account', { count: 1 }),
    },
    null: _('Unassigned'),
    default: '__null__',
    visualToggle: {
      __null__: {
        show: [],
        hide: [
          'extension',
          'voicemail',
          'numberCountry',
          'numberValue',
          'cfwToRetailAccount',
        ],
      },
      number: {
        show: ['numberCountry', 'numberValue'],
        hide: ['extension', 'voicemail', 'cfwToRetailAccount'],
      },
      extension: {
        show: ['extension'],
        hide: [
          'numberCountry',
          'numberValue',
          'voicemail',
          'cfwToRetailAccount',
        ],
      },
      voicemail: {
        show: ['voicemail'],
        hide: [
          'extension',
          'numberCountry',
          'numberValue',
          'cfwToRetailAccount',
        ],
      },
      retail: {
        show: ['cfwToRetailAccount'],
        hide: ['extension', 'numberCountry', 'numberValue', 'voicemail'],
      },
    },
  },
  numberCountry: {
    label: _('Country', { count: 1 }),
    required: true,
  },
  numberValue: {
    label: _('Number'),
    pattern: RegExp('^[0-9]+$'),
    required: true,
  },
  extension: {
    label: _('Extension', { count: 1 }),
    null: _('Unassigned'),
    default: '__null__',
    required: true,
  },
  voicemail: {
    label: _('Voicemail', { count: 1 }),
    null: _('Unassigned'),
    default: '__null__',
    required: true,
  },
  noAnswerTimeout: {
    label: _('No answer timeout'),
    default: 10,
    required: true,
  },
  targetTypeValue: {
    label: _('Target type value'),
    component: TargetTypeValue,
  },
  enabled: {
    label: _('Enabled'),
    enum: {
      '0': _('No'),
      '1': _('Yes'),
    },
    default: '1',
  },
};

const CallForwardSetting: EntityInterface = {
  ...defaultEntityBehavior,
  icon: PhoneForwardedIcon,
  iden: 'CallForwardSetting',
  title: _('Call forward setting', { count: 2 }),
  path: '/call_forward_settings',
  properties,
  columns: [
    'enabled',
    'callTypeFilter',
    'callForwardType',
    'targetType',
    'targetTypeValue',
  ],
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'CallForwardSettings',
  },
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
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
