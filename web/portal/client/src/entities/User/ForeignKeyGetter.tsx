import { autoSelectOptions } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { ForeignKeyGetterType } from '@irontec/ivoz-ui/entities/EntityInterface';
import { EntityValues } from '@irontec/ivoz-ui/services/entity/EntityService';

import {
  UnassignedExtensionSelectOptions,
  UserExtensionSelectOptions,
} from '../Extension/SelectOptions';
import PickUpGroupSelectOptions from '../PickUpGroup/SelectOptions';
import { UnassignedTerminalSelectOptions } from '../Terminal/SelectOptions';
import { BossAssistantSelectOptions } from './SelectOptions';
import { UserPropertyList } from './UserProperties';

export const foreignKeyGetter: ForeignKeyGetterType = async ({
  cancelToken,
  entityService,
  row,
  filterContext,
}): Promise<unknown> => {
  const response: UserPropertyList<unknown> = {};

  const skip = ['pickupGroupIds', 'bossAssistant', 'extension'];

  if (!filterContext) {
    skip.push(...['terminal']);
  }

  const promises = autoSelectOptions({
    entityService,
    cancelToken,
    response,
    skip,
  });

  if (filterContext) {
    promises[promises.length] = UserExtensionSelectOptions({
      callback: (options) => {
        response.extension = options;
      },
      cancelToken,
    });
  } else {
    const _includeTerminalId = (row?.terminal as EntityValues)?.id as number;
    promises[promises.length] = UnassignedTerminalSelectOptions(
      {
        callback: (options) => {
          response.terminal = options;
        },
        cancelToken,
      },
      {
        _includeId: _includeTerminalId,
      }
    );

    const _includeExtensionlId = (row?.extension as EntityValues)?.id as number;
    promises[promises.length] = UnassignedExtensionSelectOptions(
      {
        callback: (options) => {
          response.extension = options;
        },
        cancelToken,
      },
      {
        _includeId: _includeExtensionlId,
      }
    );
  }

  promises[promises.length] = PickUpGroupSelectOptions({
    callback: (options) => {
      response.pickupGroupIds = options;
    },
    cancelToken,
  });

  const _excludeId = row?.id as number | undefined;
  promises[promises.length] = BossAssistantSelectOptions(
    {
      callback: (options) => {
        response.bossAssistant = options;
      },
      cancelToken,
    },
    {
      _excludeId: _excludeId,
    }
  );

  await Promise.all(promises);

  return response;
};
