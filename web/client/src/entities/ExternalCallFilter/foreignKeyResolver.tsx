import { autoForeignKeyResolver } from 'lib/entities/DefaultEntityBehavior';
import { foreignKeyResolverType } from 'lib/entities/EntityInterface';
import { remapFk } from 'lib/services/api/genericForeigKeyResolver';
import entities from '../index';
import { ExternalCallFilterPropertiesList } from './ExternalCallFilterProperties';

const foreignKeyResolver: foreignKeyResolverType = async function(
    { data, cancelToken, entityService }
): Promise<ExternalCallFilterPropertiesList> {

    const promises = autoForeignKeyResolver({
        data, cancelToken, entityService, entities
    });

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
                remapFk(data[idx], 'holidayVoicemail', 'holidayTarget');
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
                remapFk(data[idx], 'outOfScheduleVoicemail', 'outOfScheduleTarget');
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
        delete data[idx].holidayVoicemail;
        delete data[idx].holidayNumberCountry;
        delete data[idx].holidayNumberValue;

        delete data[idx].outOfScheduleExtension;
        delete data[idx].outOfScheduleVoicemail;
        delete data[idx].outOfScheduleNumberCountry;
        delete data[idx].outOfScheduleNumberValue;
    }

    return data;
}

export default foreignKeyResolver;