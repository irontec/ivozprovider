import { HuntGroupPropertyList } from './HuntGroupProperties';
import { ForeignKeyGetterType } from 'lib/entities/EntityInterface';
import { autoSelectOptions } from 'lib/entities/DefaultEntityBehavior';
import entities from '../index';
import VoicemailSelectOptions from 'entities/Voicemail/SelectOptions';

export const foreignKeyGetter: ForeignKeyGetterType = async ({ cancelToken, entityService }): Promise<any> => {

    const response: HuntGroupPropertyList<Array<string | number>> = {};

    const promises = autoSelectOptions({
        entities,
        entityService,
        cancelToken,
        response,
        skip: [
            'noAnswerVoicemail'
        ],
    });

    promises[promises.length] = VoicemailSelectOptions({
        callback: (options: any) => {
            response.noAnswerVoicemail= options;
        },
        cancelToken
    });

    await Promise.all(promises);

    return response;
};