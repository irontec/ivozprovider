import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';
import Extension from '../Extension';

const UserExtensionSelectOptions: SelectOptionsType = (
  { callback, cancelToken },
): Promise<unknown> => {

  const params: any = {
    '_properties': ['id', 'number'],
  };

  const getAction = store.getActions().api.get;
  return getAction({
    path: Extension.path + '?routeType[exact]=user',
    params,
    successCallback: async (data: any) => {
      const options: any = {};
      for (const item of data) {
        options[item.id] = item.number;
      }
      callback(options);
    },
    cancelToken,
  });

};

export default UserExtensionSelectOptions;