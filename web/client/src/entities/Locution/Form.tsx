import defaultEntityBehavior, { EntityFormProps, FieldsetGroups } from 'lib/entities/DefaultEntityBehavior';
import { LocutionPropertyList } from './LocutionProperties';

export const foreignKeyGetter = async (): Promise<any> => {

    const response: LocutionPropertyList<Array<string | number>> = {};

    return response;
};


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
        {
            legend: '',
            fields: [
                'originalFile',
            ]
        },
        {
            legend: '',
            fields: [
                'status',
            ]
        },
    ];

    return (<DefaultEntityForm {...props} groups={groups} />);
}

export default Form;