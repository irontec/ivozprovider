import { DropdownChoices } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';

import { MediaRelaySetPropertiesList } from './MediaRelaySetProperties';

const MediaRelaySetSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const MediaRelaySet = entities.MediaRelaySet;

  return defaultEntityBehavior.fetchFks(
    MediaRelaySet.path,
    ['id', 'name'],
    (data: MediaRelaySetPropertiesList) => {
      const options: DropdownChoices = [];
      for (const item of data) {
        options.push({ id: item.id as number, label: item.name as string });
      }

      callback(options);
    },
    cancelToken
  );
};

export default MediaRelaySetSelectOptions;
