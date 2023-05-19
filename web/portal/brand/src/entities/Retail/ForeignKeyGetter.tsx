import { autoSelectOptions } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { ForeignKeyGetterType } from '@irontec/ivoz-ui/entities/EntityInterface';

import { CompanyPropertyList } from '../Company/CompanyProperties';
import CountryNameSelectOptions from '../Country/CountryNameSelectOptions';
import CompanyDdiSelectOptions from '../Ddi/SelectOptions/CompanyDdiSelectOptions';
import RetailFeatureSelectOptions from '../Feature/SelectOptions/RetailFeatureSelectOptions';
import {
  CallCsvSelectOptions,
  FaxSelectOptions,
  InvoiceSelectOptions,
  MaxDailyUsageSelectOptions,
  VoicemailSelectOptions,
} from '../NotificationTemplate/SelectOptions';

export const foreignKeyGetter: ForeignKeyGetterType = async ({
  row,
  cancelToken,
  entityService,
}): Promise<unknown> => {
  const response: CompanyPropertyList<unknown> = {};

  const promises = autoSelectOptions({
    entityService,
    cancelToken,
    response,
    skip: [
      'outgoingDdi',
      'geoIpAllowedCountries',
      'featureIds',
      'voicemailNotificationTemplate',
      'faxNotificationTemplate',
      'invoiceNotificationTemplate',
      'callCsvNotificationTemplate',
      'maxDailyUsageNotificationTemplate',
    ],
  });

  promises[promises.length] = CompanyDdiSelectOptions(
    {
      callback: (options) => {
        response.outgoingDdi = options;
      },
      cancelToken,
    },
    {
      companyId: row?.id as number,
    }
  );

  promises[promises.length] = CountryNameSelectOptions({
    callback: (options) => {
      response.geoIpAllowedCountries = options;
    },
    cancelToken,
  });

  promises[promises.length] = RetailFeatureSelectOptions({
    callback: (options) => {
      response.featureIds = options;
    },
    cancelToken,
  });

  promises[promises.length] = VoicemailSelectOptions({
    callback: (options) => {
      response.voicemailNotificationTemplate = options;
    },
    cancelToken,
  });

  promises[promises.length] = FaxSelectOptions({
    callback: (options) => {
      response.faxNotificationTemplate = options;
    },
    cancelToken,
  });

  promises[promises.length] = InvoiceSelectOptions({
    callback: (options) => {
      response.invoiceNotificationTemplate = options;
    },
    cancelToken,
  });

  promises[promises.length] = CallCsvSelectOptions({
    callback: (options) => {
      response.callCsvNotificationTemplate = options;
    },
    cancelToken,
  });

  promises[promises.length] = MaxDailyUsageSelectOptions({
    callback: (options) => {
      response.maxDailyUsageNotificationTemplate = options;
    },
    cancelToken,
  });

  await Promise.all(promises);

  return response;
};
