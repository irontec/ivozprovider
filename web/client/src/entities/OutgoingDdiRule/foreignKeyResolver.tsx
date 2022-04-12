import { foreignKeyResolverType } from '@irontec/ivoz-ui/entities/EntityInterface';
import { EntityValues } from '@irontec/ivoz-ui/services/entity/EntityService';
import entities from '../index';
import { autoForeignKeyResolver } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';

const foreignKeyResolver: foreignKeyResolverType = async function (
  { data, cancelToken, entityService },
): Promise<EntityValues> {

  const promises = autoForeignKeyResolver({
    data, cancelToken, entityService, entities,
  });

  await Promise.all(promises);

  return data;
};

export default foreignKeyResolver;