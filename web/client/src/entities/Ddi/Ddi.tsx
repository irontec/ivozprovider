import DialpadIcon from '@mui/icons-material/Dialpad';
import EntityInterface, { foreignKeyResolverType } from 'lib/entities/EntityInterface';
import _ from 'lib/services/translations/translate';
import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import Form from './Form';
import { foreignKeyGetter } from './useFkChoices';
import genericForeignKeyResolver, { remapFk } from 'lib/services/api/genericForeigKeyResolver';
import entities from '../index';
import { DdiProperties, DdiPropertiesList } from './DdiProperties';

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
        enum: {
            'none': _('None'),
            'all': _('All'),
            'inbound': _('Inbound'),
            'outbound': _('Outbound'),
        },
        default: 'none',
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
        null: _("Client's default"),
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

const foreignKeyResolver: foreignKeyResolverType = async function(
    { data, cancelToken }
): Promise<DdiPropertiesList> {

    const promises = [];
    const {
        User, Ivr, HuntGroup, ConferenceRoom, Queue, ConditionalRoute,
        Fax, ResidentialDevice, ExternalCallFilter, Country
    } = entities;

    promises.push(
        genericForeignKeyResolver({
            data,
            fkFld: 'country',
            entity: Country,
            addLink: false,
            cancelToken,
        })
    );

    promises.push(
        genericForeignKeyResolver({
            data,
            fkFld: 'externalCallFilter',
            entity: ExternalCallFilter,
            cancelToken,
        })
    );

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
            fkFld: 'fax',
            entity: Fax,
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
            fkFld: 'residentialDevice',
            entity: ResidentialDevice,
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
    icon: <DialpadIcon />,
    iden: 'Ddi',
    title: _('DDI', { count: 2 }),
    path: '/ddis',
    toStr: (row: any) => row.ddie164,
    columns,
    properties,
    Form,
    foreignKeyGetter,
    foreignKeyResolver
};

export default ddi;