import defaultEntityBehavior from '../DefaultEntityBehavior';
import TerminalModelSelectOptions from '../TerminalModel/SelectOptions';
import { useEffect, useState } from 'react';

const Form = (props:any) => {

    const DefaultEntityForm = defaultEntityBehavior.Form;

    const [fkChoices, setFkChoices] = useState<any>({});
    const [, setMounted] = useState<boolean>(true);
    const [loadingFks, setLoadingFks] = useState<boolean>(true);

    useEffect(
        () => {
            if (loadingFks) {
                TerminalModelSelectOptions((options:any) => {
                    setFkChoices({
                        ...fkChoices,
                        terminalModel: options
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

    return (<DefaultEntityForm fkChoices={fkChoices} {...props}  />);
}

export default Form;