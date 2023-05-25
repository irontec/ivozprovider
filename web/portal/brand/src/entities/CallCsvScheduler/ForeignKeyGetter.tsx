import { autoSelectOptions } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { ForeignKeyGetterType } from '@irontec/ivoz-ui/entities/EntityInterface';

import {
  ResidentialSelectOptions,
  RetailSelectOptions,
  VpbxSelectOptions,
  WholesaleSelectOptions,
} from '../Company/SelectOptions';
import { CallCsvSelectOptions } from '../NotificationTemplate/SelectOptions';
import { CallCsvSchedulerPropertyList } from './CallCsvSchedulerProperties';

export const foreignKeyGetter: ForeignKeyGetterType = async ({
  cancelToken,
  entityService,
}): Promise<unknown> => {
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
    callback: (options) => {
      response.callCsvNotificationTemplate = options;
    },
    cancelToken,
  });

  promises[promises.length] = VpbxSelectOptions({
    callback: (options) => {
      response.vpbx = options;
    },
    cancelToken,
  });

  promises[promises.length] = RetailSelectOptions({
    callback: (options) => {
      response.retail = options;
    },
    cancelToken,
  });

  promises[promises.length] = ResidentialSelectOptions({
    callback: (options) => {
      response.residential = options;
    },
    cancelToken,
  });

  promises[promises.length] = WholesaleSelectOptions({
    callback: (options) => {
      response.wholesale = options;
    },
    cancelToken,
  });

  await Promise.all(promises);

  return response;
};
