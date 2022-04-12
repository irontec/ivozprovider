import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';
import User from '../User';

type CustomPropsType = {
  _excludeId?: number,
};

const BossAssistantSelectOptions: SelectOptionsType<CustomPropsType> = (
  { callback, cancelToken },
  customProps,
): Promise<unknown> => {

  const params: any = {
    '_properties': ['id', 'name', 'lastname'],
    'isBoss': 0,
  };

  const _excludeId = customProps?._excludeId;
  if (_excludeId) {
    params['id[neq]'] = _excludeId;
  }

  const getAction = store.getActions().api.get;
  return getAction({
    path: User.path,
    params,
    successCallback: async (data: any) => {
      const options: any = {};
      for (const item of data) {
        options[item.id] = `${item.name} ${item.lastname}`;
      }
      callback(options);
    },
    cancelToken,
  });
};

export default BossAssistantSelectOptions;