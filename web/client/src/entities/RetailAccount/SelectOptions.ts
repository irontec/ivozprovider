import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';

const RetailAccountSelectOptions = (callback: Function) => {

    defaultEntityBehavior.fetchFks(
        '/retail_accounts',
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

export default RetailAccountSelectOptions;