import { foreignKeyResolverType } from 'lib/entities/EntityInterface';
import genericForeignKeyResolver from 'lib/services/api/genericForeigKeyResolver';
import entities from '../index';
import { FaxPropertiesList } from './FaxProperties';

const foreignKeyResolver: foreignKeyResolverType = async function(
    { data, cancelToken }
): Promise<FaxPropertiesList> {

    const promises = [];
    const { Ddi } = entities;

    promises.push(
        genericForeignKeyResolver({
            data,
            fkFld: 'outgoingDdi',
            entity: Ddi,
            cancelToken,
        })
    );

    await Promise.all(promises);

    if (!Array.isArray(data)) {
        return data;
    }

    return data;
}

export default foreignKeyResolver;