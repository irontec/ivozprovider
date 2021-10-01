import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';

const TerminalSelectOptions = (callback: Function) => {

    defaultEntityBehavior.fetchFks(
        '/terminals',
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

export default TerminalSelectOptions;