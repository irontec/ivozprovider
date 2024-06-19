import { DropdownChoices } from '@irontec/ivoz-ui';
import { autoSelectOptions } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { ForeignKeyGetterType } from '@irontec/ivoz-ui/entities/EntityInterface';

import { ResidentialSelectOptions } from '../Company/SelectOptions';
import { ResidentialDevicePropertyList } from './ResidentialDeviceProperties';

/** TODO remove this file unless you need to change default behaviour **/
export const foreignKeyGetter: ForeignKeyGetterType = async ({
  cancelToken,
  entityService,
}): Promise<unknown> => {
  const response: ResidentialDevicePropertyList<unknown> = {};

  const promises = autoSelectOptions({
    entityService,
    cancelToken,
    response,
    skip: ['company'],
  });

  promises[promises.length] = ResidentialSelectOptions({
    callback: (options: DropdownChoices) => {
      response.company = options;
    },
    cancelToken,
  });

  await Promise.all(promises);

  return response;
};
