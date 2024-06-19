import { PropertyFkChoices } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import { fetchAllPages } from '@irontec/ivoz-ui/helpers/fechAllPages';
import store from 'store';

import { ClientFeatures, ClientTypes } from '../../Company/ClientFeatures';

const ResidentialFeatureSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const Feature = entities.Feature;

  return fetchAllPages({
    endpoint: Feature.path,
    params: {
      _properties: ['id', 'iden', 'name'],
    },
    setter: async (data) => {
      const options: PropertyFkChoices = [];

      const featuresToIgnore = [
        ClientFeatures.queues,
        ClientFeatures.friends,
        ClientFeatures.conferences,
        ClientFeatures.billing,
        ClientFeatures.invoices,
        ClientFeatures.operatorPanel,
        ClientTypes.residential,
        ClientTypes.retail,
        ClientTypes.vpbx,
        ClientTypes.wholesale,
      ];

      for (const item of data) {
        if (featuresToIgnore.includes(item.iden as string)) {
          continue;
        }

        options.push({
          id: item.id as number,
          label: Feature.toStr(item),
          extraData: {
            iden: item.iden,
          },
        });
      }

      callback(options);
    },
    cancelToken,
  });
};

export default ResidentialFeatureSelectOptions;
