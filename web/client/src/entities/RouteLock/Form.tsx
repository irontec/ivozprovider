import defaultEntityBehavior, { EntityFormProps, FieldsetGroups } from 'lib/entities/DefaultEntityBehavior';
import _ from 'lib/services/translations/translate';
import { RouteLockPropertyList } from './RouteLockProperties';

export const foreignKeyGetter = async (): Promise<any> => {

    const response: RouteLockPropertyList<Array<string | number>> = {};

    return response;
};

const Form = (props: EntityFormProps): JSX.Element => {

    const DefaultEntityForm = defaultEntityBehavior.Form;

    const groups: Array<FieldsetGroups> = [
        {
            legend: _('Basic Configuration'),
            fields: [
                'name',
                'description',
                'open',
                'closeExtension',
                'openExtension',
                'toggleExtension',
            ]
        },
    ];

    return (<DefaultEntityForm {...props} groups={groups} />);
}

export default Form;