import SettingsApplications from '@mui/icons-material/SettingsApplications';
import EntityInterface from 'lib/entities/EntityInterface';
import _ from 'lib/services/translations/translate';
import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import genericForeignKeyResolver, { remapFk } from 'lib/services/api/genericForeigKeyResolver';
import entities from '../index';
import Form from './Form';
import { foreignKeyGetter } from './useFkChoices';
import { IvrProperties, IvrPropertiesList } from './IvrProperties';

const noInputFields = [
    'noInputNumberCountry',
    'noInputNumberValue',
    'noInputExtension',
    'noInputVoiceMailUser',
];

const errorFields = [
    'errorNumberCountry',
    'errorNumberValue',
    'errorExtension',
    'errorVoiceMailUser',
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
                show: ['noInputVoiceMailUser'],
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
    'noInputVoiceMailUser': {
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
                show: ['errorVoiceMailUser'],
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
    'errorVoiceMailUser': {
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

async function foreignKeyResolver(data: IvrPropertiesList): Promise<IvrPropertiesList> {

    const promises = [];
    const {
        Extension, User, Country,
    } = entities;

    promises.push(
        genericForeignKeyResolver(
            data,
            'noInputExtension',
            Extension.path,
            Extension.toStr
        )
    );

    promises.push(
        genericForeignKeyResolver(
            data,
            'noInputVoiceMailUser',
            User.path,
            User.toStr,
        )
    );

    promises.push(
        genericForeignKeyResolver(
            data,
            'noInputNumberCountry',
            Country.path,
            (row: any) => `${row.countryCode}`,
        )
    );

    promises.push(
        genericForeignKeyResolver(
            data,
            'errorExtension',
            Extension.path,
            Extension.toStr,
        )
    );

    promises.push(
        genericForeignKeyResolver(
            data,
            'errorVoiceMailUser',
            User.path,
            User.toStr,
        )
    );

    promises.push(
        genericForeignKeyResolver(
            data,
            'errorNumberCountry',
            Country.path,
            (row: any) => `${row.countryCode}`,
        )
    );

    await Promise.all(promises);

    if (!Array.isArray(data)) {
        return data;
    }

    for (const idx in data) {

        switch (data[idx].noInputRouteType) {
            case 'number':
                data[idx].errorTarget =
                    data[idx].noInputNumberCountry
                    + ' '
                    + data[idx].noInputNumberValue;
                break;
            case 'extension':
                remapFk(data[idx], 'noInputExtension', 'noInputTarget');
                break;
            case 'voicemail':
                remapFk(data[idx], 'noInputVoiceMailUser', 'noInputTarget');
                break;
            default:
                console.error('Unkown route type ' + data[idx].noInputRouteType);
                data[idx].noInputTarget = '';
                break;
        }

        switch (data[idx].errorRouteType) {
            case 'number':
                data[idx].errorTarget =
                    data[idx].errorNumberCountry
                    + ' '
                    + data[idx].errorNumberValue;
                break;
            case 'extension':
                remapFk(data[idx], 'errorExtension', 'errorTarget');
                break;
            case 'voicemail':
                remapFk(data[idx], 'errorVoiceMailUser', 'errorTarget');
                break;
            default:
                console.error('Unkown route type ' + data[idx].errorRouteType);
                data[idx].errorTarget = '';
                break;
        }

        delete (data[idx] as any).noInputNumberCountryId;
        delete (data[idx] as any).noInputNumberValue;
        delete (data[idx] as any).noInputExtensionId;
        delete (data[idx] as any).noInputVoiceMailUserId;

        delete (data[idx] as any).errorNumberCountryId;
        delete (data[idx] as any).errorNumberValue;
        delete (data[idx] as any).errorExtensionId;
        delete (data[idx] as any).errorVoiceMailUserId;
    }

    return data;
}

const ivr: EntityInterface = {
    ...defaultEntityBehavior,
    icon: <SettingsApplications />,
    iden: 'Ivr',
    title: _('IVR', { count: 2 }),
    path: '/ivrs',
    toStr: (row: any) => row.name,
    properties,
    columns,
    Form,
    foreignKeyGetter,
    foreignKeyResolver
};

export default ivr;