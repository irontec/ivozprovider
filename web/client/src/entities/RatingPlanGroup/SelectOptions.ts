import { CancelToken } from 'axios';
import defaultEntityBehavior, { FetchFksCallback } from 'lib/entities/DefaultEntityBehavior';
import { getI18n } from 'react-i18next';
import RatingPlanGroup from './RatingPlanGroup';

const RatingPlanGroupSelectOptions = (callback: FetchFksCallback, cancelToken?: CancelToken): Promise<unknown> => {

    return defaultEntityBehavior.fetchFks(
        RatingPlanGroup.path,
        ['id', 'name'],
        (data: any) => {

            const options: any = {};
            for (const item of data) {
                const language = getI18n().language.substring(0, 2);
                options[item.id] = item.name[language];
            }

            callback(options);
        },
        cancelToken
    );
}

export default RatingPlanGroupSelectOptions;