import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import FeaturesRelCompany from './FeaturesRelCompany';

const FeaturesRelCompanySelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  return defaultEntityBehavior.fetchFks(
    FeaturesRelCompany.path,
    ['feature'],
    (data: any) => {
      const options: any = {};
      for (const item of data) {
        options[item.feature.id] = item.feature;
      }

      callback(options);
    },
    cancelToken
  );
};

export default FeaturesRelCompanySelectOptions;
