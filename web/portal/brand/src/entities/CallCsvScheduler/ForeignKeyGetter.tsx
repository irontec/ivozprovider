import { ForeignKeyGetterType } from '@irontec/ivoz-ui/entities/EntityInterface';
import { autoSelectOptions } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { CallCsvSchedulerPropertyList } from './CallCsvSchedulerProperties';
import { CallCsvSelectOptions } from '../NotificationTemplate/SelectOptions';

/** TODO remove this file unless you need to change default behaviour **/
export const foreignKeyGetter: ForeignKeyGetterType = async ({
  cancelToken,
  entityService,
}): Promise<any> => {
  const response: CallCsvSchedulerPropertyList<unknown> = {};

  const promises = autoSelectOptions({
    entityService,
    cancelToken,
    response,
    skip: ['callCsvNotificationTemplate'],
  });

  promises[promises.length] = CallCsvSelectOptions({
    callback: (options: any) => {
      response.callCsvNotificationTemplate = options;
    },
    cancelToken,
  });

  await Promise.all(promises);

  return response;
};
