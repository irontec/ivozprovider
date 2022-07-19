import { autoSelectOptions } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { ForeignKeyGetterType } from '@irontec/ivoz-ui/entities/EntityInterface';
import entities from '../index';
import { UserPropertyList } from '../User/UserProperties';

export const foreignKeyGetter: ForeignKeyGetterType = async ({
  cancelToken,
  entityService,
}): Promise<any> => {
  const response: UserPropertyList<unknown> = {};

  const promises = autoSelectOptions({
    entities,
    entityService,
    cancelToken,
    response,
    skip: [],
  });

  await Promise.all(promises);

  return response;
};
