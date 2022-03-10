import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from 'lib/entities/EntityInterface';
import _ from 'lib/services/translations/translate';
import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import Form from './Form';
import { foreignKeyGetter } from './foreignKeyGetter';
import { IvrProperties } from './IvrProperties';
import foreignKeyResolver from './foreignKeyResolver';
import selectOptions from './SelectOptions';

const noInputFields = [
    'noInputNumberCountry',
    'noInputNumberValue',
    'noInputExtension',
    'noInputVoicemail',
];

const errorFields = [
    'errorNumberCountry',
    'errorNumberValue',
    'errorExtension',
    'errorVoicemail',
];

const properties: IvrProperties = {
    'name': {
        label: _('Name'),
        required: true,
    },
    'welcomeLocution': {
        label: _('Welcome locution'),
    },
    'noInputLocution': {
        label: _('No input locution'),
    },
    'errorLocution': {
        label: _('Locution'),
    },
    'successLocution': {
        label: _('Success locution'),
    },
    'timeout': {
        label: _('Timeout'),
        default: 6,
        helpText: _('Time in seconds the IVR will wait after playing the welcome locution or dialing a digit'),
        required: true,
    },
    'maxDigits': {
        label: _('Max digits'),
        default: 0,
        helpText: _('Max number of digits the caller can enter. Set to 0 to disable.'),
        required: true,
    },
    'allowExtensions': {
        label: _('Allow dialing extensions'),
        enum: {
            '0': _('No'),
            '1': _('Yes'),
        },
        default: 0,
        visualToggle: {
            '0': {
                show: [],
                hide: ['excludedExtensionIds'],
            },
            '1': {
                show: ['excludedExtensionIds'],
                hide: [],
            },
        }
    },
    'excludedExtensionIds': {
        label: _('Excluded Extension'),
    },
    'noInputRouteType': {
        label: _('No input target type'),
        default: '__null__',
        null: _("Unassigned"),
        enum: {
            'number': _('Number'),
            'extension': _('Extension'),
            'voicemail': _('Voicemail'),
        },
        visualToggle: {
            '__null__': {
                show: [],
                hide: noInputFields,
            },
            'number': {
                show: ['noInputNumberValue', 'noInputNumberCountry'],
                hide: noInputFields,
            },
            'extension': {
                show: ['noInputExtension'],
                hide: noInputFields,
            },
            'voicemail': {
                show: ['noInputVoicemail'],
                hide: noInputFields,
            },
        }
    },
    'noInputNumberCountry': {
        label: _('Country'),
        required: true,
    },
    'noInputNumberValue': {
        label: _('Number'),
        required: true,
    },
    'noInputExtension': {
        label: _('Extension'),
        required: true,
    },
    'noInputVoicemail': {
        label: _('Voicemail'),
        required: true,
    },
    'errorRouteType': {
        label: _('Error target type'),
        default: '__null__',
        null: _("Unassigned"),
        enum: {
            'number': _('Number'),
            'extension': _('Extension'),
            'voicemail': _('Voicemail'),
        },
        visualToggle: {
            '__null__': {
                show: [],
                hide: errorFields,
            },
            'number': {
                show: ['errorNumberValue', 'errorNumberCountry'],
                hide: errorFields,
            },
            'extension': {
                show: ['errorExtension'],
                hide: errorFields,
            },
            'voicemail': {
                show: ['errorVoicemail'],
                hide: errorFields,
            },
        }
    },
    'errorNumberCountry': {
        label: _('Country'),
        required: true,
    },
    'errorNumberValue': {
        label: _('Number'),
        required: true,
    },
    'errorExtension': {
        label: _('Extension'),
        required: true,
    },
    'errorVoicemail': {
        label: _('Voicemail'),
        required: true,
    },
    'noInputTarget': {
        label: _('No input target'),
    },
    'errorTarget': {
        label: _('Error target'),
    }
};

const columns = [
    'name',
    'timeout',
    'allowExtensions',
    'noInputRouteType',
    'noInputTarget',
    'errorRouteType',
    'errorTarget',
];

const ivr: EntityInterface = {
    ...defaultEntityBehavior,
    icon: AccountTreeIcon,
    iden: 'Ivr',
    title: _('IVR', { count: 2 }),
    path: '/ivrs',
    toStr: (row: any) => row.name,
    properties,
    columns,
    Form,
    foreignKeyGetter,
    foreignKeyResolver,
    selectOptions: (props, customProps) => { return selectOptions(props, customProps); },
};

export default ivr;