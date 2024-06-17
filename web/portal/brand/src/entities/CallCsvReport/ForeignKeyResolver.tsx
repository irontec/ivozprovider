import { autoForeignKeyResolver } from '@irontec-voip/ivoz-ui/entities/DefaultEntityBehavior';
import { foreignKeyResolverType } from '@irontec-voip/ivoz-ui/entities/EntityInterface';

import { CallCsvReportPropertiesList } from './CallCsvReportProperties';

/** TODO remove this file unless you need to change default behaviour **/
const foreignKeyResolver: foreignKeyResolverType = async function ({
  data,
  cancelToken,
  entityService,
}): Promise<CallCsvReportPropertiesList> {
  const promises = autoForeignKeyResolver({
    data,
    cancelToken,
    entityService,
  });

  await Promise.all(promises);

  return data;
};

export default foreignKeyResolver;
