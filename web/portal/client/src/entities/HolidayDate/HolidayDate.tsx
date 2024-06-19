import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import CelebrationIcon from '@mui/icons-material/Celebration';

import CustomActions from './Action';
import Calendar from './Field/Calendar';
import Target from './Field/Target';
import { HolidayDateProperties } from './HolidayDateProperties';

const routableFields = [
  'numberCountry',
  'numberValue',
  'extension',
  'voicemail',
];

const properties: HolidayDateProperties = {
  calendar: {
    label: _('Calendar', { count: 1 }),
    component: Calendar,
    readOnly: true,
  },
  name: {
    label: _('Name'),
  },
  eventDate: {
    label: _('Event date'),
    type: 'string',
    format: 'date',
  },
  locution: {
    label: _('Locution', { count: 1 }),
    null: _('Unassigned'),
    default: '__null__',
  },
  wholeDayEvent: {
    label: _('Whole day event'),
    default: 1,
    enum: {
      '0': _('No'),
      '1': _('Yes'),
    },
    visualToggle: {
      '0': {
        show: ['timeIn', 'timeOut'],
        hide: [],
      },
      '1': {
        show: [],
        hide: ['timeIn', 'timeOut'],
      },
    },
  },
  timeIn: {
    label: _('Time in'),
    type: 'string',
    format: 'time',
    required: true,
  },
  timeOut: {
    label: _('Time out'),
    type: 'string',
    format: 'time',
    required: true,
  },
  routeType: {
    label: _('Route type'),
    enum: {
      voicemail: _('Voicemail', { count: 1 }),
      extension: _('Extension', { count: 1 }),
      number: _('Number'),
    },
    null: _('Default holiday routing'),
    default: '__null__',
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
    label: _('Country', { count: 1 }),
    required: true,
  },
  numberValue: {
    label: _('Number'),
    pattern: new RegExp('^\\+?[0-9]+$'),
    required: true,
  },
  voicemail: {
    label: _('Voicemail', { count: 1 }),
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

const HolidayDate: EntityInterface = {
  ...defaultEntityBehavior,
  icon: CelebrationIcon,
  iden: 'HolidayDate',
  title: _('Holiday date', { count: 2 }),
  path: '/holiday_dates',
  properties,
  columns: [
    'name',
    'eventDate',
    'locution',
    'wholeDayEvent',
    'timeIn',
    'timeOut',
    'routeType',
    'target',
  ],
  toStr: (row) => row.name as string,
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'HolidayDates',
  },
  customActions: CustomActions,
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

export default HolidayDate;
