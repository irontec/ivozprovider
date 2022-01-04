import defaultEntityBehavior, { EntityFormProps, FieldsetGroups } from 'lib/entities/DefaultEntityBehavior';
import TerminalModelSelectOptions from '../TerminalModel/SelectOptions';
import { useEffect, useState } from 'react';
import _ from 'lib/services/translations/translate';
import { TerminalPropertyList } from './TerminalProperties';
import axios, { CancelToken } from 'axios';
import { ForeignKeyGetterType } from 'lib/entities/EntityInterface';

export const foreignKeyGetter: ForeignKeyGetterType = async (token?: CancelToken): Promise<any> => {

    const response: TerminalPropertyList<Array<string | number>> = {};
    const promises: Array<Promise<unknown>> = [];

    promises[promises.length] = TerminalModelSelectOptions(
        (options: any) => {
            response.terminalModel = options;
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