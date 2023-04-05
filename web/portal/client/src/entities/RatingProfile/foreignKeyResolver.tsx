import { foreignKeyResolverType } from '@irontec/ivoz-ui/entities/EntityInterface';
import genericForeignKeyResolver from '@irontec/ivoz-ui/services/api/genericForeigKeyResolver';
import store from 'store';
import RatingPlanGroup from '../RatingPlanGroup/RatingPlanGroup';
import { RatingProfilePropertiesList } from './RatingProfileProperties';

const foreignKeyResolver: foreignKeyResolverType = async function ({
  data,
  cancelToken,
}): Promise<RatingProfilePropertiesList> {
  const promises = [];

  const entities = store.getState().entities.entities;
  const { RoutingTag } = entities;

  promises.push(
    genericForeignKeyResolver({
      data,
      fkFld: 'ratingPlanGroup',
      entity: RatingPlanGroup,
      addLink: false,
      cancelToken,
    })
  );

  promises.push(
    genericForeignKeyResolver({
      data,
      fkFld: 'routingTag',
      entity: RoutingTag,
      addLink: false,
      cancelToken,
    })
  );

  await Promise.all(promises);

  return data;
};

export default foreignKeyResolver;
