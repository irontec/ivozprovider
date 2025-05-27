import { autoSelectOptions } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { ForeignKeyGetterType } from '@irontec/ivoz-ui/entities/EntityInterface';

import CountryNameSelectOptions from '../Country/CountryNameSelectOptions';
import CompanyDdiSelectOptions from '../Ddi/SelectOptions/CompanyDdiSelectOptions';
import { ResidentialFeatureSelectOptions } from '../Feature/SelectOptions';
import RetailFeatureSelectOptions from '../Feature/SelectOptions/RetailFeatureSelectOptions';
import FeatureSelectOptions from '../Feature/SelectOptions/SelectOptions';
import CompanyLocationSelectOptions from '../Location/SelectOptions/CompanyLocationSelectOptions';
import {
  AccessCredentialSelectOptions,
  CallCsvSelectOptions,
  FaxSelectOptions,
  InvoiceSelectOptions,
  MaxDailyUsageSelectOptions,
  VoicemailSelectOptions,
} from '../NotificationTemplate/SelectOptions';
import Residential from '../Residential/Residential';
import Retail from '../Retail/Retail';
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
      'accessCredentialNotificationTemplate',
      'corporation',
      'featureIds',
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

  if (isVpbx && row?.id) {
    promises[promises.length] = CompanyLocationSelectOptions(
      {
        callback: (options) => {
          response.location = options;
        },
        cancelToken,
      },
      {
        companyId: row?.id as number,
      }
    );
  }

  const isResidential = match.pathname.includes(
    Residential.localPath ?? Residential.path
  );

  const isRetail = match.pathname.includes(Retail.localPath ?? Retail.path);

  if (isResidential) {
    promises[promises.length] = ResidentialFeatureSelectOptions({
      callback: (options) => {
        response.featureIds = options;
      },
      cancelToken,
    });
  } else if (isRetail) {
    promises[promises.length] = RetailFeatureSelectOptions({
      callback: (options) => {
        response.featureIds = options;
      },
      cancelToken,
    });
  } else {
    promises[promises.length] = FeatureSelectOptions({
      callback: (options) => {
        response.featureIds = options;
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

  promises[promises.length] = AccessCredentialSelectOptions({
    callback: (options) => {
      response.accessCredentialNotificationTemplate = options;
    },
    cancelToken,
  });

  await Promise.all(promises);

  return response;
};
