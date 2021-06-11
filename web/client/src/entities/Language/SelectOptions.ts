import defaultEntityBehavior from '../DefaultEntityBehavior';

const LanguageSelectOptions = (callback: Function) => {

    defaultEntityBehavior.fetchFks(
        '/languages',
        ['id', 'iden'], //@TODO replace iden by name
        (data:any) => {

            const options:any = {};
            for (const item of data) {
                options[item.id] = item.iden; //@TODO current langiage
            }

            callback(options);
        }
    );
}

export default LanguageSelectOptions;