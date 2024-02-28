import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import DefaultMarshaller, {
  MarshallerValues,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior/Marshaller';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import { PartialPropertyList } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import FilterAltIcon from '@mui/icons-material/FilterAlt';
import { IvozStoreState } from 'store';

import {
  ExternalCallFilterProperties,
  ExternalCallFilterPropertyList,
} from './ExternalCallFilterProperties';
import OutOfScheduleEnabled from './Field/OutOfScheduleEnabled';

const holidayFields = [
  'holidayNumberCountry',
  'holidayNumberValue',
  'holidayExtension',
  'holidayVoicemail',
];

const outOfScheduleFields = [
  'outOfScheduleNumberCountry',
  'outOfScheduleNumberValue',
  'outOfScheduleExtension',
  'outOfScheduleVoicemail',
];

const properties: ExternalCallFilterProperties = {
  name: {
    label: _('Name'),
    required: true,
  },
  welcomeLocution: {
    label: _('Welcome locution'),
    default: '__null__',
    null: _('Unassigned'),
  },
  holidayLocution: {
    label: _('Holiday locution'),
    default: '__null__',
    null: _('Unassigned'),
  },
  outOfScheduleLocution: {
    label: _('Out of schedule locution'),
    default: '__null__',
    null: _('Unassigned'),
  },
  holidayEnabled: {
    label: _('Holidays enabled'),
    enum: {
      '0': _('No'),
      '1': _('Yes'),
    },
    default: '0',
    visualToggle: {
      '0': {
        show: [],
        hide: ['calendarIds', 'holidayTargetType', 'holidayLocution'],
      },
      '1': {
        show: ['calendarIds', 'holidayTargetType', 'holidayLocution'],
        hide: [],
      },
    },
  },
  holidayTargetType: {
    label: _('Holiday target type'),
    enum: {
      number: _('Number'),
      extension: _('Extension', { count: 1 }),
      voicemail: _('Voicemail', { count: 1 }),
    },
    null: _('Unassigned'),
    default: '__null__',
    visualToggle: {
      __null__: {
        show: [],
        hide: holidayFields,
      },
      number: {
        show: ['holidayNumberValue', 'holidayNumberCountry'],
        hide: holidayFields,
      },
      extension: {
        show: ['holidayExtension'],
        hide: holidayFields,
      },
      voicemail: {
        show: ['holidayVoicemail'],
        hide: holidayFields,
      },
    },
  },
  holidayNumberCountry: {
    label: _('Country', { count: 1 }),
    required: true,
  },
  holidayNumberValue: {
    label: _('Number'),
    required: true,
  },
  holidayExtension: {
    label: _('Extension', { count: 1 }),
    required: true,
  },
  holidayVoicemail: {
    label: _('Voicemail', { count: 1 }),
    required: true,
  },
  outOfScheduleEnabled: {
    label: _('Out of schedule enabled'),
    component: OutOfScheduleEnabled,
    enum: {
      '0': _('No'),
      '1': _('Yes'),
    },
    default: '0',
    visualToggle: {
      '0': {
        show: [],
        hide: [
          'scheduleIds',
          'outOfScheduleTargetType',
          'outOfScheduleLocution',
        ],
      },
      '1': {
        show: [
          'scheduleIds',
          'outOfScheduleTargetType',
          'outOfScheduleLocution',
        ],
        hide: [],
      },
    },
  },
  outOfScheduleTargetType: {
    label: _('Out of schedule target type'),
    enum: {
      number: _('Number'),
      extension: _('Extension', { count: 1 }),
      voicemail: _('Voicemail', { count: 1 }),
    },
    null: _('Unassigned'),
    default: '__null__',
    visualToggle: {
      __null__: {
        show: [],
        hide: outOfScheduleFields,
      },
      number: {
        show: ['outOfScheduleNumberValue', 'outOfScheduleNumberCountry'],
        hide: outOfScheduleFields,
      },
      extension: {
        show: ['outOfScheduleExtension'],
        hide: outOfScheduleFields,
      },
      voicemail: {
        show: ['outOfScheduleVoicemail'],
        hide: outOfScheduleFields,
      },
    },
  },
  outOfScheduleNumberCountry: {
    label: _('Country', { count: 1 }),
    required: true,
  },
  outOfScheduleNumberValue: {
    label: _('Number'),
    required: true,
  },
  outOfScheduleExtension: {
    label: _('Extension', { count: 1 }),
    required: true,
  },
  outOfScheduleVoicemail: {
    label: _('Voicemail', { count: 1 }),
    required: true,
  },
  scheduleIds: {
    label: _('Schedule', { count: 1 }),
  },
  calendarIds: {
    label: _('Calendar', { count: 1 }),
  },
  whiteListIds: {
    label: _('White Lists'),
    helpText: _(
      'Incoming numbers that match this lists will be always ACCEPTED without checking this filter configuration.'
    ),
  },
  blackListIds: {
    label: _('Black Lists'),
    helpText: _(
      'Incoming numbers that match this lists will be always REJECTED without checking this filter configuration.'
    ),
  },
  holidayTarget: {
    label: _('Holiday target'),
    memoize: false,
  },
  outOfScheduleTarget: {
    label: _('Out of schedule target'),
    memoize: false,
  },
};

const columns = (store: IvozStoreState) => {
  const nonResidentialColumns = [
    'name',
    'holidayTargetType',
    'holidayTarget',
    'outOfScheduleTargetType',
    'outOfScheduleTarget',
  ];

  const residentialColumns = [
    'name',
    'blackListIds',
    'outOfScheduleNumberCountry',
    'outOfScheduleEnabled',
    'outOfScheduleNumberValue',
  ];
  const residential = store.clientSession.aboutMe.profile?.residential;

  return residential ? residentialColumns : nonResidentialColumns;
};

const externalCallFilter: EntityInterface = {
  ...defaultEntityBehavior,
  icon: FilterAltIcon,
  link: '/doc/en/administration_portal/client/vpbx/routing_tools/external_call_filters.html',
  iden: 'ExternalCallFilter',
  title: _('External call filter', { count: 2 }),
  path: '/external_call_filters',
  toStr: (row: ExternalCallFilterPropertyList<string>) => `${row.name}`,
  properties,
  columns,
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'ExternalCallFilters',
  },
  marshaller: (
    values: MarshallerValues,
    properties: PartialPropertyList,
    whitelist: string[] = []
  ): MarshallerValues => {
    const response = DefaultMarshaller(values, properties, whitelist);

    if (response.outOfScheduleEnabled && response.outOfScheduleNumberValue) {
      // Force value in residential clients
      response.outOfScheduleTargetType = 'number';
    }

    return response;
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

export default externalCallFilter;
