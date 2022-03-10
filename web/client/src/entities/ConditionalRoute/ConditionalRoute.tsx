import SwitchCameraIcon from '@mui/icons-material/SwitchCamera';
import EntityInterface from 'lib/entities/EntityInterface';
import _ from 'lib/services/translations/translate';
import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import Form from './Form';
import { foreignKeyGetter } from './foreignKeyGetter';
import { ConditionalRouteProperties } from './ConditionalRouteProperties';
import foreignKeyResolver from './foreignKeyResolver';
import selectOptions from './SelectOptions';

const routableFields = [
    'numberCountry',
    'numbervalue',
    'ivr',
    'user',
    'huntGroup',
    'voicemail',
    'friendvalue',
    'queue',
    'conferenceRoom',
    'extension',
];

const properties: ConditionalRouteProperties = {
    'name': {
        label: _('Name'),
    },
    'locution': {
        label: _('Locution'),
        null: _('Unassgined'),
        default: '__null__',
    },
    'routetype': {
        label: _('Route type'),
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
        null: _('Unassigned'),
        default: '__null__',
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
                show: ['numberCountry', 'numbervalue'],
                hide: routableFields,
            },
            'friend': {
                show: ['friendvalue'],
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
            },
        }
    },
    'ivr': {
        label: _('IVR'),
        required: true,
    },
    'huntGroup': {
        label: _('Hunt Group'),
        required: true,
    },
    'voicemail': {
        label: _('Voicemail'),
        required: true,
    },
    'user': {
        label: _('User'),
        required: true,
    },
    'numberCountry': {
        label: _('Country'),
        required: true,
    },
    'numbervalue': {
        label: _('Number'),
        required: true,
    },
    'friendvalue': {
        label: _('Friend value'),
        required: true,
    },
    'queue': {
        label: _('Queue'),
        required: true,
    },
    'conferenceRoom': {
        label: _('Conference room'),
        required: true,
    },
    'extension': {
        label: _('Extension'),
        required: true,
    },
    'target': {
        label: _('Target'),
    },
};

const columns = [
    'name',
    'locution',
    'routetype',
    'target',
];

const ConditionalRoute: EntityInterface = {
    ...defaultEntityBehavior,
    icon: SwitchCameraIcon,
    iden: 'ConditionalRoute',
    title: _('Conditional Route', { count: 2 }),
    path: '/conditional_routes',
    toStr: (row: any) => row.name,
    properties,
    columns,
    Form,
    foreignKeyGetter,
    foreignKeyResolver,
    selectOptions: (props, customProps) => { return selectOptions(props, customProps); },
};

export default ConditionalRoute;