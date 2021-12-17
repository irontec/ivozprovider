import defaultEntityBehavior, { EntityFormProps, FieldsetGroups } from 'lib/entities/DefaultEntityBehavior';
import TerminalModelSelectOptions from '../TerminalModel/SelectOptions';
import { useEffect, useState } from 'react';
import _ from 'lib/services/translations/translate';
import { TerminalPropertyList } from './TerminalProperties';

export const foreignKeyGetter = async (): Promise<any> => {

    const response: TerminalPropertyList<Array<string | number>> = {};
    const promises: Array<Promise<unknown>> = [];

    promises[promises.length] = TerminalModelSelectOptions((options: any) => {
        response.terminalModel = options;
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

    const groups: Array<FieldsetGroups> = [
        {
            legend: _('Login Info'),
            fields: [
                'name',
                'password',
            ]
        },
        {
            legend: _('Connection Info'),
            fields: [
                'allowAudio',
                'allowVideo',
                'directMediaMethod',
                't38Passthrough',
                'rtpEncryption',
            ]
        },
        {
            legend: _('Provisioning Info'),
            fields: [
                'terminalModel',
                'mac',
                'lastProvisionDate'
            ]
        },
    ];

    return (<DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />);
}

export default Form;