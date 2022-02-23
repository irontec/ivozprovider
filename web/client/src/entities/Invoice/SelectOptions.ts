import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import { SelectOptionsType } from 'lib/entities/EntityInterface';

const InvoiceSelectOptions: SelectOptionsType = ({callback, cancelToken}): Promise<unknown> => {

    return defaultEntityBehavior.fetchFks(
        '/invoices',
        ['id', 'number'],
        (data: any) => {
            const options: any = {};
            for (const item of data) {
                options[item.id] = item.number;
            }

            callback(options);
        },
        cancelToken
    );
}

export default InvoiceSelectOptions;