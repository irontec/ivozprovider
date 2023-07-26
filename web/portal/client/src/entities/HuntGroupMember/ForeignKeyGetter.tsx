import { autoSelectOptions } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { ForeignKeyGetterType } from '@irontec/ivoz-ui/entities/EntityInterface';
import { EntityValues } from '@irontec/ivoz-ui/services/entity/EntityService';

import HuntGroupAvailableSelectOptions from '../User/SelectOptions/HuntGroupAvailableSelectOptions';
import { HuntGroupMemberPropertyList } from './HuntGroupMemberProperties';

export const foreignKeyGetter: ForeignKeyGetterType = async (
  props
): Promise<unknown> => {
  const { cancelToken, entityService, match, filterContext } = props;
  const row:
    | HuntGroupMemberPropertyList<string | number | EntityValues>
    | undefined = props.row;
  const response: HuntGroupMemberPropertyList<
    null | string | number | EntityValues
  > = {};

  const skip = [];
  if (!filterContext) {
    skip.push(...['user']);
  }

  const promises = autoSelectOptions({
    entityService,
    cancelToken,
    response,
    skip,
  });

  if (!filterContext) {
    promises[promises.length] = HuntGroupAvailableSelectOptions(
      {
        callback: (options) => {
          response.user = options;
        },
        cancelToken,
      },
      {
        row,
        match,
      }
    );
  }

  await Promise.all(promises);

  switch (row?.routeType) {
    case 'user':
      response.target = { user: row.user as EntityValues };
      break;
    case 'number':
      response.target = {
        numberCountry: row?.numberCountry as EntityValues,
        numberValue: row?.numberValue as string,
      };
      break;
  }

  return response;
};
