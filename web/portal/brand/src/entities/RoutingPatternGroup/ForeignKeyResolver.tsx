import { autoForeignKeyResolver } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { foreignKeyResolverType } from '@irontec/ivoz-ui/entities/EntityInterface';
import genericForeignKeyResolver from '@irontec/ivoz-ui/services/api/genericForeigKeyResolver';
import { getI18n } from 'react-i18next';
import store from 'store';
import { RoutingPatternGroupPropertiesList } from './RoutingPatternGroupProperties';
import { RoutingPatternPropertyList } from '../RoutingPattern/RoutingPatternProperties';
import { EntityValues } from '@irontec/ivoz-ui';

/** TODO remove this file unless you need to change default behaviour **/
const foreignKeyResolver: foreignKeyResolverType = async function ({
  data,
  cancelToken,
  entityService,
}): Promise<RoutingPatternGroupPropertiesList> {
  const promises = autoForeignKeyResolver({
    data,
    cancelToken,
    entityService,
    skip: ['patternIds'],
  });

  const entities = store.getState().entities.entities;

  promises.push(
    genericForeignKeyResolver({
      data,
      fkFld: 'patternIds',
      entity: {
        ...entities.RoutingPattern,
        toStr: (row: RoutingPatternPropertyList<EntityValues>) => {
          const language = getI18n().language.substring(0, 2);
          const name =
            row?.name && row.name[language] ? row.name[language] : '';

          return `${name} (${row.prefix})`;
        },
      },
      cancelToken,
    })
  );

  await Promise.all(promises);

  return data;
};

export default foreignKeyResolver;
