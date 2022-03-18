import InvoiceSelectOptions from 'entities/Invoice/SelectOptions';
import { BillableCallPropertyList } from './BillableCallProperties';
import { ForeignKeyGetterType } from '@irontec/ivoz-ui/entities/EntityInterface';

export const foreignKeyGetter: ForeignKeyGetterType = async ({ cancelToken }): Promise<any> => {

    const response: BillableCallPropertyList<unknown> = {};
    const promises: Array<Promise<unknown>> = [];

    promises[promises.length] = InvoiceSelectOptions({
        callback: (options: any) => {
            response.invoice = options;
        },
        cancelToken
    });

    await Promise.all(promises);

    return response;
};