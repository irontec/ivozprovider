import { autoSelectOptions } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { ForeignKeyGetterType } from '@irontec/ivoz-ui/entities/EntityInterface';

import CountryNameSelectOptions from '../Country/CountryNameSelectOptions';
import CompanyDdiSelectOptions from '../Ddi/SelectOptions/CompanyDdiSelectOptions';
import {
  CallCsvSelectOptions,
  FaxSelectOptions,
  InvoiceSelectOptions,
  MaxDailyUsageSelectOptions,
  VoicemailSelectOptions,
} from '../NotificationTemplate/SelectOptions';
import VirtualPbx from '../VirtualPbx/VirtualPbx';
import { CompanyPropertyList } from './CompanyProperties';
import { CorporationSelectOptions } from './SelectOptions';

export const foreignKeyGetter: ForeignKeyGetterType = async (
  props
): Promise<unknown> => {
  const { row, cancelToken, entityService, match } = props;
  const response: CompanyPropertyList<unknown> = {};

  const promises = autoSelectOptions({
    entityService,
    cancelToken,
    response,
    skip: [
      'outgoingDdi',
      'geoIpAllowedCountries',
      'voicemailNotificationTemplate',
      'faxNotificationTemplate',
      'invoiceNotificationTemplate',
      'callCsvNotificationTemplate',
      'maxDailyUsageNotificationTemplate',
      'corporation',
    ],
  });

  if (row?.id) {
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
  } else {
    response.outgoingDdi = [];
  }

  const isVpbx = match.pathname.includes(VirtualPbx.localPath);
  if (isVpbx) {
    promises[promises.length] = CorporationSelectOptions({
      callback: (options) => {
        response.corporation = options;
      },
      cancelToken,
    });
  }

  promises[promises.length] = CountryNameSelectOptions({
    callback: (options) => {
      response.geoIpAllowedCountries = options;
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
