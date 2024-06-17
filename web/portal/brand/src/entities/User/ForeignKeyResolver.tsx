import { autoForeignKeyResolver } from '@irontec-voip/ivoz-ui/entities/DefaultEntityBehavior';
import { foreignKeyResolverType } from '@irontec-voip/ivoz-ui/entities/EntityInterface';
import genericForeignKeyResolver from '@irontec-voip/ivoz-ui/services/api/genericForeigKeyResolver';
import store from 'store';

import { UserPropertiesList } from './UserProperties';

/** TODO remove this file unless you need to change default behaviour **/
const foreignKeyResolver: foreignKeyResolverType = async function ({
  data,
  cancelToken,
  entityService,
}): Promise<UserPropertiesList> {
  const entities = store.getState().entities.entities;

  const promises = autoForeignKeyResolver({
    data,
    cancelToken,
    entityService,
    skip: ['company'],
  });

  promises.push(
    genericForeignKeyResolver({
      data,
      fkFld: 'company',
      addLink: false,
      entity: entities.Company,
      cancelToken,
    })
  );

  await Promise.all(promises);

  return data;
};

export default foreignKeyResolver;
