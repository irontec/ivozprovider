import useFkChoices from 'lib/entities/data/useFkChoices';
import defaultEntityBehavior, { EntityFormProps, FieldsetGroups } from 'lib/entities/DefaultEntityBehavior';
import _ from 'lib/services/translations/translate';
import {foreignKeyGetter} from "../Queue/foreignKeyGetter";

const Form = (props: EntityFormProps): JSX.Element => {

    const { entityService, row, match } = props;
    const userVoicemail = row?.user != undefined;

    const DefaultEntityForm = defaultEntityBehavior.Form;
    const fkChoices = useFkChoices({
        foreignKeyGetter,
        entityService,
        row,
        match,
    });

    const readOnlyProperties = {
        name: userVoicemail,
        email: userVoicemail,
    };

    const groups: Array<FieldsetGroups> = [
        {
            legend: _('Basic configuration'),
            fields: [
                'enabled',
                'name',
            ]
        },
        {
            legend: _('Notification configuration'),
            fields: [
                'sendMail',
                'email',
                'attachSound',
            ]
        },
        {
            legend: _('Customization'),
            fields: [
                'locution',
            ]
        },
    ];

    return (<DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} readOnlyProperties={readOnlyProperties} />);
};

export default Form;