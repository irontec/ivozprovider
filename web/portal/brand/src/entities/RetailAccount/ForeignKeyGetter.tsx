import { ForeignKeyGetterType } from '@irontec/ivoz-ui/entities/EntityInterface';
import { autoSelectOptions } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { RetailAccountPropertyList } from './RetailAccountProperties';
import { RetailSelectOptions } from '../Company/SelectOptions';
import { DropdownChoices } from '@irontec/ivoz-ui';

export const foreignKeyGetter: ForeignKeyGetterType = async ({
  cancelToken,
  entityService,
}): Promise<any> => {
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
