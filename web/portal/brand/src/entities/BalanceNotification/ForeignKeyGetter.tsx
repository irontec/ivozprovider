import { ForeignKeyGetterType } from '@irontec/ivoz-ui/entities/EntityInterface';
import { autoSelectOptions } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { BalanceNotificationPropertyList } from './BalanceNotificationProperties';
import { LowBalanceSelectOptions } from '../NotificationTemplate/SelectOptions';

/** TODO remove this file unless you need to change default behaviour **/
export const foreignKeyGetter: ForeignKeyGetterType = async ({
  cancelToken,
  entityService,
}): Promise<any> => {
  const response: BalanceNotificationPropertyList<unknown> = {};

  const promises = autoSelectOptions({
    entityService,
    cancelToken,
    response,
    skip: ['notificationTemplate'],
  });

  promises[promises.length] = LowBalanceSelectOptions({
    callback: (options: any) => {
      response.notificationTemplate = options;
    },
    cancelToken,
  });

  await Promise.all(promises);

  return response;
};
