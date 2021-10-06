import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import { useEffect, useState } from 'react';
import UserSelectOptions from 'entities/User/SelectOptions';

const Form = (props: any) => {

    const DefaultEntityForm = defaultEntityBehavior.Form;

    const [fkChoices, setFkChoices] = useState<any>({});
    const [mounted, setMounted] = useState<boolean>(true);
    const [loadingFks, setLoadingFks] = useState<boolean>(true);

    useEffect(
        () => {
            if (mounted && loadingFks) {
                UserSelectOptions((options: any) => {
                    mounted && setFkChoices((fkChoices: any) => {
                        return {
                            ...fkChoices,
                            userIds: options,
                        }
                    });
                });

                setLoadingFks(false);
            }

            return function umount() {
                setMounted(false);
            };
        },
        [loadingFks, fkChoices]
    );

    return (<DefaultEntityForm fkChoices={fkChoices} {...props} />);
}

export default Form;