import { autoForeignKeyResolver } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { foreignKeyResolverType } from '@irontec/ivoz-ui/entities/EntityInterface';
import { remapFk } from '@irontec/ivoz-ui/services/api/genericForeigKeyResolver';
import { OutgoingRoutingPropertiesList } from './OutgoingRoutingProperties';

/** TODO remove this file unless you need to change default behaviour **/
const foreignKeyResolver: foreignKeyResolverType = async function ({
  data,
  cancelToken,
  entityService,
}): Promise<OutgoingRoutingPropertiesList> {
  const promises = autoForeignKeyResolver({
    data,
    cancelToken,
    entityService,
  });

  await Promise.all(promises);

  for (const idx in data) {
    const { type } = data[idx];

    if (type === 'group') {
      remapFk(data[idx], 'routingPatternGroup', 'destination');
    } else {
      remapFk(data[idx], 'routingPattern', 'destination');
    }
  }

  return data;
};

export default foreignKeyResolver;
