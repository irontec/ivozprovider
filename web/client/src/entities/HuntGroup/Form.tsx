import defaultEntityBehavior, { EntityFormProps, FieldsetGroups } from 'lib/entities/DefaultEntityBehavior';
import { useEffect, useState } from 'react';
import LocutionSelectOptions from 'entities/Locution/SelectOptions';
import CountrySelectOptions from 'entities/Country/SelectOptions';
import ExtensionSelectOptions from 'entities/Extension/SelectOptions';
import UserSelectOptions from 'entities/User/SelectOptions';
import _ from 'lib/services/translations/translate';
import { HuntGroupPropertyList } from './HuntGroupProperties';

export const foreignKeyGetter = async (): Promise<any> => {

    const response: HuntGroupPropertyList<Array<string | number>> = {};
    const promises: Array<Promise<unknown>> = [];

    promises[promises.length] = LocutionSelectOptions((options: any) => {
        response.noAnswerLocution = options;
    });

    promises[promises.length] = CountrySelectOptions((options: any) => {
        response.noAnswerNumberCountry = options;
    });

    promises[promises.length] = ExtensionSelectOptions((options: any) => {
        response.noAnswerExtension = options;
    });

    promises[promises.length] = UserSelectOptions((options: any) => {
        response.noAnswerVoiceMailUser = options;
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