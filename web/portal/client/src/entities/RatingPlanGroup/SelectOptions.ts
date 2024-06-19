import { DropdownChoices } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import { getI18n } from 'react-i18next';
import store from 'store';

const RatingPlanGroupSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const RatingPlanGroup = entities.RatingPlanGroup;

  return defaultEntityBehavior.fetchFks(
    RatingPlanGroup.path,
    ['id', 'name'],
    (data) => {
      const options: DropdownChoices = {};
      for (const item of data) {
        const language = getI18n().language.substring(0, 2);
        options[item.id] = item.name[language];
      }

      callback(options);
    },
    cancelToken
  );
};

export default RatingPlanGroupSelectOptions;
