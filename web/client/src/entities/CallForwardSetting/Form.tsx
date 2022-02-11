import useFkChoices from 'lib/entities/data/useFkChoices';
import defaultEntityBehavior, { EntityFormProps, FieldsetGroups } from 'lib/entities/DefaultEntityBehavior';
import { foreignKeyGetter } from './foreignKeyGetter';

const Form = (props: EntityFormProps): JSX.Element => {

    const DefaultEntityForm = defaultEntityBehavior.Form;
    const fkChoices = useFkChoices(foreignKeyGetter);
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