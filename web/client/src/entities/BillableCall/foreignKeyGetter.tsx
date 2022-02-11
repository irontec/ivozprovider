import InvoiceSelectOptions from 'entities/Invoice/SelectOptions';
import { BillableCallPropertyList } from './BillableCallProperties';
import { ForeignKeyGetterType } from 'lib/entities/EntityInterface';
import { CancelToken } from 'axios';

export const foreignKeyGetter: ForeignKeyGetterType = async (token?: CancelToken): Promise<any> => {

    const response: BillableCallPropertyList<unknown> = {};
    const promises: Array<Promise<unknown>> = [];

    promises[promises.length] = InvoiceSelectOptions(
        (options: any) => {
            response.invoice = options;
        },
        token
    );

    await Promise.all(promises);

    return response;
};