import { foreignKeyResolverType } from 'lib/entities/EntityInterface';
import { EntityValues } from 'lib/services/entity/EntityService';
import entities from '../index';
import { autoForeignKeyResolver } from 'lib/entities/DefaultEntityBehavior';

const foreignKeyResolver: foreignKeyResolverType = async function(
    { data, cancelToken, entityService }
): Promise<EntityValues> {

    const promises = autoForeignKeyResolver({
        data, cancelToken, entityService, entities
    });

    await Promise.all(promises);

    return data;
}

export default foreignKeyResolver;