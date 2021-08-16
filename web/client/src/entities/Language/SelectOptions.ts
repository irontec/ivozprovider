import defaultEntityBehavior from '../DefaultEntityBehavior';
import { getI18n } from 'react-i18next';

const LanguageSelectOptions = (callback: Function) => {

    defaultEntityBehavior.fetchFks(
        '/languages',
        ['id', 'name'],
        (data:any) => {
            const options:any = {};
            const language = getI18n().language;
            for (const item of data) {
                options[item.id] = item.name[language];
            }

            callback(options);
        }
    );
}

export default LanguageSelectOptions;