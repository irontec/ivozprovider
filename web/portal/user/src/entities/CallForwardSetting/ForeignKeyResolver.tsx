import { autoForeignKeyResolver } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { foreignKeyResolverType } from '@irontec/ivoz-ui/entities/EntityInterface';
import entities from '../index';
import { CallForwardSettingPropertiesList } from './CallForwardSettingProperties';

const foreignKeyResolver: foreignKeyResolverType = async function ({
  data,
  cancelToken,
  entityService,
}): Promise<CallForwardSettingPropertiesList> {
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
