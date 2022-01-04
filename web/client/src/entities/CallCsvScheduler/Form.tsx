import defaultEntityBehavior, { EntityFormProps, FieldsetGroups } from 'lib/entities/DefaultEntityBehavior';
import _ from 'lib/services/translations/translate';
import useFkChoices from './useFkChoices';

const Form = (props: EntityFormProps): JSX.Element => {

    const DefaultEntityForm = defaultEntityBehavior.Form;
    const fkChoices = useFkChoices();

    const groups: Array<FieldsetGroups> = [
        {
            legend: _('Basic Information'),
            fields: [
                'name',
                'email',
            ]
        },
        {
            legend: _('Time Information'),
            fields: [
                'frequency',
                'unit',
                'nextExecution',
                'lastExecution',
            ]
        },
        {
            legend: _('Filters'),
            fields: [
                'callDirection',
                'ddi',
                'retailAccount',
                'residentialDevice',
                'endpointType',
                'user',
                'fax',
                'friend',
            ]
        },
    ];

    return (<DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />);
}

export default Form;