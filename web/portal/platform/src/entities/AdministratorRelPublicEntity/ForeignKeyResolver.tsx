import { autoForeignKeyResolver } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { foreignKeyResolverType } from '@irontec/ivoz-ui/entities/EntityInterface';

import { AdministratorRelPublicEntityPropertiesList } from './AdministratorRelPublicEntityProperties';

/** TODO remove this file unless you need to change default behaviour **/
const foreignKeyResolver: foreignKeyResolverType = async function ({
  data,
  cancelToken,
  entityService,
}): Promise<AdministratorRelPublicEntityPropertiesList> {
  const promises = autoForeignKeyResolver({
    data,
    cancelToken,
    entityService,
    allowLinks: false,
    skip: ['administrator'],
  });

  await Promise.all(promises);

  return data;
};

export default foreignKeyResolver;
