import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import AccountTreeIcon from '@mui/icons-material/AccountTree';

import { HolidayDateRangeProperties } from './HolidayDateRangeProperties';

const properties: HolidayDateRangeProperties = {
  name: {
    label: _('Name'),
    required: true,
  },
  locution: {
    label: _('Locution', { count: 1 }),
    $ref: '#/definitions/Locution',
  },
  wholeDayEvent: {
    label: _('Whole day event'),
    type: 'boolean',
    default: 1,
    visualToggle: {
      1: {
        show: [],
        hide: ['timeIn', 'timeOut'],
      },
      0: {
        show: ['timeIn', 'timeOut'],
        hide: [],
      },
    },
  },
  timeIn: {
    label: _('Time in'),
    required: true,
    format: 'time',
  },
  timeOut: {
    label: _('Time out'),
    required: true,
    format: 'time',
  },
  routeType: {
    label: _('Route type'),
    enum: {
      __null__: _('Default holiday routing'),
      number: _('Number'),
      extension: _('Extension', { count: 1 }),
      voicemail: _('Voicemail', { count: 1 }),
    },
    visualToggle: {
      __null__: {
        show: [],
        hide: ['numberCountry', 'numberValue', 'extension', 'voicemail'],
      },
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
  extension: {
    label: _('Extension', { count: 1 }),
    required: true,
    $ref: '#/definitions/Extension',
  },
  voicemail: {
    label: _('Voicemail', { count: 1 }),
    required: true,
    $ref: '#/definitions/Voicemail',
  },
  numberCountry: {
    label: _('Country', { count: 1 }),
    required: true,
    $ref: '#/definitions/Country',
  },
  numberValue: {
    label: _('Number'),
    required: true,
  },
  startDate: {
    label: _('Start date'),
    required: true,
    type: 'string',
    format: 'date',
  },
  endDate: {
    label: _('End date'),
    required: true,
    type: 'string',
    format: 'date',
  },
  calendar: {
    label: _('Calendar', { count: 1 }),
    required: true,
    $ref: '#/definitions/Calendar',
  },
};

const HolidayDateRange: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'HolidayDateRange',
  title: _('Holiday date range', { count: 2 }),
  path: '/holiday_dates_range',
  toStr: () => {
    return '';
  },
  acl: {
    ...defaultEntityBehavior,
    iden: 'HolidayDateRange',
  },
  properties,
  foreignKeyGetter: async () => {
    const module = await import('./ForeignKeyGetter');

    return module.foreignKeyGetter;
  },
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
};

export default HolidayDateRange;
