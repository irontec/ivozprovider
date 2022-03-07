import useFkChoices from 'lib/entities/data/useFkChoices';
import defaultEntityBehavior, { EntityFormProps, FieldsetGroups } from 'lib/entities/DefaultEntityBehavior';
import _ from 'lib/services/translations/translate';
import { foreignKeyGetter } from './foreignKeyGetter';

const Form = (props: EntityFormProps): JSX.Element => {

    const { entityService, row, match } = props;
    const DefaultEntityForm = defaultEntityBehavior.Form;
    const fkChoices = useFkChoices({
        foreignKeyGetter,
        entityService,
        row,
        match,
    });

    const groups: Array<FieldsetGroups> = [
        {
            legend: _('Basic Configuration'),
            fields: [
                'name',
            ]
        },
        {
            legend: _('Action Configuration'),
            fields: [
                'defaultAction',
                'forcedDdi',
            ]
        },
    ];

    return (<DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />);
}

export default Form;