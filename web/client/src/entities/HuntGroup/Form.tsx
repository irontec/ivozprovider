import useFkChoices from 'lib/entities/data/useFkChoices';
import defaultEntityBehavior, { EntityFormProps, FieldsetGroups } from 'lib/entities/DefaultEntityBehavior';
import _ from 'lib/services/translations/translate';
import { foreignKeyGetter } from './foreignKeyGetter';

const Form = (props: EntityFormProps): JSX.Element => {

    const DefaultEntityForm = defaultEntityBehavior.Form;
    const fkChoices = useFkChoices(foreignKeyGetter);

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