import defaultEntityBehavior, { EntityFormProps, FieldsetGroups } from 'lib/entities/DefaultEntityBehavior';
import { useEffect, useState } from 'react';
import LocutionSelectOptions from 'entities/Locution/SelectOptions';
import CountrySelectOptions from 'entities/Country/SelectOptions';
import ExtensionSelectOptions from 'entities/Extension/SelectOptions';
import UserSelectOptions from 'entities/User/SelectOptions';
import _ from 'lib/services/translations/translate';
import { HuntGroupPropertyList } from './HuntGroupProperties';
import { ForeignKeyGetterType } from 'lib/entities/EntityInterface';
import axios, { CancelToken } from 'axios';

export const foreignKeyGetter: ForeignKeyGetterType = async (token?: CancelToken): Promise<any> => {

    const response: HuntGroupPropertyList<Array<string | number>> = {};
    const promises: Array<Promise<unknown>> = [];

    promises[promises.length] = LocutionSelectOptions(
        (options: any) => {
            response.noAnswerLocution = options;
        },
        token
    );

    promises[promises.length] = CountrySelectOptions(
        (options: any) => {
            response.noAnswerNumberCountry = options;
        },
        token
    );

    promises[promises.length] = ExtensionSelectOptions(
        (options: any) => {
            response.noAnswerExtension = options;
        },
        token
    );

    promises[promises.length] = UserSelectOptions(
        (options: any) => {
            response.noAnswerVoiceMailUser = options;
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
            legend: _('Basic Configuration'),
            fields: [
                'name',
                'description',
                'preventMissedCalls',
                'allowCallForwards',
                'strategy',
                'ringAllTimeout',
            ]
        },
        {
            legend: _('No answer configuration'),
            fields: [
                'noAnswerLocution',
                'noAnswerTargetType',
                'noAnswerNumberCountry',
                'noAnswerNumberValue',
                'noAnswerExtension',
                'noAnswerVoiceMailUser',
            ]
        },
    ];

    return (<DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />);
}

export default Form;