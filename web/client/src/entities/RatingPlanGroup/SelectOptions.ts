import defaultEntityBehavior from '../DefaultEntityBehavior';
import { getI18n } from 'react-i18next';

const RatingPlanGroupSelectOptions = (callback: Function) => {

    defaultEntityBehavior.fetchFks(
        //@TODO add endpoint
        '/rating_plan_groups',
        ['id', 'name'],
        (data:any) => {

            const options:any = {};
            for (const item of data) {
                const language = getI18n().language;
                options[item.id] = item.name[language];
            }

            callback(options);
        }
    );
}

export default RatingPlanGroupSelectOptions;