import { foreignKeyResolverType } from '@irontec/ivoz-ui/entities/EntityInterface';
import genericForeignKeyResolver from '@irontec/ivoz-ui/services/api/genericForeigKeyResolver';
import store from 'store';
import { CompanyServicePropertiesList } from './CompanyServiceProperties';

const foreignKeyResolver: foreignKeyResolverType = async function ({
  data,
  cancelToken,
}): Promise<CompanyServicePropertiesList> {
  const promises = [];

  const entities = store.getState().entities.entities;
  const { Service } = entities;

  promises.push(
    genericForeignKeyResolver({
      data,
      fkFld: 'service',
      entity: Service,
      addLink: false,
      cancelToken,
    })
  );

  await Promise.all(promises);

  return data;
};

export default foreignKeyResolver;
