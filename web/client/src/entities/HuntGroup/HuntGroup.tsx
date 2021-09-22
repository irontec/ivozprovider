import SettingsApplications from '@mui/icons-material/SettingsApplications';
import EntityInterface, { PropertiesList } from 'entities/EntityInterface';
import _ from 'services/Translations/translate';
import defaultEntityBehavior from 'entities/DefaultEntityBehavior';
import Form from './Form';

const routableFields = [
    'noAnswerNumberCountry',
    'noAnswerNumberValue',
    'noAnswerExtension',
    'noAnswerVoiceMailUser',
];

const properties: PropertiesList = {
    'name': {
        label: _('Name'),
    },
    'description': {
        label: _('Description'),
    },
    'strategy': {
        label: _('Strategy'),
        enum: {
            'ringAll': _('Ring all'),
            'linear': _('Linear'),
            'roundRobin': _('Round Robin'),
            'random': _('Random')
        },
        visualToggle: {
            'ringAll': {
                show: ['ringAllTimeout'],
                hide: [],
            },
            'linear': {
                show: [],
                hide: ['ringAllTimeout'],
            },
            'roundRobin': {
                show: [],
                hide: ['ringAllTimeout'],
            },
            'random': {
                show: [],
                hide: ['ringAllTimeout'],
            },
        },
        helpText: _('Determines the order users will be called')
    },
    'preventMissedCalls': {
        label: _('Prevent missed calls'),
        enum: {
            '0': _('No'),
            '1': _('Yes'),
        },
        helpText: _("When 'Yes', calls will never generate a missed call. When 'No', missed calls will be prevented only for RingAll huntgroups if someone answers."),
    },
    'allowCallForwards': {
        label: _('Allow Call Forwards'),
        enum: {
            '0': _('No'),
            '1': _('Yes'),
        },
        helpText: _("When 'Yes', Users call forward settings will be followed."),
    },
    'ringAllTimeout': {
        label: _('Ring all timeout'),
    },
    'noAnswerTargetType': {
        label: _('Timeout target type'),
        enum: {
            'number': _('Number'),
            'extension': _('Extension'),
            'voicemail': _('Voicemail'),
        },
        visualToggle: {
            '__null__': {
                show: [],
                hide: routableFields,
            },
            'number': {
                show: ['noAnswerNumberCountry', 'noAnswerNumberValue'],
                hide: routableFields,
            },
            'extension': {
                show: ['noAnswerExtension'],
                hide: routableFields,
            },
            'voicemail': {
                show: ['noAnswerVoiceMailUser'],
                hide: routableFields,
            },
        },
        null: _('Unassigned'),
    },
    'noAnswerLocution': {
        label: _('No answer locution'),
    },
    'noAnswerNumberCountry': {
        label: _('Country'),
    },
    'noAnswerNumberValue': {
        label: _('Number'),
    },
    'noAnswerExtension': {
        label: _('Extension'),
    },
    'noAnswerVoiceMailUser': {
        label: _('Voicemail'),
    },
};

const huntGroup: EntityInterface = {
    ...defaultEntityBehavior,
    icon: <SettingsApplications />,
    iden: 'HuntGroup',
    title: _('Hunt Group', { count: 2 }),
    path: '/hunt_groups',
    toStr: (row: any) => row.name,
    properties,
    Form
};

export default huntGroup;