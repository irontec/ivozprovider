import defaultEntityBehavior, { EntityFormProps, FieldsetGroups } from 'lib/entities/DefaultEntityBehavior';
import _ from 'lib/services/translations/translate';
import useFkChoices from './useFkChoices';

const Form = (props: EntityFormProps): JSX.Element => {

    const DefaultEntityForm = defaultEntityBehavior.Form;
    const fkChoices = useFkChoices();

    const groups: Array<FieldsetGroups> = [
        {
            legend: _('Number data'),
            fields: [
                'country',
                'ddi',
                'displayName',
                'language',
            ]
        },
        {
            legend: _('Filters data'),
            fields: [
                'externalCallFilter',
            ]
        },
        {
            legend: _('Routing configuration'),
            fields: [
                'routeType',
                'user',
                'fax',
                'ivr',
                'huntGroup',
                'conferenceRoom',
                'friendValue',
                'queue',
                'residentialDevice',
                'conditionalRoute',
                'retailAccount',
            ]
        },
        {
            legend: _('Recording data'),
            fields: [
                'recordCalls',
            ]
        },
    ];

    return (<DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />);
}

export default Form;