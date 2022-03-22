import defaultEntityBehavior, { EntityFormProps, FieldsetGroups } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import useFkChoices from './foreignKeyGetter';

const Form = (props: EntityFormProps): JSX.Element => {

    const { entityService, match } = props;

    const service = props?.row?.service as Record<string, any> | undefined;
    const currentServiceId: number | undefined = service?.id;
    const DefaultEntityForm = defaultEntityBehavior.Form;
    const fkChoices = useFkChoices({
        entityService,
        currentServiceId,
        match
    });

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