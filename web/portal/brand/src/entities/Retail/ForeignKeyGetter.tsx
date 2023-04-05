import { ForeignKeyGetterType } from '@irontec/ivoz-ui/entities/EntityInterface';
import { autoSelectOptions } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { CompanyPropertyList } from '../Company/CompanyProperties';
import CountryNameSelectOptions from '../Country/CountryNameSelectOptions';
import RetailFeatureSelectOptions from '../Feature/SelectOptions/RetailFeatureSelectOptions';
import CompanyDdiSelectOptions from '../Ddi/SelectOptions/CompanyDdiSelectOptions';

import {
  CallCsvSelectOptions,
  FaxSelectOptions,
  InvoiceSelectOptions,
  VoicemailSelectOptions,
  MaxDailyUsageSelectOptions,
} from '../NotificationTemplate/SelectOptions';

export const foreignKeyGetter: ForeignKeyGetterType = async ({
  row,
  cancelToken,
  entityService,
}): Promise<any> => {
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
      callback: (options: any) => {
        response.outgoingDdi = options;
      },
      cancelToken,
    },
    {
      companyId: row?.id as number,
    }
  );

  promises[promises.length] = CountryNameSelectOptions({
    callback: (options: any) => {
      response.geoIpAllowedCountries = options;
    },
    cancelToken,
  });

  promises[promises.length] = RetailFeatureSelectOptions({
    callback: (options: any) => {
      response.featureIds = options;
    },
    cancelToken,
  });

  promises[promises.length] = VoicemailSelectOptions({
    callback: (options: any) => {
      response.voicemailNotificationTemplate = options;
    },
    cancelToken,
  });

  promises[promises.length] = FaxSelectOptions({
    callback: (options: any) => {
      response.faxNotificationTemplate = options;
    },
    cancelToken,
  });

  promises[promises.length] = InvoiceSelectOptions({
    callback: (options: any) => {
      response.invoiceNotificationTemplate = options;
    },
    cancelToken,
  });

  promises[promises.length] = CallCsvSelectOptions({
    callback: (options: any) => {
      response.callCsvNotificationTemplate = options;
    },
    cancelToken,
  });

  promises[promises.length] = MaxDailyUsageSelectOptions({
    callback: (options: any) => {
      response.maxDailyUsageNotificationTemplate = options;
    },
    cancelToken,
  });

  await Promise.all(promises);

  return response;
};
