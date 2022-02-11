import { foreignKeyResolverType } from 'lib/entities/EntityInterface';
import genericForeignKeyResolver, { remapFk } from 'lib/services/api/genericForeigKeyResolver';
import entities from '../index';
import { ExternalCallFilterPropertiesList } from './ExternalCallFilterProperties';

const foreignKeyResolver: foreignKeyResolverType = async function(
    { data, cancelToken }
): Promise<ExternalCallFilterPropertiesList> {

    const promises = [];
    const {
        User, Extension, Country, Locution
    } = entities;

    promises.push(
        genericForeignKeyResolver({
            data,
            fkFld: 'holidayLocution',
            entity: Locution,
            cancelToken,
        })
    );

    promises.push(
        genericForeignKeyResolver({
            data,
            fkFld: 'holidayExtension',
            entity: Extension,
            cancelToken,
        })
    );

    promises.push(
        genericForeignKeyResolver({
            data,
            fkFld: 'holidayVoiceMailUser',
            entity: User,
            cancelToken,
        })
    );

    promises.push(
        genericForeignKeyResolver({
            data,
            fkFld: 'holidayNumberCountry',
            entity: Country,
            cancelToken,
        })
    );

    //////////////////

    promises.push(
        genericForeignKeyResolver({
            data,
            fkFld: 'outOfScheduleLocution',
            entity: Locution,
            cancelToken,
        })
    );

    promises.push(
        genericForeignKeyResolver({
            data,
            fkFld: 'outOfScheduleExtension',
            entity: Extension,
            cancelToken,
        })
    );

    promises.push(
        genericForeignKeyResolver({
            data,
            fkFld: 'outOfScheduleVoiceMailUser',
            entity: User,
            cancelToken,
        })
    );

    promises.push(
        genericForeignKeyResolver({
            data,
            fkFld: 'outOfScheduleNumberCountry',
            entity: Country,
            cancelToken,
        })
    );

    await Promise.all(promises);

    if (!Array.isArray(data)) {
        return data;
    }

    for (const idx in data) {

        switch (data[idx].holidayTargetType) {
            case null:
                data[idx].holidayTarget = '';
                break;
            case 'extension':
                remapFk(data[idx], 'holidayExtension', 'holidayTarget');
                break;
            case 'voicemail':
                remapFk(data[idx], 'holidayVoiceMailUser', 'holidayTarget');
                break;
            case 'number':
                data[idx].holidayTarget =
                    data[idx].holidayNumberCountry
                    + ' '
                    + data[idx].holidayNumberValue;
                break;
            default:
                console.error('Unkown route type:', data[idx].holidayTargetType);
                data[idx].holidayTarget = '';
                break;
        }

        switch (data[idx].outOfScheduleTargetType) {
            case null:
                data[idx].outOfScheduleTarget = '';
                break;
            case 'extension':
                remapFk(data[idx], 'outOfScheduleExtension', 'outOfScheduleTarget');
                break;
            case 'voicemail':
                remapFk(data[idx], 'outOfScheduleVoiceMailUser', 'outOfScheduleTarget');
                break;
            case 'number':
                data[idx].outOfScheduleTarget =
                    data[idx].outOfScheduleNumberCountry
                    + ' '
                    + data[idx].outOfScheduleNumberValue;
                break;
            default:
                console.error('Unkown route type:', data[idx].outOfScheduleTargetType);
                data[idx].outOfScheduleTarget = '';
                break;
        }

        delete data[idx].holidayExtension;
        delete data[idx].holidayVoiceMailUser;
        delete data[idx].holidayNumberCountry;
        delete data[idx].holidayNumberValue;

        delete data[idx].outOfScheduleExtension;
        delete data[idx].outOfScheduleVoiceMailUser;
        delete data[idx].outOfScheduleNumberCountry;
        delete data[idx].outOfScheduleNumberValue;
    }

    return data;
}

export default foreignKeyResolver;