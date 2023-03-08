import { EntityValues } from '@irontec/ivoz-ui';
import { autoForeignKeyResolver } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { foreignKeyResolverType } from '@irontec/ivoz-ui/entities/EntityInterface';
import genericForeignKeyResolver from '@irontec/ivoz-ui/services/api/genericForeigKeyResolver';
import store from 'store';
import { BrandPropertiesList } from './BrandProperties';
import { getI18n } from 'react-i18next';
import { FeaturePropertyList } from '../Feature/FeatureProperties';

/** TODO remove this file unless you need to change default behaviour **/
const foreignKeyResolver: foreignKeyResolverType = async function ({
  data,
  cancelToken,
  entityService,
}): Promise<BrandPropertiesList> {
  const entities = store.getState().entities.entities;

  const promises = autoForeignKeyResolver({
    data,
    cancelToken,
    entityService,
    skip: ['features'],
  });

  promises.push(
    genericForeignKeyResolver({
      data,
      fkFld: 'features',
      addLink: false,
      entity: {
        ...entities.Feature,
        toStr: (row: FeaturePropertyList<EntityValues>) => {
          const language = getI18n().language.substring(0, 2);
          const name = row.name as Record<string, string>;
          return name[language];
        },
      },
      cancelToken,
    })
  );

  await Promise.all(promises);

  return data;
};

export default foreignKeyResolver;
