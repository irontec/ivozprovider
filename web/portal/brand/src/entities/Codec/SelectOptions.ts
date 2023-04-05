import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';

const CodecSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const Codec = entities.Codec;

  return defaultEntityBehavior.fetchFks(
    Codec.path,
    ['id', 'iden'],
    (data: any) => {
      const options: any = {};
      for (const item of data) {
        options[item.id] = item.iden;
      }

      callback(options);
    },
    cancelToken
  );
};

export default CodecSelectOptions;
