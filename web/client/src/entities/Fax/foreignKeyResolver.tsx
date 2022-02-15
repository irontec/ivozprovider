import { autoForeignKeyResolver } from 'lib/entities/DefaultEntityBehavior';
import { foreignKeyResolverType } from 'lib/entities/EntityInterface';
import entities from '../index';
import { FaxPropertiesList } from './FaxProperties';

const foreignKeyResolver: foreignKeyResolverType = async function(
    { data, cancelToken, entityService }
): Promise<FaxPropertiesList> {

    const promises = autoForeignKeyResolver({
        data, cancelToken, entityService, entities
    });

    await Promise.all(promises);

    if (!Array.isArray(data)) {
        return data;
    }

    return data;
}

export default foreignKeyResolver;