import defaultEntityBehavior, { FieldsetGroups } from 'lib/entities/DefaultEntityBehavior';
import _ from 'lib/services/translations/translate';

const Form = (props: any) => {

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

    return (<DefaultEntityForm groups={groups} {...props} />);
}

export default Form;