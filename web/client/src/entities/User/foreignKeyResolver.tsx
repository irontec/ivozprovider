import { autoForeignKeyResolver } from 'lib/entities/DefaultEntityBehavior';
import { foreignKeyResolverType } from 'lib/entities/EntityInterface';
import entities from '../index';
import { UserPropertiesList } from './UserProperties';

const foreignKeyResolver: foreignKeyResolverType = async function(
    { data, cancelToken, entityService }
): Promise<UserPropertiesList> {

    const promises = autoForeignKeyResolver({
        data, cancelToken, entityService, entities
    });

    await Promise.all(promises);

    return data;
}

export default foreignKeyResolver;