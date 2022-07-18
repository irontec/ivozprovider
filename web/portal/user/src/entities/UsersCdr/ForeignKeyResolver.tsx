import { autoForeignKeyResolver } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { foreignKeyResolverType } from '@irontec/ivoz-ui/entities/EntityInterface';
import entities from '../index';
import { UsersCdrPropertiesList } from './UsersCdrProperties';

const foreignKeyResolver: foreignKeyResolverType = async function ({
  data,
  cancelToken,
  entityService,
}): Promise<UsersCdrPropertiesList> {
  const promises = autoForeignKeyResolver({
    data,
    cancelToken,
    entityService,
    entities,
  });

  await Promise.all(promises);

  return data;
};

export default foreignKeyResolver;
