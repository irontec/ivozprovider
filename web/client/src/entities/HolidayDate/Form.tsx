import useFkChoices from 'lib/entities/data/useFkChoices';
import defaultEntityBehavior, { EntityFormProps, FieldsetGroups } from 'lib/entities/DefaultEntityBehavior';
import { foreignKeyGetter } from './foreignKeyGetter';

const Form = (props: EntityFormProps): JSX.Element => {

    const { edit } = props;

    const DefaultEntityForm = defaultEntityBehavior.Form;
    const fkChoices = useFkChoices(foreignKeyGetter);
    const groups: Array<FieldsetGroups | false> = [
        {
            legend: '',
            fields: [
                edit && 'calendar',
            ],
        },
        {
            legend: '',
            fields: [
                'name',
                'locution',
            ],
        },
        {
            legend: '',
            fields: [
                'eventDate',
                'wholeDayEvent',
                'timeIn',
                'timeOut',
            ],
        },
        {
            legend: '',
            fields: [
                'routeType',
                'numberCountry',
                'numberValue',
                'voiceMailUser',
                'extension',
            ],
        },
    ];

    return (<DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />);
}

export default Form;