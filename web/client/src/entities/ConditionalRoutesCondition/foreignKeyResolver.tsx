import genericForeignKeyResolver, { remapFk } from 'lib/services/api/genericForeigKeyResolver';
import entities from '../index';
import { ConditionalRoutesConditionPropertiesList } from './ConditionalRoutesConditionProperties';
import { foreignKeyResolverType } from 'lib/entities/EntityInterface';
import { autoForeignKeyResolver } from 'lib/entities/DefaultEntityBehavior';
import store from 'store';
import { EntityList } from 'lib/router/parseRoutes';
import { CountryPropertyList } from 'entities/Country/CountryProperties';

const foreignKeyResolver: foreignKeyResolverType = async function (
    { data, cancelToken, entityService }
): Promise<ConditionalRoutesConditionPropertiesList> {

    const promises = autoForeignKeyResolver({
        data,
        cancelToken,
        entityService,
        entities,
        skip: [
            'numberCountry',
            'conditionalRoute',
        ],
    });

    promises.push(
        genericForeignKeyResolver({
            data,
            fkFld: 'numberCountry',
            entity: {
                ...entities.Country,
                toStr: (row: CountryPropertyList<string>) => `${row.countryCode}`,
            },
            cancelToken,
        })
    );

    const getAction = store.getActions().api.get;
    const {
        ConditionalRoutesConditionsRelCalendar,
        ConditionalRoutesConditionsRelMatchList,
        ConditionalRoutesConditionsRelRouteLock,
        ConditionalRoutesConditionsRelSchedule,
    } = entities;

    const conditionMatchEntities: EntityList = {
        calendar: ConditionalRoutesConditionsRelCalendar,
        matchlist: ConditionalRoutesConditionsRelMatchList,
        routeLock: ConditionalRoutesConditionsRelRouteLock,
        schedule: ConditionalRoutesConditionsRelSchedule,
    }

    const ids = [];
    for (const idx in data) {
        ids.push(data[idx].id);
    }

    for (const fld in conditionMatchEntities) {

        const entity = conditionMatchEntities[fld];
        promises[promises.length] = getAction({
            path: entity.path,
            params: {
                condition: ids,
                _pagination: false
            },
            cancelToken: cancelToken,
            successCallback: async (response: any) => {

                for (const item of response) {
                    for (const row of data) {
                        if (item.condition.id !== row.id) {
                            continue;
                        }

                        if (row.conditionMatch === undefined) {
                            row.conditionMatch = [];
                        }

                        row.conditionMatch.push(
                            item[fld].name
                        );
                    }
                }
            }
        });
    }

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
            case 'voicemail':
                remapFk(data[idx], 'voicemail', 'target');
                break;
            case 'number':
                data[idx].target =
                    data[idx].numberCountry
                    + ' '
                    + data[idx].numbervalue;
                break;
            case 'friend':
                data[idx].target = data[idx].friendValue;
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
    }

    return data;
}

export default foreignKeyResolver;