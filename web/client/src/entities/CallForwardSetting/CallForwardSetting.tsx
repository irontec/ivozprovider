import PhoneForwardedIcon from '@mui/icons-material/PhoneForwarded';
import EntityInterface, { foreignKeyResolverType } from 'lib/entities/EntityInterface';
import _ from 'lib/services/translations/translate';
import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import { CallForwardSettingProperties, CallForwardSettingPropertiesList } from './CallForwardSettingProperties';
import Form from './Form';
import entities from '../index';
import genericForeignKeyResolver, { remapFk } from 'lib/services/api/genericForeigKeyResolver';
import Target from './Field/Target';
import { CountryPropertyList } from 'entities/Country/CountryProperties';
import { foreignKeyGetter } from './useFkChoices';

const properties: CallForwardSettingProperties = {
    user: {
        label: _('User'),
        required: true,
    },
    residentialDevice: {
        label: _('Residential Device'),
        //@TODO required: true,
    },
    ddi: {
        label: _('Called DDI'),
        null: _('Any'),
        default: '__null__',
        //@TODO required: true,
    },
    cfwToretailAccount: {
        label: _('Retail Account'),
        null: _("Unassigned"),
        default: '__null__',
        //@TODO required: true,
    },
    callTypeFilter: {
        label: _('Call type'),
        enum: {
          'internal': _('Internal'),
          'external': _('External'),
          'both': _('Both'),
        },
    },
    callForwardType: {
        label: _('Call forward type'),
        enum: {
            'inconditional': _('Inconditional'),
            'noAnswer': _('No Answer'),
            'busy': _('Busy'),
            'userNotRegistered': _('Unreachable'),
        },
        visualToggle: {
            'inconditional': {
                show: [],
                hide: ['noAnswerTimeout'],
            },
            'noAnswer': {
                show: ['noAnswerTimeout'],
                hide: [],
            },
            'busy': {
                show: [],
                hide: ['noAnswerTimeout'],
            },
            'userNotRegistered': {
                show: [],
                hide: ['noAnswerTimeout'],
            }
        },

    },
    targetType: {
        label: _('Target type'),
        enum: {
            'number': _('Number'),
            'extension': _('Extension'),
            'voicemail': _('Voicemail'),
            'retail': _('Retail Account'),
        },
        null: _('Unassigned'),
        default: '__null__',
        visualToggle: {
            '__null__': {
                show: [],
                hide: ['extension', 'voiceMailUser', 'numberCountry', 'numberValue', 'cfwToretailAccount'],
            },
            'number': {
                show: ['numberCountry', 'numberValue'],
                hide: ['extension', 'voiceMailUser', 'cfwToretailAccount'],
            },
            'extension': {
                show: ['extension'],
                hide: ['numberCountry', 'numberValue', 'voiceMailUser', 'cfwToretailAccount'],
            },
            'voicemail': {
                show: ['voiceMailUser'],
                hide: ['extension', 'numberCountry', 'numberValue', 'cfwToretailAccount'],
            },
            //@TODO
            'retail': {
                show: ['cfwToretailAccount'],
                hide: ['extension', 'numberCountry', 'numberValue', 'voiceMailUser'],
            },
        },
    },
    numberCountry: {
        label: _('Country'),
        required: true,
    },
    numberValue: {
        label: _('Number'),
        pattern: RegExp('^[0-9]+$'),
        required: true,
    },
    extension: {
        label: _('Extension'),
        null: _("Unassigned"),
        default: '__null__',
        required: true,
    },
    voiceMailUser: {
        label: _('Voicemail'),
        null: _("Unassigned"),
        default: '__null__',
        required: true,
    },
    noAnswerTimeout: {
        label: _('No answer timeout'),
        default: 10,
        required: true,
    },
    targetTypeValue: {
        label: _('Target type value'),
        component: Target,
    },
    enabled: {
        label: _('Enabled'),
        enum: {
            '0':  _("No"),
            '1': _("Yes"),
        },
        default: '1',
    },
};

const foreignKeyResolver: foreignKeyResolverType = async function(
    { data, cancelToken }
): Promise<CallForwardSettingPropertiesList> {
    const promises = [];
    const { User, Extension, Ddi, RetailAccount, ResidentialDevice, Country } = entities;

    promises.push(
        genericForeignKeyResolver({
            data,
            fkFld: 'user',
            entity: User,
            cancelToken,
        })
    );

    promises.push(
        genericForeignKeyResolver({
            data,
            fkFld: 'voiceMailUser',
            entity: User,
            cancelToken,
        })
    );

    promises.push(
        genericForeignKeyResolver({
            data,
            fkFld: 'extension',
            entity: Extension,
            cancelToken,
        })
    );

    promises.push(
        genericForeignKeyResolver({
            data,
            fkFld: 'ddi',
            entity: Ddi,
            cancelToken,
        })
    );

    promises.push(
        genericForeignKeyResolver({
            data,
            fkFld: 'retailAccount',
            entity: RetailAccount,
            cancelToken,
        })
    );

    promises.push(
        genericForeignKeyResolver({
            data,
            fkFld: 'residentialDevice',
            entity: ResidentialDevice,
            cancelToken,
        })
    );

    promises.push(
        genericForeignKeyResolver({
            data,
            fkFld: 'numberCountry',
            entity: {
                ...Country,
                toStr: (row: CountryPropertyList<string>) => row.countryCode as string,
            },
            cancelToken,
        })
    );

    promises.push(
        genericForeignKeyResolver({
            data,
            fkFld: 'cfwToRetailAccount',
            entity: RetailAccount,
            cancelToken,
        })
    );

    await Promise.all(promises);

    for (const values of data) {
        switch(values.targetType) {
            case 'extension':
                remapFk(values, 'extension', 'targetTypeValue');
                break;
            case 'voicemail':
                remapFk(values, 'voiceMailUser', 'targetTypeValue');
                break;
            case 'retail':
                remapFk(values, 'cfwToretailAccount', 'targetTypeValue');
                break;
            case 'number':
                values.targetTypeValue = `${values.numberCountry} ${values.numberValue}`;
                break;
        }
    }

    return data;
}

const CallForwardSetting: EntityInterface = {
    ...defaultEntityBehavior,
    icon: PhoneForwardedIcon,
    iden: 'CallForwardSetting',
    title: _('Call forward setting', { count: 2 }),
    path: '/call_forward_settings',
    properties,
    columns: [
        'enabled',
        'callTypeFilter',
        'callForwardType',
        'targetType',
        'targetTypeValue',
    ],
    Form,
    foreignKeyResolver,
    foreignKeyGetter,
};

export default CallForwardSetting;