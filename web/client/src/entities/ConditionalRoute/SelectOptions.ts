import defaultEntityBehavior from '../DefaultEntityBehavior';

const ConditionalRouteSelectOptions = (callback: Function) => {

    defaultEntityBehavior.fetchFks(
        '/conditional_routes',
        ['id', 'name'],
        (data:any) => {
            const options:any = {};
            for (const item of data) {
                options[item.id] = item.name;
            }

            callback(options);
        }
    );
}

export default ConditionalRouteSelectOptions;