import defaultEntityBehavior from '../DefaultEntityBehavior';

const RoutingTagSelectOptions = (callback: Function) => {

    defaultEntityBehavior.fetchFks(
        '/routing_tag',
        ['id', 'name'],
        (data: any) => {

            const options: any = {};
            for (const item of data) {
                options[item.id] = item.name;
            }

            callback(options);
        }
    );
}

export default RoutingTagSelectOptions;