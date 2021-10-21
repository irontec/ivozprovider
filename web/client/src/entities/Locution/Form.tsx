import defaultEntityBehavior, { EntityFormProps, FieldsetGroups } from 'lib/entities/DefaultEntityBehavior';

const Form = (props: EntityFormProps): JSX.Element => {

    const DefaultEntityForm = defaultEntityBehavior.Form;

    const groups: Array<FieldsetGroups> = [
        {
            legend: '',
            fields: [
                'name',
                //'recordingExtension',
            ]
        },
        /*{
            legend: '',
            fields: [
                'originalFile',
                'encodedFile',
            ]
        }*/
    ];

    return (<DefaultEntityForm {...props} groups={groups} />);
}

export default Form;