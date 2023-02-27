import { ForeignKeyGetterType } from '@irontec/ivoz-ui/entities/EntityInterface';
import { autoSelectOptions } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { BrandPropertyList } from './BrandProperties';
import featureSelectOptions from '../Feature/SelectOptions';
import proxyTrunkSelectOptions from '../ProxyTrunk/SelectOptions';
import timezoneSelectOptions from '../Timezone/SelectOptions';
import languageSelectOptions from '../Language/SelectOptions';
import currencySelectOptions from '../Currency/SelectOptions';
import { DropdownChoices } from '@irontec/ivoz-ui';

export const foreignKeyGetter: ForeignKeyGetterType = async ({
  cancelToken,
  entityService,
}): Promise<BrandPropertyList<unknown>> => {
  const response: BrandPropertyList<unknown> = {};

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

  await Promise.all(promises);

  return response;
};
