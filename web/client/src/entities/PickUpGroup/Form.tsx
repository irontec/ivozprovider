import defaultEntityBehavior, { EntityFormProps } from 'lib/entities/DefaultEntityBehavior';
import { useEffect, useState } from 'react';
import UserSelectOptions from 'entities/User/SelectOptions';
import { PickUpGroupPropertyList } from './PickUpGroupProperties';

export const foreignKeyGetter = async (): Promise<any> => {

    const response: PickUpGroupPropertyList<Array<string | number>> = {};
    const promises: Array<Promise<unknown>> = [];

    promises[promises.length] = UserSelectOptions((options: any) => {
        response.userIds = options;
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