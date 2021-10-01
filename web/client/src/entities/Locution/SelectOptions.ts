import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';

const LocutionSelectOptions = (callback: Function) => {

    defaultEntityBehavior.fetchFks(
        '/locutions',
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

export default LocutionSelectOptions;