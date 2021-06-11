import defaultEntityBehavior from '../DefaultEntityBehavior';

const TerminalModelSelectOptions = (callback: Function) => {

    defaultEntityBehavior.fetchFks(
        '/terminal_models',
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

export default TerminalModelSelectOptions;