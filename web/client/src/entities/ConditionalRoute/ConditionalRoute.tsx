import SettingsApplications from '@mui/icons-material/SettingsApplications';
import EntityInterface, { PropertiesList } from 'entities/EntityInterface';
import _ from 'services/Translations/translate';
import defaultEntityBehavior from 'entities/DefaultEntityBehavior';
import genericForeignKeyResolver, { remapFk } from 'services/genericForeigKeyResolver';
import entities from '../index';
import Form from './Form';
import EntityService from 'services/Entity/EntityService';

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

const properties: PropertiesList = {
    'name': {
        label: _('Name'),
    },
    'locution': {
        label: _('Locution'),
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
    },
    'huntGroup': {
        label: _('Hunt Group'),
    },
    'voicemailUser': {
        label: _('Voicemail'),
    },
    'user': {
        label: _('User'),
    },
    'numberCountry': {
        label: _('Country'),
    },
    'numbervalue': {
        label: _('Number'),
    },
    'friendvalue': {
        label: _('Friend value'),
    },
    'queue': {
        label: _('Queue'),
    },
    'conferenceRoom': {
        label: _('Conference room'),
    },
    'extension': {
        label: _('Extension'),
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

async function foreignKeyResolver(data: any, entityService: EntityService) {

    const promises = [];
    const {
        User, HuntGroup, ConferenceRoom, Queue, Ivr, Extension, Country, Friend
    } = entities;

    promises.push(
        genericForeignKeyResolver(
            data,
            'user',
            User.path,
            User.toStr,
        )
    );

    promises.push(
        genericForeignKeyResolver(
            data,
            'ivr',
            Ivr.path,
            Ivr.toStr
        )
    );

    promises.push(
        genericForeignKeyResolver(
            data,
            'huntGroup',
            HuntGroup.path,
            HuntGroup.toStr
        )
    );

    promises.push(
        genericForeignKeyResolver(
            data,
            'voicemailUser',
            User.path,
            User.toStr,
        )
    );

    promises.push(
        genericForeignKeyResolver(
            data,
            'numberCountry',
            Country.path,
            Country.toStr,
        )
    );

    promises.push(
        genericForeignKeyResolver(
            data,
            'friend',
            Friend.path,
            Friend.toStr,
        )
    );

    promises.push(
        genericForeignKeyResolver(
            data,
            'queue',
            Queue.path,
            Queue.toStr,
        )
    );

    promises.push(
        genericForeignKeyResolver(
            data,
            'conferenceRoom',
            ConferenceRoom.path,
            ConferenceRoom.toStr,
        )
    );

    promises.push(
        genericForeignKeyResolver(
            data,
            'extension',
            Extension.path,
            Extension.toStr,
        )
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
        delete data[idx].voicemail;
        delete data[idx].number;
        delete data[idx].friend;
        delete data[idx].queue;
        delete data[idx].conferenceRoom;
        delete data[idx].extension;
    }

    return data;
}

const conditionalRoute: EntityInterface = {
    ...defaultEntityBehavior,
    icon: <SettingsApplications />,
    iden: 'ConditionalRoute',
    title: _('Conditional Route', { count: 2 }),
    path: '/conditional_routes',
    toStr: (row: any) => row.name,
    properties,
    columns,
    Form,
    foreignKeyResolver
};

export default conditionalRoute;