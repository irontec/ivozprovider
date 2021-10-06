import defaultEntityBehavior, { FetchFksCallback } from 'lib/entities/DefaultEntityBehavior';

const RoutingTagSelectOptions = (callback: FetchFksCallback) => {

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