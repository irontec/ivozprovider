import { foreignKeyResolverType } from 'lib/entities/EntityInterface';
import { EntityValues } from 'lib/services/entity/EntityService';
import entities from '../index';
import genericForeignKeyResolver from 'lib/services/api/genericForeigKeyResolver';

const foreignKeyResolver: foreignKeyResolverType = async function(
    { data, cancelToken }
): Promise<EntityValues> {

    const promises = [];
    const { Ddi } = entities;

    promises.push(
        genericForeignKeyResolver({
            data,
            fkFld: 'forcedDdi',
            entity: Ddi,
            addLink: Ddi.acl.update,
            cancelToken,
        })
    );

    await Promise.all(promises);

    return data;
}

export default foreignKeyResolver;