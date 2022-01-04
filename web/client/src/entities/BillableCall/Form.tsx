import defaultEntityBehavior, { EntityFormProps } from 'lib/entities/DefaultEntityBehavior';
import { useEffect, useState } from 'react';
import InvoiceSelectOptions from 'entities/Invoice/SelectOptions';
import { BillableCallPropertyList } from './BillableCallProperties';
import { ForeignKeyGetterType } from 'lib/entities/EntityInterface';
import axios, { CancelToken } from 'axios';

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


const Form = (props: EntityFormProps): JSX.Element => {

    const DefaultEntityForm = defaultEntityBehavior.Form;
    const [fkChoices, setFkChoices] = useState<any>({});

    useEffect(
        () => {

            let mounted = true;

            const CancelToken = axios.CancelToken;
            const source = CancelToken.source();

            foreignKeyGetter(source.token).then((options) => {

                if (!mounted) {
                    return;
                }

                setFkChoices((fkChoices: any) => {
                    return {
                        ...fkChoices,
                        ...options
                    }
                });
            });


            return () => {
                mounted = false;
                source.cancel();
            }
        },
        []
    );

    return (<DefaultEntityForm {...props} fkChoices={fkChoices} />);
}

export default Form;