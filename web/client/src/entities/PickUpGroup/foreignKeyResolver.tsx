import { foreignKeyResolverType } from 'lib/entities/EntityInterface';
import entities from '../index';
import { PickUpGroupPropertiesList } from './PickUpGroupProperties';
import genericForeignKeyResolver from 'lib/services/api/genericForeigKeyResolver';

const foreignKeyResolver: foreignKeyResolverType = async function ({
    data, cancelToken
}): Promise<PickUpGroupPropertiesList> {

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