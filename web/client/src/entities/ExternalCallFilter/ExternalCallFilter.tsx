import FilterAltIcon from '@mui/icons-material/FilterAlt';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import Form from './Form';
import { foreignKeyGetter } from './foreignKeyGetter';
import { ExternalCallFilterProperties } from './ExternalCallFilterProperties';
import foreignKeyResolver from './foreignKeyResolver';
import selectOptions from './SelectOptions';

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
    'name': {
        label: _('Name'),
        required: true,
    },
    'welcomeLocution': {
        label: _('Welcome locution'),
        default: '__null__',
        null: _('Unassigned'),
    },
    'holidayLocution': {
        label: _('Holiday locution'),
        default: '__null__',
        null: _('Unassigned'),
    },
    'outOfScheduleLocution': {
        label: _('Out of schedule locution'),
        default: '__null__',
        null: _('Unassigned'),
    },
    'holidayEnabled': {
        label: _('Holidays enabled'),
        enum: {
            '0': _('No'),
            '1': _('Yes'),
        },
        default: '1',
        visualToggle: {
            '0': {
                show: [],
                hide: [
                    'calendarIds',
                    'holidayTargetType',
                    'holidayLocution',
                ],
            },
            '1': {
                show: [
                    'calendarIds',
                    'holidayTargetType',
                    'holidayLocution',
                ],
                hide: [],
            }
        }
    },
    'holidayTargetType': {
        label: _('Holiday target type'),
        enum: {
            'number': _("Number"),
            'extension': _('Extension'),
            'voicemail': _('Voicemail'),
        },
        null: _('Unassigned'),
        default: '__null__',
        visualToggle: {
            '__null__': {
                show: [],
                hide: holidayFields,
            },
            'number': {
                show: ['holidayNumberValue', 'holidayNumberCountry'],
                hide: holidayFields,
            },
            'extension': {
                show: ['holidayExtension'],
                hide: holidayFields,
            },
            'voicemail': {
                show: ['holidayVoicemail'],
                hide: holidayFields,
            },
        }
    },
    'holidayNumberCountry': {
        label: _('Country'),
        required: true,
    },
    'holidayNumberValue': {
        label: _('Number'),
        required: true,
    },
    'holidayExtension': {
        label: _('Extension'),
        required: true,
    },
    'holidayVoicemail': {
        label: _('Voicemail'),
        required: true,
    },
    'outOfScheduleEnabled': {
        label: _('Out of schedule enabled'),
        enum: {
            '0': _('No'),
            '1': _('Yes'),
        },
        default: '1',
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
            }
        }
    },
    'outOfScheduleTargetType': {
        label: _('Out of schedule target type'),
        enum: {
            'number': _("Number"),
            'extension': _('Extension'),
            'voicemail': _('Voicemail'),
        },
        null: _('Unassigned'),
        default: '__null__',
        visualToggle: {
            '__null__': {
                show: [],
                hide: outOfScheduleFields,
            },
            'number': {
                show: ['outOfScheduleNumberValue', 'outOfScheduleNumberCountry'],
                hide: outOfScheduleFields,
            },
            'extension': {
                show: ['outOfScheduleExtension'],
                hide: outOfScheduleFields,
            },
            'voicemail': {
                show: ['outOfScheduleVoicemail'],
                hide: outOfScheduleFields,
            },
        }
    },
    'outOfScheduleNumberCountry': {
        label: _('Country'),
        required: true,
    },
    'outOfScheduleNumberValue': {
        label: _('Number'),
        required: true,
    },
    'outOfScheduleExtension': {
        label: _('Extension'),
        required: true,
    },
    'outOfScheduleVoicemail': {
        label: _('Voicemail'),
        required: true,
    },
    'scheduleIds': {
        label: _('Schedule'),
    },
    'calendarIds': {
        label: _('Calendar'),
    },
    'whiteListIds': {
        label: _('White Lists'),
        helpText: _("Incoming numbers that match this lists will be always ACCEPTED without checking this filter configuration."),
    },
    'blackListIds': {
        label: _('Black Lists'),
        helpText: _("Incoming numbers that match this lists will be always REJECTED without checking this filter configuration."),
    },
    'holidayTarget': {
        label: _('Holiday target')
    },
    'outOfScheduleTarget': {
        label: _('Out of schedule target')
    }
};

const columns = [
    'name',
    'holidayTargetType',
    'holidayTarget',
    'outOfScheduleTargetType',
    'outOfScheduleTarget',
];

const externalCallFilter: EntityInterface = {
    ...defaultEntityBehavior,
    icon: FilterAltIcon,
    iden: 'ExternalCallFilter',
    title: _('External call filter', { count: 2 }),
    path: '/external_call_filters',
    toStr: (row: any) => row.name,
    properties,
    columns,
    Form,
    foreignKeyGetter,
    foreignKeyResolver,
    selectOptions: (props, customProps) => { return selectOptions(props, customProps); },
};

export default externalCallFilter;