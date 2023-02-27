import { DropdownChoices } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';
import { RtpenginePropertiesList } from './RtpengineProperties';

const RtpengineSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const Rtpengine = entities.Rtpengine;

  return defaultEntityBehavior.fetchFks(
    Rtpengine.path,
    ['id', 'url'],
    (data: RtpenginePropertiesList) => {
      const options: DropdownChoices = [];
      for (const item of data) {
        options.push({ id: item.id as number, label: item.url as string });
      }

      callback(options);
    },
    cancelToken
  );
};

export default RtpengineSelectOptions;
