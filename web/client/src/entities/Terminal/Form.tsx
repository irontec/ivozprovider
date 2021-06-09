import defaultEntityBehavior from '../DefaultEntityBehavior';
import { useEffect, useState } from 'react';

const Form = (props:any) => {

    const DefaultEntityForm = defaultEntityBehavior.Form;

    const [fkChoices, setFkChoices] = useState<any>({});
    const [mounted, setMounted] = useState<boolean>(true);
    const [loadingFks, setLoadingFks] = useState<boolean>(true);

    useEffect(
        () => {
            if (loadingFks) {
                if (!mounted || fkChoices?.terminalModel) {
                    return;
                }

                defaultEntityBehavior.fetchFks(
                    '/terminal_models',
                    ['id', 'name'],
                    (data:any) => {
                        if (!mounted) {
                            return;
                        }

                        const options:any = {};
                        for (const item of data) {
                            options[item.id] = item.name;
                        }

                        setFkChoices({
                            ...fkChoices,
                            terminalModel: options
                        });
                        setLoadingFks(false);
                    }
                );
            }

            return function umount() {
                setMounted(false);
            };
        },
        [loadingFks, mounted, fkChoices]
    );

    return (<DefaultEntityForm fkChoices={fkChoices} {...props}  />);
}

export default Form;