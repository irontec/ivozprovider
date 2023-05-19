import { EntityValues } from '@irontec/ivoz-ui';
import { autoForeignKeyResolver } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { foreignKeyResolverType } from '@irontec/ivoz-ui/entities/EntityInterface';
import genericForeignKeyResolver from '@irontec/ivoz-ui/services/api/genericForeigKeyResolver';
import { getI18n } from 'react-i18next';
import store from 'store';

import { DestinationPropertyList } from '../Destination/DestinationProperties';
import { DestinationRatePropertiesList } from './DestinationRateProperties';

/** TODO remove this file unless you need to change default behaviour **/
const foreignKeyResolver: foreignKeyResolverType = async function ({
  data,
  cancelToken,
  entityService,
}): Promise<DestinationRatePropertiesList> {
  const entities = store.getState().entities.entities;

  const promises = autoForeignKeyResolver({
    data,
    cancelToken,
    entityService,
    skip: ['destination'],
  });

  promises.push(
    genericForeignKeyResolver({
      data,
      fkFld: 'destination',
      entity: {
        ...entities.Destination,
        toStr: (row: DestinationPropertyList<EntityValues>) => {
          const language = getI18n().language.substring(0, 2);

          return `${row.name?.[language]} (${row.prefix})`;
        },
      },
      cancelToken,
    })
  );

  await Promise.all(promises);

  return data;
};

export default foreignKeyResolver;
