import SwitchCameraIcon from '@mui/icons-material/SwitchCamera';
import EntityInterface, { foreignKeyResolverType } from 'lib/entities/EntityInterface';
import _ from 'lib/services/translations/translate';
import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import genericForeignKeyResolver, { remapFk } from 'lib/services/api/genericForeigKeyResolver';
import entities from '../index';
import Form from './Form';
import { foreignKeyGetter } from './useFkChoices';
import {
    ConditionalRouteProperties, ConditionalRoutePropertiesList
} from './ConditionalRouteProperties';

const routableFields = [
    'numberCountry',
    'numbervalue',
    'ivr',
    'user',
    'huntGroup',
    'voicemailUser',
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
                show: ['voicemailUser'],
                hide: routableFields,
            },
            'number': {
                show: ['numbervalue'],
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
    'voicemailUser': {
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

const foreignKeyResolver: foreignKeyResolverType = async function(
    { data, cancelToken }
): Promise<ConditionalRoutePropertiesList> {

    const promises = [];
    const {
        User, HuntGroup, ConferenceRoom, Queue, Ivr, Extension, Country, Friend, Locution
    } = entities;

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
            fkFld: 'ivr',
            entity: Ivr,
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
            fkFld: 'voicemailUser',
            entity: User,
            cancelToken,
        })
    );

    promises.push(
        genericForeignKeyResolver({
            data,
            fkFld: 'numberCountry',
            entity: Country,
            cancelToken,
        })
    );

    promises.push(
        genericForeignKeyResolver({
            data,
            fkFld: 'friend',
            entity: Friend,
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
            fkFld: 'conferenceRoom',
            entity: ConferenceRoom,
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
            fkFld: 'locution',
            entity: Locution,
            cancelToken,
        })
    );

    await Promise.all(promises);

    if (!Array.isArray(data)) {
        return data;
    }

    for (const idx in data) {

        switch (data[idx].routetype) {
            case 'user':
                remapFk(data[idx], 'user', 'target');
                break;
            case 'ivr':
                remapFk(data[idx], 'ivr', 'target');
                break;
            case 'huntGroup':
                remapFk(data[idx], 'huntGroup', 'target');
                break;
            case 'voicemail':
                remapFk(data[idx], 'voicemailUser', 'target');
                break;
            case 'number':
                data[idx].target =
                    data[idx].numberCountry
                    + ' '
                    + data[idx].numbervalue;
                break;
            case 'friend':
                data[idx].target = data[idx].friendvalue;
                break;
            case 'queue':
                remapFk(data[idx], 'queue', 'target');
                break;
            case 'conferenceRoom':
                remapFk(data[idx], 'conferenceRoom', 'target');
                break;
            case 'extension':
                remapFk(data[idx], 'extension', 'target');
                break;
            default:
                console.error('Unkown route type:', data[idx].routetype);
                data[idx].target = '';
                break;
        }

        delete data[idx].user;
        delete data[idx].ivr;
        delete data[idx].huntGroup;
        delete data[idx].voicemailUser;
        delete data[idx].numbervalue;
        delete data[idx].friendvalue;
        delete data[idx].queue;
        delete data[idx].conferenceRoom;
        delete data[idx].extension;
    }

    return data;
}

const ConditionalRoute: EntityInterface = {
    ...defaultEntityBehavior,
    icon: <SwitchCameraIcon />,
    iden: 'ConditionalRoute',
    title: _('Conditional Route', { count: 2 }),
    path: '/conditional_routes',
    toStr: (row: any) => row.name,
    properties,
    columns,
    Form,
    foreignKeyGetter,
    foreignKeyResolver
};

export default ConditionalRoute;