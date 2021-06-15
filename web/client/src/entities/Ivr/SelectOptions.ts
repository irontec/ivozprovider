import defaultEntityBehavior from '../DefaultEntityBehavior';

const IvrSelectOptions = (callback: Function) => {

    defaultEntityBehavior.fetchFks(
        '/ivrs',
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

export default IvrSelectOptions;