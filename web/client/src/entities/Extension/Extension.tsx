import SettingsApplications from '@mui/icons-material/SettingsApplications';
import EntityInterface, { foreignKeyResolverType } from 'lib/entities/EntityInterface';
import genericForeignKeyResolver, { remapFk } from 'lib/services/api/genericForeigKeyResolver';
import _ from 'lib/services/translations/translate';
import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import Form from './Form';
import { foreignKeyGetter } from './useFkChoices';
import entities from '../index';
import { ExtensionProperties, ExtensionPropertiesList } from './ExtensionProperties';

const allRoutableFields = [
    'numberCountry',
    'numberValue',
    'ivr',
    'user',
    'huntGroup',
    'conferenceRoom',
    'friendValue',
    'queue',
    'conditionalRoute',
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
                show: ['conditional'],
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
    'target': {
        label: _('Target'),
    },
};

const columns = [
    'number',
    'routeType',
    'target'
];


const foreignKeyResolver: foreignKeyResolverType = async function(
    { data, cancelToken }
): Promise<ExtensionPropertiesList> {

    const promises = [];
    const { User, Country, Ivr, HuntGroup, ConferenceRoom, Queue, ConditionalRoute } = entities;

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
            fkFld: 'numberCountry',
            entity: {
                ...Country,
                toStr: (row: any) => `${row.countryCode}`
            },
            cancelToken,
        })
    );

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
            fkFld: 'conferenceRoom',
            entity: ConferenceRoom,
            cancelToken,
        })
    );

    promises.push(
        genericForeignKeyResolver({
            data,
            fkFld: 'huntGroup',
            entity: HuntGroup,
            cancelToken,
        })
    );

    promises.push(
        genericForeignKeyResolver({
            data,
            fkFld: 'queue',
            entity: Queue,
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

    if (!Array.isArray(data)) {
        return data;
    }

    for (const idx in data) {

        switch (data[idx].routeType) {

            case 'user':
                remapFk(data[idx], 'user', 'target');
                break;
            case 'ivr':
                remapFk(data[idx], 'ivr', 'target');
                break;
            case 'huntGroup':
                remapFk(data[idx], 'huntGroup', 'target');
                break;
            case 'conferenceRoom':
                remapFk(data[idx], 'conferenceRoom', 'target');
                break;
            case 'number':
                data[idx].target =
                    data[idx].numberCountry
                    + ' '
                    + data[idx].numberValue;
                break;
            case 'friend':
                data[idx].target = data[idx].friendValue;
                break;
            case 'queue':
                remapFk(data[idx], 'queue', 'target');
                break;
            case 'conditional':
                remapFk(data[idx], 'conditionalRoute', 'target');
                break;
            default:
                console.error('Unkown route type ' + data[idx].routeType);
                data[idx].target = '';
                break;
        }

        delete data[idx].user;
        delete data[idx].ivr;
        delete data[idx].huntGroup;
        delete data[idx].conferenceRoom;
        delete data[idx].numberCountry;
        delete data[idx].numberValue;
        delete data[idx].friendValue;
        delete data[idx].queue;
        delete data[idx].conditionalRoute;
    }

    return data;
}

const extension: EntityInterface = {
    ...defaultEntityBehavior,
    icon: <SettingsApplications />,
    iden: 'Extension',
    title: _('Extension', { count: 2 }),
    path: '/extensions',
    toStr: (row: any) => row.number,
    columns,
    properties,
    Form,
    foreignKeyGetter,
    foreignKeyResolver
};

export default extension;