import { autoForeignKeyResolver } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { foreignKeyResolverType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';
import { FaxPropertiesList } from './FaxProperties';

const foreignKeyResolver: foreignKeyResolverType = async function ({
  data,
  cancelToken,
  entityService,
}): Promise<FaxPropertiesList> {
  const entities = store.getState().entities.entities;
  const promises = autoForeignKeyResolver({
    data,
    cancelToken,
    entityService,
    entities,
  });

  await Promise.all(promises);

  if (!Array.isArray(data)) {
    return data;
  }

  return data;
};

export default foreignKeyResolver;
