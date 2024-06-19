import { DropdownChoices } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';

const FeaturesRelCompanySelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const FeaturesRelCompany = entities.FeaturesRelCompany;

  return defaultEntityBehavior.fetchFks(
    FeaturesRelCompany.path,
    ['feature'],
    (data) => {
      const options: DropdownChoices = {};
      for (const item of data) {
        options[item.feature.id] = item.feature;
      }

      callback(options);
    },
    cancelToken
  );
};

export default FeaturesRelCompanySelectOptions;
