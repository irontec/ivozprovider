import genericForeignKeyResolver, { remapFk } from 'lib/services/api/genericForeigKeyResolver';
import entities from '../index';
import { DdiPropertiesList } from './DdiProperties';
import { foreignKeyResolverType } from 'lib/entities/EntityInterface';

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

export default foreignKeyResolver;