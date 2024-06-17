import { autoForeignKeyResolver } from '@irontec-voip/ivoz-ui/entities/DefaultEntityBehavior';
import { foreignKeyResolverType } from '@irontec-voip/ivoz-ui/entities/EntityInterface';

import { BillableCallPropertiesList } from './BillableCallProperties';

const foreignKeyResolver: foreignKeyResolverType = async function ({
  data,
  cancelToken,
  entityService,
}): Promise<BillableCallPropertiesList> {
  const promises = autoForeignKeyResolver({
    data,
    cancelToken,
    entityService,
    skip: ['ddi', 'ddiProvider'],
  });

  await Promise.all(promises);

  return data;
};

export default foreignKeyResolver;
