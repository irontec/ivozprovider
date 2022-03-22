import { IvrEntryPropertyList } from './IvrEntryProperties';
import { ForeignKeyGetterType } from '@irontec/ivoz-ui/entities/EntityInterface';
import { autoSelectOptions } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import entities from '../index';
import VoicemailSelectOptions from 'entities/Voicemail/SelectOptions';

export const foreignKeyGetter: ForeignKeyGetterType = async ({ cancelToken, entityService }): Promise<any> => {

    const response: IvrEntryPropertyList<Array<string | number>> = {};

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