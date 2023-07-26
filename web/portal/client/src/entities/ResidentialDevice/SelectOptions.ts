import { DropdownChoices } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';

const ResidentialDeviceSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const ResidentialDevice = entities.ResidentialDevice;

  return defaultEntityBehavior.fetchFks(
    ResidentialDevice.path,
    ['id', 'name'],
    (data) => {
      const options: DropdownChoices = {};
      for (const item of data) {
        options[item.id] = item.name;
      }

      callback(options);
    },
    cancelToken
  );
};

export default ResidentialDeviceSelectOptions;
