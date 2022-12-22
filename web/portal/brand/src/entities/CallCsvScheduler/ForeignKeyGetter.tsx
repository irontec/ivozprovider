import { ForeignKeyGetterType } from '@irontec/ivoz-ui/entities/EntityInterface';
import { autoSelectOptions } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { CallCsvSchedulerPropertyList } from './CallCsvSchedulerProperties';
import { CallCsvSelectOptions } from '../NotificationTemplate/SelectOptions';
import {
  VpbxSelectOptions,
  RetailSelectOptions,
  ResidentialSelectOptions,
  WholesaleSelectOptions,
} from '../Company/SelectOptions';

export const foreignKeyGetter: ForeignKeyGetterType = async ({
  cancelToken,
  entityService,
}): Promise<any> => {
  const response: CallCsvSchedulerPropertyList<unknown> = {};

  const promises = autoSelectOptions({
    entityService,
    cancelToken,
    response,
    skip: [
      'callCsvNotificationTemplate',
      'company',
      'vpbx',
      'retail',
      'residential',
      'wholesale',
      'ddi',
      'user',
      'fax',
      'friend',
      'retailAccount',
      'residentialDevice',
    ],
  });

  promises[promises.length] = CallCsvSelectOptions({
    callback: (options: any) => {
      response.callCsvNotificationTemplate = options;
    },
    cancelToken,
  });

  promises[promises.length] = VpbxSelectOptions({
    callback: (options: any) => {
      response.vpbx = options;
    },
    cancelToken,
  });

  promises[promises.length] = RetailSelectOptions({
    callback: (options: any) => {
      response.retail = options;
    },
    cancelToken,
  });

  promises[promises.length] = ResidentialSelectOptions({
    callback: (options: any) => {
      response.residential = options;
    },
    cancelToken,
  });

  promises[promises.length] = WholesaleSelectOptions({
    callback: (options: any) => {
      response.wholesale = options;
    },
    cancelToken,
  });

  await Promise.all(promises);

  return response;
};
