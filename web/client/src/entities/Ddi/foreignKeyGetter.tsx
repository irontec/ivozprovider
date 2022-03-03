import LanguageSelectOptions from 'entities/Language/SelectOptions';
import { DdiPropertyList } from './DdiProperties';
import { ForeignKeyGetterType } from 'lib/entities/EntityInterface';
import entities from '../index';
import { autoSelectOptions } from 'lib/entities/DefaultEntityBehavior';
import FeaturesRelCompanySelectOptions from 'entities/FeaturesRelCompany/SelectOptions';

export const foreignKeyGetter: ForeignKeyGetterType = async ({cancelToken, entityService}): Promise<any> => {

    const response: DdiPropertyList<unknown> = {};

    const promises = autoSelectOptions({
        entities,
        entityService,
        cancelToken,
        response,
        skip: [
            'language',
        ]
    });

    promises[promises.length] = LanguageSelectOptions({
        callback: (options: any) => {
            response.language = options;
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