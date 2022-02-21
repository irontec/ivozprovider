import useFkChoices from 'lib/entities/data/useFkChoices';
import defaultEntityBehavior, { EntityFormProps, FieldsetGroups } from 'lib/entities/DefaultEntityBehavior';
import _ from 'lib/services/translations/translate';
import {foreignKeyGetter} from './foreignKeyGetter';

const Form = (props: EntityFormProps): JSX.Element => {

    const DefaultEntityForm = defaultEntityBehavior.Form;
    const fkChoices = useFkChoices(foreignKeyGetter);

    const groups: Array<FieldsetGroups> = [
        {
            legend: _('Matching priority'),
            fields: [
                'priority',
            ]
        },
        {
            legend: _('Matching type'),
            fields: [
                'matchListIds',
                'routeLockIds',
                'scheduleIds',
                'calendarIds',
            ]
        },
        {
            legend: _('Matching handler'),
            fields: [
                'locution',
                'routeType',
                'numberCountry',
                'numberValue',
                'ivr',
                'user',
                'huntGroup',
                'voicemailUser',
                'friendValue',
                'queue',
                'conferenceRoom',
                'extension',
            ]
        },
    ];

    return (<DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />);
}

export default Form;