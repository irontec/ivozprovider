import CelebrationIcon from '@mui/icons-material/Celebration';
import EntityInterface from 'lib/entities/EntityInterface';
import _ from 'lib/services/translations/translate';
import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import { HolidayDateProperties } from './HolidayDateProperties';
import Form from './Form';
import Target from './Field/Target';
import foreignKeyResolver from './foreignKeyResolver';
import { foreignKeyGetter } from './foreignKeyGetter';
import Calendar from './Field/Calendar';

const routableFields = [
    'numberCountry',
    'numberValue',
    'extension',
    'voicemail',
];

const properties: HolidayDateProperties = {
    'calendar': {
        label: _('Calendar'),
        component: Calendar,
        readOnly: true,
    },
    'name': {
        label: _('Name'),
    },
    'eventDate': {
        label: _('Event date'),
        type: 'string',
        format: 'date',
    },
    'locution': {
        label: _('Locution'),
        null: _("Unassigned"),
        default: '__null__',
    },
    'wholeDayEvent': {
        label: _('Whole day event'),
        default: 1,
        enum: {
            '0': _("No"),
            '1': _("Yes"),
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
    'timeIn': {
        label: _('Time in'),
        type: 'string',
        format: 'time',
        required: true,
    },
    'timeOut': {
        label: _('Time out'),
        type: 'string',
        format: 'time',
        required: true,
    },
    'routeType': {
        label: _('Route type'),
        enum: {
            'voicemail': _('Voicemail'),
            'extension': _('Extension'),
            'number': _('Number'),

        },
        null: _("Default holiday routing"),
        default: '__null__',
        visualToggle: {
            '__null__': {
                show: [],
                hide: routableFields,
            },
            'voicemail': {
                show: ['voicemail'],
                hide: routableFields
            },
            'extension': {
                show: ['extension'],
                hide: routableFields
            },
            'number': {
                show: ['numberCountry', 'numberValue'],
                hide: routableFields
            },
        }
    },
    'numberCountry': {
        label: _('Country'),
        required: true,
    },
    'numberValue': {
        label: _('Number'),
        pattern: new RegExp('^\\+?[0-9]+$'),
        required: true,
    },
    'voicemail': {
        label: _('Voicemail'),
        required: true,
        null: _('Unassigned'),
        default: '__null__',
    },
    'extension': {
        label: _('Extension'),
        required: true,
        null: _('Unassigned'),
        default: '__null__',
    },
    'target': {
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
    Form,
    foreignKeyResolver,
    foreignKeyGetter,
};

export default HolidayDate;