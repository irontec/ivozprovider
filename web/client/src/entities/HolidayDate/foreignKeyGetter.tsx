import { ForeignKeyGetterType } from 'lib/entities/EntityInterface';
import { autoSelectOptions } from 'lib/entities/DefaultEntityBehavior';
import entities from '../index';
import { HolidayDatePropertyList } from './HolidayDateProperties';
import { VoicemailEnabledSelectOptions } from 'entities/User/SelectOptions';

export const foreignKeyGetter: ForeignKeyGetterType = async ({ cancelToken, entityService }): Promise<any> => {

    const response: HolidayDatePropertyList<unknown> = {};

    const promises = autoSelectOptions({
        entities,
        entityService,
        cancelToken,
        response,
        skip: [
            'voiceMailUser',
        ],
    });

    promises[promises.length] = VoicemailEnabledSelectOptions({
        callback: (options: any) => {
            response.voiceMailUser = options;
        },
        cancelToken
    });

    await Promise.all(promises);

    return response;
};