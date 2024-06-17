import { autoForeignKeyResolver } from '@irontec-voip/ivoz-ui/entities/DefaultEntityBehavior';
import { foreignKeyResolverType } from '@irontec-voip/ivoz-ui/entities/EntityInterface';
import genericForeignKeyResolver from '@irontec-voip/ivoz-ui/services/api/genericForeigKeyResolver';
import store from 'store';

import { CallForwardSettingPropertiesList } from './CallForwardSettingProperties';

const foreignKeyResolver: foreignKeyResolverType = async function ({
  data,
  cancelToken,
  entityService,
}): Promise<CallForwardSettingPropertiesList> {
  const entities = store.getState().entities.entities;

  const promises = autoForeignKeyResolver({
    data,
    cancelToken,
    entityService,
    skip: ['extension'],
  });

  promises.push(
    genericForeignKeyResolver({
      data,
      fkFld: 'extension',
      addLink: false,
      entity: entities.Extension,
      cancelToken,
    })
  );

  await Promise.all(promises);

  return data;
};

export default foreignKeyResolver;
