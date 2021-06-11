import defaultEntityBehavior from '../DefaultEntityBehavior';

const TransformationRuleSetSelectOptions = (callback: Function) => {

    defaultEntityBehavior.fetchFks(
        '/transformation_rule_sets',
        ['id', 'areaCode'], //@TODO request name
        (data:any) => {

            const options:any = {};
            for (const item of data) {
                options[item.id] = item.areaCode; //@TODO use name
            }

            callback(options);
        }
    );
}

export default TransformationRuleSetSelectOptions;