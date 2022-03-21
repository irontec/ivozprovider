import FormatListNumberedIcon from '@mui/icons-material/FormatListNumbered';
import EntityInterface from 'lib/entities/EntityInterface';
import _ from 'lib/services/translations/translate';
import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import Form from './Form';
import { foreignKeyGetter } from './foreignKeyGetter';
import { IvrEntryProperties } from './IvrEntryProperties';
import Target from './Field/Target';
import foreignKeyResolver from './foreignKeyResolver';

const toggleFlds = [
  'numberCountry',
  'numberValue',
  'extension',
  'voicemail',
  'conditionalRoute',
];

const properties: IvrEntryProperties = {
    'ivr': {
        label: _('IVR'),
    },
    'entry': {
        label: _('Entry'),
        required: true,
        helpText: _("You can use regular expressions to define values this entry will match."),
    },
    'welcomeLocution': {
        label: _('Success locution'),
        null: _("Unassigned"),
        default: '__null__',
    },
    'routeType': {
        label: _('Target type'),
        required: true,
        enum: {
            'number': _('Number'),
            'extension': _('Extension'),
            'voicemail': _('Voicemail'),
            'conditional': _('Conditional Route'),
        },
        visualToggle: {
            '__null__': {
                show: [],
                hide: toggleFlds,
            },
            'number': {
                show: ['numberCountry', 'numberValue'],
                hide: toggleFlds,
            },
            'extension': {
                show: ['extension'],
                hide: toggleFlds,
            },
            'voicemail': {
                show: ['voicemail'],
                hide: toggleFlds,
            },
            'conditional': {
                show: ['conditionalRoute'],
                hide: toggleFlds,
            },
        },
        null: _("Unassigned"),
        default: '__null__',
    },
    'numberCountry': {
        label: _('Country'),
        required: true,
    },
    'numberValue': {
        label: _('Number'),
        required: true,
    },
    'extension': {
        label: _('Extension'),
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
    'conditionalRoute': {
        label: _('Conditional Route'),
        required: true,
        null: _("Unassigned"),
        default: '__null__',
    },
    'target': {
        label: _('Target'),
        component: Target,
    },
};

const IvrEntry: EntityInterface = {
    ...defaultEntityBehavior,
    icon: FormatListNumberedIcon,
    iden: 'IvrEntry',
    title: _('IVR entry', { count: 2 }),
    path: '/ivr_entries',
    toStr: (row: any) => row.name,
    properties,
    columns: [
        'entry',
        'welcomeLocution',
        'routeType',
        'target',
    ],
    Form,
    foreignKeyGetter,
    foreignKeyResolver,
};

export default IvrEntry;