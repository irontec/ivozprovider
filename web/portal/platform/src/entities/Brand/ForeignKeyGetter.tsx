import { DropdownChoices } from '@irontec/ivoz-ui';
import { autoSelectOptions } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { ForeignKeyGetterType } from '@irontec/ivoz-ui/entities/EntityInterface';

import currencySelectOptions from '../Currency/SelectOptions';
import featureSelectOptions from '../Feature/SelectOptions';
import languageSelectOptions from '../Language/SelectOptions';
import {
  CallCsvSelectOptions,
  FaxSelectOptions,
  InvoiceSelectOptions,
  MaxDailyUsageSelectOptions,
  OnDemandRecordSelectOptions,
  VoicemailSelectOptions,
} from '../NotificationTemplate/SelectOptions';
import proxyTrunkSelectOptions from '../ProxyTrunk/SelectOptions';
import timezoneSelectOptions from '../Timezone/SelectOptions';
import { BrandPropertyList } from './BrandProperties';

export const foreignKeyGetter: ForeignKeyGetterType = async ({
  row,
  cancelToken,
  entityService,
}): Promise<BrandPropertyList<unknown>> => {
  const response: BrandPropertyList<unknown> = {};
  const brandId = row?.id as number | undefined;

  const promises = autoSelectOptions({
    entityService,
    cancelToken,
    response,
    skip: [
      'features',
      'proxyTrunks',
      'defaultTimazone',
      'language',
      'currency',
      'voicemailNotificationTemplate',
      'onDemandRecordNotificationTemplate',
      'faxNotificationTemplate',
      'invoiceNotificationTemplate',
      'callCsvNotificationTemplate',
      'maxDailyUsageNotificationTemplate',
    ],
  });

  promises[promises.length] = featureSelectOptions({
    callback: (options: DropdownChoices) => {
      response.features = options;
    },
    cancelToken,
  });

  promises[promises.length] = proxyTrunkSelectOptions({
    callback: (options: DropdownChoices) => {
      response.proxyTrunks = options;
    },
    cancelToken,
  });

  promises[promises.length] = timezoneSelectOptions({
    callback: (options: DropdownChoices) => {
      response.defaultTimezone = options;
    },
    cancelToken,
  });

  promises[promises.length] = languageSelectOptions({
    callback: (options: DropdownChoices) => {
      response.language = options;
    },
    cancelToken,
  });

  promises[promises.length] = currencySelectOptions({
    callback: (options: DropdownChoices) => {
      response.currency = options;
    },
    cancelToken,
  });

  if (brandId) {
    promises[promises.length] = VoicemailSelectOptions(
      {
        callback: (options: DropdownChoices) => {
          response.voicemailNotificationTemplate = options;
        },
        cancelToken,
      },
      { brandId }
    );

    promises[promises.length] = OnDemandRecordSelectOptions(
      {
        callback: (options: DropdownChoices) => {
          response.onDemandRecordNotificationTemplate = options;
        },
        cancelToken,
      },
      { brandId }
    );

    promises[promises.length] = FaxSelectOptions(
      {
        callback: (options: DropdownChoices) => {
          response.faxNotificationTemplate = options;
        },
        cancelToken,
      },
      { brandId }
    );

    promises[promises.length] = InvoiceSelectOptions(
      {
        callback: (options: DropdownChoices) => {
          response.invoiceNotificationTemplate = options;
        },
        cancelToken,
      },
      { brandId }
    );

    promises[promises.length] = CallCsvSelectOptions(
      {
        callback: (options: DropdownChoices) => {
          response.callCsvNotificationTemplate = options;
        },
        cancelToken,
      },
      { brandId }
    );

    promises[promises.length] = MaxDailyUsageSelectOptions(
      {
        callback: (options: DropdownChoices) => {
          response.maxDailyUsageNotificationTemplate = options;
        },
        cancelToken,
      },
      { brandId }
    );
  }

  await Promise.all(promises);

  return response;
};
