import defaultEntityBehavior, { EntityFormProps, FieldsetGroups } from 'lib/entities/DefaultEntityBehavior';
import _ from 'lib/services/translations/translate';
import useFkChoices from './useFkChoices';

const Form = (props: EntityFormProps): JSX.Element => {

    const DefaultEntityForm = defaultEntityBehavior.Form;
    const fkChoices = useFkChoices();

    const groups: Array<FieldsetGroups> = [
        {
            legend: _('Basic Configuration'),
            fields: [
                'name',
            ]
        },
        {
            legend: _('No matching condition handler'),
            fields: [
                'locution',
                'routetype',
                'ivr',
                'huntGroup',
                'voicemailUser',
                'user',
                'numberCountry',
                'numbervalue',
                'friendvalue',
                'queue',
                'conferenceRoom',
                'extension',
            ]
        },
    ];

    return (<DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />);
}

export default Form;