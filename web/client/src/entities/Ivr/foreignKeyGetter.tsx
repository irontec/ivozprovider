import { IvrPropertyList } from './IvrProperties';
import { ForeignKeyGetterType } from 'lib/entities/EntityInterface';
import entities from '../index';
import { autoSelectOptions } from 'lib/entities/DefaultEntityBehavior';
import ExtensionSelectOptions from 'entities/Extension/SelectOptions';
import { VoicemailEnabledSelectOptions } from 'entities/User/SelectOptions';

export const foreignKeyGetter: ForeignKeyGetterType = async ({ cancelToken, entityService }): Promise<any> => {

    const response: IvrPropertyList<Array<string | number>> = {};

    const promises = autoSelectOptions({
        entities,
        entityService,
        cancelToken,
        response,
        skip: [
            'noInputExtension',
            'errorExtension',
            'excludedExtensionIds',

            'noInputVoiceMailUser',
            'errorVoiceMailUser',
        ],
    });

    promises[promises.length] = ExtensionSelectOptions({
        callback: (options: any) => {
            response.noInputExtension = options;
            response.errorExtension = options;
            response.excludedExtensionIds = options;
        },
        cancelToken
    });

    promises[promises.length] = VoicemailEnabledSelectOptions({
        callback: (options: any) => {
            response.noInputVoiceMailUser = options;
            response.errorVoiceMailUser = options;
        },
        cancelToken
    });

    await Promise.all(promises);

    return response;
};