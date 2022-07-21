import { CallCsvSchedulerPropertyList } from './CallCsvSchedulerProperties';
import { ForeignKeyGetterType } from '@irontec/ivoz-ui/entities/EntityInterface';
import { autoSelectOptions } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import entities from '../index';

export const foreignKeyGetter: ForeignKeyGetterType = async ({
  cancelToken,
  entityService,
}): Promise<any> => {
  const response: CallCsvSchedulerPropertyList<unknown> = {};

  const promises = autoSelectOptions({
    entities,
    entityService,
    cancelToken,
    response,
  });

  await Promise.all(promises);

  return response;
};
