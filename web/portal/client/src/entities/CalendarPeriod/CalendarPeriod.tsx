import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import { EntityValues } from '@irontec/ivoz-ui/services/entity/EntityService';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import DateRangeIcon from '@mui/icons-material/DateRange';

import { CalendarPeriodProperties } from './CalendarPeriodProperties';
import Target from './Field/Target';

const routableFields = [
  'numberCountry',
  'numberValue',
  'extension',
  'voicemail',
];

const properties: CalendarPeriodProperties = {
  calendar: {
    label: 'Calendar',
  },
  startDate: {
    label: _('Start date'),
    type: 'string',
    format: 'date',
  },
  endDate: {
    label: _('End date'),
    type: 'string',
    format: 'date',
  },
  scheduleIds: {
    label: _('Schedule', { count: 2 }),
    null: _('There are not associated elements'),
    memoize: false,
  },
  locution: {
    label: _('Locution'),
    null: _("Filter's Out of schedule Locution"),
    default: '__null__',
  },
  routeType: {
    label: _('Route type'),
    null: _("Filter's Out of schedule Routing"),
    default: '__null__',
    enum: {
      voicemail: _('Voicemail'),
      extension: _('Extension'),
      number: _('Number'),
    },
    visualToggle: {
      __null__: {
        show: [],
        hide: routableFields,
      },
      voicemail: {
        show: ['voicemail'],
        hide: routableFields,
      },
      extension: {
        show: ['extension'],
        hide: routableFields,
      },
      number: {
        show: ['numberCountry', 'numberValue'],
        hide: routableFields,
      },
    },
  },
  numberCountry: {
    label: _('Country'),
    required: true,
  },
  numberValue: {
    label: _('Number'),
    pattern: new RegExp('^\\+?[0-9]+$'),
    required: true,
  },
  voicemail: {
    label: _('Voicemail'),
    null: _('Unassigned'),
    default: '__null__',
  },
  extension: {
    label: _('Extension'),
    null: _('Unassigned'),
    default: '__null__',
  },
  target: {
    label: _('Target'),
    component: Target,
  },
};

const CalendarPeriod: EntityInterface = {
  ...defaultEntityBehavior,
  icon: DateRangeIcon,
  iden: 'CalendarPeriod',
  title: _('Calendar Period', { count: 2 }),
  path: '/calendar_periods',
  properties,
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'CalendarPeriods',
  },
  toStr: (row: EntityValues) => row?.name as string | '',
  columns: [
    'startDate',
    'endDate',
    'scheduleIds',
    'locution',
    'routeType',
    'target',
    'voicemail',
  ],
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

export default CalendarPeriod;
