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
                'weight',
                'strategy',
            ]
        },
        {
            legend: _('Announce'),
            fields: [
                'periodicAnnounceLocution',
                'periodicAnnounceFrequency',
            ]
        },
        {
            legend: _('Members configuration'),
            fields: [
                'memberCallTimeout',
                'memberCallRest',
                'preventMissedCalls',
            ]
        },
        {
            legend: _('Timeout configuration'),
            fields: [
                'maxWaitTime',
                'timeoutLocution',
                'timeoutTargetType',
                'timeoutExtension',
                'timeoutVoiceMailUser',
                'timeoutNumberCountry',
                'timeoutNumberValue',
            ]
        },
        {
            legend: _('Full Queue configuration'),
            fields: [
                'maxlen',
                'fullLocution',
                'fullTargetType',
                'fullExtension',
                'fullVoiceMailUser',
                'fullNumberCountry',
                'fullNumberValue',
            ]
        },
    ];

    return (<DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />);
}

export default Form;