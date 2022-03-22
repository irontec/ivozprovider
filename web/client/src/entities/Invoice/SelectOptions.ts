import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';

const InvoiceSelectOptions: SelectOptionsType = ({ callback, cancelToken }): Promise<unknown> => {

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