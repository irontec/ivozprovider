import { DropdownChoices } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';

import { RatingPlanPropertiesList } from './RatingPlanProperties';

const RatingPlanSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const RatingPlan = entities.RatingPlan;

  return defaultEntityBehavior.fetchFks(
    RatingPlan.path,
    ['id'],
    (data: RatingPlanPropertiesList) => {
      const options: DropdownChoices = [];
      for (const item of data) {
        options.push({
          id: item.id as number,
          label: `${item.id}`,
        });
      }

      callback(options);
    },
    cancelToken
  );
};

export default RatingPlanSelectOptions;
