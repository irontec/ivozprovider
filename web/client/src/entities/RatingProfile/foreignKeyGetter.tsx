import RatingPlanGroupSelectOptions from 'entities/RatingPlanGroup/SelectOptions';
import RoutingTagSelectOptions from 'entities/RoutingTag/SelectOptions';
import { RatingProfilePropertyList } from './RatingProfileProperties';
import { CancelToken } from 'axios';
import { ForeignKeyGetterType } from 'lib/entities/EntityInterface';

export const foreignKeyGetter: ForeignKeyGetterType = async (token?: CancelToken): Promise<any> => {

    const response: RatingProfilePropertyList<Array<string | number>> = {};
    const promises: Array<Promise<unknown>> = [];

    promises[promises.length] = RatingPlanGroupSelectOptions(
        (options: any) => {
            response.ratingPlanGroup = options;
        },
        token
    );

    promises[promises.length] = RoutingTagSelectOptions(
        (options: any) => {
            response.routingTag = options;
        },
        token
    );

    await Promise.all(promises);

    return response;
};