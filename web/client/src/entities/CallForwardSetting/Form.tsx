import defaultEntityBehavior, { EntityFormProps, FieldsetGroups } from 'lib/entities/DefaultEntityBehavior';
import useFkChoices from './useFkChoices';

const Form = (props: EntityFormProps): JSX.Element => {

    const DefaultEntityForm = defaultEntityBehavior.Form;
    const fkChoices = useFkChoices();
    const groups: Array<FieldsetGroups> = [
        {
            legend: '',
            fields: [
                'enabled',
                'callTypeFilter',
                'callForwardType',
                'noAnswerTimeout',
                'targetType',
                'extension',
                'voiceMailUser',
                'numberCountry',
                'numberValue',
                'cfwToretailAccount',
            ]
        },
    ];

    return (<DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />);
}

export default Form;