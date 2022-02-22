import RatingPlanGroupSelectOptions from 'entities/RatingPlanGroup/SelectOptions';
import RoutingTagSelectOptions from 'entities/RoutingTag/SelectOptions';
import { RatingProfilePropertyList } from './RatingProfileProperties';
import { ForeignKeyGetterType } from 'lib/entities/EntityInterface';

export const foreignKeyGetter: ForeignKeyGetterType = async ({cancelToken}): Promise<any> => {

    const response: RatingProfilePropertyList<Array<string | number>> = {};
    const promises: Array<Promise<unknown>> = [];

    promises[promises.length] = RatingPlanGroupSelectOptions({
        callback: (options: any) => {
            response.ratingPlanGroup = options;
        },
        cancelToken
    });

    promises[promises.length] = RoutingTagSelectOptions({
        callback: (options: any) => {
            response.routingTag = options;
        },
        cancelToken
    });

    await Promise.all(promises);

    return response;
};