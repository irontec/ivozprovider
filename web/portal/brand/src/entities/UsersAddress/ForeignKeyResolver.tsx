import { autoForeignKeyResolver } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { foreignKeyResolverType } from '@irontec/ivoz-ui/entities/EntityInterface';
import { UsersAddressPropertiesList } from './UsersAddressProperties';

/** TODO remove this file unless you need to change default behaviour **/
const foreignKeyResolver: foreignKeyResolverType = async function (
  { data, cancelToken, entityService },
): Promise<UsersAddressPropertiesList> {

  const promises = autoForeignKeyResolver({
    data, cancelToken, entityService,
  });

  await Promise.all(promises);

  return data;
};

export default foreignKeyResolver;