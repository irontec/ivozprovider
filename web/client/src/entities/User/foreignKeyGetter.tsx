import { UserPropertyList } from './UserProperties';
import { ForeignKeyGetterType } from '@irontec/ivoz-ui/entities/EntityInterface';
import { autoSelectOptions } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import entities from '../index';
import PickUpGroupSelectOptions from 'entities/PickUpGroup/SelectOptions';
import { UnassignedTerminalSelectOptions } from 'entities/Terminal/SelectOptions';
import { UnassignedExtensionSelectOptions } from 'entities/Extension/SelectOptions';
import { EntityValues } from '@irontec/ivoz-ui/services/entity/EntityService';
import { BossAssistantSelectOptions } from './SelectOptions';

export const foreignKeyGetter: ForeignKeyGetterType = async ({ cancelToken, entityService, row }): Promise<any> => {

    const response: UserPropertyList<unknown> = {};

    const promises = autoSelectOptions({
        entities,
        entityService,
        cancelToken,
        response,
        skip: [
            'terminal',
            'extension',
            'pickupGroupIds',
            'bossAssistant',
        ],
    });

    const _includeTerminalId = (row?.terminal as EntityValues)?.id as number;
    promises[promises.length] = UnassignedTerminalSelectOptions(
        {
            callback: (options: any) => {
                response.terminal = options;
            },
            cancelToken
        },
        {
            '_includeId': _includeTerminalId
        }
    );

    const _includeExtensionlId = (row?.extension as EntityValues)?.id as number;
    promises[promises.length] = UnassignedExtensionSelectOptions(
        {
            callback: (options: any) => {
                response.extension = options;
            },
            cancelToken
        },
        {
            '_includeId': _includeExtensionlId
        }
    );

    promises[promises.length] = PickUpGroupSelectOptions({
        callback: (options: any) => {
            response.pickupGroupIds = options;
        },
        cancelToken
    });

    const _excludeId = row?.id as number | undefined;
    promises[promises.length] = BossAssistantSelectOptions(
        {
            callback: (options: any) => {
                response.bossAssistant = options;
            },
            cancelToken
        },
        {
            '_excludeId': _excludeId
        }
    );

    await Promise.all(promises);

    return response;
};