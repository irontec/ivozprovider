import defaultEntityBehavior, { FetchFksCallback } from 'lib/entities/DefaultEntityBehavior';
import Ddi from './Ddi';

const DdiSelectOptions = (callback: FetchFksCallback): Promise<unknown> => {

    return defaultEntityBehavior.fetchFks(
        Ddi.path,
        ['id', 'ddie164'],
        (data: any) => {

            const options: any = {};
            for (const item of data) {
                options[item.id] = item.ddie164;
            }

            callback(options);
        }
    );
}

export default DdiSelectOptions;