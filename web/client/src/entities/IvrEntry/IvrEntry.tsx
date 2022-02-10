import FormatListNumberedIcon from '@mui/icons-material/FormatListNumbered';
import EntityInterface, { foreignKeyResolverType } from 'lib/entities/EntityInterface';
import _ from 'lib/services/translations/translate';
import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import genericForeignKeyResolver, { remapFk } from 'lib/services/api/genericForeigKeyResolver';
import entities from '../index';
import Form from './Form';
import { foreignKeyGetter } from './useFkChoices';
import { IvrEntryProperties, IvrEntryPropertiesList } from './IvrEntryProperties';
import Target from './Field/Target';
import { CountryPropertyList } from 'entities/Country/CountryProperties';

const toggleFlds = [
  'numberCountry',
  'numberValue',
  'extension',
  'voiceMailUser',
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
                show: ['voiceMailUser'],
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
    'voiceMailUser': {
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

const foreignKeyResolver: foreignKeyResolverType = async function(
    { data, cancelToken }
): Promise<IvrEntryPropertiesList> {
    const promises = [];
    const {
        Ivr, Locution, Country, Ddi, Extension, User, ConditionalRoute,
    } = entities;

    promises.push(
        genericForeignKeyResolver({
            data,
            fkFld: 'ivr',
            entity: Ivr,
            cancelToken,
        })
    );

    promises.push(
        genericForeignKeyResolver({
            data,
            fkFld: 'welcomeLocution',
            entity: Locution,
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
            fkFld: 'ddi',
            entity: Ddi,
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
            fkFld: 'voiceMailUser',
            entity: User,
            cancelToken,
        })
    );

    promises.push(
        genericForeignKeyResolver({
            data,
            fkFld: 'conditionalRoute',
            entity: ConditionalRoute,
            cancelToken,
        })
    );

    await Promise.all(promises);

    for (const values of data) {
        switch(values.routeType) {
            case 'extension':
                remapFk(values, 'extension', 'target');
                break;
            case 'voicemail':
                remapFk(values, 'voiceMailUser', 'target');
                break;
            case 'conditional':
                remapFk(values, 'conditionalRoute', 'target');
                break;
            case 'number':
                values.target = `${values.numberCountry} ${values.numberValue}`;
                break;
        }
    }

    return data;
}

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