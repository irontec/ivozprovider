import { DropdownChoices } from '@irontec/ivoz-ui';
import { autoSelectOptions } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { ForeignKeyGetterType } from '@irontec/ivoz-ui/entities/EntityInterface';

import { RetailSelectOptions } from '../Company/SelectOptions';
import { RetailAccountPropertyList } from './RetailAccountProperties';

export const foreignKeyGetter: ForeignKeyGetterType = async ({
  cancelToken,
  entityService,
}): Promise<unknown> => {
  const response: RetailAccountPropertyList<unknown> = {};

  const promises = autoSelectOptions({
    entityService,
    cancelToken,
    response,
    skip: ['company'],
  });

  promises[promises.length] = RetailSelectOptions({
    callback: (options: DropdownChoices) => {
      response.company = options;
    },
    cancelToken,
  });

  await Promise.all(promises);

  return response;
};
