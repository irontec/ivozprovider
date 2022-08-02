import { foreignKeyResolverType } from '@irontec/ivoz-ui/entities/EntityInterface';
import genericForeignKeyResolver from '@irontec/ivoz-ui/services/api/genericForeigKeyResolver';
import store from 'store';
import { PickUpGroupPropertiesList } from './PickUpGroupProperties';

const foreignKeyResolver: foreignKeyResolverType = async function ({
  data,
  cancelToken,
}): Promise<PickUpGroupPropertiesList> {
  const promises = [];

  const entities = store.getState().entities.entities;
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
};

export default foreignKeyResolver;
