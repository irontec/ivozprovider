import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import { SelectOptionsType } from 'lib/entities/EntityInterface';
import { getI18n } from 'react-i18next';

const TransformationRuleSetSelectOptions: SelectOptionsType = ({callback, cancelToken}): Promise<unknown> => {

    return defaultEntityBehavior.fetchFks(
        '/transformation_rule_sets',
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

export default TransformationRuleSetSelectOptions;