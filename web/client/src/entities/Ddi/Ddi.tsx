import SettingsApplications from '@mui/icons-material/SettingsApplications';
import EntityInterface from 'lib/entities/EntityInterface';
import _ from 'lib/services/translations/translate';
import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import Form from './Form';
import genericForeignKeyResolver, { remapFk } from 'lib/services/api/genericForeigKeyResolver';
import entities from '../index';
import EntityService from 'lib/services/entity/EntityService';
import { DdiProperties, DdiPropertiesList } from './DdiProperties';
import { PropertySpec } from 'lib/services/api/ParsedApiSpecInterface';

const allRoutableFields = [
    'ivr',
    'huntGroup',
    'user',
    'fax',
    'conferenceRoom',
    'friendValue',
    'queue',
    'residentialDevice',
    'conditionalRoute',
    'retailAccount',
];

const properties: DdiProperties = {
    'ddi': {
        label: _('DDI'),
    },
    'externalCallFilter': {
        label: _('External call filter'),
    },
    'routeType': {
        label: _('Route type'),
        enum: {
            'user': _('User'),
            'ivr': _('IVR'),
            'huntGroup': _('Hunt Group'),
            'fax': _('Fax'),
            'conferenceRoom': _('Conference room'),
            'friend': _('Friend'),
            'queue': _('Queue'),
            'residential': _('Residential Device'),
            'conditional': _('Conditional Route'),
            'retail': _('Retail Account'),
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
            'fax': {
                show: ['fax'],
                hide: allRoutableFields,
            },
            'conferenceRoom': {
                show: ['conferenceRoom'],
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
            'residential': {
                show: ['residentialDevice', 'recordCalls'],
                hide: allRoutableFields,
            },
            'conditional': {
                show: ['conditionalRoute'],
                hide: allRoutableFields,
            },
            'retail': {
                show: ['retailAccount'],
                hide: allRoutableFields,
            },
        }
    },
    'recordCalls': {
        label: _('Record call'),
        helpText: _('Local legislation may enforce to announce the call recording to both parties, act responsibly'),
    },
    'displayName': {
        label: _('Display name'),
        helpText: _("This value will be displayed in the called terminals"),
    },
    'user': {
        label: _('User'),
    },
    'ivr': {
        label: _('IVR'),
    },
    'huntGroup': {
        label: _('Hunt Group'),
    },
    'fax': {
        label: _('Fax'),
    },
    'conferenceRoom': {
        label: _('Conference room'),
    },
    'residentialDevice': {
        label: _('Residential Device'),
    },
    'friendValue': {
        label: _('Friend value'),
    },
    'country': {
        label: _('Country'),
    },
    'language': {
        label: _('Language'),
    },
    'queue': {
        label: _('Queue'),
    },
    'conditionalRoute': {
        label: _('Conditional Route'),
    },
    'retailAccount': {
        label: _('Retail Account'),
    },
    'target': {
        label: _('Target'),
    },
};

const columns = [
    'country',
    'ddi',
    'externalCallFilter',
    'routeType',
    'target',
];

async function foreignKeyResolver(
    data: DdiPropertiesList,
    entityService: EntityService
) {

    const promises = [];
    const {
        User, Ivr, HuntGroup, ConferenceRoom, Queue, ConditionalRoute,
        Fax, ResidentialDevice, ExternalCallFilter
    } = entities;

    promises.push(
        genericForeignKeyResolver(
            data,
            'externalCallFilter',
            ExternalCallFilter.path,
            ExternalCallFilter.toStr
        )
    );

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
            'ivr',
            Ivr.path,
            Ivr.toStr,
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
            'fax',
            Fax.path,
            Fax.toStr,
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
            'residentialDevice',
            ResidentialDevice.path,
            ResidentialDevice.toStr,
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
            case 'fax':
                remapFk(data[idx], 'fax', 'target');
                break;
            case 'conferenceRoom':
                remapFk(data[idx], 'conferenceRoom', 'target');
                break;
            case 'friend':
                remapFk(data[idx], 'friendValue', 'target');
                break;
            case 'queue':
                remapFk(data[idx], 'queue', 'target');
                break;
            case 'residential':
                remapFk(data[idx], 'residentialDevice', 'target');
                break;
            case 'conditional':
                remapFk(data[idx], 'conditionalRoute', 'target');
                break;
            case 'retail':
                remapFk(data[idx], 'retailAccount', 'target');
                break;
            default:
                console.error('Unkown route type ' + data[idx].routeType);
                data[idx].target = '';
                break;
        }

        delete data[idx].user;
        delete data[idx].ivr;
        delete data[idx].huntGroup;
        delete data[idx].fax;
        delete data[idx].conferenceRoom;
        delete data[idx].residentialDevice;
        delete data[idx].friendValue;
        delete data[idx].queue;
        delete data[idx].conditionalRoute;
        delete data[idx].retailAccount;
    }

    return data;
}

const ddi: EntityInterface = {
    ...defaultEntityBehavior,
    icon: <SettingsApplications />,
    iden: 'Ddi',
    title: _('DDI', { count: 2 }),
    path: '/ddis',
    toStr: (row: any) => row.ddie164,
    columns,
    properties,
    Form,
    foreignKeyResolver
};

export default ddi;