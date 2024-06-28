import { autoForeignKeyResolver } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { foreignKeyResolverType } from '@irontec/ivoz-ui/entities/EntityInterface';

import { VoicemailPropertiesList } from './VoicemailProperties';

const foreignKeyResolver: foreignKeyResolverType = async function ({
  data,
  cancelToken,
  entityService,
}): Promise<VoicemailPropertiesList> {
  const promises = autoForeignKeyResolver({
    data,
    cancelToken,
    entityService,
  });

  await Promise.all(promises);

  return data;
};

export default foreignKeyResolver;
