import { autoSelectOptions } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { ForeignKeyGetterType } from '@irontec/ivoz-ui/entities/EntityInterface';

import { VpbxSelectOptions } from '../Company/SelectOptions';
import { FriendPropertyList } from './FriendProperties';

/** TODO remove this file unless you need to change default behaviour **/
export const foreignKeyGetter: ForeignKeyGetterType = async ({
  cancelToken,
  entityService,
}): Promise<unknown> => {
  const response: FriendPropertyList<unknown> = {};

  const promises = autoSelectOptions({
    entityService,
    cancelToken,
    response,
    skip: ['interCompany', 'company'],
  });

  promises[promises.length] = VpbxSelectOptions({
    callback: (options) => {
      response.company = options;
    },
    cancelToken,
  });

  await Promise.all(promises);

  return response;
};
