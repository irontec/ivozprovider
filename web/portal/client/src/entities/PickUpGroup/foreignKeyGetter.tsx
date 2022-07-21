import UserSelectOptions from 'entities/User/SelectOptions';
import { PickUpGroupPropertyList } from './PickUpGroupProperties';
import { ForeignKeyGetterType } from '@irontec/ivoz-ui/entities/EntityInterface';

export const foreignKeyGetter: ForeignKeyGetterType = async ({
  cancelToken,
}): Promise<any> => {
  const response: PickUpGroupPropertyList<Array<string | number>> = {};
  const promises: Array<Promise<unknown>> = [];

  promises[promises.length] = UserSelectOptions({
    callback: (options: any) => {
      response.userIds = options;
    },
    cancelToken,
  });

  await Promise.all(promises);

  return response;
};
