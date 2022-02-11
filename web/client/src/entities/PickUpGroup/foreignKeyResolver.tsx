import { foreignKeyResolverType } from 'lib/entities/EntityInterface';
import entities from '../index';
import genericForeignKeyResolver from 'lib/services/api/genericForeigKeyResolver';
import { PickUpGroupPropertiesList } from './PickUpGroupProperties';

const foreignKeyResolver: foreignKeyResolverType = async function(
    { data, cancelToken }
): Promise<PickUpGroupPropertiesList> {

    const promises = [];
    const { User } = entities;

    promises.push(
        genericForeignKeyResolver({
            data,
            fkFld: 'userIds',
            entity: User,
            cancelToken,
        })
    );

    await Promise.all(promises);

    return data;
}

export default foreignKeyResolver;