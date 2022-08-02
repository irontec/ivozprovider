import { autoSelectOptions } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { ForeignKeyGetterType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';
import { QueueMemberPropertyList } from './QueueMemberProperties';

export const foreignKeyGetter: ForeignKeyGetterType = async ({
  cancelToken,
  entityService,
}): Promise<any> => {
  const response: QueueMemberPropertyList<Array<string | number>> = {};

  const entities = store.getState().entities.entities;
  const promises = autoSelectOptions({
    entities,
    entityService,
    cancelToken,
    response,
  });

  await Promise.all(promises);

  return response;
};
