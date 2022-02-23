import { QueueMemberPropertyList } from './QueueMemberProperties';
import { ForeignKeyGetterType } from 'lib/entities/EntityInterface';
import { autoSelectOptions } from 'lib/entities/DefaultEntityBehavior';
import entities from '../index';

export const foreignKeyGetter: ForeignKeyGetterType = async ({ cancelToken, entityService }): Promise<any> => {

    const response: QueueMemberPropertyList<Array<string | number>> = {};

    const promises = autoSelectOptions({
        entities,
        entityService,
        cancelToken,
        response,
    });

    await Promise.all(promises);

    return response;
};