import { ForeignKeyGetterType } from 'lib/entities/EntityInterface';
import { autoSelectOptions } from 'lib/entities/DefaultEntityBehavior';
import entities from '../index';
import { HolidayDatePropertyList } from './HolidayDateProperties';
import VoicemailSelectOptions from 'entities/Voicemail/SelectOptions';

export const foreignKeyGetter: ForeignKeyGetterType = async ({ cancelToken, entityService }): Promise<any> => {

    const response: HolidayDatePropertyList<unknown> = {};

    const promises = autoSelectOptions({
        entities,
        entityService,
        cancelToken,
        response,
        skip: [
            'voicemail',
        ],
    });

    promises[promises.length] = VoicemailSelectOptions({
        callback: (options: any) => {
            response.voicemail = options;
        },
        cancelToken
    });

    await Promise.all(promises);

    return response;
};