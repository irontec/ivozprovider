import { autoSelectOptions } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { ForeignKeyGetterType } from '@irontec/ivoz-ui/entities/EntityInterface';

import { LowBalanceSelectOptions } from '../NotificationTemplate/SelectOptions';
import { BalanceNotificationPropertyList } from './BalanceNotificationProperties';

/** TODO remove this file unless you need to change default behaviour **/
export const foreignKeyGetter: ForeignKeyGetterType = async ({
  cancelToken,
  entityService,
}): Promise<unknown> => {
  const response: BalanceNotificationPropertyList<unknown> = {};

  const promises = autoSelectOptions({
    entityService,
    cancelToken,
    response,
    skip: ['notificationTemplate'],
  });

  promises[promises.length] = LowBalanceSelectOptions({
    callback: (options) => {
      response.notificationTemplate = options;
    },
    cancelToken,
  });

  await Promise.all(promises);

  return response;
};
