import defaultEntityBehavior, { EntityFormProps, FieldsetGroups } from 'lib/entities/DefaultEntityBehavior';
import { SchedulePropertyList } from './ScheduleProperties';

export const foreignKeyGetter = async (): Promise<any> => {

    const response: SchedulePropertyList<Array<string | number>> = {};

    return response;
};

const Form = (props: EntityFormProps): JSX.Element => {

    const DefaultEntityForm = defaultEntityBehavior.Form;

    const groups: Array<FieldsetGroups> = [
        {
            legend: '',
            fields: [
                'name',
            ]
        },
        {
            legend: '',
            fields: [
                'timeIn',
                'timeout',
            ]
        },
        {
            legend: '',
            fields: [
                'monday',
                'tuesday',
                'wednesday',
                'thursday',
                'friday',
                'saturday',
                'sunday',
            ]
        },
    ];

    return (<DefaultEntityForm {...props} groups={groups} />);
}

export default Form;