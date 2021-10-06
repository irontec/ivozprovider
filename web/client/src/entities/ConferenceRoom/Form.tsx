import defaultEntityBehavior, { FieldsetGroups } from 'lib/entities/DefaultEntityBehavior';
import { useEffect, useState } from 'react';
import CallAclSelectOptions from 'entities/CallAcl/SelectOptions';
import TransformationRuleSetSelectOptions from 'entities/TransformationRuleSet/SelectOptions';
import DdiSelectOptions from 'entities/Ddi/SelectOptions';
import LanguageSelectOptions from 'entities/Language/SelectOptions';
import _ from 'lib/services/translations/translate';

const Form = (props: any) => {

    const DefaultEntityForm = defaultEntityBehavior.Form;

    const [fkChoices, setFkChoices] = useState<any>({});
    const [mounted, setMounted] = useState<boolean>(true);
    const [loadingFks, setLoadingFks] = useState<boolean>(true);

    useEffect(
        () => {
            if (mounted && loadingFks) {

                CallAclSelectOptions((options: any) => {
                    mounted && setFkChoices((fkChoices: any) => {
                        return {
                            ...fkChoices,
                            callACL: options,
                        }
                    });
                });

                TransformationRuleSetSelectOptions((options: any) => {
                    mounted && setFkChoices((fkChoices: any) => {
                        return {
                            ...fkChoices,
                            transformationRuleSet: options,
                        }
                    });
                });

                DdiSelectOptions((options: any) => {
                    mounted && setFkChoices((fkChoices: any) => {
                        return {
                            ...fkChoices,
                            outgoingDdi: options,
                        }
                    });
                });

                LanguageSelectOptions((options: any) => {
                    mounted && setFkChoices((fkChoices: any) => {
                        return {
                            ...fkChoices,
                            language: options,
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

    const groups: Array<FieldsetGroups> = [
        {
            legend: _('Basic Configuration'),
            fields: [
                'name',
                'maxMembers',
            ]
        },
        {
            legend: _('Authentication Settings'),
            fields: [
                'pinProtected',
                'pinCode',
            ]
        },
    ];

    return (<DefaultEntityForm fkChoices={fkChoices} groups={groups} {...props} />);
}

export default Form;