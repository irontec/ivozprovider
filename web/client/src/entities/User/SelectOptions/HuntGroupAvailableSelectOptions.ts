import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';
import HuntGroup from '../../HuntGroup/HuntGroup';
import { EntityValues } from '@irontec/ivoz-ui/services/entity/EntityService';
import { match } from 'react-router-dom';

interface CustomArgs {
  row?: EntityValues,
  match: match,
}

const HuntGroupAvailableSelectOptions: SelectOptionsType<CustomArgs> = (
  { callback, cancelToken },
  customArgs,
): Promise<unknown> => {

  const match = customArgs?.match as match;
  const id = (match?.params as Record<string, string>)?.parent_id_1;

  const params: any = {
    '_properties': ['id', 'name', 'lastname'],
  };

  const includeId = (customArgs?.row?.user as EntityValues)?.id as number | undefined;
  if (includeId) {
    params._includeId = includeId;
  }

  const getAction = store.getActions().api.get;
  return getAction({
    path: HuntGroup.path + `/${id}/users_available`,
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

export default HuntGroupAvailableSelectOptions;