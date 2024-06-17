import { DropdownChoices } from '@irontec-voip/ivoz-ui';
import defaultEntityBehavior from '@irontec-voip/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec-voip/ivoz-ui/entities/EntityInterface';
import store from 'store';

import { ResidentialDevicePropertiesList } from '../ResidentialDeviceProperties';

const ResidentialDeviceSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const ResidentialDevice = entities.ResidentialDevice;

  return defaultEntityBehavior.fetchFks(
    ResidentialDevice.path,
    ['id', 'name'],
    (data: ResidentialDevicePropertiesList) => {
      const options: DropdownChoices = [];
      for (const item of data) {
        options.push({
          id: item.id as number,
          label: item.name as string,
        });
      }

      callback(options);
    },
    cancelToken
  );
};

export default ResidentialDeviceSelectOptions;
