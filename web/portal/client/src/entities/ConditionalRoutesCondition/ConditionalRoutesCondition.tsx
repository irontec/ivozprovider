import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import FormatListNumberedIcon from '@mui/icons-material/FormatListNumbered';

import {
  ConditionalRoutesConditionProperties,
  ConditionalRoutesConditionPropertyList,
} from './ConditionalRoutesConditionProperties';
import ConditionMatch from './Field/ConditionMatch';
import RouteType from './Field/RouteType';
import Target from './Field/Target';

const routableFields = [
  'numberCountry',
  'numberValue',
  'ivr',
  'user',
  'huntGroup',
  'voicemail',
  'friendValue',
  'queue',
  'conferenceRoom',
  'extension',
];

const properties: ConditionalRoutesConditionProperties = {
  conditionalRoute: {
    label: _('Conditional Route', { count: 1 }),
  },
  priority: {
    label: _('Priority'),
    default: '1',
    minimum: 0,
    maximum: 100,
  },
  matchListIds: {
    label: _('Origin'),
    type: 'array',
    helpText: _(
      'If caller matches any selected matchlist, this criteria is considered fulfilled.'
    ),
  },
  scheduleIds: {
    label: _('Schedule', { count: 1 }),
    type: 'array',
    helpText: _(
      'If calling time is included in any selected schedules, this criteria is considered fulfilled.'
    ),
  },
  calendarIds: {
    label: _('Calendar', { count: 1 }),
    type: 'array',
    helpText: _(
      'If calling date is marked as holiday in any selected calendar, this criteria is considered fulfilled. Calendar periods are not taken into account.'
    ),
  },
  routeLockIds: {
    label: _('Route Lock', { count: 1 }),
    type: 'array',
    helpText: _(
      'If one of selected route locks is open, this criteria is considered fulfilled.'
    ),
  },
  ConditionMatch: {
    label: _('Match'),
    component: ConditionMatch,
  },
  locution: {
    label: _('Locution', { count: 1 }),
    null: _('Unassigned'),
    default: '__null__',
  },
  routeType: {
    label: _('Route type'),
    component: RouteType,
    null: _('Unassigned'),
    default: '__null__',
    enum: {
      user: _('User', { count: 1 }),
      ivr: _('IVR', { count: 1 }),
      huntGroup: _('Hunt Group', { count: 1 }),
      voicemail: _('Voicemail', { count: 1 }),
      number: _('Number'),
      friend: _('Friend', { count: 1 }),
      queue: _('Queue', { count: 1 }),
      conferenceRoom: _('Conference room', { count: 1 }),
      extension: _('Extension', { count: 1 }),
    },
    visualToggle: {
      __null__: {
        show: [],
        hide: routableFields,
      },
      user: {
        show: ['user'],
        hide: routableFields,
      },
      ivr: {
        show: ['ivr'],
        hide: routableFields,
      },
      huntGroup: {
        show: ['huntGroup'],
        hide: routableFields,
      },
      voicemail: {
        show: ['voicemail'],
        hide: routableFields,
      },
      number: {
        show: ['numberCountry', 'numberValue'],
        hide: routableFields,
      },
      friend: {
        show: ['friendValue'],
        hide: routableFields,
      },
      queue: {
        show: ['queue'],
        hide: routableFields,
      },
      conferenceRoom: {
        show: ['conferenceRoom'],
        hide: routableFields,
      },
      extension: {
        show: ['extension'],
        hide: routableFields,
      },
    },
  },
  ivr: {
    label: _('IVR', { count: 1 }),
    required: true,
    null: _('Unassigned'),
    default: '__null__',
  },
  huntGroup: {
    label: _('Hunt Group', { count: 1 }),
    required: true,
    null: _('Unassigned'),
    default: '__null__',
  },
  voicemail: {
    label: _('Voicemail', { count: 1 }),
    required: true,
    null: _('Unassigned'),
    default: '__null__',
  },
  user: {
    label: _('User', { count: 1 }),
    required: true,
    null: _('Unassigned'),
    default: '__null__',
  },
  numberCountry: {
    label: _('Country', { count: 1 }),
    required: true,
    null: _('Unassigned'),
    default: '__null__',
  },
  numberValue: {
    label: _('Number'),
    required: true,
    maxLength: 25,
  },
  friendValue: {
    label: _('Friend value'),
    required: true,
    maxLength: 25,
  },
  queue: {
    label: _('Queue', { count: 1 }),
    required: true,
    null: _('Unassigned'),
    default: '__null__',
  },
  conferenceRoom: {
    label: _('Conference room', { count: 1 }),
    required: true,
    null: _('Unassigned'),
    default: '__null__',
  },
  extension: {
    label: _('Extension', { count: 1 }),
    required: true,
    null: _('Unassigned'),
    default: '__null__',
  },
  target: {
    label: _('Target'),
    component: Target,
  },
};

const ConditionalRoutesCondition: EntityInterface = {
  ...defaultEntityBehavior,
  icon: FormatListNumberedIcon,
  iden: 'ConditionalRoutesCondition',
  title: _('Condition', { count: 2 }),
  path: '/conditional_routes_conditions',
  toStr: (row: ConditionalRoutesConditionPropertyList<string>) => `${row.id}`,
  properties,
  columns: [
    'priority',
    'ConditionMatch',
    'match',
    'locution',
    'routeType',
    'target',
  ],
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'ConditionalRoutesConditions',
  },
  foreignKeyResolver: async () => {
    const module = await import('./ForeignKeyResolver');

    return module.default;
  },
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
};

export default ConditionalRoutesCondition;
