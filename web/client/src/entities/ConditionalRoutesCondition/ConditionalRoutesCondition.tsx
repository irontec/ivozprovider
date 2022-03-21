import FormatListNumberedIcon from '@mui/icons-material/FormatListNumbered';
import EntityInterface from 'lib/entities/EntityInterface';
import _ from 'lib/services/translations/translate';
import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import { ConditionalRoutesConditionProperties } from './ConditionalRoutesConditionProperties';
import Target from './Field/Target';
import ConditionMatch from './Field/ConditionMatch';
import foreignKeyResolver from './foreignKeyResolver';
import Form from './Form';

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
    'conditionalRoute': {
        label: _('Conditional Route'),
    },
    'priority': {
        label: _('Priority'),
        default: '1',
        minimum: 0,
        maximum: 100,
    },
    'matchListIds':  {
        label: _('Origin'),
        type: 'array',
        helpText: _("If caller matches any selected matchlist, this criteria is considered fulfilled."),
    },
    'scheduleIds': {
        label: _('Schedule'),
        type: 'array',
        helpText: _("If calling time is included in any selected schedules, this criteria is considered fulfilled."),
    },
    'calendarIds': {
        label: _('Calendar'),
        type: 'array',
        helpText: _("If calling date is marked as holiday in any selected calendar, this criteria is considered fulfilled. Calendar periods are not taken into account."),
    },
    'routeLockIds': {
        label: _('Route Lock'),
        type: 'array',
        helpText: _("If one of selected route locks is open, this criteria is considered fulfilled."),
    },
    'ConditionMatch': {
        label: _('Match'),
        component: ConditionMatch,
        // class: IvozProvider_Klear_Ghost_ConditionalRoutes::getMatchData
    },
    'locution': {
        label: _('Locution'),
        null: _("Unassigned"),
        default: '__null__',
    },
    'routeType': {
        label: _('Route type'),
        null: _("Unassigned"),
        default: '__null__',
        enum: {
            'user': _('User'),
            'ivr': _('IVR'),
            'huntGroup': _('Hunt Group'),
            'voicemail': _('Voicemail'),
            'number': _('Number'),
            'friend': _('Friend'),
            'queue': _('Queue'),
            'conferenceRoom': _('Conference room'),
            'extension': _('Extension'),
        },
        visualToggle: {
            '__null__': {
                show: [],
                hide: routableFields,
            },
            'user': {
                show: ['user'],
                hide: routableFields,
            },
            'ivr': {
                show: ['ivr'],
                hide: routableFields,
            },
            'huntGroup': {
                show: ['huntGroup'],
                hide: routableFields,
            },
            'voicemail': {
                show: ['voicemail'],
                hide: routableFields,
            },
            'number': {
                show: ['numberCountry', 'numberValue'],
                hide: routableFields,
            },
            'friend': {
                show: ['friendValue'],
                hide: routableFields,
            },
            'queue': {
                show: ['queue'],
                hide: routableFields,
            },
            'conferenceRoom': {
                show: ['conferenceRoom'],
                hide: routableFields,
            },
            'extension': {
                show: ['extension'],
                hide: routableFields,
            }
        }
    },
    'ivr': {
        label: _('IVR'),
        required: true,
        null: _("Unassigned"),
        default: '__null__',
    },
    'huntGroup': {
        label: _('Hunt Group'),
        required: true,
        null: _("Unassigned"),
        default: '__null__',
    },
    'voicemail': {
        label: _('Voicemail'),
        required: true,
        null: _("Unassigned"),
        default: '__null__',
    },
    'user': {
        label: _('User'),
        required: true,
        null: _("Unassigned"),
        default: '__null__',
    },
    'numberCountry': {
        label: _('Country'),
        required: true,
        null: _("Unassigned"),
        default: '__null__',
    },
    'numberValue': {
        label: _('Number'),
        required: true,
        maxLength: 25
    },
    'friendValue': {
        label: _('Friend value'),
        required: true,
        maxLength: 25
    },
    'queue': {
        label: _('Queue'),
        required: true,
        null: _("Unassigned"),
        default: '__null__',
    },
    'conferenceRoom': {
        label: _('Conference room'),
        required: true,
        null: _("Unassigned"),
        default: '__null__',
    },
    'extension': {
        label: _('Extension'),
        required: true,
        null: _("Unassigned"),
        default: '__null__',
    },
    'target': {
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
    toStr: (row: any) => row.name,
    properties,
    columns: [
        'priority',
        'ConditionMatch',
        'match',
        'locution',
        'routeType',
        'target'
    ],
    foreignKeyResolver,
    Form,
};

export default ConditionalRoutesCondition;