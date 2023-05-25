import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import GroupsIcon from '@mui/icons-material/Groups';

import {
  HuntGroupProperties,
  HuntGroupPropertyList,
} from './HuntGroupProperties';

const routableFields = [
  'noAnswerNumberCountry',
  'noAnswerNumberValue',
  'noAnswerExtension',
  'noAnswerVoicemail',
];

const properties: HuntGroupProperties = {
  name: {
    label: _('Name'),
  },
  description: {
    label: _('Description'),
    required: false,
  },
  strategy: {
    label: _('Strategy'),
    enum: {
      ringAll: _('Ring all'),
      linear: _('Linear'),
      roundRobin: _('Round Robin'),
      random: _('Random'),
    },
    visualToggle: {
      ringAll: {
        show: ['ringAllTimeout'],
        hide: [],
      },
      linear: {
        show: [],
        hide: ['ringAllTimeout'],
      },
      roundRobin: {
        show: [],
        hide: ['ringAllTimeout'],
      },
      random: {
        show: [],
        hide: ['ringAllTimeout'],
      },
    },
    helpText: _('Determines the order users will be called'),
  },
  preventMissedCalls: {
    label: _('Prevent missed calls'),
    enum: {
      '0': _('No'),
      '1': _('Yes'),
    },
    default: '1',
    helpText: _(
      "When 'Yes', calls will never generate a missed call. When 'No', missed calls will be prevented only for RingAll huntgroups if someone answers."
    ),
  },
  allowCallForwards: {
    label: _('Allow Call Forwards'),
    enum: {
      '0': _('No'),
      '1': _('Yes'),
    },
    default: '0',
    helpText: _("When 'Yes', Users call forward settings will be followed."),
  },
  ringAllTimeout: {
    label: _('Ring all timeout'),
    required: true,
  },
  noAnswerTargetType: {
    label: _('Timeout target type'),
    enum: {
      number: _('Number'),
      extension: _('Extension'),
      voicemail: _('Voicemail'),
    },
    default: '__null__',
    visualToggle: {
      __null__: {
        show: [],
        hide: routableFields,
      },
      number: {
        show: ['noAnswerNumberCountry', 'noAnswerNumberValue'],
        hide: routableFields,
      },
      extension: {
        show: ['noAnswerExtension'],
        hide: routableFields,
      },
      voicemail: {
        show: ['noAnswerVoicemail'],
        hide: routableFields,
      },
    },
    null: _('Unassigned'),
  },
  noAnswerLocution: {
    label: _('No answer locution'),
    null: _('Unassigned'),
  },
  noAnswerNumberCountry: {
    label: _('Country'),
    required: true,
  },
  noAnswerNumberValue: {
    label: _('Number'),
    required: true,
  },
  noAnswerExtension: {
    label: _('Extension'),
    required: true,
  },
  noAnswerVoicemail: {
    label: _('Voicemail'),
    required: true,
  },
};

const huntGroup: EntityInterface = {
  ...defaultEntityBehavior,
  icon: GroupsIcon,
  iden: 'HuntGroup',
  title: _('Hunt Group', { count: 2 }),
  path: '/hunt_groups',
  toStr: (row: HuntGroupPropertyList<string>) => `${row.name}`,
  properties,
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'HuntGroups',
  },
  selectOptions: async () => {
    const module = await import('./SelectOptions');

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

export default huntGroup;
