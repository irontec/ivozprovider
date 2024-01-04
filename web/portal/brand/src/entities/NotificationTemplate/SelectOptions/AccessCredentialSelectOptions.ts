import { DropdownChoices } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';

const AccessCredentialSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const NotificationTemplate = entities.NotificationTemplate;

  return defaultEntityBehavior.fetchFks(
    `${NotificationTemplate.path}?type=accessCredentials`,
    ['id', 'name'],
    (data) => {
      const options: DropdownChoices = [];
      for (const item of data) {
        options.push({
          id: item.id,
          label: NotificationTemplate.toStr(item),
        });
      }

      callback(options);
    },
    cancelToken
  );
};

export default AccessCredentialSelectOptions;
