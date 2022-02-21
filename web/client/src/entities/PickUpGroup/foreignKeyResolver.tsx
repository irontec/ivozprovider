import { foreignKeyResolverType } from 'lib/entities/EntityInterface';
import entities from '../index';
import { PickUpGroupPropertiesList } from './PickUpGroupProperties';
import { autoForeignKeyResolver } from 'lib/entities/DefaultEntityBehavior';

const foreignKeyResolver: foreignKeyResolverType = async function(
    { data, cancelToken, entityService }
): Promise<PickUpGroupPropertiesList> {

    const promises = autoForeignKeyResolver({
        data, cancelToken, entityService, entities
    });

    await Promise.all(promises);

    return data;
}

export default foreignKeyResolver;