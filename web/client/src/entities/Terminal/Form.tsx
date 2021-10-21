import defaultEntityBehavior, { EntityFormProps, FieldsetGroups } from 'lib/entities/DefaultEntityBehavior';
import TerminalModelSelectOptions from '../TerminalModel/SelectOptions';
import { useEffect, useState } from 'react';
import _ from 'lib/services/translations/translate';

const Form = (props: EntityFormProps): JSX.Element => {

    const DefaultEntityForm = defaultEntityBehavior.Form;

    const [fkChoices, setFkChoices] = useState<any>({});
    const [mounted, setMounted] = useState<boolean>(true);
    const [loadingFks, setLoadingFks] = useState<boolean>(true);

    useEffect(
        () => {
            if (mounted && loadingFks) {
                TerminalModelSelectOptions((options: any) => {
                    mounted && setFkChoices((fkChoices: any) => {
                        return {
                            ...fkChoices,
                            terminalModel: options
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