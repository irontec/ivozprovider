import { foreignKeyResolverType } from 'lib/entities/EntityInterface';
import genericForeignKeyResolver from 'lib/services/api/genericForeigKeyResolver';
import entities from '../index';
import { UserPropertiesList } from './UserProperties';

const foreignKeyResolver: foreignKeyResolverType = async function(
    { data, cancelToken }
): Promise<UserPropertiesList> {
    const promises = [];
    const { Ddi, Extension, Terminal } = entities;

    promises.push(
        genericForeignKeyResolver({
            data,
            fkFld: 'terminal',
            entity: Terminal,
            cancelToken,
        })
    );

    promises.push(
        genericForeignKeyResolver({
            data,
            fkFld: 'extension',
            entity: Extension,
            cancelToken,
        })
    );

    promises.push(
        genericForeignKeyResolver({
            data,
            fkFld: 'outgoingDdi',
            entity: Ddi,
            cancelToken,
        })
    );

    await Promise.all(promises);

    return data;
}

export default foreignKeyResolver;