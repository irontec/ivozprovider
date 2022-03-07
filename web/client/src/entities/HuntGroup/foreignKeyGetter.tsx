import { HuntGroupPropertyList } from './HuntGroupProperties';
import { ForeignKeyGetterType } from 'lib/entities/EntityInterface';
import { autoSelectOptions } from 'lib/entities/DefaultEntityBehavior';
import entities from '../index';
import { VoicemailEnabledSelectOptions } from 'entities/User/SelectOptions';

export const foreignKeyGetter: ForeignKeyGetterType = async ({ cancelToken, entityService }): Promise<any> => {

    const response: HuntGroupPropertyList<Array<string | number>> = {};

    const promises = autoSelectOptions({
        entities,
        entityService,
        cancelToken,
        response,
        skip: [
            'noAnswerVoiceMailUser'
        ],
    });

    promises[promises.length] = VoicemailEnabledSelectOptions({
        callback: (options: any) => {
            response.noAnswerVoiceMailUser = options;
        },
        cancelToken
    });

    await Promise.all(promises);

    return response;
};