import defaultEntityBehavior from '../DefaultEntityBehavior';

const DdiProviderSelectOptions = (callback: Function) => {

    defaultEntityBehavior.fetchFks(
        '/extensions',
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

export default DdiProviderSelectOptions;