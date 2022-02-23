import { IvrPropertyList } from './IvrProperties';
import { ForeignKeyGetterType } from 'lib/entities/EntityInterface';
import entities from '../index';
import { autoSelectOptions } from 'lib/entities/DefaultEntityBehavior';

export const foreignKeyGetter: ForeignKeyGetterType = async ({ cancelToken, entityService }): Promise<any> => {

    const response: IvrPropertyList<Array<string | number>> = {};

    const promises = autoSelectOptions({
        entities,
        entityService,
        cancelToken,
        response,
    });

    await Promise.all(promises);

    return response;
};