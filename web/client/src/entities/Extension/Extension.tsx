import SettingsApplications from '@material-ui/icons/SettingsApplications';
import EntityInterface, { PropertiesList } from 'entities/EntityInterface';
import EntityService from 'services/Entity/EntityService';
import genericForeignKeyResolver, { remapFk } from 'services/genericForeigKeyResolver';
import _ from 'services/Translations/translate';
import defaultEntityBehavior from 'entities/DefaultEntityBehavior';
import Form from './Form';
import entities from '../index';

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

const properties:PropertiesList = {
    'number': {
        label: _('Number'),
        helpText: _('Minimal length: 2')
    },
    'routeType': {
        label:_('Route type'),
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
    },
    'numberValue': {
        label: _('Number'),
    },
    'ivr': {
        label: _('IVR'),
    },
    'huntGroup': {
        label: _('Hunt Group'),
    },
    'conferenceRoom': {
        label: _('Conference room'),
    },
    'user': {
        label: _('User'),
    },
    'friendValue': {
        label: _('Friend value'),
    },
    'queue': {
        label: _('Queue'),
    },
    'conditionalRoute': {
        label: _('Conditional Route'),
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

async function foreignKeyResolver(data: any, entityService: EntityService) {

    const promises= [];
    const { User, Country, Ivr, HuntGroup, ConferenceRoom, Queue, ConditionalRoute } = entities;

    promises.push(
        genericForeignKeyResolver(
            data,
            'user',
            User.path,
            User.toStr
        )
    );

    promises.push(
        genericForeignKeyResolver(
            data,
            'numberCountry',
            Country.path,
            (row:any) => `${row.countryCode}`,
        )
    );

    promises.push(
        genericForeignKeyResolver(
            data,
            'ivr',
            Ivr.path,
            Ivr.toStr,
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
            'huntGroup',
            HuntGroup.path,
            HuntGroup.toStr,
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
            'conditionalRoute',
            ConditionalRoute.path,
            ConditionalRoute.toStr,
        )
    );

    await Promise.all(promises);

    for (const idx in data) {

        switch(data[idx].routeType) {

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

const extension:EntityInterface = {
    ...defaultEntityBehavior,
    icon: <SettingsApplications />,
    iden: 'Extension',
    title: _('Extension', {count: 2}),
    path: '/extensions',
    toStr: (row:any) => row.number,
    columns,
    properties,
    Form,
    foreignKeyResolver
};

export default extension;