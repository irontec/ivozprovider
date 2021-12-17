import defaultEntityBehavior, { EntityFormProps } from 'lib/entities/DefaultEntityBehavior';
import { useEffect, useState } from 'react';
import InvoiceSelectOptions from 'entities/Invoice/SelectOptions';
import DdiProviderSelectOptions from 'entities/DdiProvider/SelectOptions';
import { BillableCallPropertyList } from './BillableCallProperties';

export const foreignKeyGetter = async (): Promise<any> => {

    const response: BillableCallPropertyList<unknown> = {};
    const promises: Array<Promise<unknown>> = [];

    promises[promises.length] = InvoiceSelectOptions((options: any) => {
        response.invoice = options;
    });

    promises[promises.length] = DdiProviderSelectOptions((options: any) => {
        response.ddiProvider = options;
    });

    await Promise.all(promises);

    return response;
};


const Form = (props: EntityFormProps): JSX.Element => {

    const DefaultEntityForm = defaultEntityBehavior.Form;

    const [fkChoices, setFkChoices] = useState<any>({});
    const [mounted, setMounted] = useState<boolean>(true);
    const [loadingFks, setLoadingFks] = useState<boolean>(true);

    useEffect(
        () => {

            if (mounted && loadingFks) {

                foreignKeyGetter().then((options) => {
                    mounted && setFkChoices((fkChoices: any) => {
                        return {
                            ...fkChoices,
                            ...options
                        }
                    });
                });

                setLoadingFks(false);
            }

            return function umount() {
                setMounted(false);
            };
        },
        [mounted, loadingFks, fkChoices]
    );

    return (<DefaultEntityForm {...props} fkChoices={fkChoices} />);
}

export default Form;