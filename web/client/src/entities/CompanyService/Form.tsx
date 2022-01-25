import defaultEntityBehavior, { EntityFormProps, FieldsetGroups } from 'lib/entities/DefaultEntityBehavior';
import useFkChoices from './useFkChoices';

const Form = (props: EntityFormProps): JSX.Element => {

    const currentServiceId: number | undefined = props?.row?.service?.id;
    const DefaultEntityForm = defaultEntityBehavior.Form;
    const fkChoices = useFkChoices(currentServiceId);

    const groups: Array<FieldsetGroups> = [
        {
            legend: '',
            fields: [
                'service',
                'code',
            ]
        }
    ];

    const readOnlyProperties = {
        service: props.edit ? true : false,
    };

    return (<DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} readOnlyProperties={readOnlyProperties} />);
}

export default Form;