import defaultEntityBehavior, { EntityFormProps, FieldsetGroups } from 'lib/entities/DefaultEntityBehavior';
import useFkChoices from './useFkChoices';

const Form = (props: EntityFormProps): JSX.Element => {

    const DefaultEntityForm = defaultEntityBehavior.Form;
    const fkChoices = useFkChoices();

    const groups: Array<FieldsetGroups> = [
        {
            legend: '',
            fields: [
                'number',
            ]
        },
        {
            legend: '',
            fields: [
                'routeType',
                'ivr',
                'huntGroup',
                'conferenceRoom',
                'user',
                'numberCountry',
                'numberValue',
                'friendValue',
                'queue',
                'conditionalRoute',
            ]
        },
    ];

    return (<DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />);
}

export default Form;