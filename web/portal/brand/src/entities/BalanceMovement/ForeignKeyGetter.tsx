import { autoSelectOptions } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { ForeignKeyGetterType } from '@irontec/ivoz-ui/entities/EntityInterface';

import { BalanceMovementPropertyList } from './BalanceMovementProperties';

/** TODO remove this file unless you need to change default behaviour **/
export const foreignKeyGetter: ForeignKeyGetterType = async ({
  cancelToken,
  entityService,
}): Promise<unknown> => {
  const response: BalanceMovementPropertyList<unknown> = {};

  const promises = autoSelectOptions({
    entityService,
    cancelToken,
    response,
    skip: [],
  });

  await Promise.all(promises);

  return response;
};
