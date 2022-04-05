import ShortcutIcon from '@mui/icons-material/Shortcut';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import Form from './Form';
import { foreignKeyGetter } from './foreignKeyGetter';
import { ExtensionProperties } from './ExtensionProperties';
import foreignKeyResolver from './foreignKeyResolver';
import selectOptions from './SelectOptions/SelectOptions';

/** TODO */
const vpbx = true;

const allRoutableFields = [
    'numberCountry',
    'numberValue',
    vpbx && 'ivr',
    vpbx && 'user',
    vpbx && 'huntGroup',
    vpbx && 'voicemail',
    'conferenceRoom',
    'friendValue',
    'queue',
    vpbx && 'conditionalRoute',
];

const properties: ExtensionProperties = {
    'number': {
        label: _('Number'),
        helpText: _('Minimal length: 2')
    },
    'routeType': {
        label: _('Route type'),
        enum: {
            'user': _('User'),
            'ivr': _('IVR'),
            'huntGroup': _('Hunt Group'),
            'conferenceRoom': _('Conference room'),
            'number': _('Number'),
            'friend': _('Friend'),
            'queue': _('Queue'),
            'conditional': _('Conditional Route'),
            'voicemail': _('Voicemail'),
        },
        default: '__null__',
        null: _("Unassigned"),
        visualToggle: {
            '__null__': {
                show: [],
                hide: allRoutableFields,
            },
            'user': {
                show: ['user'],
                hide: allRoutableFields,
            },
            'ivr': {
                show: ['ivr'],
                hide: allRoutableFields,
            },
            'huntGroup': {
                show: ['huntGroup'],
                hide: allRoutableFields,
            },
            'conferenceRoom': {
                show: ['conferenceRoom'],
                hide: allRoutableFields,
            },
            'number': {
                show: ['numberCountry', 'numberValue'],
                hide: allRoutableFields,
            },
            'friend': {
                show: ['friendValue'],
                hide: allRoutableFields,
            },
            'queue': {
                show: ['queue'],
                hide: allRoutableFields,
            },
            'conditional': {
                show: ['conditionalRoute'],
                hide: allRoutableFields,
            },
            'voicemail': {
                show: ['voicemail'],
                hide: allRoutableFields,
            }
        }
    },
    'numberCountry': {
        label: _('Country'),
        required: true,
    },
    'numberValue': {
        label: _('Number'),
        required: true,
    },
    'ivr': {
        label: _('IVR'),
        required: true,
    },
    'huntGroup': {
        label: _('Hunt Group'),
        required: true,
    },
    'conferenceRoom': {
        label: _('Conference room'),
        required: true,
    },
    'user': {
        label: _('User'),
        required: true,
    },
    'friendValue': {
        label: _('Friend value'),
        required: true,
    },
    'queue': {
        label: _('Queue'),
        required: true,
    },
    'conditionalRoute': {
        label: _('Conditional Route'),
        required: true,
    },
    'voicemail': {
        label: _('Voicemail'),
        required: true,
    },
    'target': {
        label: _('Target'),
    },
};

const columns = [
    'number',
    'routeType',
    'target'
];

const extension: EntityInterface = {
    ...defaultEntityBehavior,
    icon: ShortcutIcon,
    iden: 'Extension',
    title: _('Extension', { count: 2 }),
    path: '/extensions',
    toStr: (row: any) => row.number,
    columns,
    properties,
    Form,
    foreignKeyGetter,
    foreignKeyResolver,
    selectOptions: (props, customProps) => { return selectOptions(props, customProps); },
};

export default extension;