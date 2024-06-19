import { autoSelectOptions } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { ForeignKeyGetterTypeArgs } from '@irontec/ivoz-ui/entities/EntityInterface';
import { EntityValues } from '@irontec/ivoz-ui/services/entity/EntityService';

import { UnassignedCompanySelectOptions } from '../Company/SelectOptions';
import { FriendPropertyList } from './FriendProperties';

type CompanyServiceForeignKeyGetterType = (
  props: ForeignKeyGetterTypeArgs,
  currentServiceId?: number
) => Promise<unknown>;

export const foreignKeyGetter: CompanyServiceForeignKeyGetterType = async ({
  cancelToken,
  filterContext,
  entityService,
  row,
}): Promise<unknown> => {
  const response: FriendPropertyList<unknown> = {};
  const promises = autoSelectOptions({
    entityService,
    cancelToken,
    response,
    skip: ['interCompany'],
  });

  if (!filterContext) {
    const _includeInterCompanyId = (row?.interCompany as EntityValues)
      ?.id as number;
    promises[promises.length] = UnassignedCompanySelectOptions(
      {
        callback: (options) => {
          response.interCompany = options;
        },
        cancelToken,
      },
      {
        _includeId: _includeInterCompanyId,
      }
    );
  }

  await Promise.all(promises);

  return response;
};
