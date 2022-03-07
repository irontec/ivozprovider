import { ConditionalRoutePropertyList } from './ConditionalRouteProperties';
import { ForeignKeyGetterType } from 'lib/entities/EntityInterface';
import { autoSelectOptions } from 'lib/entities/DefaultEntityBehavior';
import entities from '../index';
import FeaturesRelCompanySelectOptions from 'entities/FeaturesRelCompany/SelectOptions';
import { VoicemailEnabledSelectOptions } from 'entities/User/SelectOptions';

export const foreignKeyGetter: ForeignKeyGetterType = async ({ cancelToken, entityService }): Promise<any> => {

    const response: ConditionalRoutePropertyList<unknown> = {};

    const promises = autoSelectOptions({
        entities,
        entityService,
        cancelToken,
        response,
        skip: [
            'voicemailUser',
        ],
    });

    promises[promises.length] = VoicemailEnabledSelectOptions({
        callback: (options: any) => {
            response.voicemailUser = options;
        },
        cancelToken
    });

    promises[promises.length] = FeaturesRelCompanySelectOptions(
        {
            callback: (options: any) => {
                response.companyFeatures = options;
            },
            cancelToken
        }
    );

    await Promise.all(promises);

    return response;
};