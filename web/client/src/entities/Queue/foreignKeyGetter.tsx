import { QueuePropertyList } from './QueueProperties';
import { ForeignKeyGetterType } from 'lib/entities/EntityInterface';
import { autoSelectOptions } from 'lib/entities/DefaultEntityBehavior';
import entities from '../index';
import VoicemailSelectOptions from 'entities/Voicemail/SelectOptions';

export const foreignKeyGetter: ForeignKeyGetterType = async ({ cancelToken, entityService }): Promise<any> => {

    const response: QueuePropertyList<Array<string | number>> = {};

    const promises = autoSelectOptions({
        entities,
        entityService,
        cancelToken,
        response,
        skip: [
            'timeoutVoicemail',
            'fullVoicemail',
        ]
    });

    promises[promises.length] = VoicemailSelectOptions({
        callback: (options: any) => {
            response.timeoutVoicemail = options;
            response.fullVoicemail = options;
        },
        cancelToken
    });

    await Promise.all(promises);

    return response;
};