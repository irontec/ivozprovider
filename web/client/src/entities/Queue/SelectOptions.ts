import defaultEntityBehavior from '../DefaultEntityBehavior';

const QueueSelectOptions = (callback: Function) => {

    defaultEntityBehavior.fetchFks(
        '/queues',
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

export default QueueSelectOptions;