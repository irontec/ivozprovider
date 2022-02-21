import { foreignKeyResolverType } from 'lib/entities/EntityInterface';
import { HolidayDatePropertiesList } from './HolidayDateProperties';
import entities from '../index';
import { autoForeignKeyResolver } from 'lib/entities/DefaultEntityBehavior';
import { remapFk } from 'lib/services/api/genericForeigKeyResolver';

const foreignKeyResolver: foreignKeyResolverType = async function (
    { data, cancelToken, entityService }
): Promise<HolidayDatePropertiesList> {

    const promises = autoForeignKeyResolver({
        data,
        cancelToken,
        entityService,
        entities,
        skip: []
    });

    await Promise.all(promises);

    for (const values of data) {
        switch (values.routeType) {
            case 'extension':
                remapFk(values, 'extension', 'target');
                break;
            case 'voicemail':
                remapFk(values, 'voiceMailUser', 'target');
                break;
            case 'retail':
                remapFk(values, 'cfwToretailAccount', 'target');
                break;
            case 'number':
                values.targetTypeValue = `${values.numberCountry} ${values.numberValue}`;
                break;
        }
    }

    return data;
}

export default foreignKeyResolver;