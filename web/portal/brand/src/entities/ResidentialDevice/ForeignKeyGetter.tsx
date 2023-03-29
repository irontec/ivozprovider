import { ForeignKeyGetterType } from '@irontec/ivoz-ui/entities/EntityInterface';
import { autoSelectOptions } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { ResidentialDevicePropertyList } from './ResidentialDeviceProperties';
import { ResidentialSelectOptions } from '../Company/SelectOptions';
import { DropdownChoices } from '@irontec/ivoz-ui';

/** TODO remove this file unless you need to change default behaviour **/
export const foreignKeyGetter: ForeignKeyGetterType = async ({
  cancelToken,
  entityService,
}): Promise<any> => {
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
