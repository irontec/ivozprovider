import defaultEntityBehavior, { FieldsetGroups } from '../DefaultEntityBehavior';
import _ from 'services/Translations/translate';

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