import { ExtensionPropertyList } from './ExtensionProperties';
import { ForeignKeyGetterType } from '@irontec/ivoz-ui/entities/EntityInterface';
import { autoSelectOptions } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import entities from '../index';
import FeaturesRelCompanySelectOptions from 'entities/FeaturesRelCompany/SelectOptions';

export const foreignKeyGetter: ForeignKeyGetterType = async (
    { cancelToken, entityService }
): Promise<any> => {

    const response: ExtensionPropertyList<Array<string | number>> = {};

    const promises = autoSelectOptions({
        entities,
        entityService,
        cancelToken,
        response,
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